<?php

/**
 * This is the model class for table "members".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $password
 * @property string $name
 * @property string $fullname
 * @property string $email
 * @property string $yahoo
 * @property string $birthday
 * @property string $sex
 * @property string $avatar
 * @property string $created
 * @property string $modified
 * @property string $skype
 * @property integer $status
 */                        
class Member extends CActiveRecord
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
		return 'members';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
        public function is_exist($attribute,$params){
            if(!empty($this->$attribute)){
                $member = $this->find($attribute.'="'.$this->$attribute.'"');
                if($member)
                    $this->addError($attribute, 'Tên truy cập đã tồn tại. Vui lòng thử tên khác!');
            }
        }
        public function checkperson($attribute,$params){
            if(!empty($this->$attribute)){ 
                $member = $this->find('name="'.$this->$attribute.'"');
                if(!$member)
                    $this->addError($attribute, 'Thanh vien nay khong ton tai. Vui long nhap lai ten thanh vien');
            }
        }
        
        public function checkcaptcha($attribute,$params){
            $captcha=Yii::app()->controller->createAction("captcha");
            $code = $captcha->verifyCode;
            if(trim($this->$attribute)!='' && trim($this->$attribute)!=$code)
                $this->addError($attribute, 'Mã số an toàn không chính xác');
        }
        
        // check pass dung
        public function checkpass($attribute,$params){
            //echo getString($this->password, 3).' : '.$this->$attribute;
            $member = $this->findByPk($this->id);
            if(getString($member->password, 3)!=$this->$attribute)
                 $this->addError($attribute, 'Mật khẩu không chính xác');   
        }
        
        // check pas moi
        public function checkconfirmpass($attribute,$params){
            if($this->$attribute!='' && $this->newpass!='')
                if($this->$attribute!=$this->newpass)
                    $this->addError($attribute, 'Xác nhận mật khẩu không chính xác');   
        }

        public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,password,fullname,email,birthday,city_id,sex,created, modified,address,cmnd,date_create,place_create,phone,person1,person2,captcha,newpass,confirmpass,oldpass,address_cmnd', 'required','message'=>'{attribute} không được để trống'),
			array('status, vip, level,parents,lft,rgt,city_id,sex', 'numerical', 'integerOnly'=>true),			
                        array('name','numerical','message'=>'{attribute} phải là số'),
                        array('name', 'length', 'max'=>200,'min'=>4), 
                        array('oldpass','checkpass'),
                        array('confirmpass','checkconfirmpass'),
                        //array('name','is_exist'),                        
                        array('person1,person2','checkperson'),
                        array('password','length','min'=>6),
                        array('captcha', 'checkcaptcha'),
                       // array('captcha', 'captcha', 'allowEmpty'=>CCaptcha::checkRequirements()),
                        array('avatar','file','types'=>'jpg, gif, png','maxSize'=>50*1024,'allowEmpty'=>true),
                        array('email','email','message'=>'Địa chỉ email không hợp lệ'),
                        array('vip, parents,lft,rgt','numerical','allowEmpty'=>true),
                        array('avatar','length','allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,vip,fullname,email,city, parents, name, lft,level, created, modified, rgt, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('MemberBonus'=>array(self::HAS_MANY,'MemberBonus','submember_id'),
                    'MemberBuying'=>array(self::HAS_MANY,'MemberBuying','member_id'),
                    'City'=>array(self::BELONGS_TO,'City','place_create'),
                    'CardAccount'=>array(self::HAS_ONE,'CardAccount','member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parents' => 'Thành viên giới thiệu',
			'name' => 'Tên thành viên',
			'title' => 'Danh hiệu',
			'vip' => 'Vip',
			'level' => 'Level',
			'lft' => 'Trái',
			'rgt' => 'Phải',
			'created' => 'Created',
			'modified' => 'Modified',
                        'password'=>'Mật khẩu',
                        'fullname'=>'Họ tên',
                        'email'=>'Email',
                        'sex'=>'Giới tính',
                        'birthday'=>'Ngày sinh',
                        'city_id'=>'city',
                        'yahoo'=>'yahoo',
                        'skype'=>'skype',
                        'avatar'=>'Avatar',
                        'person1'=>'Người giới thiệu 1',
                        'person2'=>'Người giới thiệu 2',
                        'address'=>'Địa chỉ',
                        'cmnd'=>'CMND',
                        'place_create'=>'Nơi cấp',
                        'phone'=>'Số điện thoại',
                        'newpass'=>'Mật khẩu mới',
                        'oldpass'=>'Mật khẩu cũ',
                        'address_cmnd'=>'Địa chỉ theo CMND',
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
		$criteria->compare('parents',$this->parents,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('vip',$this->vip);
		$criteria->compare('lft',$this->lft,true);
		$criteria->compare('rgt',$this->rgt,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}     
        
       function getTreeMember($condition,$level=0){ 
           $members= $this->findAll($condition); 
           $data='<ul '.(($level==0)? 'id="mixed"':'').'>';  $level++;
             foreach($members as $member){
                 $childs = $this->findAll('parents ='.$member->id);
                 if($member->title==0){
                     $class='tvkn';
                     $change='<a href="'.  getURL().'member/default/changeMember/'.$member->id.'" class="btchange">Thay thế </a>';
                 }
                 else {
                     $class='tvct';
                     $change='';
                 }
                 if($level==1)
                    $class = 'member_root'; 
                 if(count($childs)>0)
                     $data .='<li><span value="'.$member->id.'" class="'.$class.'">'.(($level>1)?'['.($level-1).'] ':'').$member->fullname.' ('.$member->created.')'.$change.'</span>'.$this->getTreeMember('parents ='.$member->id,$level).'</li>';
                 else
                     $data .='<li><span value="'.$member->id.'" class="'.$class.'">'.(($level>1)?'['.($level-1).'] ':'').$member->fullname.' ('.$member->created.')'.$change.'</span></li>';
             }
           $data.='</ul>';          
           return $data;
       }
        
}