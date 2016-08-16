<?php
class CardAccountNoCheck extends CActiveRecord
{
        public $captcha;
        public $newpass;
        public $confirmpass;
        public $oldpass;
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
		return 'card_accounts';
	}        
        
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, numbercard,created, numberaccount, modified, password_card,mobile,address', 'required'),
			array('member_id, numbercard, numberaccount,money', 'numerical', 'integerOnly'=>true),
                        array('status','length','allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,member_id, numbercard,created, numberaccount, modified, password_card', 'safe', 'on'=>'search'),
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
                    'Member'=>array(self::HAS_ONE,'Member','member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'member_id' => 'Mã thành viên',
			'numbercard' => 'Số thẻ',
			'password_card' => 'Mật khẩu thẻ',
			'created' => 'Ngày mở',
			'modified' => 'Modified',
			'numberaccount' => 'Số tài khoản',
                        'mobile'=>'Số điện thoại nhận SMS',
                        'max_transfer'=>'max_transfer'
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
		$criteria->compare('member_id',$this->member_id,true);
		$criteria->compare('numbercard',$this->numbercard,true);
		$criteria->compare('password_card',$this->password_card);
		$criteria->compare('numberaccount',$this->numberaccount,true);		
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}        
}