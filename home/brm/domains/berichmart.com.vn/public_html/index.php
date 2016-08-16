<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
 date_default_timezone_set('asia/saigon');
require_once($yii);
Yii::createWebApplication($config)->run();

// mang add code rand dom
function addCode($string,$key,$string_key="dher12af35"){
    switch ($key){
        case 1:
            $string .= $string_key;
            $string = strrev($string);
            break;
        case 2:
            $string = strrev($string);
            $string .= $string_key;
            break;
        case 3:
            $string = $string_key.$string; 
            $string = strrev($string);
            break;
        case 4:
            $string = strrev($string);
            $string = $string_key.$string;
            break;
        case 5:
            $string = encrypt($string);
            $string = strrev($string);            
    }    
    return encrypt($string);
}
function getString($stringCode,$key,$string_key="dher12af35"){
    $string = decrypt($stringCode);
    switch ($key){
        case 1:
            $string = strrev($string);
            $string = substr($string, 0,  strlen($string) - strlen($string_key));
            break;
        case 2:
            $string = substr($string, 0,  strlen($string) - strlen($string_key));
            $string = strrev($string);
            break;
        case 3:            
            $string = strrev($string); 
            $string = substr($string, strlen($string_key)); 
            break;
        case 4:
            $string = substr($string, strlen($string_key));
            $string = strrev($string);
            break;
        case 5:            
            $string = strrev($string);
            $string = decrypt($string);             
    }    
    return $string;
}

// url den thu muc admin
function getURL($type=null){
        return Yii::app()->request->baseUrl.'/';
}

// khai bao ham pr
 function pr($arr){
     echo "<pre>"; print_r($arr); echo "</pre>"; 
 }
 
 // ham tra ve session
 function getSession(){     
    $session = new CHttpSession;      
    $session->open();
    return $session;
 }
 
 // return tiny
 function tiny($obj,$option){
     $obj->renderPartial('/helper/tiny',array('option'=>$option));
 }
 
 // return ckeditor
 function ckeditor($obj,$option){
     $obj->renderPartial('/helper/ckeditor',array('option'=>$option));
 }
 
 // show iframe upload
 function showUpload($id){
     $data = '<span class="button button2" style="margin-left: 10px; cursor: pointer;" onclick="showIframe(';
     $data.= "'$id');";
     $data .= '">Upload</span>';
     //'<span style="margin-left: 10px; cursor: pointer;" onclick="showIframe('Product_image');">Upload</span>';
     return $data;
 }
 
 // check Login admin
 function checkLogin($object){
    $session = getSession();    
    if(!isset($session['user']['id'])){ 
        $object->redirect(array('login/login'));        
    } else return true;
 }
 
 // check Login member
 function checkLoginMember($object){
    $session = getSession();    
    if(!isset($session['member'])){ 
        $object->redirect(array('/dang-nhap'));        
    } else return true;
 }

 function encrypt($string, $key = "a12bc57de") {
  $result = '';
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)+ord($keychar));
    $result.=$char;
  }

  return base64_encode($result);
}

function decrypt($string, $key = "a12bc57de") {
  $result = '';
  $string = base64_decode($string);

  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)-ord($keychar));
    $result.=$char;
  }

  return $result;
}

function char($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
    $str = preg_replace("/(đ|Đ)/", 'd', $str);
    $str = preg_replace("/(B)/", 'b', $str);
    $str = preg_replace("/(%)/", '', $str);
    $str = preg_replace("/( - )/", '-', $str);
    $str = preg_replace("/( )/", '-', $str);
    $str = preg_replace("/(  )/", '-', $str);
    $str = preg_replace("/(   )/", '-', $str);
    $str = preg_replace("/(    )/", '-', $str);
    $str = preg_replace("/(C)/", 'c', $str);
    $str = preg_replace("/(G)/", 'g', $str);
    $str = preg_replace("/(L)/", 'l', $str);
    $str = preg_replace("/(M)/", 'm', $str);
    $str = preg_replace("/(N)/", 'n', $str);
    $str = preg_replace("/(H)/", 'h', $str);
    $str = preg_replace("/(T)/", 't', $str);
    $str = preg_replace("/(K)/", 'k', $str);
    $str = preg_replace("/(S)/", 's', $str);
    $str = preg_replace("/(R)/", 'r', $str);
    $str = preg_replace("/(V)/", 'v', $str);
    $str = preg_replace("/(Y)/", 'y', $str);
    $str = preg_replace("/(W)/", 'w', $str);
	
    return trim($str);
}

