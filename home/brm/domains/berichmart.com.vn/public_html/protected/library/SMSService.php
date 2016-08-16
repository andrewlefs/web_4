<?php

error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
//error_reporting(0);
define('APP_PATH', dirname(__FILE__));

require_once APP_PATH . DIRECTORY_SEPARATOR . 'protected' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'MySQL.php';
require_once APP_PATH . DIRECTORY_SEPARATOR . 'protected' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'Member.php';
require_once APP_PATH . DIRECTORY_SEPARATOR . 'protected' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'NuSOAP' . DIRECTORY_SEPARATOR . 'nusoap.php';
$server = new soap_server();

$dbconfig = array(
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '123',
    'name' => 'esccard'
);

function sentMt($params) {
  
    $msgbody = ' (ESC '.date('H:i A').') '.$params['message'];
    $reqtime = gmdate("YmdHis", time()+(7*3600));
    
    $db = db_mysql::getInstance();
    $result = $db->fetch($db->query("SELECT MT_ID FROM sms_mo WHERE MO_ID='".$params['modid']."' LIMIT 1"));
    
    $mtseq = $result->MT_ID;
    $moid = $params['modid'];
    $moseq = $params['moseq'];
    $dest = $params['dest'];
    $src = $params['src'];
    $cmdcode = $params['cmdcode'];
    $opid = $params['opid'];
    // Khai bao MT:
    $msgtype='Text';
    $msgtitle='';
    $mttotalseg='1';
    $mtseqref='1';
    $cpid='296';
    $procresult='1';
    $username='esc';
    $password='YY8uLyYNLT';

    //Khai bao client
    $WSDL = "http://www.mymobile.com.vn/SMSAPIWS/SMSAgentWS.asmx?wsdl";
    $client = new nusoap_client($WSDL, true);
    $client->soap_defencoding = 'UTF-8';
    $status = $client->call('SendMT', array('mtseq'=>$mtseq,
    'moid'=>$moid,
    'moseq'=>$moseq,
    'src'=>$dest,
    'dest'=>$src,
    'cmdcode'=>$cmdcode,
    'msgbody'=>$msgbody,
    'msgtype'=>$msgtype,
    'msgtitle'=>$msgtitle,
    'mttotalseg'=>$mttotalseg,
    'mtseqref'=>$mtseqref,
    'cpid'=>$cpid,
    'reqtime'=>$reqtime,
    'procresult'=>$procresult,
    'opid'=>$opid,
    'username'=>$username,
    'password'=>$password));

    $tthai = $status['SendMTResult'];
//    $msgbody .= $src;
    $requesttime = gmdate("Y-m-d H:i:s", time()+(7*3600));
	// Luu tin gui di vao bang sms_mt
    $db->query("INSERT INTO sms_mt(mtseq, moid, moseq, src, dest, cmdcode, msgbody, msgtype, msgtitle, mttotalseg, mtseqref, cpid, reqtime, procresult, opid, Status) 
            VALUES ('$mtseq','$moid','$moseq','$dest',$src,'$cmdcode','$msgbody','$msgtype','$msgtitle','$mttotalseg','$mtseqref','$cpid','$requesttime','$procresult','$opid','$tthai')");
    if($status['SendMTResult'] == 202){
        // cap nhat trang thai neu la 202
        $db->query("UPDATE sms_mo SET Status = 202 WHERE MT_ID=$mtseq");		
    }
}

function responseCardSerial($sms, $currentUser) {
    $codeLength = strlen($sms);
    $provider = '';
    $gia = '';
    for ($i = 0; $i < $codeLength; $i++) {
        if (is_numeric($sms{$i}))
            $gia .= $sms{$i};
        else
            $provider .= $sms{$i};
    }
    $gia .= '000';
    $db = db_mysql::getInstance();
    // get card provider
    $query = $db->query("SELECT `Id`, `CName` FROM `procatagory` WHERE `sms_code` = '" . $provider . "' AND `Published` = 1 LIMIT 1");
    if ($db->num_rows($query) > 0) {
        $query = $db->fetch($query);
        $provider = $query;

        // get price
        $query = $db->query("SELECT * FROM `prosub` WHERE `SCatID` = '" . $provider->Id . "' AND `SPrice` = '" . $gia . "' AND `Published` = 1 LIMIT 1");
        if ($db->num_rows($query) > 0) {
            // check chiet khau
            $price = $db->fetch($query);
            $chietkhau = ($price->SDiscount * $gia) / 100;
            // chiet khau truc tiep (cap 1)
            $chietkhau = ($chietkhau * $price->CKhau1) / 100;
            $thanhtien = $price->SPrice - $chietkhau;

            if ($currentUser->Gold < $thanhtien) {
                return 'not_eno_money';
            } else {
                // get card serial
                $query = $db->query("SELECT `Id`, `Code` FROM `prodata` WHERE `SubId` = '" . $price->Id . "' AND `Published` = 1 LIMIT 1");
                if ($db->num_rows($query) > 0) {
                    $card = $db->fetch($query);
                    // update user current money
                    $giamua = $thanhtien;
                    //$giamua = $thanhtien - $chietkhau;
                    $db->query("UPDATE `member` SET `Gold` = `Gold` - $giamua WHERE `Id` = '" . $currentUser->Id . "'");

                    // update commission
                    $db->query("INSERT INTO `commission` (MemberId, Money, CreateDate) VALUES (" . $currentUser->Id . ", '" . $chietkhau . "', NOW())");

                    // update chiet khau cho cac thanh vien
                    if ($currentUser->Parent) {
                        // chuyen tien cho cac thanh vien duoc huong hoa hong
                        Member::getParentTree(2, $currentUser->Parent, true); // lay len 6 cap, 2 -> 7
                        $parentTree = Member::getMemberTreeArray();
                        if (!empty($parentTree)) {
                            $discount = ($price->SDiscount * $gia) / 100;
                            foreach ($parentTree as $ckhau => $parent) {
                                // chiet khau cac cap
                                $level = 'CKhau' . $ckhau;
                                $duocHuong = ($discount * $price->$level) / 100;
                                // update money
                                $db->query("UPDATE `member` SET `Gold` = `Gold` + $duocHuong WHERE `Id` = '" . $parent['Id'] . "'");

                                // update commission
                                $db->query("INSERT INTO `commission` (MemberId, Money, CreateDate) VALUES (" . $parent['Id'] . ", '" . $duocHuong . "', NOW())");
                            }
                        }
                    }
                    // update histran
                    $totalDiscount = array(
                        'CKhau1' => $price->CKhau1,
                        'CKhau2' => $price->CKhau2,
                        'CKhau3' => $price->CKhau3,
                        'CKhau4' => $price->CKhau4,
                        'CKhau5' => $price->CKhau5,
                        'CKhau6' => $price->CKhau6,
                        'CKhau7' => $price->CKhau7,
                    );
                    $cardArray = array();
                    $cardArray[] = $card->Code;
                    $db->query("INSERT INTO `histrans` (TMoney, TDiscount, TSub, TotalDiscount, TProId, TDate, AuthorId) VALUES ('" . $price->SPrice . "', '" . $price->SDiscount . "','" . $price->Id . "','" . serialize($totalDiscount) . "','" . serialize($cardArray) . "','" . date('Y-m-d H:i:s') . "','" . $currentUser->Id . "')");
                    $ngayxuat = time();
                    $nguoimua = $currentUser->Phone;
                    // update card to buyed status
                    $db->query("UPDATE `prodata` SET `Published` = '0', `Userbuy`= '" . $nguoimua . "', `OutDate`= '" . $ngayxuat . "' WHERE `Id` = '" . $card->Id . "'");
                    return 'Quy khach vua mua the: ' . $provider->CName . ', so serial/ma cua the la: ' . $card->Code;
                } else {
                    return 'not_card';
                }
            }
        } else {
            return 'invalid_price';
        }
    }
    else
        return 'invalid_provider';
}

function activeUser($phone) {
    $pattern = '/^84(\d+)/i';
    $replacement = '0$1';
    $phone = preg_replace($pattern, $replacement, $phone);
    $db = db_mysql::getInstance();
    $query = $db->query("SELECT `Id`, `Parent`, `Username`, `Gold2` FROM `member` WHERE `Phone` = '" . $phone . "' AND `Published` = 0 LIMIT 1");

    if ($db->num_rows($query) > 0) {
           $query = $db->fetch($query);
            // Check tai khoan dang ky cap 1
                $chek444 = $query->Parent ; 
                $chek555 = $chek444-1; 
                if ($chek555 != 0){
                $diemtt = '10000';
                $status = '1';
                $db->query("UPDATE `member` SET `Published` = $status , `Gold2` = $diemtt  WHERE `Id` = '" . $query->Id . "' LIMIT 1");
                // update chiet khau cho cac thanh vien
                if ($query->Parent) {
                    // chuyen tien cho cac thanh vien duoc huong hoa hong
                    // Day la cho con thieu. 
                    Member::getParentTree(2, $query->Parent, true); // lay len 6 cap, 2 -> 7
                    $parentTree = Member::getMemberTreeArray();
                    if (!empty($parentTree)) {
                        $addMoneyArr = array(
                            2 => 5000,
                            3 => 1000,
                            4 => 1000,
                            5 => 0,
                            6 => 0,
                            7 => 0
                        );
                        foreach ($parentTree as $level => $parent) {
                            $money = $addMoneyArr[$level];
                            if($money)
                                $db->query("UPDATE `member` SET `Published` = $status , `Gold2` = `Gold2` + $money  WHERE `Id` = '" . $parent['Id'] . "' LIMIT 1");
                        }
                    }
                }
                return 'Quy khach da kich hoat thanh cong, Ban duoc thuong ' . $diemtt . 'D dien tich luy ';
            } 

        return 'Tai khoan '.$phone.' dang duoc kiem duyet. xin vui long lien he dien thoai: 0983.018866 de duoc huong dan them.'; 
   } 
    else {
        return 'Thanh vien da duoc kich hoat.';
    }
}

function getUserPassword($phone) {
    $pattern = '/^84(\d+)/i';
    $replacement = '0$1';
    $phone = preg_replace($pattern, $replacement, $phone);
    $db = db_mysql::getInstance();
    $query = $db->query("SELECT `Id`, `Username` FROM `member` WHERE `Phone` = '" . $phone . "' LIMIT 1");
    if ($db->num_rows($query) > 0) {
        $query = $db->fetch($query);
        $username = $query->Username;
             // Generate password
            $newPassword = sprintf('%x', crc32($username . time()));
            // update into database
            $secKey = "Xyz123";
            $pass = md5($secKey . $newPassword);
            $db->query("UPDATE `member` SET `Password` = '" . $pass . "' WHERE `Id` = '" . $query->Id . "'");
            return $newPassword;
    } else {
        return 'not_reg';
    }
}

// Dang ky thanh vien moi
//Chuyen Khoan
function getchager($currentUser, $money, $phone1) {
    $pattern = '/^84(\d+)/i';
    $replacement = '0$1';
    $time = time() - (15 * 60);
    $money1 = intval($money);
    $phone1 = preg_replace($pattern, $replacement, $phone1);
    $db = db_mysql::getInstance();
    $tien1 = $currentUser->Gold;
    $tien2 = $tien1 - $money1;
    if ($money1 >= 1000) {

        if ($tien2 >= 0) {
            $query2 = $db->query("SELECT `Id`, `Phone`, `Username` FROM `member` WHERE `Phone` = '" . $phone1 . "' LIMIT 1");
            if ($db->num_rows($query2) > 0) {
                $query2 = $db->fetch($query2);
                $sedto = $query2;
                $db->query("UPDATE `member` SET `Gold` = `Gold` - $money1 WHERE `Id` = '" . $currentUser->Id . "'");
                $db->query("UPDATE `member` SET `Gold` = `Gold` + $money1 WHERE `Id` = '" . $sedto->Id . "'");
                $db->query("INSERT INTO `histranfer` (Money, FromID, ToID, CreateDate) VALUES (" . $money1 . ", '" . $currentUser->Id . "', '" . $sedto->Id . "', NOW())");
                return 'Quy khach da chuyen thanh cong ' . number_format($money1) . ' EV tu tai khoan: ' . $currentUser->Phone . ' den tai khoan: ' . $phone1 . ' Cam on da su dung dich vu cua ESC.';
            } else {
                return 'invalid_phoneto';
            }
        } else {
            return 'invalid_money';
        }
    } else {
        return 'invalid_nozo';
    }
}

//Het Chuyen khoan
function newUser($phone, $Identity, $phone2) {
    $pattern = '/^84(\d+)/i';
    $replacement = '0$1';
    $mamoi = '';
    $phone = preg_replace($pattern, $replacement, $phone);
    $Identity = preg_replace($pattern, $replacement, $Identity);
    $phone2 = preg_replace($pattern, $replacement, $phone2);
    $ngaydang = time();
    // Generate password
    $newPassword = sprintf('%x', crc32($phone . time()));
    // update into database
    $secKey = "Xyz123";
    $pass = md5($secKey . $newPassword);
    $db = db_mysql::getInstance();
    $query = $db->query("SELECT `Id`, `Username` FROM `member` WHERE `Phone` = '" . $phone2 . "' AND `Published` = 1 LIMIT 1");
    if ($db->num_rows($query) > 0) {
        $query = $db->fetch($query);
        $mamoi = $query;
        $tien = 10000;
        $db->query("INSERT INTO `member` (Username, FullName, Parent, Phone, Identity, Code, Gold, GroupID, Password, Email, Published, CreateDate, Gold2) VALUES ('" . $phone . "', 'SMS', " . $mamoi->Id . ", '" . $phone . "', '" . $Identity . "', 'ESC-" . $Identity . "', '0', '2', '" . $pass . "', 'esc" . $ngaydang . "@escgroup.vn', '1' , '" . $ngaydang . "', '".$tien."')");
        
        Member::getParentTree(2, $mamoi->Id, true); // lay len 6 cap, 2 -> 7
        $parentTree = Member::getMemberTreeArray();
        if (!empty($parentTree)) {
            $addMoneyArr = array(
                2 => 5000,
                3 => 1000,
                4 => 1000,
                5 => 0,
                6 => 0,
                7 => 0
            );
            foreach ($parentTree as $level => $parent) {
                $money = $addMoneyArr[$level];
                if($money)
                    $db->query("UPDATE `member` SET `Gold2` = `Gold2` + $money  WHERE `Id` = '" . $parent['Id'] . "' LIMIT 1");
            }
        }
        //return "Quy khach da dang ky thanh cong. Ten dang nhap:" . $phone . ", mat khau: " . $newPassword . ", Website dang nhap: www.esccard.vn.";        
        return "Quy khach da dang ky thanh cong. Ten dang nhap:" . $phone . ", mat khau: " . $newPassword . ", Website dang nhap: www.esccard.vn.";
    } else {
        return "So dien thoai " . $phone2 . " moi ko co, Quy khach vui long lien he lai voi thanh vien ESC hoac truy cap www.esccard.vn de duoc huong dan. Xin cam on!.";
    }
}

// Ket thuc dang ky thanh vien moi //
function getCurrentUserKH($phone) {
    $pattern = '/^84(\d+)/i';
    $replacement = '0$1';
    $phone = preg_replace($pattern, $replacement, $phone);

    // get user
    $db = db_mysql::getInstance();
    $query = $db->query("SELECT `Id`, `Username`, `Phone`, `Gold`, `Gold2`, `Parent`, `Published` FROM `member` WHERE `Phone` = '" . $phone . "' LIMIT 1");
    if ($db->num_rows($query) > 0) {
        $query = $db->fetch($query);
        return $query;
    } else {
        return 'invalid_user';
    }
}

function getCurrentUser($phone) {
    $pattern = '/^84(\d+)/i';
    $replacement = '0$1';
    $phone = preg_replace($pattern, $replacement, $phone);

    // get user
    $db = db_mysql::getInstance();
    $query = $db->query("SELECT `Id`, `Username`, `Phone`, `Gold`, `Gold2`, `Parent`, `Published` FROM `member` WHERE `Phone` = '" . $phone . "' AND `Published` = 1 LIMIT 1");
    if ($db->num_rows($query) > 0) {
        $query = $db->fetch($query);
        return $query;
    } else {
        return 'invalid_user';
    }
}

// Nguoi nhan
function getReUser($phone1) {
    $pattern = '/^84(\d+)/i';
    $replacement = '0$1';
    $phone1 = preg_replace($pattern, $replacement, $phone1);

    // get user
    $db = db_mysql::getInstance();
    $query = $db->query("SELECT `Id`, `Username`, `Gold` FROM `member` WHERE `Phone` = '" . $phone1 . "' LIMIT 1");
    if ($db->num_rows($query) > 0) {
        $query = $db->fetch($query);
        return $query;
    } else {
        return 'invalid_vic';
    }
}

function getTotalChuyen($usrID) {
    $db = db_mysql::getInstance();
    $query = $db->query("SELECT `Id` FROM `hismn` WHERE `FromID` = '" . $usrID . "'");
    return $db->num_rows($query);
}

//Ket thuc nguoi nhan
//function ReceiveMO($moid, $moseq, $src, $dest, $cmdcode, $msgbody, $opid, $username, $password)
function ReceiveMO($moid, $moseq, $src, $dest, $cmdcode, $msgbody, $opid, $username, $password) {
    $msgbody = strtoupper($msgbody);
    $cmdcode = strtoupper($cmdcode);

    if (strtolower($username) != 'escsmsservice' OR strtolower($password) != 'esc_hoanggia') {
        // sai username hoac password
        return 404;
    }
    
    $requesttime = gmdate("Y-m-d H:i:s", time()+(7*3600));
    $db = db_mysql::getInstance();
    $db->query("INSERT INTO sms_mo(MO_ID, MOSEQ, UserID, ServiceID, CommnadCode, MsgBody, OpID, Requesttime) VALUES ('$moid','$moseq','$src','$dest','$cmdcode','$msgbody','$opid','$requesttime')");

    $params = array();
    // sms table
    $params['modid'] = $moid;
    $params['src'] = $src;
    $params['moseq'] = $moseq;
    $params['dest'] = $dest;
    $params['cmdcode'] = $cmdcode;
    $params['opid'] = $opid;
    
    // process sms
    $sms = explode(' ', $msgbody);
    if (!is_array($sms)) {
        // cu phap tin nhan khong chinh xac
        $params['message'] = 'Ma dich vu khong dung. Quy khach vui long lien he 043 5501189 . Hoac truy cap website http://www.esccard.vn de duoc ho tro.';
        sentMt($params);
        return 200;
    }

    if ($sms[0] == 'ESC' AND isset($sms[1]) AND $sms[1] == 'SD') {
        $currentUser = getCurrentUser($src);
        if ($currentUser == 'invalid_user') {
            $params['message'] = 'So tai khoan/dien thoai nay khong hop le, Quy khach vui long truy cap website www.esccard.vn de dang ky.';
        } else {
            $params['message'] = 'So du kha dung cua Quy khach la: ' . number_format($currentUser->Gold) . ' EV, Diem tich luy cua Quy khach la: ' . number_format($currentUser->Gold2) . ' D. Cam on da su dung dich vu cua ESC.';
        }
        sentMt($params);
        return 200;
    }
    // Lam ma thay the
    
// Huu bat dau lam dang ky nhanh


    if (!in_array($sms[0], array('EMK', 'EMU', 'EDK', 'ECK', 'EM21', 'EXN'))) {
        $params['message'] = 'Ma dich vu khong dung. Quy khach vui long lien he 043 5501189 . Hoac truy cap website http://www.esccard.vn de duoc ho tro.';
        sentMt($params);
        return 200;
    }

    if ($sms[0] == 'EMK' AND !isset($sms[1])) {
        $pass = getUserPassword($src);
        if ($pass == 'not_reg') {
            $params['message'] = 'Quy khach khong phai la thanh vien cua ESC. Xin vui long dang ky truoc.';
        } else {
            $params['message'] = 'Mat khau moi cua quy khach la: ' . $pass;
        }
    }
    //fdsfhsf
    else if ($sms[0] == 'EXN') {
        $currentUser = getCurrentUser($src);
        $currentUserKH = getCurrentUserKH($src);
        $esckh = activeUser($src);
        if ($currentUserKH == 'invalid_user') {
            $params['message'] = 'Quy khach khong phai la thanh vien cua ESC. Xin vui long dang ky truoc.';
        } else {
            $params['message'] = $esckh;
        }
        sentMt($params);
        return 200;
    }
    ///fdjsfkld
    // Dang ky
    elseif ($sms[0] == 'EDK') {
        $currentUser = getCurrentUser($src);
        $escdk = newUser($src, $sms[1], $sms[2]);
        if ($currentUser == 'invalid_user') {
            $params['message'] = $escdk;
        } else {
            $params['message'] = 'So dien thoai nay da ton tai, de lay lai mat khau soan tin: EMK gui 8088. De xem cac huong dan giao dich khac, vui long truy cap www.esccard.vn. Xin cam on!';
        }
        sentMt($params);
        return 200;
    }
    // Ket thuc dang ky thanh tien moi
    // Chuyen khoan
    elseif ($sms[0] == 'ECK' AND !isset($sms[3])) {
        $currentUser = getCurrentUser($src); // check so dien thoai chuyen di
        $chagemoney = getchager($src, $sms[1], $sms[2]);
        if ($currentUser == 'invalid_user') {
            $params['message'] = 'Quy khach vui long dang ky lam thanh vien cua ESC truoc khi su dung dich vu nay.';
        } else {
            $status = getchager($currentUser, $sms[1], $sms[2]); ///invalid_nozo
            if ($status == 'invalid_nozo') {
                $params['message'] = 'So tien can chuyen phai lon 1.000 EV. Chi tiet xem tai website www.esccard.vn.';
            } elseif ($status == 'invalid_money') {
                $params['message'] = 'So du trong TK khong du de thuc hien, xin vui long nap them. Chi tiet xem tai website www.esccard.vn.';
            } elseif ($status == 'invalid_phoneto') {
                $params['message'] = 'Tai khoan nhan khong co thuc, xim vui long kiem tra lai.';
            } else {
                $params['message'] = $status;
            }
        }
    }
    // Chuyen khoan
    elseif ($sms[0] == 'EMU' AND !isset($sms[2])) {
        $currentUser = getCurrentUser($src);
        if ($currentUser == 'invalid_user') {
            $params['message'] = 'Tai khoan khong co thuc hoac chua kich hoat.';
        } else {
            $status = responseCardSerial($sms[1], $currentUser);
            if ($status == 'invalid_provider') {
                $params['message'] = 'Ma dich vu khong dung. Quy khach vui long lien he 043 5501189 . Hoac truy cap website http://www.esccard.vn de duoc ho tro.';
            } elseif ($status == 'invalid_price') {
                $params['message'] = 'Menh gia the quy khach can mua khong chinh xac.';
            } elseif ($status == 'not_card') {
                $params['message'] = 'Loai the quy khach can mua da het. Xin vui long thong bao cho ban quan tri www.esccard.vn';
            } elseif ($status == 'not_eno_money') {
                $params['message'] = 'So tien trong tai khoan cua quy khach khong du de thuc hien giao dich. Vui long truy cap http://esccard.vn de nap them tien vao tai khoan.';
            } else {
                $params['message'] = $status;
            }
        }
    }
    // chuyen tu tai khoan 2 sang 1
    elseif($sms[0] == 'EM21') {
        $currentUser = getCurrentUser($src);
        if ($currentUser == 'invalid_user') {
            $params['message'] = 'Quy khach khong phai la thanh vien cua ESC. Xin vui long dang ky truoc.';
        } else {
          Member::getMemberTotal($currentUser->Id, 3); // level la so cap can lay bat dau tu 1 
          $totalMember = Member::getTotalMemberCount();
           // $dktt = 125; Dieu kien thanh vien cap 3 la 125
             $dktt = 0; // Tao song cho thanh vien xuong.
            if($totalMember < $dktt) {
                $params['message'] = 'Tong so thanh vien cap 3 cua ban la '.$totalMember.' va Diem tich luy cua ban la '.$currentUser->Gold2.' diem, chua du dieu kien doi diem tich luy thanh so du kha dung. Xin vui long kiem tra lai, chi tiet xem tai www.esccard.vn.';
            } else {
                // chuyen tien 
                $totalChuyen = getTotalChuyen($currentUser->Id);
                $db = db_mysql::getInstance();
                $update = false;
                if($totalChuyen >= 1) {
                    // da co, chi chuyen dc 50%
                    $tienchuyen = ceil($currentUser->Gold2 / 2);
                    $gold2 = 0;
                    $gold1 = $currentUser->Gold + $tienchuyen;
                    $update = true;
                } else {
                    $tienchuyen = 150000;// gioi han so tien chuyen lan 1
                    $tienchuyen = 50000; // Tao song
                    if($currentUser->Gold2 < $tienchuyen) {
                        $params['message'] = 'So tien cua ban chua du ' . $tienchuyen . '. Xin vui long kiem tra lai.';
                    } else {
                        $gold2 = $currentUser->Gold2 - $tienchuyen;
                        $gold1 = $currentUser->Gold + $tienchuyen;
                        $update = true;
                    }
                }
                
                if($update) {
                    $db->query("UPDATE `member` SET `Gold` = $gold1, `Gold2` = $gold2  WHERE `Id` = '" . $currentUser->Id . "' LIMIT 1");
                    $db->query("INSERT INTO `hismn` (Money, FromID, CreateDate) VALUES ('".$tienchuyen."', ".$currentUser->Id.", NOW())");
                    $params['message'] = 'Quy khach da doi thanh cong '.$currentUser->Gold2.' D thanh '.$tienchuyen.' EV, so diem tich luy cua ban con '.$gold2.' D. Cam on quy khach da su dung dich vu cua ESC!';
                }
            }
        }
    }
    else {
        $params['message'] = 'Ma dich vu khong dung. Quy khach vui long lien he 043 5501189 . Hoac truy cap website http://www.esccard.vn de duoc ho tro.';
    }
    
    sentMt($params);
    return 200;
}

$requestService = array(
    'moid' => 'xsd:string',
    'moseq' => 'xsd:string',
    'src' => 'xsd:string',
    'dest' => 'xsd:string',
    'cmdcode' => 'xsd:string',
    'msgbody' => 'xsd:string',
    'opid' => 'xsd:string',
    'username' => 'xsd:string',
    'password' => 'xsd:string'
);

$responseService = array(
    'ReceiveMOResult' => 'xsd:int'
);

$server->configureWSDL('ReceiveMO', 'urn:ReceiveMO');
$server->register("ReceiveMO", $requestService, $responseService);
$query = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($query);