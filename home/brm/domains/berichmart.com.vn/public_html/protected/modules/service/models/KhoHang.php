<?php
class KhoHang extends CActiveRecord
{
        /**
        * @var string post makho
        * @soap
        */
        public $makho;
        /**
        * @var string post tenkho
        * @soap
        */
        public $tenkho;
        /**
        * @var string post diachi
        * @soap
        */
        public $diachi;
        /**
        * @var string post dienthoai
        * @soap
        */
        public $dienthoai;
        
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
		return 'khohang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('makho', 'required'),
			array('tenkho, diachi, dienthoai', 'length', 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('makho,tenkho, diachi, dienthoai', 'safe', 'on'=>'search'),
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

		$criteria->compare('makho',$this->makho);
		$criteria->compare('tenkho',$this->tenkho,true);
		$criteria->compare('diachi',$this->diachi,true);
		$criteria->compare('dienthoai',$this->dienthoai);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
}