function getTimeAgo($time){ // $time la ket qua cua phep tru mktime cua ngay hien tai va ngay trong database
    $phut = 60;
    $gio = 3600;
    $ngay = $gio * 24;
    $result = '';   
    if($time >$ngay){
        $time_du = $time%$ngay;
        $day = ($time-$time_du)/$ngay;
        $result=$day.' ngày ';
        $result .= getTimeAgo($time_du);        
    } 
    else if($time>$gio){
        $time_du = $time%$gio;
        $hour = ($time-$time_du)/$gio;
        $result=$hour.' giờ ';
        $result .= getTimeAgo($time_du); 
    }
    else if($time>$phut){
        $time_du = $time%$phut;
        $minute = ($time-$time_du)/$phut;
        $result=$minute.' phút ';
        $result .= getTimeAgo($time_du); 
    }
    else $result=$time.' giây ';
    return $result;
}

function convertArray($array){   
    $result=array();
    foreach($array as $e)
        $result[$e['id']]=$e;
    return $result;
}
// gan array 1 vao array 2
function pasteArray($array1,$array2){
    $result = $array2;
    //
    foreach($array1 as $key=>$value){
        if(!isset($result[$key]))
            $result[$key]=Null;
    }
}

// cat chuoi
function substring($string, $length = 0, $append = '...')
    {
         $start = 0;
        $stringLast = "";
        if ($start < 0 || $length < 0 || strlen($string) <= $length)
        {
            $stringLast = $string;
        }
        else
        {
            $i = 0;
            while ($i < $length)
            {
                $stringTMP = substr($string, $i, 1);
                if ( ord($stringTMP) >=224 )
                {
                    $stringTMP = substr($string, $i, 3);
                    $i = $i + 3;
                }
                elseif( ord($stringTMP) >=192 )
                {
                    $stringTMP = substr($string, $i, 2);
                    $i = $i + 2;
                }
                else
                {
                    $i = $i + 1;
                }
                $stringLast[] = $stringTMP;
            }
            $stringLast = implode("",$stringLast);
            if(!empty($append))
            {
                $stringLast .= $append;
            }
        }
        return $stringLast;
    }
    //tao tham so cho duong dan
    function createQuery($key='',$value='',$options=null){
        $str=$keys=$values='';
        $nsx=0;        
        if(isset($options)){
            if(isset($options['obj'])){
                $str .= (!empty($str))?'&&':'?';
                $str .= 'cat='.$options['obj']->cat->id;
            }
            
            if(isset($options['nsx'])){
                $str .= (!empty($str))?'&&':'?';
                $str .= 'nsx='.$options['nsx'];
            } else if(isset($_GET['nsx'])){ // lay tham so nsx cu
                $str .= (!empty($str))?'&&':'?';
                $str .='nsx='.$_GET['nsx'];
            }   
        } 
        if(!isset($_GET['key'])&& !empty($key)){ // tao moi tham so key
            $str .= (!empty($str))?'&&':'?';
            $str .='key='.$key.'&&value='.$value;
        }  else     
        if(isset($_GET['key'])){// lay mang tham so option
            $keys=$_GET['key']; 
            $values=$_GET['value'];
            $count= count($keys);
            $keys=  explode(',', $keys); 
            $values = explode(',', $values);
            $check = -1;  
            foreach($keys as $k=>$v){
               if($v==$key) 
                   $check=$k;
               
            }            
            if(!empty($key)){
                if($check==-1){
                    $keys[$count]=$key; // them phan tu tim kiem moi
                    $values[$count]=$value;  
                }
                else{                 
                    if($values[$check]!=$value) // thay doi gia tri phan tu tim kiem cu
                        $values[$check]=$value;
                } 
            } 
           
            $keys = implode(',', $keys);
            $values = implode(',', $values);
            if(!empty($str))
                $str .='&&';
            else
                $str .='?';
            $str .='key='.$keys.'&&value='.$values;
        }
        return $str;
    }
    
    // ham get content
    function file_post_contents($url, $data, $username = null, $password = null)
{
    //$postdata = http_build_query($data);

    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/json',
            'content' => $data
        )
    );

    if($username && $password)
    {
        $opts['http']['header'] = ("Authorization: Basic " . base64_encode("$username:$password"));
    }

    $context = stream_context_create($opts);
    return file_get_contents($url, false, $context);
}
// ep kieu 
function parseArrayToObject($array) {
    $object = new stdClass();
    if (is_array($array) && count($array) > 0) {
        foreach ($array as $name=>$value) {
            $name = strtolower(trim($name));
            if (!empty($name)) {
                $object->$name = $value;
            }
        }
    }
    return $object;
}
 // ep kieu
