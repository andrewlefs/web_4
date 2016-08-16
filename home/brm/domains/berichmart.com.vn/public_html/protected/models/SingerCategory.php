<?php
class SingerCategory extends CActiveRecord
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
		return 'singer_categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,position,created, modified, status', 'required'),
                        array('parent_id,position,status','numerical','integerOnly'=>true),
                        array('parent_id','numerical','allowEmpty'=>true),
			array('name','length','max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,name,parent_id,created, modified, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('Parent'=>array(self::BELONGS_TO,'SingerCategory','parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                            'id' => 'ID',
                            'name'=>'Tên thể loại album',
                            'parent_id'=>'Danh mục cha',
                            'position'=>'Vị trí',
                            'status'=>'Trạng thái',
                            'created' => 'Created',
                            'modified' => 'Modified',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('parent_id',$this->parent_id,true);
                $criteria->compare('position',$this->position,true);
                $criteria->compare('status',$this->status,true);                
                $criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        // ham tra ve mang cay array('key'=>'name')
        public function generateTree($condition,$string='-',$level=0){
            $tree = array();
            $separator ='';
            for($i=1;$i<=$level;$i++){ 
                if($i>1)
                    $separator .='||';
                $separator .=$string;
            }
            $list = $this->findAll($condition);
            foreach($list as $li){
                $tree[$li->id] = $separator.$li->name;
                $sublevel = $level + 1;
                $tree += $this->generateTree('parent_id ='.$li->id,$string,$sublevel);
            }               
            return $tree;
        }  
        
        // ham tra ve mang cay array(index=>array(),...,...)
        public function listCats($condition,$string='---',$level=0){
            $tree = array();
            $separator ='';
            for($i=1;$i<=$level;$i++){ 
                if($i>1)
                    $separator .='||';
                $separator .=$string;
            }
            $list = $this->findAll($condition);
            foreach($list as $li){
                $tree[] = array('separator'=>$separator,'cat'=>$li);
                $sublevel = $level + 1;
                $tree = $this->sum($tree,$this->listCats('parent_id ='.$li->id,$string,$sublevel));
            }            
            return $tree;
        } 
        
        // cong 2 mang theo co che giu nguyen 2 mang , key tang dan
        public function sum($arr1=  array(),$arr2=  array()){
            $count= count($arr1);
            $tg= array();
            for($i=0;$i<count($arr2);$i++)
                $tg[$count+$i]=$arr2[$i];
            return $arr1 + $tg;
        }
        
        public function getCountVideo(){
            $count = Yii::app()->db->createCommand('select count(*) from videos where singer_category_id like "%,'.$this->id.',%"')->queryScalar();
            return $count;
        }
}