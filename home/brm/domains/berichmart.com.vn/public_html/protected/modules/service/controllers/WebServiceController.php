<?php
Yii::import("application.library.DonDatHang");
Yii::import("application.library.TaiKhoanThe");
Yii::import("application.library.HoaHong");
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
     * @param string username   
     * @param string password    
     * @return Product[]
     * @soap
     */
     public function getProducts($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=  Product::model()->findAll();
            return $result;     
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param string condition    
     * @return Product[]
     * @soap
     */
     public function getProductsByCondition($username,$password,$condition){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=  Product::model()->findAll($condition);
            return $result;     
         }
     }
     
     /**
     * @param string username   
     * @param string password     
     * @param int cat
     * @return Product[]
     * @soap
     */
     public function getProductsByCategoryId($username,$password,$cat){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = Product::model()->findAll('category_id="'.$cat.'"');
            return $result;
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param string code    
     * @return Product
     * @soap
     */
     public function getProductByCode($username,$password,$code){   
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = Product::model()->find('code="'.$code.'"');
            return $result;
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param int id    
     * @return Product
     * @soap
     */
     public function getProductById($username,$password,$id){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=  Product::model()->findByPk($id);
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param string code
     * @return int
     * @soap
     */
     public function deleteProductByCode($username,$password,$code)
     {
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $product = Product::model()->find('code="'.$code.'"') ;
            return $product->delete();
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param int cat_id
     * @return int
     * @soap
     */
     public function deleteProductByCatId($username,$password,$cat_id)
     {        
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = Yii::app()->db->createCommand()->delete('products', 'category_id="'.$cat_id.'"');
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @return int
     * @soap
     */
     public function deleteProductsListAll($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = Yii::app()->db->createCommand()->delete('products');
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param Product data
     * @return int
     * @soap
     */
     public function insertProduct($username,$password,$data){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $product = new Product();
            $data = parseObjectToArray($data);
            $data['bonus']=$data['price_sell'] - $data['price_buy'] - $data['shipping'];
            $phiton = ($data['bog']+$data['km']+$data['hhh'])*$data['bonus']/100;
            $data['bonus'] = ($data['bonus']-$phiton)/1000;
            $data['status']=1;
            $data['created']=!isset($data['created'])?date('Y-m-d'):$data['created'];
            $data['modified']=!isset($data['modified'])?date('Y-m-d'):$data['modified'];
            $data['alias']=!isset($data['alias'])?char($data['title']):char($data['alias']);
            $product->attributes=$data;
            $result = $product->save(); 
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param Product data
     * @return int
     * @soap
     */
     public function editProduct($username,$password,$data){ // pr($data);
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $data = parseObjectToArray($data);
            $product= Product::model()->findByPk($data['id']);         
            $data['modified']=date('Y-m-d');
            $product->attributes=$data;
            $result = $product->save(); 
            return $result;
         }
     }
     
     // cac ham xy ly danh mục
    
    /** 
     * @param string username   
     * @param string password     
     * @return Category[]
     * @soap
     */
     public function getCats($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=  Category::model()->findAll();
            return $result;
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param string condition    
     * @return Category[]
     * @soap
     */
     public function getCatsByCondition($username,$password,$condition){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=  Category::model()->findAll($condition);
            return $result;   
         }
     }
     
     /**     
     * @param string username   
     * @param string password 
     * @param int parent_id
     * @return Category[]
     * @soap
     */
     public function getCatsByParentId($username,$password,$parent_id){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=Category::model()->findAll('parent_id="'.$parent_id.'"');
            return $result;
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param int id    
     * @return Category
     * @soap
     */
     public function getCatById($username,$password,$id){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=Category::model()->findByPk($id);
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param int id
     * @return int
     * @soap
     */
     public function deleteCatById($username,$password,$id)
     {
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $product = Category::model()->findByPk($id);
            return $product->delete();
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param int parent_id
     * @return int
     * @soap
     */
     public function deleteCatByParentId($username,$password,$parent_id)
     {        
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = Yii::app()->db->createCommand()->delete('categories', 'parent_id="'.$parent_id.'"');
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @return int
     * @soap
     */
     public function deleteCatsListAll($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = Yii::app()->db->createCommand()->delete('categories');
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param Category data
     * @return int
     * @soap
     */
     public function insertCat($username,$password,$data){ //pr($data);
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $cat= new Category();
            $data = parseObjectToArray($data);
            $data['status']=1;
            $data['created']=!isset($data['created'])?date('Y-m-d'):$data['created'];
            $data['modified']=!isset($data['modified'])?date('Y-m-d'):$data['modified'];
            $data['alias']=!isset($data['alias'])?char($data['name']):char($data['alias']);
            $cat->attributes=$data;
            $result = $cat->save(); 
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param Category data
     * @return int
     * @soap
     */
     public function editCat($username,$password,$data){ // pr($data);
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $data = parseObjectToArray($data);
            $cat= Category::model()->findByPk($data['id']);
            $data['modified']=date('Y-m-d');          
            $cat->attributes=$data;
            $result = $cat->save(); 
            return $result;
         }
     }
     
     // cac ham xy ly member
    
    /** 
     * @param string username   
     * @param string password     
     * @return Member[]
     * @soap
     */
     public function getMembers($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=  Member::model()->findAll();
            return $result;
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param int id    
     * @return Member
     * @soap
     */
     public function getMemberById($username,$password,$id){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=Member::model()->findByPk($id);
            return $result;
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param string username_member    
     * @return Member
     * @soap
     */
     public function getMemberByUsername($username,$password,$username_member){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=Member::model()->find('name="'.$username_member.'"');
            return $result;
         }
     }
     
     // cac ham xy ly the
    
    /** 
     * @param string username   
     * @param string password 
     * @param string option     
     * @return TaiKhoanThe[]
     * @soap
     */
     public function getTaiKhoanTheList($username,$password,$option = 'new'){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
             $condtion ='';
            if($option=='new')
                $condtion= 'status=0';
            else
                $condtion='1=1';
            $cards= CardAccount::model()->findAll($condtion);
            $result=array();
            foreach ($cards as $key=> $item){
               $result[$key] = new TaiKhoanThe();
               $result[$key]->id = $item->id;
               $result[$key]->member_id = $item->member_id;
               $result[$key]->numbercard = $item->numbercard;
               $result[$key]->numberaccount = $item->numberaccount;
               $result[$key]->created = $item->created;
               $result[$key]->modified = $item->modified;
               $result[$key]->password_card = $item->password_card;
               $result[$key]->mobile = $item->mobile;
               $result[$key]->address = $item->address;
               $result[$key]->money = $item->money;
               $member = Member::model()->findByPk($item->member_id);
               $result[$key]->member_name = $member->name;
               $result[$key]->tong_diem = Yii::app()->tree->sumProfit($item->member_id,date('m'),date('Y')); 
               $data = Yii::app()->tree->sumRoseMember($member,date('m'),date('Y'));
               $result[$key]->HoaHong = $data['buying']['total']['totalrose']+$data['offline']['total']['sum']+$data['online']['total']['sum']+$data['hoahongtieudung'];
               $result[$key]->HHThucLinh=$data['buying']['total']['success']+$data['offline']['total']['success']+$data['online']['total']['success']+$data['hoahongtieudung'];
               $result[$key]->month = date('m');
               $result[$key]->year = date('Y');
               $item->status=1;
               $item->save();
            }
            return $result;
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param string member_name    
     * @return TaiKhoanThe
     * @soap
     */
     public function getTaiKhoanTheByMemberName($username,$password,$member_name){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $member = Member::model()->find('name="'.$member_name.'"');
            $card=CardAccount::model()->find('member_id = "'.$member->id.'"');
            $result = new TaiKhoanThe();
            if($card){
                $result->id = $card->id;
                $result->member_id = $card->member_id;
                $result->numbercard = $card->numbercard;
                $result->numberaccount = $card->numberaccount;
                $result->created = $card->created;
                $result->modified = $card->modified;
                $result->password_card = $card->password_card;
                $result->mobile = $card->mobile;
                $result->address = $card->address;
                $result->money = $card->money;
                $result->member_name = $member->name;
                $result->tong_diem = Yii::app()->tree->sumProfit($card->member_id,date('m'),date('Y'));
                $data = Yii::app()->tree->sumRoseMember($member,date('m'),date('Y'));
                $result->HoaHong = $data['buying']['total']['totalrose']+$data['offline']['total']['sum']+$data['online']['total']['sum']+$data['hoahongtieudung'];
                $result->HHThucLinh=$data['buying']['total']['success']+$data['offline']['total']['success']+$data['online']['total']['success']+$data['hoahongtieudung'];
                $result->month = date('m');
                $result->year = date('Y');
                return $result;
            }            
         }
     }
     
     // cac ham xy ly nhan vien
    
    /**  
     * @param string username   
     * @param string password    
     * @return NhanVien[]
     * @soap
     */
     public function getNhanVienList($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result= NhanVien::model()->findAll();
            return $result;     
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param string condition    
     * @return NhanVien[]
     * @soap
     */
     public function getNhanVienListByCondition($username,$password,$condition){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=  NhanVien::model()->findAll($condition);
            return $result;         
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param string MaNV    
     * @return NhanVien
     * @soap
     */
     public function getNhanvienByMaNV($username,$password,$MaNV){  
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = NhanVien::model()->find('manv="'.$MaNV.'"');
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param string MaNV
     * @return int
     * @soap
     */
     public function deleteNhanVien($username,$password,$MaNV)
     {
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $product = NhanVien::model()->find('manv="'.$MaNV.'"');
            return $product->delete();
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @return int
     * @soap
     */
     public function deleteNhanVienListAll($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = Yii::app()->db->createCommand()->delete('nhanvien');
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param NhanVien data
     * @return int
     * @soap
     */
     public function insertNhanVien($username,$password,$data){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $nhanvien = new NhanVien();
            $data = parseObjectToArray($data);
            $nhanvien->attributes=$data;
            $result = $nhanvien->save(); 
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param NhanVien data
     * @return int
     * @soap
     */
     public function editNhanvien($username,$password,$data){ // pr($data);
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $data = parseObjectToArray($data);
            $nhanvien= NhanVien::model()->findByPk($data['manv']);   
            $nhanvien->attributes=$data;
            $result = $nhanvien->save(); 
            return $result;
         }
     }
     
     // xy ly kho hang
     /**
     * @param string username   
     * @param string password      
     * @return KhoHang[]
     * @soap
     */
     public function getKhoHangList($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result= KhoHang::model()->findAll();
            return $result;     
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param string condition    
     * @return KhoHang[]
     * @soap
     */
     public function getKhoHangListByCondition($username,$password,$condition){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=  KhoHang::model()->findAll($condition);
            return $result; 
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param string MaKho    
     * @return KhoHang
     * @soap
     */
     public function getKhoHangByMaKho($username,$password,$MaKho){  
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = KhoHang::model()->find('makho="'.$MaKho.'"');
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param string MaKho
     * @return int
     * @soap
     */
     public function deleteKhoHang($username,$password,$MaKho)
     {
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $khohang = KhoHang::model()->find('makho="'.$MaKho.'"');
            return $khohang->delete();
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @return int
     * @soap
     */
     public function deleteKhoHangListAll($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = Yii::app()->db->createCommand()->delete('khohang');
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param KhoHang data
     * @return int
     * @soap
     */
     public function insertKhoHang($username,$password,$data){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $khohang = new KhoHang();
            $data = parseObjectToArray($data);
            $khohang->attributes=$data;
            $result = $khohang->save(); 
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param KhoHang data
     * @return int
     * @soap
     */
     public function editKhoHang($username,$password,$data){ // pr($data);
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $data = parseObjectToArray($data);
            $khohang= KhoHang::model()->findByPk($data['makho']);   
            $khohang->attributes=$data;
            $result = $khohang->save(); 
            return $result;
         }
     }
     
     // xy ly hoa don xuat
     /**     
     * @param string username   
     * @param string password 
     * @return HoaDonXuat[]
     * @soap
     */
     public function getHoaDonXuatList($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result= HoaDonXuat::model()->findAll();
            return $result;  
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param string condition    
     * @return HoaDonXuat[]
     * @soap
     */
     public function getHoaDonXuatListByCondition($username,$password,$condition){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=  HoaDonXuat::model()->findAll($condition);
            return $result; 
         }
     }
     
     /**
     * @param string username   
     * @param string password  
     * @param string MaPX    
     * @return HoaDonXuat
     * @soap
     */
     public function getHoaDonXuatByMaPX($username,$password,$MaPX){  
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = HoaDonXuat::model()->find('MaPX="'.$MaPX.'"');
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param string MaPX
     * @return int
     * @soap
     */
     public function deleteHoaDonXuat($username,$password,$MaPX)
     {
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){           
            $hoadon = HoaDonXuat::model()->find('MaPX="'.$MaPX.'"');
            return $hoadon->delete();
         }
     }
     
      /**
     * @param string username   
     * @param string password 
     * @return int
     * @soap
     */
     public function deleteHoaDonXuatListAll($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = Yii::app()->db->createCommand()->delete('hoadon');
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param HoaDonXuat[] data
     * @return int
     * @soap
     */
     public function insertHoaDonXuat($username,$password,$data){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         $result =0;
         if(!empty($user)){
            foreach($data as $item){
                $hoadon = HoaDonXuat::model()->find('MaPX="'.$item->MaPX.'"');
                if(empty($hoadon))
                    $hoadon = new HoaDonXuat();
                $item = parseObjectToArray($item);
                $hoadon->attributes=$item;
                if($hoadon->save())
                    $result++;
            }
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param HoaDonXuat data
     * @return int
     * @soap
     */
     public function editHoaDonXuat($username,$password,$data){ // pr($data);
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $data = parseObjectToArray($data);
            $hoadon= HoaDonXuat::model()->findByPk($data['MaPX']);   
            $hoadon->attributes=$data;
            $result = $hoadon->save(); 
            return $result;
         }
     }
     
     // xy ly hoa don xuat chi tiet
     /**  
     * @param string username   
     * @param string password    
     * @return HoaDonXuatCT[]
     * @soap
     */
     public function getHoaDonXuatCTList($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result= HoaDonXuatCT::model()->findAll();
            return $result;    
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param string condition    
     * @return HoaDonXuatCT[]
     * @soap
     */
     public function getHoaDonXuatCTListByCondition($username,$password,$condition){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result=  HoaDonXuatCT::model()->findAll($condition);
            return $result;    
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param string MaPX    
     * @return HoaDonXuatCT[]
     * @soap
     */
     public function getHoaDonXuatCTListByMaPX($username,$password,$MaPX){  
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = HoaDonXuatCT::model()->findAll('MaPX="'.$MaPX.'"');
            return $result;
         }
     }
     
     /** 
     * @param string username   
     * @param string password 
     * @param string MaPX  
     * @param string MaHang   
     * @return HoaDonXuatCT
     * @soap
     */
     public function getHoaDonXuatCT($username,$password,$MaPX,$MaHang){ 
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = HoaDonXuatCT::model()->find('MaPX="'.$MaPX.'" and MaHang="'.$MaHang.'"');
            return $result;
         }
     }
     
     
     
     /**
     * @param string username   
     * @param string password 
     * @param string MaPX
     * @return int
     * @soap
     */
     public function deleteHoaDonXuatCTList($username,$password,$MaPX)
     {
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $hoadon = HoaDonXuatCT::model()->findAll('MaPX="'.$MaPX.'"');
            $result=1;
            foreach ($hoadon as $item)
                if(!$item->delete())
                    $result=0;
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @return int
     * @soap
     */
     public function deleteHoaDonXuatCTListAll($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = Yii::app()->db->createCommand()->delete('hoadonchitiet');
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param string MaPX
     * @param string MaHang   
     * @return int
     * @soap
     */
     public function deleteHoaDonXuatCT($username,$password,$MaPX,$MaHang)
     {
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $hoadon = HoaDonXuatCT::model()->find('MaPX="'.$MaPX.'" and MaHang="'.$MaHang.'"');         
            return $hoadon->delete();
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param HoaDonXuatCT data
     * @return int
     * @soap
     */
     public function insertHoaDonXuatCT($username,$password,$data){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $hoadon = new HoaDonXuatCT();
            $data = parseObjectToArray($data);
            $hoadon->attributes=$data;
            $result = $hoadon->save(); 
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param HoaDonXuatCT data
     * @return int
     * @soap
     */
     public function editHoaDonXuatCT($username,$password,$data){ // pr($data);
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $data = parseObjectToArray($data);
            $hoadon= HoaDonXuatCT::model()->find('MaPX="'.$data['MaPX'].'" and MaHang="'.$data['MaHang'].'"') ;
            $hoadon->attributes=$data; 
            $result = $hoadon->save(); 
            return $result;
         }
     }
     
     //xu ly don dat hang
     /**
     * @param string username   
     * @param string password 
     * @return DonDatHang[]
     * @soap
     */
     public function getDonDatHangList($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = MemberBuying::model()->findAll();
            $kq = array();
            foreach ($result as $key=>$item){
                $kq[$key]= convertMemberBuyingToDonDatHang($item);
            }
            return $kq;
         }
     }     
     
     /**
     * @param string username   
     * @param string password 
     * @param int MaDDH
     * @return DonDatHang
     * @soap
     */
     public function getDonDatHang($username,$password,$MaDDH){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = MemberBuying::model()->findByPk($MaDDH);
            $kq = convertMemberBuyingToDonDatHang($result);
            return $kq;
         }
     }
     
      /**
     * @param string username   
     * @param string password 
     * @return int
     * @soap
     */
     public function deleteDonDatHangListAll($username,$password){
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = Yii::app()->db->createCommand()->delete('member_buyings');
            return $result;
         }
     }
     /**
     * @param string username   
     * @param string password 
     * @param int MaDDH
     * @return int
     * @soap
     */
     public function deleteDonDatHang($username,$password,$MaDDH){
        $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $result = MemberBuying::model()->findByPk($MaDDH)->delete();
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param User data
     * @return int
     * @soap
     */
     public function insertUser($username,$password,$data){ //pr($data);
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $obj= new User();
            $data = parseObjectToArray($data);
            $data['status']=1;
            $data['created']=!isset($data['created'])?date('Y-m-d'):$data['created'];
            $data['modified']=!isset($data['modified'])?date('Y-m-d'):$data['modified'];
            $obj->attributes=$data;
            $result = $obj->save(); 
            return $result;
         }
     }
     
     /**
     * @param string username   
     * @param string password 
     * @param int member_id   
     * @param int month   
     * @param int year 
     * @return HoaHong
     * @soap
     */
     public function getHoaHong($username,$password,$member_id,$month,$year){ //pr($data);
         $user = User::model()->find('name=? and password = ?',array($username,md5($password))) ;
         if(!empty($user)){
            $obj= new HoaHong(); 
            $member = Member::model()->findByPk($member_id);
            $data = Yii::app()->tree->sumRoseMember($member,$month,$year);
            $obj->HoaHong = $data['buying']['total']['totalrose']+$data['offline']['total']['sum']+$data['online']['total']['sum'];
            $obj->HHThucLinh=$data['buying']['total']['success']+$data['offline']['total']['success']+$data['online']['total']['success']+$data['hoahongtieudung'];
            $obj->TaiKhoan = $member->CardAccount['money'];
            return $obj;
         }
     }
} 