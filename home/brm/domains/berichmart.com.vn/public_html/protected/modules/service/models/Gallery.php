<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class Gallery extends CActiveRecord
{
	public static function model($className = __CLASS__) {
            return parent::model($className);
        }


                	/**
	 * Declares the validation rules.
	 */
        public function tableName() {
            return 'galleries';//tên trong csdl
        }

        public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('images,created,modified,status,link', 'required'),
			// email has to be a valid email address
			array('id,status', 'numerical','integerOnly'=>TRUE),
			// verifyCode needs to be entered correctly
			array('images, thumb', 'length','max'=>256),
                        array('name','length','allowEmpty'=>TRUE),
                        array('name','length','max'=>50),
                        array('id,name,images,created,modified,status,thumb,link','safe','on'=>'search')
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
        public function relations()
                    { 
                return array();

            }
        public function attributeLabels()
	{
		return array(
			'id'=>'Mã',
                        'name'=>'Tên ảnh',
                        'images'=>'ảnh',
                        'created'=>'ngày tạo',
                        'modified'=>'ngày sửa',
                        'status'=>'status',
                        'thumb'=>'thumb',
                        'link'=>'Link click ảnh',
		);
	}
      public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('images',$this->images,true);
		
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('status',$this->status);
                $criteria->compare('thumb',$this->thumb,true);
                $criteria->compare('link',$this->link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}