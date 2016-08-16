<?php
class Setting extends CActiveRecord
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
		return 'settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                    array('name, title, info_other,address,phone,mobile,email,fax','length','allowEmpty'=>true),
                    //array('status,view,hotnews,slidenews','numerical','allowEmpty'=>true),
				// The following rule is used by search().
			// Please remove those attributes that should not be searched.
                    array('id,name, title, info_other,address,phone,mobile,email,fax', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()//câu lệnh liên kết của news vs category thông qua category_id
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}                     //bí danh                          tên mode

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{ 
		return array(
                        
                            'id' => 'ID',
                            'name' => 'Tên công ty',
                            'title' => 'Tiêu đề',
                            'info_other'=>'Thông tin khác',
                            'address' => 'Địa chỉ',
                            'phone' => 'Điện thoại',
                            'mobile' => 'Di động',
                            'email' => 'Email',
                            'fax' => 'Fax',
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
//id,name, title, info_other,address,phone,mobile,email,fax'
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('info_other',$this->info_other);
		$criteria->compare('address',$this->address,true);
                $criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email ',$this->email ,true);
		$criteria->compare('fax',$this->fax,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                  
		));
	}
}