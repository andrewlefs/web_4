<?php
class HoaDonXuat extends CActiveRecord
{
        /**
        * @var string post MaPX
        * @soap
        */
        public $MaPX;
        /**
        * @var string post NgayXuat
        * @soap
        */
        public $NgayXuat;
        /**
        * @var string post MaKho
        * @soap
        */
        public $MaKho;
        /**
        * @var string post member_id
        * @soap
        */
        public $member_id;
        /**
        * @var string post NguoiNhan
        * @soap
        */
        public $NguoiNhan;
        /**
        * @var string post NoiDung
        * @soap
        */
        public $NoiDung;
        /**
        * @var float post TienCK
        * @soap
        */
        public $TienCK;
        /**
        * @var float post TienHang
        * @soap
        */
        public $TienHang;
        /**
        * @var float post TienVAT
        * @soap
        */
        public $TienVAT;
        /**
        * @var float post TongPX
        * @soap
        */
        public $TongPX;
        /**
        * @var float post TongDiem
        * @soap
        */
        public $TongDiem;
        /**
        * @var float post TongHHTieuDung
        * @soap
        */
        public $TongHHTieuDung;
        /**
        * @var string post MaNV
        * @soap
        */
        public $MaNV;
        
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
		return 'hoadon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MaPX,member_id', 'required'),
			array('NgayXuat, MaKho, NguoiNhan,NoiDung,TienCK,TienHang,TienVAT,TongPX,MaNV,TongDiem,TongHHTieuDung', 'length', 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('MaPX,member_id,NgayXuat, MaKho, NguoiNhan,NoiDung,TienCK,TienHang,TienVAT,TongPX,MaNV', 'safe', 'on'=>'search'),
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

		$criteria->compare('MaPX',$this->MaPX);
		$criteria->compare('member_id',$this->member_id,true);
		$criteria->compare('NgayXuat',$this->NgayXuat,true);
		$criteria->compare('MaKho',$this->MaKho);
		$criteria->compare('NguoiNhan',$this->NguoiNhan,true);
		$criteria->compare('MaNV',$this->MaNV);
		$criteria->compare('TienVAT',$this->TienVAT,true);
		$criteria->compare('TienCK',$this->TienCK,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
}