function parseObjectToArray($object) {
    $array = array();
    if (is_object($object)) {
        $array = get_object_vars($object);
    }
    return $array;
}

function createConditionSerialize($array){
    $arr = serialize($array);  
    $arr=  explode('{', $arr); 
    $arr=  explode('}', $arr[1]); 
    $arr=  explode(';', $arr[0]);
    unset($arr[count($arr)-1]);   
    $str='';
        foreach($arr as $k=>$v){
            if($k>0&&$k%2>0){
                $arr[$k] = explode(':', $arr[$k]);
                $arr[$k] = $arr[$k][count($arr[$k])-1];
            }
        }
    foreach($arr as $k=>$v)
        $str.='%'.$v;
    if(!empty($str))
        $str.='%';
    return $str;
}

function createNumberCard($numberCard){
    $result='';
    $number =strlen($numberCard)/4;
    for($i=0;$i<$number;$i++){
        $result .= substr($numberCard, $i*4, 4).' ';
    } 
    return $result;
}

function sendMail($to,$from,$subject,$content='',$template=''){
    $mailer = new YiiMail();
    
    $mailer->transportType = 'smtp'; // mac dinh gia tri la : "php" tuc dung ham mail php
    $mailer->transportOptions=array(
        'host'=>'smtp.gmail.com',
        'username'=>'congnv@hoanggia.biz',
        'password'=>'tutumetmet',
        'port'=>465, // 465 hoac 587
        'encryption'=>'ssl',
    );
     
    $mailMessage = new YiiMailMessage();
    if(!empty($template))
        $mailMessage->view=$template;
    else 
        $mailMessage->view='default';
    $mailMessage->setTo(array($to=>'deg'));
    $mailMessage->setFrom(array($from=>'BeRichMart.189.vn'));
    $mailMessage->setSubject($subject);
    $mailMessage->setBody(array('content'=>$content), 'text/html');
    return $mailer->send($mailMessage);
}

function sendEmail($to, $from, $from_name, $subject, $body){
    global $error;
    $mail = new PHPMailer();  // tạo một đối tượng mới từ class PHPMailer
    $mail->IsSMTP(); // bật chức năng SMTP
  //  $mail->SMTPDebug = 0;  // kiểm tra lỗi : 1 là  hiển thị lỗi và thông báo cho ta biết, 2 = chỉ thông báo lỗi
    $mail->SMTPAuth = true;  // bật chức năng đăng nhập vào SMTP này
    $mail->SMTPSecure = 'ssl'; // sử dụng giao thức SSL vì gmail bắt buộc dùng cái này
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465; 
    $mail->Username ='congnv@hoanggia.biz';  
    $mail->Password = 'tutumetmet';           
    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);    
    $mail->IsHTML(true); // send as HTML
    if(!$mail->Send()) {
        $error = 'Gởi mail bị lỗi: '.$mail->ErrorInfo; 
        return false;
    } else {
        $error = 'thư của bạn đã được gởi đi ';
        return true;
    }
}
// xoa tat ca cac file trong 1 thu muc
function remove_allFile($dir) {
    if ($handle = opendir("$dir")) {
        while (false !== ($item = readdir($handle))) {
            if ($item != "." && $item != "..") {
            unlink("$dir/$item");
            }
        }
        closedir($handle);
    }
}

// ma hoa thẻ
function encrypt2($input, $key_seed='hoanggia.biz'){
    $input = trim($input);     
    $block = mcrypt_get_block_size('tripledes', 'ecb');      
    $len = strlen($input);      
    $padding = $block - ($len % $block);      
    $input .= str_repeat(chr($padding),$padding);    
    $key = substr(md5($key_seed),0,24);    
    $iv_size = mcrypt_get_iv_size(MCRYPT_TRIPLEDES, MCRYPT_MODE_ECB);    
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);  
    $encrypted_data = mcrypt_encrypt(MCRYPT_TRIPLEDES, $key, $input,  MCRYPT_MODE_ECB, $iv);
    return base64_encode($encrypted_data);  
}

