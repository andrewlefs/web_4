<?php
class WebServiceController extends CController
{
   public function actions()
    {
       return array(
        'service' => array(
          'class' => 'CWebServiceAction',
        ),
      );
    }
    
    // cac ham xy ly san pham
    
    /**     
     * @return array
     * @soap
     */
     public function getProducts(){
         $result=Yii::app()->db->createCommand('select * from products')->queryAll();
         return $result;
     }
     
     /**     
     * @param string cat
     * @return array
     * @soap
     */
     public function getProductsByCategoryId($cat){
         $result=Yii::app()->db->createCommand('select * from products where category_id="'.$cat.'"')->queryAll();
         return $result;
     }
     
     /** 
     * @param string code    
     * @return array
     * @soap
     */
     public function getProductByCode($code){
         $result=Yii::app()->db->createCommand('select * from products where code="'.$code.'"')->queryRow();
         return $result;
     }
     
     /** 
     * @param string id    
     * @return array
     * @soap
     */
     public function getProductById($id){
         $result=Yii::app()->db->createCommand('select * from products where id="'.$id.'"')->queryRow();
         return $result;
     }
     
     /**
     * @param string code
     * @return int
     * @soap
     */
     public function deleteByCode($code)
     {
         $product = Product::model()->find('code="'.$code.'"') ; 
         return $product->delete();
     }
     
     /**
     * @param string cat_id
     * @return int
     * @soap
     */
     public function deleteByCatId($cat_id)
     {        
         $result = Yii::app()->db->createCommand()->delete('products', 'category_id="'.$cat_id.'"');
         return $result;
     }
     
     /**
     * @param array product
     * @return int
     * @soap
     */
     public function insertProduct($product){
         $product = new Product();
         $product->attributes=$product;
         return $product->save();
     }

} 