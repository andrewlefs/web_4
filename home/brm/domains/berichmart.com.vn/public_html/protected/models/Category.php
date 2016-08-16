<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $password
 * @property string $name
 * @property integer $power
 * @property string $email
 * @property integer $phone
 * @property string $birth_date
 * @property string $sex
 * @property string $images
 * @property string $created
 * @property string $modified
 * @property string $active_key
 * @property integer $status
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, alias,created, level, modified, status', 'required'),
			array('status, order, level,group_product_id', 'numerical', 'integerOnly'=>true),
			array('name, alias', 'length', 'max'=>250),
                        array('order, parent_id,show,group_product_id','numerical','allowEmpty'=>true),
                        array('meta_key, meta_des,icon,image','length','allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,order, parent_id, name, alias,level, created, modified, meta_key, meta_des, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('Parent'=>array(self::BELONGS_TO,'Category','parent_id'),
                    'Product'=>array(self::HAS_MANY,'Product','category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Danh mục cha',
			'name' => 'Tên danh mục',
			'alias' => 'Bí danh',
			'order' => 'Thứ tự',
			'level' => 'level',
			'meta_key' => 'Tư khóa SEO',
			'meta_des' => 'Nôi dung tóm tắt SEO',
			'created' => 'Created',
			'modified' => 'Modified',
			'status' => 'Trạng thái',
                        'show'=>'Hiện ở trang chủ',
                        'icon'=>'Icon',
                        'image'=>'Hình ảnh',
                        'group_product_id'=>'Nhóm sản phẩm'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias',$this->alias);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('meta_key',$this->meta_key);
		$criteria->compare('meta_des',$this->meta_des,true);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        // ham tra ve mang cay array('key'=>'name')
        public function generateTree($condition,$string='-',$level=0){
            $tree = array();
            $separator ='';
            for($i=1;$i<=$level;$i++){ 
                if($i>1)
                    $separator .='||';
                $separator .=$string;
            }
            $list = $this->findAll($condition);
            foreach($list as $li){
                $tree[$li->id] = $separator.$li->name;
                $sublevel = $level + 1;
                $tree += $this->generateTree('parent_id ='.$li->id,$string,$sublevel);
            }               
            return $tree;
        }  
        
        // ham tra ve mang cay array(index=>array(),...,...)
        public function listCats($condition,$string='---',$level=0){
            $tree = array();
            $separator ='';
            for($i=1;$i<=$level;$i++){ 
                if($i>1)
                    $separator .='||';
                $separator .=$string;
            }
            $list = $this->findAll($condition);
            foreach($list as $li){
                $tree[] = array('separator'=>$separator,'cat'=>$li);
                $sublevel = $level + 1;
                $tree = $this->sum($tree,$this->listCats('parent_id ='.$li->id,$string,$sublevel));
            }            
            return $tree;
        }  
        
        // array(key=>key)
        public function getListId($id){
            $listId = array();
            $list = $this->findAll('parent_id ="'.$id.'"');
            $listId = CHtml::listData($list,'id','id');
            $listId[$id] = $id; 
            foreach($list as $cat){                
                $listId += $this->getListId($cat->id);
            }             
            return $listId;
        }   
        
        public function getParentListId($id,$i = -1){
            $listId = array();
            $parent = $this->findByPk($id);
            if($i<0)
                $listId[++$i] = $id; 
            if($parent && !empty($parent->parent_id)){
                $listId[++$i] = $parent->parent_id;
                $listId += $this->getParentListId($parent->parent_id,$i);     
            }           
            return $listId;
        }   
        
        // cong 2 mang theo co che giu nguyen 2 mang , key tang dan
        public function sum($arr1=  array(),$arr2=  array()){
            $count= count($arr1);
            $tg= array();
            for($i=0;$i<count($arr2);$i++)
                $tg[$count+$i]=$arr2[$i];
            return $arr1 + $tg;
        }
        
}