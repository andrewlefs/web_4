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
class Producer extends CActiveRecord
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
		return 'producers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,group_product_id', 'required'),
			array('group_product_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>250),
                       
                       
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name,group_product_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'Category'=>array(self::BELONGS_TO,'Category','category_id'),
		
                    'GroupProduct'=>array(self::BELONGS_TO,'GroupProduct','group_product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			
			'name' => 'Tên nhà sản xuất',
                        'group_product_id'=>'Nhóm sản phẩm',
			
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
		
		$criteria->compare('name',$this->name,true);
		$criteria->compare('category_id',$this->category_id,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        // ham tra ve mang caay
        public function generateTree($condition,$string='-',$level=0){
            $tree = array();
            $separator ='';
            for($i=1;$i<=$level;$i++)
                $separator .=$string;
            $list = $this->findAll($condition);
            foreach($list as $li){
                $tree[$li->id] = $separator.$li->name;
                $sublevel = $level + 1;
                $tree += $this->generateTree('parent_id ='.$li->id,$string,$sublevel);
            }               
            return $tree;
        }  
        
        public function getListId($id){
            $listId = array();
            $list = $this->findAll('parent_id ='.$id);
            $listId = CHtml::listData($list,'id','id');
            $listId[$id] = $id; 
            foreach($list as $cat){                
                $listId += $this->getListId($cat->id);
            }             
            return $listId;
        }      
        
}