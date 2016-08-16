<?php

    class UploadController extends Controller{
        
        public function actionPopup(){
            $this->renderPartial('popup');
        }
        
        public function actionDeleteFile(){
            $url= $_POST['url'];
            $thum = $_POST['thum'];
            $kq='false';
            if(file_exists($thum))
                unlink($thum);
            if(file_exists($url))
                if(unlink($url))
                $kq = 'true';
                else
                    $kq = 'false';
            echo $kq;
        }
        
        public function actionLoadImages(){
            $this->renderPartial('loadImages');
        }
        public function actionUpload(){
            $this->renderPartial('upload');
            
        }
        
        public function actionUploadData(){
            $this->renderPartial('uploadData');
            
        }
        
        public function beforeAction($action) { 
            $checklogin = checkLogin($this);
            return $checklogin;
        }
    }
?>
