<?php
Yii::import("application.library.Nested_Set");
/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'ClassesExcel/');

/** PHPExcel */
require_once 'PHPExcel.php';

/** PHPExcel_RichText */
require_once 'PHPExcel/RichText.php';
include 'PHPExcel/IOFactory.php';

class ReportController extends Controller{
    // bao cao thu tien(tien gui)
    public function actionReportImport(){
        $from = trim($_REQUEST['d_from']);
        $to = trim($_REQUEST['d_to']).' 23:59:59'; 
        if(!empty($from)&&!empty($to)){
            $from = str_replace('/', '-', $from);
            $from = date('Y-m-d',  strtotime($from));
            $to = str_replace('/', '-', $to);    
            $to = date('Y-m-d H:i:s',  strtotime($to)); 
            $user_id = (isset($_REQUEST['user_id']))?trim($_REQUEST['user_id']):'';
            if(empty($user_id))
                $imports = Yii::app()->db->createCommand('select * from update_money where status=1 and created>="'.$from.'" and created<="'.$to.'"')->queryAll();
            else 
                $imports = Yii::app()->db->createCommand('select * from update_money where status=1 and created>="'.$from.'" and created<="'.$to.'" and user_id="'.$user_id.'"')->queryAll();
            
            $reports=array(); $total=0;
            foreach ($imports as $key=> $import){
                $reports[$key]['UpdateMoney'] =$import;
                $total += $import['money'];
                $card = Yii::app()->db->createCommand('select * from card_accounts where numberaccount="'.$import['numberaccount'].'"')->queryRow();           
                $reports[$key]['Member']= Yii::app()->db->createCommand('select * from members where id="'.$card['member_id'].'"')->queryRow();            
                $reports[$key]['User']= Yii::app()->db->createCommand('select * from users where id="'.$import['user_id'].'"')->queryRow();            
            }  
            // tao file excel
            $objPHPExcel = new PHPExcel(); 
            // tao tieu de
            $i = 1;
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Báo cáo chi từ ngày '.$from.' tới ngày '.date('Y-m-d',  strtotime($to)));	
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':F'.$i); // tron 5 cot lam 1
            
            // thiet lap kich thuoc cot
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
            
            // tieu de cot            
            $i=4;
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Tên đăng nhập' );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Họ tên' );
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Số tài khoản');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Số tiền nạp' );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Ngày giờ nạp' );
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai
            
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,'Nhân viên thu' );
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $i=5; // dong thu 5 bat dau in danh sach
            foreach($reports as $report){                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,$report['Member']['name'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$report['Member']['fullname']);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$i,$report['UpdateMoney']['numberaccount'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,number_format($report['UpdateMoney']['money']).' VNĐ');
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$report['UpdateMoney']['created']);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$report['User']['fullname']);
                $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                $i++;
            }
            $i++;
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Tổng thu : '.  number_format($total).' VNĐ');	
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(15);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':F'.$i); // tron 6 cot lam 1
            
            $fileName = "Bao_cao_thu_tu_ngay_".$from.'_den_ngay_'.date('Y-m-d',  strtotime($to)).".xls";

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
            header('Content-Disposition: attachment;filename="'.$fileName.'"');
            $objWriter->save('php://output');
            /*
            $fileName = "export/Bao_cao_thu_tu_ngay_".$from.'_den_ngay_'.date('Y-m-d',  strtotime($to)).".xls";
            // xoa het cac file trong thu muc        
            remove_allFile(Yii::getPathOfAlias('webroot').'/export');
            $objWriter->save($fileName);
            header("location: ".  getURL().$fileName);
             * 
             */
        } 
    }
    
    // bao cao rut tien
    public function actionReportExport(){ 
        $from = trim($_REQUEST['d_from']);
        $to = trim($_REQUEST['d_to']).' 23:59:59';   
        if(!empty($from)&&!empty($to)){
            $from = str_replace('/', '-', $from);
            $from = date('Y-m-d',  strtotime($from));
            $to = str_replace('/', '-', $to);    
            $to = date('Y-m-d H:i:s',  strtotime($to));
            $user_id = (isset($_REQUEST['user_id']))?trim($_REQUEST['user_id']):'';
            if(empty($user_id))
                $imports = Yii::app()->db->createCommand('select * from update_money where status=0 and created>="'.$from.'" and created<="'.$to.'"')->queryAll();
            else 
                $imports = Yii::app()->db->createCommand('select * from update_money where status=0 and created>="'.$from.'" and created<="'.$to.'" and user_id="'.$user_id.'"')->queryAll();
            $reports=array(); $total=0;
            foreach ($imports as $key=> $import){
                $reports[$key]['UpdateMoney'] =$import;
                $total += $import['money'];
                $card = Yii::app()->db->createCommand('select * from card_accounts where numberaccount="'.$import['numberaccount'].'"')->queryRow();           
                $reports[$key]['Member']= Yii::app()->db->createCommand('select * from members where id="'.$card['member_id'].'"')->queryRow();            
                $reports[$key]['User']= Yii::app()->db->createCommand('select * from users where id="'.$import['user_id'].'"')->queryRow();            
            }  
            // tao file excel
            $objPHPExcel = new PHPExcel(); 
            // tao tieu de
            $i = 1;
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Báo cáo chi từ ngày '.$from.' tới ngày '.date('Y-m-d',  strtotime($to)));	
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':F'.$i); // tron 4 cot lam 1
            
            // thiet lap kich thuoc cot
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
            
            // tieu de cot            
            $i=4;
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Tên đăng nhập' );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Họ tên' );
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Số tài khoản');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Số tiền chi' );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Ngày giờ chi' );
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai
            
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,'Nhân viên chi' );
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $i=5; // dong thu 5 bat dau in danh sach
            foreach($reports as $report){                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,$report['Member']['name'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$report['Member']['fullname']);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$i,$report['UpdateMoney']['numberaccount'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,number_format($report['UpdateMoney']['money']).' VNĐ');
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$report['UpdateMoney']['created']);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$report['User']['fullname']);
                $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                $i++;
            }
            $fileName = "Bao_cao_chi_tu_ngay_".$from.'_den_ngay_'.date('Y-m-d',  strtotime($to)).".xls";

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');            
            header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
            header('Content-Disposition: attachment;filename="'.$fileName.'"');
            $objWriter->save('php://output');
            /* tao file luu tren server
            $fileName = "export/Bao_cao_chi_tu_ngay_".$from.'_den_ngay_'.date('Y-m-d',  strtotime($to)).".xls";
            // xoa het cac file trong thu muc        
            remove_allFile(Yii::getPathOfAlias('webroot').'/export');
            $objWriter->save($fileName);
            header("location: ".  getURL().$fileName);
             * 
             */
        } 
    }
    
    // bao cao rut tien
    public function actionReportTransfer(){ 
        $from =trim($_REQUEST['d_from']);
        $to = trim($_REQUEST['d_to']).' 23:59:59';  
        if(!empty($from)&&!empty($to)){
            $from = str_replace('/', '-', $from);
            $from = date('Y-m-d',  strtotime($from));
            $to = str_replace('/', '-', $to);    
            $to = date('Y-m-d H:i:s',  strtotime($to));
            $reports = Yii::app()->db->createCommand('select * from transfer where created>="'.$from.'" and created<="'.$to.'"')->queryAll();
            // tao file excel
            $objPHPExcel = new PHPExcel(); 
            // tao tieu de
            $i = 1;
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Báo cáo chuyển khoản từ ngày '.$from.' đến ngày '.date('Y-m-d',  strtotime($to)));	
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':E'.$i); // tron 4 cot lam 1
            
            // thiet lap kich thuoc cot
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            
            // tieu de cot            
            $i=4;
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Tài khoản gửi' );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Tài khoản nhân' );
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Số tiền chuyển');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Nội dung thanh toán' );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Ngày giờ chuyển' );
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $i=5; // dong thu 5 bat dau in danh sach
            foreach($reports as $report){                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,$report['account_send'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$i,$report['account_get'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, number_format($report['money']).' VNĐ');
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$report['information']);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$report['created']);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                $i++;
            }
            $fileName = "Bao_cao_chuyen_khoan_tu_ngay_".$from.'_den_ngay_'.date('Y-m-d',  strtotime($to)).".xls";

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
            header('Content-Disposition: attachment;filename="'.$fileName.'"');
            $objWriter->save('php://output');
            /* tao file luu tren server
             $fileName = "export/Bao_cao_chuyen_khoan_tu_ngay_".$from.'_den_ngay_'.date('Y-m-d',  strtotime($to)).".xls";
            // xoa het cac file trong thu muc        
            remove_allFile(Yii::getPathOfAlias('webroot').'/export');
            $objWriter->save($fileName);
            header("location: ".  getURL().$fileName);
             * *
             */
        }        
    }
    
    // bao cao rut tien
    public function actionReportFees(){
        $from = trim($_REQUEST['d_from']);
        $to = trim($_REQUEST['d_to']).' 23:59:59';   
        if(!empty($from)&&!empty($to)){
            $from = str_replace('/', '-', $from);
            $from = date('Y-m-d',  strtotime($from));
            $to = str_replace('/', '-', $to);    
            $to = date('Y-m-d H:i:s',  strtotime($to));
            $fees = Yii::app()->db->createCommand('select * from fees where created>="'.$from.'" and created<="'.$to.'"')->queryAll();
            $reports=array();
            foreach ($fees as $key=> $fee){
                $reports[$key]['Fee'] =$fee;
                $card = Yii::app()->db->createCommand('select * from card_accounts where numberaccount="'.$fee['numberaccount'].'"')->queryRow();           
                $reports[$key]['Member']= Yii::app()->db->createCommand('select * from members where id="'.$card['member_id'].'"')->queryRow();            
            }
            // tao file excel
            $objPHPExcel = new PHPExcel(); 
            // tao tieu de
            $i = 1;
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Báo cáo thu phi từ ngày '.$from.' đến ngày '.date('Y-m-d',  strtotime($to)));	
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':F'.$i); // tron 4 cot lam 1
            
            // thiet lap kich thuoc cot
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
            
            // tieu de cot            
            $i=4;
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Tên đăng nhập' );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Họ tên' );
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Số tài khoản');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Số tiền phí' );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Loại phí' );
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,'Ngày giờ thu phí' );
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $i=5; // dong thu 5 bat dau in danh sach
            foreach($reports as $report){
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,$report['Member']['name'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$report['Member']['fullname']);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$i, $report['Fee']['numberaccount'],  PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,number_format($report['Fee']['fee']).' VNĐ' );
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$report['Fee']['type']);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$report['Fee']['created']);
                $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                $i++;
            }
            $fileName = "Bao_cao_thu phi_tu_ngay_".$from.'_den_ngay_'.date('Y-m-d',  strtotime($to)).".xls";

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
            header('Content-Disposition: attachment;filename="'.$fileName.'"');
            $objWriter->save('php://output');
            /*
            $fileName = "export/Bao_cao_thu phi_tu_ngay_".$from.'_den_ngay_'.date('Y-m-d',  strtotime($to)).".xls";
            // xoa het cac file trong thu muc        
            remove_allFile(Yii::getPathOfAlias('webroot').'/export');
            $objWriter->save($fileName);
            //header( "Content-type: application/vnd.ms-excel; charset=UTF-8" ); 
            header("location: ".  getURL().$fileName);
             * 
             */
        }
    }
    
    // bao cao hoa hong
    public function actionReportRose(){       
        $month = trim($_REQUEST['month']);
        $year= trim($_REQUEST['year']);
        if(!empty($month)&&!empty($year)){            
            $roses = Yii::app()->db->createCommand('select * from rose_months where month="'.$month.'" and year="'.$year.'" and status="success"')->queryAll();
            $reports=array();
            foreach ($roses as $key=> $rose){
                $reports[$key]['Rose'] =$rose;            
                $reports[$key]['Member']= Yii::app()->db->createCommand('select * from members where id="'.$rose['member_id'].'"')->queryRow();            
            }    
            // tao file excel
            $objPHPExcel = new PHPExcel(); 
            // tao tieu de
            $i = 1;
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Báo cáo hoa hồng tháng '.$month.' năm '.$year);	
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':F'.$i); // tron 4 cot lam 1
            
            // thiet lap kich thuoc cot
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            
            // tieu de cot            
            $i=4;
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Tên đăng nhập' );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'HH thụ động' );
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'HH hỗ trợ PTHT');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'HH PTHT' );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Thuế' );
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,'Tổng HH' );
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('G'.$i,'Tổng thực' );
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('H'.$i,'Ngày lập' );
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $i=5; // dong thu 5 bat dau in danh sach
            foreach($reports as $report){
                $rose = unserialize($report['Rose']['totalrose']);
                $buying=$rose['buying']['total']['success'];
                $offline=$rose['offline']['total']['success'];
                $online=$rose['online']['total']['success'];
                $tax=  $rose['tax'];
                $total=$buying+$offline+$online+$rose['hoahongtieudung']; 
                $moneyTax = ($total>=$rose['salary'])?$total/100*$tax:0;
                $realTotal =$total-$moneyTax; 

                $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,$report['Member']['name'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,number_format($buying).' VNĐ' );
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, number_format($offline).' VNĐ');
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,number_format($online).' VNĐ' );
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,number_format($moneyTax));
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,number_format($total).' VNĐ');
                $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i,number_format($realTotal).' VNĐ' );
                $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('H'.$i,date('d/m/Y',  strtotime($report['Rose']['created'])));
                $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(14);
                $i++;
            }
            $fileName = "Bao_cao_hoa_hong_thang_".$month.'_nam_'.$year.".xls";

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');            
            header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
            header('Content-Disposition: attachment;filename="'.$fileName.'"');
            $objWriter->save('php://output');
            /*
            // xoa het cac file trong thu muc        
            remove_allFile(Yii::getPathOfAlias('webroot').'/export');
            $fileName = "export/Bao_cao_hoa_hong_thang_".$month.'_nam_'.$year.".xls";
            $objWriter->save($fileName); 
            header("location: ".  getURL().$fileName);
             * 
             */
        }
        
    }
    
    // bao cao hoa hong
    public function actionReportTax(){    
        $month = trim($_REQUEST['month']);
        $year= trim($_REQUEST['year']);
        if(!empty($month)&&!empty($year)){            
            $taxs = Yii::app()->db->createCommand('select * from member_tax where month="'.$month.'" and year="'.$year.'"')->queryAll();
            $reports=array();
            foreach ($taxs as $key=> $tax){
                $reports[$key]['Tax'] =$tax;            
                $reports[$key]['Member']= Yii::app()->db->createCommand('select * from members where id="'.$tax['member_id'].'"')->queryRow();            
            }    
            // tao file excel
            $objPHPExcel = new PHPExcel(); 
            // tao tieu de
            $i = 1;
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Báo cáo thuế tháng '.$month.' năm '.$year);	
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':E'.$i); // tron 4 cot lam 1
            
            // thiet lap kich thuoc cot
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            
            // tieu de cot            
            $i=4;
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Tên đăng nhập' );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Họ tên' );
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'CMTND');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Số tiền đóng thuế' );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Ngày đóng' );
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $i=5; // dong thu 5 bat dau in danh sach
            foreach($reports as $report){                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,$report['Member']['name'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$report['Member']['fullname']);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $report['Member']['cmnd']);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,number_format($report['Tax']['money']).' VNĐ');
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,date('d/m/Y',  strtotime($report['Tax']['created'])));
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                $i++;
            }
            $fileName = "Bao_cao_thue_thang_".$month.'_nam_'.$year.".xls";
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
            header('Content-Disposition: attachment;filename="'.$fileName.'"');
            $objWriter->save('php://output');
            /*
            $fileName = "export/Bao_cao_thue_thang_".$month.'_nam_'.$year.".xls";
            // xoa het cac file trong thu muc        
            remove_allFile(Yii::getPathOfAlias('webroot').'/export');
            $objWriter->save($fileName);
            header("location: ".  getURL().$fileName);
             * 
             */
        }        
    }
    
    // bao cao doanh thu tieu dung
    public function actionReportBuying(){    
        $month = trim($_REQUEST['month']);
        $year= trim($_REQUEST['year']);
        $member_id = trim($_REQUEST['member_id']);
        if(!empty($month)&&!empty($year)){            
            $productBuying= MemberBuying::model()->findAll('member_id=? and month(created)=? and year(created)=?',array($member_id,$month,$year));            
            // tao file excel
            $objPHPExcel = new PHPExcel(); 
            // tao tieu de
            $i = 1;
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Báo cáo tiêu dùng tháng '.$month.' năm '.$year);	
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':E'.$i); // tron 4 cot lam 1
            
            // thiet lap kich thuoc cot
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(60);
            
            // tieu de cot            
            $i=4;
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Ngày giao dich' );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Số hóa đơn' );
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Số tiền (VND)');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Điểm' );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Mô tả' );
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $i=5; // dong thu 5 bat dau in danh sach
            foreach($productBuying as $order){             
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,date('d/m/Y', strtotime($order->created)),PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$order->id);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, number_format($order->total));
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$order->profit);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'');
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                $i++;
            }
            $fileName = "Bao_cao_tieu_dung_thang_".$month.'_nam_'.$year.".xls";
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
            header('Content-Disposition: attachment;filename="'.$fileName.'"');
            $objWriter->save('php://output');
            /*
            $fileName = "export/Bao_cao_thue_thang_".$month.'_nam_'.$year.".xls";
            // xoa het cac file trong thu muc        
            remove_allFile(Yii::getPathOfAlias('webroot').'/export');
            $objWriter->save($fileName);
            header("location: ".  getURL().$fileName);
             * 
             */
        }        
    }
    
    // bao cao lich su hoa hong
    public function actionReportHistoryRose(){    
        $month = trim($_REQUEST['month']);
        $year= trim($_REQUEST['year']);
        $member_id = trim($_REQUEST['member_id']);
        if(!empty($month)&&!empty($year)){
            $rosemonth=  RoseMonth::model()->find('member_id=? and month=? and year=?',array($member_id,$month,$year));
            // tao file excel
            $objPHPExcel = new PHPExcel(); 
            // tao tieu de
            $i = 1;
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i,'Hoa hồng tháng '.$month.' năm '.$year);	
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':E'.$i); // tron 4 cot lam 1
            
            // tong hop hoa hoa hong 
            $i += 2;
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Ngày thanh toán' );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Doanh số tiêu dùng' );
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Hoa hồng thụ động');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Hoa hồng hỗ trợ phát triển hệ thống' );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Hoa hồng phát triển hệ thống' );
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai
            
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,'Tổng' );
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai
             $i += 2;
           
            $data = unserialize($rosemonth->totalrose);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,date('d-m-Y',  strtotime($rosemonth->created)),PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,Yii::app()->tree->sumProfit($member_id,$month,$year).' d');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $data['buying']['total']['success']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$data['offline']['total']['success']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$data['online']['total']['success']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$data['online']['total']['success']+$data['offline']['total']['success']+$data['buying']['total']['success']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
             
            // HOA HONG THU DONG chi tiet
            $i += 4;
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i,'Chi tiết hoa hồng thụ động');	
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':E'.$i); // tron 5 cot lam 1
            
            // thiet lap kich thuoc cot
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(60);
            
            // tieu de cot            
            $i+=2;
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Cây thành viên' );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Tổng số thành viên' );
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Tổng số doanh thu');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Tổng hoa hồng (VND)' );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Đạt / Không đạt' );
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $i+=2; // dong thu 5 bat dau in danh sach
            $data = unserialize($rosemonth->totalrose);
            $arrLevel=$data['buying']['level'];
            $total = $data['buying']['total'];
            foreach($arrLevel as $level){             
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,$level['level'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai
                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$level['count']);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, number_format($level['sum']).' d');
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,number_format($level['totalrose']));
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                $reasons='';
                if($level['success']==false){
                    if(isset($level['reason'])){
                        foreach($level['reason'] as $reason){
                            $reasons .=$reason;
                        }}
                }
                else
                    $reasons = 'Đạt';
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$reasons);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // can phai
                $i++;
            }
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,'Tổng số',PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$total['count']);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, number_format($total['sum']).' d');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,number_format($total['success']));
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                               
            // HOA HONG GIOI THIEU GIAN TIEP
            $i +=4;
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i,'Chi tiết hoa hồng giới thiệu gián tiếp');	
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':D'.$i); // tron 5 cot lam 1
            
            // thiet lap kich thuoc cot
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60);
            
            // tieu de cot            
            $i+=2;
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Cây thành viên' );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Tổng số thành viên đăng ký mới' );
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Tổng hoa hồng (VND)');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Đạt / Không đạt' );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $i+=2; // dong thu 5 bat dau in danh sach
            $arrLevel=$data['offline']['level'];
            $total = $data['offline']['total'];
            foreach($arrLevel as $level){             
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,$level['level'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai
                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$level['count']);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, number_format($level['sum']));
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                
                $reasons='';
                if($level['success']==false){
                    if(isset($level['reason'])){
                        foreach($level['reason'] as $reason){
                            $reasons .=$reason;
                        }}
                }
                else
                    $reasons = 'Đạt';
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$reasons);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // can phai
                $i++;
            }            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,'Tổng số',PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$total['count']);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, number_format($total['success']));
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                       
            // HOA HONG GIOI THIEU truc tiep
            $i +=4;
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i,'Chi tiết hoa hồng giới thiệu trực tiếp');	
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':D'.$i); // tron 5 cot lam 1
            
            // thiet lap kich thuoc cot
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60);
            
            // tieu de cot            
            $i+=2;
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Cây thành viên' );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Tổng số thành viên chinh thuc' );
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Tổng hoa hồng (VND)');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Đạt / Không đạt' );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $i+=2; // dong thu 5 bat dau in danh sach
            $arrLevel=$data['online']['level'];
            $total = $data['online']['total'];
            foreach($arrLevel as $level){             
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,$level['level'],PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai
                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$level['count']);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, number_format($level['sum']));
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                
                $reasons='';
                if($level['success']==false){
                    if(isset($level['reason'])){
                        foreach($level['reason'] as $reason){
                            $reasons .=$reason;
                        }}
                }
                else
                    $reasons = 'Đạt';
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$reasons);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // can phai
                $i++;
            }            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,'Tổng số',PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$total['count']);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, number_format($total['success']));
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai            
            
            $fileName = "Bao_cao_hoa_hong_thang_".$month.'_nam_'.$year.".xls";
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
            header('Content-Disposition: attachment;filename="'.$fileName.'"');
            $objWriter->save('php://output');            
        }        
    }
    
    // bao cao duyet hoa hong
    public function actionReportBrowse(){
        $data = Yii::app()->session['browse']; 
        $time = Yii::app()->session['time'];
        if(!empty($data)){ 
            // tao file excel
            $objPHPExcel = new PHPExcel(); 
            // tao tieu de
            $i = 1;
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Báo cáo duyệt hoa hồng thang '.$time['month'].' năm '.$time['year']);	
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':F'.$i); // tron 5 cot lam 1
            
            // thiet lap kich thuoc cot
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
            
            // tieu de cot            
            $i=4;
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'Tên đăng nhập' );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Họ tên' );
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'HH thụ động');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'HH hỗ trợ PTHT' );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'HH PTHT' );
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai
            
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,'HH tiêu dùng' );
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai
            
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Thuế' );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Tổng HH' );
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai
            
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,'Tổng thực' );
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // can phai

            $i=5; // dong thu 5 bat dau in danh sach
            foreach($data as $k=> $item){
                $report = $item['Rose'];
                $member= $item['Member'];
                $buying=$report['buying']['total']['success'];
                $offline=$report['offline']['total']['success'];
                $online=$report['online']['total']['success'];
                $tax=0;
                $total=$buying+$offline+$online + $report['hoahongtieudung'];
                $realTotal =$total-$tax; 
                if($realTotal>0){
                    $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$i,$member->name,PHPExcel_Cell_DataType::TYPE_STRING);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);

                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$member->fullname);
                    $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
                    $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // can phai

                    $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$i,number_format($buying).' VNĐ',PHPExcel_Cell_DataType::TYPE_STRING);
                    $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
                    $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,number_format($offline).' VNĐ');
                    $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
                    $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,number_format($online).' VNĐ');
                    $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
                    $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,number_format($report['hoahongtieudung']));
                    $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
                    $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$tax);
                    $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setName('Times New Roman');
                    $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$i,number_format($total).' VNĐ');
                    $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setName('Times New Roman');
                    $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai

                    $objPHPExcel->getActiveSheet()->setCellValue('I'.$i,number_format($realTotal).' VNĐ');
                    $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setName('Times New Roman');
                    $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
                    $i++;
                }
            }
                       
            $fileName = "Bao_cao_duyet_hoa_hong_thang_".$time['month'].'_nam_'.$time['year'].".xls";
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
            header('Content-Disposition: attachment;filename="'.$fileName.'"');
            $objWriter->save('php://output');
            /*
            $fileName = "export/Bao_cao_thu_tu_ngay_".$from.'_den_ngay_'.date('Y-m-d',  strtotime($to)).".xls";
            // xoa het cac file trong thu muc        
            remove_allFile(Yii::getPathOfAlias('webroot').'/export');
            $objWriter->save($fileName);
            header("location: ".  getURL().$fileName);
             * 
             */
        } 
    }
    
    
    public function beforeAction($action) { 
            $checklogin = checkLogin($this);
            if($checklogin==true){
                $user_id=Yii::app()->session['user']['id'];
                $phanquyen = Yii::app()->db->createCommand("select * from phan_quyen where user_id='".$user_id."'")->queryRow();
                if(!empty($phanquyen)){
                    $pq = unserialize($phanquyen['quyen']);
                    $controller = Yii::app()->controller->id;
                    $action = Yii::app()->controller->action->id; //echo $pq[$controller][$action]; die;
                    if(isset($pq[$controller][$action])&&$pq[$controller][$action]==0)
                        $this->redirect(getURL().'site/message/83');
                    else 
                        return TRUE;
                }
                else  return FALSE;
            }
            else  return FALSE;
        }
}
?>
