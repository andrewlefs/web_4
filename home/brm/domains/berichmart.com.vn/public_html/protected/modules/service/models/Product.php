<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $name
 * @property string $images
 * @property string $created
 * @property string $modified
 * @property string $view
 * @property integer $status
 */
class Product extends CActiveRecord
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
		return 'products';
	}
        
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title,bonus,price_sell,price_buy,shipping,bog,km,hhh', 'required'),
			array('title, alias,image', 'length', 'max'=>255),
                        array('category_id,famous, reduce,view,group_product_id,status,producer_id', 'numerical','allowEmpty'=>true),
                        array('content,material,color,type,origin,code,meta_key,meta_des,modified,created,image,image1,image2,quality,fields','length','allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_id, title, alias,created, modified, meta_key, meta_des, status', 'safe', 'on'=>'search'),
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
                    'Producer'=>array(self::BELONGS_TO,'Producer','producer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Danh mục',
			'title' => 'Tên sản phẩm',
			'alias' => 'Bí danh',
			'code' => 'Mã sản phẩm',
                        'quantity' => 'Số lượng',
			'price_sell' => 'Gía bán',
			'meta_key' => 'Tư khóa SEO',
			'meta_des' => 'Nôi dung tóm tắt SEO',
			'created' => 'Created',
			'modified' => 'Modified',
			'status' => 'Trạng thái',
                        'introduction'=>'Tóm tắt',
                        'content'=>'Nội dung',
                        'bonus'=>'Triết khấu',
                        'image'=>'Hình ảnh 1',
                        'image1'=>'Hình ảnh 2',
                        'image2'=>'Hình ảnh 3',
                        'quality'=>'Chất lượng',
                        'producer_id'=>'Nhà sản xuất',
                        'origin'=>'Nguồn gốc',
                        'type'=>'Loại',
                        'color'=>'Màu sắc',
                        'material'=>'Chất liệu',
                        'famous'=>'Sản phẩm nổi bật',
                        'reduce'=>'Sản phẩm giảm giá',
                        'price_buy'=>'Gía nhập',
                        'shipping'=>'Phí vận chuyển',
                        'bog'=>'Bình ổn giá',
                        'km'=>'Khuyễn mại',
                        'hhh'=>'Hàng hư hỏng',
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
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias);
		$criteria->compare('code',$this->code,true);
                $criteria->compare('price_sell',$this->price_sell,true);
		$criteria->compare('meta_key',$this->meta_key);
		$criteria->compare('meta_des',$this->meta_des,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}       
        
        
}