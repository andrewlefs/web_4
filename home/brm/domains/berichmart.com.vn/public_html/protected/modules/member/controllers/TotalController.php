<?php
class TotalController extends Controller
{
    public function actionCreateExcel(){
       /** Include path **/
        set_include_path(get_include_path() . PATH_SEPARATOR . 'ClassesExcel/');

        /** PHPExcel */
        require_once 'PHPExcel.php';

        /** PHPExcel_RichText */
        require_once 'PHPExcel/RichText.php';

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();      
        $i = 1; // dong 1 tao tieu de , bang co 4 cot, dong 1 gop 4 cot lai
        // chinhn utf-8 neu bi hien loi ko thi thoi : iconv("ISO-8859-1",'UTF-8','Danh sách thành viên')
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Danh sách thành viên');	
	$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
	$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(20);
	$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
	
	$objPHPExcel->getActiveSheet()->mergeCells('D'.$i.':G'.$i); // tron 4 cot lam 1
        
        // load all member
        $members = Member::model()->findAll();
            
        // thiet lap do rong cho cac cot
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(45);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(45);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(55);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(45);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
        
        $i=4; // thiet lap tieu de cot
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,'ID' );
        $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,'Tên đăng nhập' );
        $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Mật khẩu');
        $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,'Người giới thiêu 1' );
        $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,'Người giới thiêu 2' );
        $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,'ID Cha' );
        $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('G'.$i,'Họ tên' );
        $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('H'.$i,'Email' );
        $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('I'.$i,'Địa chỉ' );
        $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('J'.$i,'CMND');
        $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('K'.$i,'Ngày cấp' );
        $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('L'.$i,'Nơi cấp' );
        $objPHPExcel->getActiveSheet()->getStyle('L'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('L'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('L'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('M'.$i,'Địa chỉ theo CMND' );
        $objPHPExcel->getActiveSheet()->getStyle('M'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('M'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('M'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('N'.$i,'Số điện thoại');
        $objPHPExcel->getActiveSheet()->getStyle('N'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('N'.$i)->getFont()->setSize(14); 
        $objPHPExcel->getActiveSheet()->getStyle('N'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('O'.$i,'Gioi tính' );
        $objPHPExcel->getActiveSheet()->getStyle('O'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('O'.$i)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('O'.$i)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('P'.$i,'Ngày sinh');
        $objPHPExcel->getActiveSheet()->getStyle('P'.$i)->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('P'.$i)->getFont()->setSize(14); 
        $objPHPExcel->getActiveSheet()->getStyle('P'.$i)->getFont()->setBold(true);
        
        $i=5; // dong thu 5 bat dau in danh sach
        foreach ($members as $member){
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$member->id );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
            
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$member->name );
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(14);
            
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, getString($member->password,3));
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // can phai
            
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$member->person1 );
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(14);
            
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$member->person2 );
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(14);
            
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$member->parents );
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(14);
            
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$member->fullname );
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(14);
            
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$i,$member->email );
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(14);
            
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$member->address );
            $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getFont()->setSize(14);
            
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$i,$member->cmnd );
            $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getFont()->setSize(14);
            
            $objPHPExcel->getActiveSheet()->setCellValue('K'.$i,$member->date_create );
            $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->getFont()->setSize(14);
            
            $objPHPExcel->getActiveSheet()->setCellValue('L'.$i,$member->place_create );
            $objPHPExcel->getActiveSheet()->getStyle('L'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('L'.$i)->getFont()->setSize(14);
            
            $objPHPExcel->getActiveSheet()->setCellValue('M'.$i,$member->address_cmnd );
            $objPHPExcel->getActiveSheet()->getStyle('M'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('M'.$i)->getFont()->setSize(14);
            
            $objPHPExcel->getActiveSheet()->setCellValue('N'.$i,$member->phone );
            $objPHPExcel->getActiveSheet()->getStyle('N'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('N'.$i)->getFont()->setSize(14); 
            
            $objPHPExcel->getActiveSheet()->setCellValue('O'.$i,$member->sex );
            $objPHPExcel->getActiveSheet()->getStyle('O'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('O'.$i)->getFont()->setSize(14);
            
            $objPHPExcel->getActiveSheet()->setCellValue('P'.$i,$member->birthday );
            $objPHPExcel->getActiveSheet()->getStyle('P'.$i)->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getStyle('P'.$i)->getFont()->setSize(14);            
            
            $i++;
        }       
        
        include 'PHPExcel/IOFactory.php';
        
        $fileName = "export/bang_excel_sp_".gmdate("Y_m_d", time() + 7*3600).".xls";

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        // xoa het cac file trong thu muc        
        remove_allFile(Yii::getPathOfAlias('webroot').'/export');
        $objWriter->save($fileName);
        //header( "Content-type: application/vnd.ms-excel; charset=UTF-8" ); 
        header("location: ".  getURL().$fileName);
    }
}
?>