//gia ma thẻ
function decrypt2($input, $key_seed='hoanggia.biz')  {  
    $input = base64_decode($input);  
    $key = substr(md5($key_seed),0,24);  
    $text=mcrypt_decrypt(MCRYPT_TRIPLEDES, $key, $input, MCRYPT_MODE_ECB,'12345678');  
    $block = mcrypt_get_block_size('tripledes', 'ecb');  
    $packing = ord($text{strlen($text) - 1});  
    if($packing and ($packing < $block)){  
        for($P = strlen($text) - 1; $P >= strlen($text) - $packing; $P--){   
            if(ord($text{$P}) != $packing){  
                $packing = 0;
            } 
        }
    }  
    $text = substr($text,0,strlen($text) - $packing); 
    return $text;  
    } 
    
    // convert
    function convertMemberBuyingToDonDatHang($memberbuying){
        $kq = array();
        if($memberbuying){
            $kq= new DonDatHang();
            $kq->MaDDH = $memberbuying->id;
            $kq->Member_id = $memberbuying->member_id;
            $kq->TongTien = $memberbuying->total;
            $kq->TongDiem = $memberbuying->profit;
            $kq->NgayDat = $memberbuying->created;
            $kq->HoaHongTieuDung = $memberbuying->money_off;
            $kq->TongTienThanhToan = $memberbuying->total_off;
            $kq->TrangThai = $memberbuying->status;
            $kq->NguoiMua = new Nguoi();
            $memberbuying->personbuy = unserialize($memberbuying->personbuy);
            $kq->NguoiMua->fullname = $memberbuying->personbuy['fullname'];
            $kq->NguoiMua->sex = $memberbuying->personbuy['sex'];
            $kq->NguoiMua->address = $memberbuying->personbuy['address'];
            $kq->NguoiMua->email = $memberbuying->personbuy['email'];
            $kq->NguoiMua->phone = $memberbuying->personbuy['phone'];
            $kq->NguoiMua->mobile = $memberbuying->personbuy['mobile'];
            $kq->NguoiMua->fullname = $memberbuying->personbuy['fullname'];
            $kq->NguoiMua->fax = $memberbuying->personbuy['fax'];
            $kq->NguoiMua->info = $memberbuying->personbuy['info']; 
            $kq->NguoiNhan = new Nguoi();
            $memberbuying->personget = unserialize($memberbuying->personget);
            $kq->NguoiNhan->fullname = $memberbuying->personbuy['fullname'];
            $kq->NguoiNhan->sex = $memberbuying->personbuy['sex'];
            $kq->NguoiNhan->address = $memberbuying->personbuy['address'];
            $kq->NguoiNhan->email = $memberbuying->personbuy['email'];
            $kq->NguoiNhan->phone = $memberbuying->personbuy['phone'];
            $kq->NguoiNhan->mobile = $memberbuying->personbuy['mobile'];
            $kq->NguoiNhan->fullname = $memberbuying->personbuy['fullname'];
            $kq->NguoiNhan->fax = $memberbuying->personbuy['fax'];
            $kq->NguoiNhan->info = $memberbuying->personbuy['info']; 
            $memberbuying->products = unserialize($memberbuying->products);
            $i=0;
            foreach ($memberbuying->products as $key2=>$sp){
                $kq->HangDat[$i] = new SPDat();
                $kq->HangDat[$i]->MaSP = $key2;
                $kq->HangDat[$i]->TenSP =$sp['name'];
                $kq->HangDat[$i]->SoLuong =$sp['sl'];
                $kq->HangDat[$i]->GiaBan =$sp['price_sell'];
                $kq->HangDat[$i]->TongTien =$sp['total'];
                $kq->HangDat[$i]->TongDiem =$sp['bonus'];                
                $i++;
            }
        }
        return $kq;
    }
    function doiSoThanhChu($so){
    $number=$so;
    $donvi=" đồng ";
    $tiente=array("nganty" => " nghìn tỷ ","ty" => " tỷ ","trieu" => " triệu ","ngan" =>" nghìn ","tram" => " trăm ");
    $num_f=$nombre_format_francais = number_format($number, 2, ',', ' ');
    $vitri=strpos($num_f,',');
    $num_cut=substr($num_f,0,$vitri);
    $mang=explode(" ",$num_cut);
    $sophantu=count($mang);
    switch($sophantu)
    {
        case '5':
                $nganty=doc3so($mang[0]);
                $text=$nganty;
                $ty=doc3so($mang[1]);
                $trieu=doc3so($mang[2]);
                $ngan=doc3so($mang[3]);
                $tram=doc3so($mang[4]);
                if((int)$mang[1]!=0)
                {
                    $text.=$tiente['ngan'];
                    $text.=$ty.$tiente['ty'];
                }
                else
                {
                    $text.=$tiente['nganty'];
                }
                if((int)$mang[2]!=0)
                    $text.=$trieu.$tiente['trieu'];
                if((int)$mang[3]!=0)
                    $text.=$ngan.$tiente['ngan'];
                if((int)$mang[4]!=0)
                    $text.=$tram;
                $text.=$donvi;
                echo $text;


        break;
        case '4':
                $ty=doc3so($mang[0]);
                $text=$ty.$tiente['ty'];
                $trieu=doc3so($mang[1]);
                $ngan=doc3so($mang[2]);
                $tram=doc3so($mang[3]);
                if((int)$mang[1]!=0)
                    $text.=$trieu.$tiente['trieu'];
                if((int)$mang[2]!=0)
                    $text.=$ngan.$tiente['ngan'];
                if((int)$mang[3]!=0)
                    $text.=$tram;
                $text.=$donvi;
                echo $text;


        break;
        case '3':
                $trieu=doc3so($mang[0]);
                $text=$trieu.$tiente['trieu'];
                $ngan=doc3so($mang[1]);
                $tram=doc3so($mang[2]);
                if((int)$mang[1]!=0)
                    $text.=$ngan.$tiente['ngan'];
                if((int)$mang[2]!=0)
                    $text.=$tram;
                $text.=$donvi;
                echo $text;
        break;
        case '2':
                $ngan=doc3so($mang[0]);
                $text=$ngan.$tiente['ngan'];
                $tram=doc3so($mang[1]);
                if((int)$mang[1]!=0)
                    $text.=$tram;
                $text.=$donvi;
                echo $text;

        break;
        case '1':
                $tram=doc3so($mang[0]);
                $text=$tram.$donvi;
                echo $text;

        break;
        default:
            echo "Xin lỗi số quá lớn không thể đổi được";
        break;
    }
}
function doc3so($so)
{
    $achu = array ( " không "," một "," hai "," ba "," bốn "," năm "," sáu "," bảy "," tám "," chín " );
    $aso = array ( "0","1","2","3","4","5","6","7","8","9" );
    $kq = "";
    $tram = floor($so/100); // Hàng trăm
    $chuc = floor(($so/10)%10); // Hàng chục
    $donvi = floor(($so%10)); // Hàng đơn vị
    if($tram==0 && $chuc==0 && $donvi==0) $kq = "";
    if($tram!=0)
    {
        $kq .= $achu[$tram] . " trăm ";
        if (($chuc == 0) && ($donvi != 0)) $kq .= " lẻ ";
    }
    if (($chuc != 0) && ($chuc != 1))
    {
            $kq .= $achu[$chuc] . " mươi";
            if (($chuc == 0) && ($donvi != 0)) $kq .= " linh ";
    }
    if ($chuc == 1) $kq .= " mười ";
    switch ($donvi)
    {
        case 1:
            if (($chuc != 0) && ($chuc != 1))
            {
                $kq .= " mốt ";
            }
            else
            {
                $kq .= $achu[$donvi];
            }
            break;
        case 5:
            if ($chuc == 0)
            {
                $kq .= $achu[$donvi];
            }
            else
            {
                $kq .= " lăm ";
            }
            break;
        default:
            if ($donvi != 0)
            {
                   $kq .= $achu[$donvi];
            }
            break;
    }
    if($kq=="")
    $kq=0;   
    return $kq;
}
function doc_so($so)
{
    $so = preg_replace("([a-zA-Z]*)","",$so);
    if (strlen($so) <= 21)
    {
        $kq = "";
        $c = 0;
        $d = 0;
        $tien = array ( "", " nghìn", " triệu", " tỷ", " nghìn tỷ", " triệu tỷ", " tỷ tỷ" );
        for ($i = 0; $i < strlen($so); $i++)
        {
            if ($so[$i] == "0")
                $d++;
            else break;
        }
        $so = substr($so,$d);
        for ($i = strlen($so); $i > 0; $i-=3)
        {
            $a[$c] = substr($so, $i, 3);
            $so = substr($so, 0, $i);
            $c++;
        }
        $a[$c] = $so;
        for ($i = count($a); $i > 0; $i--)
        {
            if (strlen(trim($a[$i])) != 0)
            {
                if (doc3so($a[$i]) != "")
                {
                    if (($tien[$i-1]==""))
                    {
                        if (count($a) > 2)
                            $kq .= " không trăm lẻ ".doc3so($a[$i]).$tien[$i-1];
                        else $kq .= doc3so($a[$i]).$tien[$i-1];
                    }
                    else if ((trim(doc3so($a[$i])) == "mười") && ($tien[$i-1]==""))
                    {
                        if (count($a) > 2)
                            $kq .= " không trăm ".doc3so($a[$i]).$tien[$i-1];
                        else $kq .= doc3so($a[$i]).$tien[$i-1];
                    }
                    else
                    {
                    $kq .= doc3so($a[$i]).$tien[$i-1];
                    }
                }
            }
        }
        return $kq;
    }
    else
    {
        return "Số quá lớn!";
    }
}   