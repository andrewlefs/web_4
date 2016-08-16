<?php
class TestServiceController extends CController
{
   public function actions()
    {
       return array(
        'abc' => array(
          'class' => 'CWebServiceAction',
        ),
      );
    }

    /**
     * @param string username
     * @return float
     * @soap
     */
     public function getauth($uname)
     {
         return strlen($uname);             
     }

     /**
     * @param string username
     * @return string
     * @soap
     */
     public function getemp($uname)
     { 
         return $uname;
     }
     
     /**
     * @param string name
     * @param string value 
     * @return float
     * @soap
     */
     public function update($name,$value){
         $result=Yii::app()->db->createCommand()->update('member_options', array('value'=>$value,'created'=>date('Y-m-d')),'name="'.$name.'"');
         return $result;
     }
     
     /**     
     * @return array
     * @soap
     */
     public function getOptions(){
         $result=Yii::app()->db->createCommand('select * from `member_options')->queryAll();
         return $result;
     }
} 