<?php
class HoaDonXuatCT extends CActiveRecord
{
        /**
        * @var string post MaPX
        * @soap
        */
        public $MaPX;
        /**
        * @var string post MaHang
        * @soap
        */
        public $MaHang;
        /**
        * @var int post SoLuong
        * @soap
        */
        public $SoLuong;
        /**
        * @var int post DonGia
        * @soap
        */
        public $DonGia;
        /**
        * @var float post ChietKhau
        * @soap
        */
        public $ChietKhau;
        /**
        * @var float post ThueSuatVAT
        * @soap
        */
        public $ThueSuatVAT;
        /**
        * @var int post GiaVon
        * @soap
        */
        public $GiaVon;
        /**
        * @var string post MaVach
        * @soap
        */
        public $MaVach;
        
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
		return 'hoadonchitiet';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MaPX,MaHang', 'required'),
			array('SoLuong, DonGia, ChietKhau,ThueSuatVAT,GiaVon,MaVach', 'length', 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('MaPX,MaHang,SoLuong, DonGia, ChietKhau,ThueSuatVAT,GiaVon,MaVach', 'safe', 'on'=>'search'),
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
		$criteria->compare('MaHang',$this->MaHang,true);
		$criteria->compare('SoLuong',$this->SoLuong,true);
		$criteria->compare('DonGia',$this->DonGia);
		$criteria->compare('ChietKhau',$this->ChietKhau,true);
		$criteria->compare('ThueSuatVAT',$this->ThueSuatVAT);
		$criteria->compare('GiaVon',$this->GiaVon,true);
		$criteria->compare('MaVach',$this->MaVach,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
}