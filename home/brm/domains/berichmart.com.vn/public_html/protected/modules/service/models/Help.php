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
class Help extends CActiveRecord
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
		return 'helps';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sdt,email,yahoo,created, modified, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('hotline, email, skype,yahoo,sdt','length','max'=>256),
                    array('hotline,skype','length','allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,email,yahoo,hotline,skype,sdt,created, modified, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                            'id' => 'ID',
                            'yahoo'=>'Yahoo',
                            'email' => 'Email',
                            'hotline'=>'Số đt di động',
                            'skype'=>'Skype',
                            'sdt'=>'Số đt bàn',
                            'created' => 'Created',
                            'modified' => 'Modified',
                            'status' => 'Trạng thái',
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
		$criteria->compare('yahoo',$this->yahoo,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('hotline',$this->hotline);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('sdt',$this->sdt,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}