<?php
class NhanVien extends CActiveRecord
{
        /**
        * @var string post manv
        * @soap
        */
        public $manv;
        /**
        * @var string post tennv
        * @soap
        */
        public $tennv;
        /**
        * @var int post gioitinh
        * @soap
        */
        public $gioitinh;
        /**
        * @var string post ngaysinh
        * @soap
        */
        public $ngaysinh;
        /**
        * @var string post cmnd
        * @soap
        */
        public $cmnd;
        /**
        * @var string post diachi
        * @soap
        */
        public $diachi;
        /**
        * @var string post ghichu
        * @soap
        */
        public $ghichu;
        /**
        * @var string post ngayvaolam
        * @soap
        */
        public $ngayvaolam;
        
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
		return 'nhanvien';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('manv', 'required'),
			array('tennv, gioitinh, ngaysinh,cmnd,diachi,ghichu,ngayvaolam', 'length', 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('manv,tennv, gioitinh, ngaysinh,cmnd,diachi,ghichu,ngayvaolam', 'safe', 'on'=>'search'),
		);
	}

	/**,
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array( //'Parent'=>array(self::BELONGS_TO,'Category','parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			
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

		$criteria->compare('manv',$this->manv);
		$criteria->compare('tennv',$this->tennv,true);
		$criteria->compare('gioitinh',$this->gioitinh,true);
		$criteria->compare('ngaysinh',$this->ngaysinh);
		$criteria->compare('cmnd',$this->cmnd,true);
		$criteria->compare('diachi',$this->diachi);
		$criteria->compare('ghichu',$this->ghichu,true);
		$criteria->compare('ngayvaolam',$this->ngayvaolam,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
}