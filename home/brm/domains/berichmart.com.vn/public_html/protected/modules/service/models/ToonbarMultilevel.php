<?php
defined( '_HGEXEC' ) or die( 'Restricted access' );
/**
 * ToonbarMultilevel class.
 */
   class ToonbarMultilevel extends CActiveRecord{
   public   $_connection;
	public  $_parent = 0; 	
	public 	$_data; 
	public 	$_id;
	public 	$_orderArr;
	
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	public function tableName(){
		return '{{sanpham}}';
	}
	public function __construct() {
		$connection=Yii::app()->db;
		$this->_connection=$connection;
	}
	/**
	* Update info of node
	* 
	* @author chiennv
	*
	* @param  array Data array store node info.
	* @param  int ID of node which you modify.
	* @param  int ID of parent node if you change parent node when you update current node
	*
	* @return A node modified and node info save to database.
	*/
	
	public function updateNode($table,$data,$id = null,$newParentId = 0){
		if($id != null && $id != 0){
			$nodeInfo = $this->getNodeInfo($id);
			$strUpdate = $this->createUpdateQuery($data);
			$sql	= 'UPDATE {{'.$table.'}} 
					   SET ' . $strUpdate . '  
					   WHERE id = '.$id;		
		$command=$this->_connection->createCommand($sql);
		$dataReader=$command->query();	
		}
		
		if($newParentId != null && $newParentId > 0){
			if($nodeInfo['parents'] != $newParentId){
				$this->moveNode($id,$newParentId);
			}
		}
		
	}
	/**
	* Move node to new parent (move: left - right - before - after)
	* 
	* @author chiennv
	*
	* @param  int ID of node which you want move to new parent.
	* @param  int ID of parent node which you want apply new node
	* @param  array Case when you apply new node (apply: left position - right position - before position - after position)
	*
	* @return Change tree structure.
	*/
	
	public function moveNode($id, $parent = 0, $options = null){
		$this->_id 	= $id;
		$this->_parent 	= $parent;
		
		if($options['position'] == 'right' || $options == null)	$this->moveRight();
		
		if($options['position'] == 'left')	$this->moveLeft();
		
		if($options['position'] == 'after')	$this->movetAfter($options['brother_id']);
		
		if($options['position'] == 'before') $this->moveBefore($options['brother_id']);
	}
	/**
	* Move node to left postion a unit on a level
	* 
	* @author chiennv
	*
	* @param  int ID of node which you want move to new position.
	* 
	* @return Change tree structure.
	* 
	*/
	public function moveUp($table,$id){
		$nodeInfo = $this->getNodeInfo($id);		
		$parentInfo = $this->getNodeInfo($nodeInfo['parents']);
		
		$sql 	= 'SELECT * 
				   FROM {{'.$table.'}} 
				   WHERE lft < ' . $nodeInfo['lft'] . '
				   AND parents = ' . $nodeInfo['parents'] . ' 
				   ORDER BY lft DESC 
				   LIMIT 1
				   ';
		$command=$this->_connection->createCommand($sql);
		$result=$command->query();
		//$result = mysql_query($sql,$this->_connect);
		$nodeBrother = mysql_fetch_assoc($result);
		
		if(!empty($nodeBrother)){
			
			$options = array('position'=>'before','brother_id'=>$nodeBrother['id']);
			$this->moveNode($id,$parentInfo['id'],$options);
		}
		
	}
	/**
	* Move node to right postion a unit on a level
	* 
	* @author chiennv
	*
	* @param  int ID of node which you want move to new position.
	* 
	* @return Change tree structure.
	* 
	*/
	public function moveDown($table,$id){
		$nodeInfo = $this->getNodeInfo($id);		
		$parentInfo = $this->getNodeInfo($nodeInfo['parents']);
		
		$sql 	= 'SELECT * 
				   FROM {{'.$table.'}} 
				   WHERE lft > ' . $nodeInfo['lft'] . '
				   AND parents = ' . $nodeInfo['parents'] . ' 
				   ORDER BY lft ASC  
				   LIMIT 1
				   ';
		$command=$this->_connection->createCommand($sql);
		$result=$command->query();		   
		//$result = mysql_query($sql,$this->_connect);
		$nodeBrother = mysql_fetch_assoc($result);
		
		if(!empty($nodeBrother)){
			
			$options = array('position'=>'after','brother_id'=>$nodeBrother['id']);
			$this->moveNode($id,$parentInfo['id'],$options);
		}
	}
	/**
	* Get info of parent node
	* 
	* @author chiennv
	*
	* @param  int ID of node which you want get info
	* 
	* @return Node info.
	* 
	*/
	public function getParentNode($id){
		$infoNode = $this->getNodeInfo($id);
		$parentId = $infoNode['parents'];		
		$infoParentNode = $this->getNodeInfo($parentId);
		return $infoParentNode;
	}
	/**
	* Update ordering of all node in tree
	* 
	* @author chiennv
	*
	* @param  array An array store info tree
	* @param  array An array store info of ordering
	* 
	* @return Change tree structure.
	* 
	*/
	public function orderTree($data,$orderArr){
				
		$orderGroup = $this->orderGroup($data);				
		$newOrderGroup = array();
		foreach ($orderGroup as $key => $val){
			$tmpVal = array();
			foreach ($val as $key2 => $val2){
				$tmpVal[$key2] = $orderArr[$key2];
			}
			natsort($tmpVal);		
			$orderGroup[$key] = $tmpVal;
		}
		
		foreach ($orderGroup as $key => $val){
			$tmpVal = array();
			foreach ($val as $key2 => $val2){
				$info = $this->getNodeByLeft($key2);
				$tmpVal[$info['id']] = $val2;
			}
			$orderGroup[$key] = $tmpVal;
		}
	
		foreach ($orderGroup as $key => $val){
			foreach ($val as $key2 => $val2){
				$nodeID = $key2;
				$parent = $key;				
				$this->moveNode($nodeID, $parent);
			}
		}
	}
	/**
	* Get info of node
	* 
	* @author chiennv
	*
	* @param  int Left value of node
	* 
	* @return array Node info.
	* 
	*/
	protected function getNodeByLeft($table,$left){
		$sql = 'SELECT * FROM {{'.$table.'}} WHERE lft = ' . $left;
		$command=$this->_connection->createCommand($sql);
		$result=$command->query();
		//$result = mysql_query($sql,$this->_connect);
		$row = mysql_fetch_assoc($result);
		return $row;
	}
	/**
	* Create node groups
	* 
	* @author chiennv
	*
	* @param  array An array store info tree
	* 
	* @return array of node groups
	* 
	*/
		
	public function orderGroup($data = null){
                $orderArr2 = array();
		if($data != null){
			$orderArr = array();
		 	if(count($data)>0){
		 		foreach ($data as $key => $val){
		 			$orderArr[$val['id']] = array();
		 			if(isset($orderArr[$val['parents']])){
		 				$orderArr[$val['parents']][] = $val['lft'];
		 			}
		 		}
		 		//$orderArr2 = array();
		 		foreach ($orderArr as $key => $val){
		 			$tmp = array();
		 			$tmp = $orderArr[$key];
		 			if(count($tmp)>0){
		 				$orderArr2[$key] = array_flip($val);
		 			}
		 		}
		 		
		 	}
		}
		$this->_orderArr = $orderArr2;
		return $this->_orderArr;
	}
	/**
	* Create ordering of node by left value
	* 
	* @author chiennv
	*
	* @param int ID of parent of current node
	* @param int Letf value of current node
	* 
	* @return int An value of ordering 
	* 
	*/
	public function getNodeOrdering($parent,$left){
            if($parent>1){
		$ordering = $this->_orderArr[$parent][$left] + 1;
		return $ordering;}
	}
	/**
	* Create breadcrumbs for nodes of tree 
	* 
	* @author chiennv
	*
	* @param int ID of current node
	* @param int level of parent where you want get info
	* 
	* @return array An array store info of breadcrumbs
	* 
	*/
	public function breadcrumbs($table,$id, $level_stop = null){
		$sql = 'SELECT parent.* 
				FROM {{'.$table.'}} AS node,
			         {{'.$table.'}} AS parent
				WHERE node.lft BETWEEN parent.lft AND parent.rgt
			      AND node.id = ' . $id;
		
		if(isset($level_stop)){
			$sql .= ' AND parent.level > ' . $level_stop;
		}
		
		$sql .= ' ORDER BY node.lft';
		
		//echo '<br>' . $sql;
		//$result = mysql_query($sql,$this->_connect);
		$command=$this->_connection->createCommand($sql);
		$result=$command->query();
		if($result){
			while($row = mysql_fetch_assoc($result)){
				$arrData[] = $row;
			}
		}
		return $arrData;
	}
	/**
	* Processing move node to before position of other node
	* 
	* @author chiennv
	*
	* @param int ID of node which you want move current node to before postion
	* 
	* @return Change tree structure
	* 
	*/
	protected function moveBefore($table,$brother_id){
		
		$infoMoveNode = $this->getNodeInfo($this->_id);
		
		$lftMoveNode = $infoMoveNode['lft'];
		$rgtMoveNode = $infoMoveNode['rgt'];
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);		
		
		$sqlReset = 'UPDATE {{'.$table.'}} 
					 SET rgt = (rgt -  ' . $rgtMoveNode . '),  
					 	 lft = (lft -  ' . $lftMoveNode . ')   
					  WHERE lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		$command=$this->_connection->createCommand($sqlReset);
		$result=$command->query();
		//mysql_query($sqlReset,$this->_connect);
		
		
		$slqUpdateRight = 'UPDATE {{'.$table.'}}  
						   SET rgt = (rgt -  ' . $widthMoveNode . ')  
							WHERE rgt > ' . $rgtMoveNode;		
		$command=$this->_connection->createCommand($slqUpdateRight);
		$result=$command->query();
		//mysql_query($slqUpdateRight,$this->_connect);
		
		$slqUpdateLeft = 'UPDATE {{'.$table.'}} 
						  SET lft = (lft -  ' . $widthMoveNode . ') 
						  WHERE lft > ' . $rgtMoveNode;
		$command=$this->_connection->createCommand($slqUpdateLeft);
		$result=$command->query();
		//mysql_query($slqUpdateLeft,$this->_connect);
		
				
		$infoBrotherNode = $this->getNodeInfo($brother_id);
		$lftBrotherNode = $infoBrotherNode['lft'];
		
		
		$slqUpdateLeft = 'UPDATE {{'.$table.'}} 
						  SET lft = (lft +  ' . $widthMoveNode . ') 
						  WHERE lft >= ' . $lftBrotherNode . ' 
						  AND rgt>0';
		$command=$this->_connection->createCommand($slqUpdateLeft);
		$result=$command->query();
		//mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE {{'.$table.'}}  
						   SET rgt = (rgt +  ' . $widthMoveNode . ')  
							WHERE rgt >= ' . $lftBrotherNode;	
		$command=$this->_connection->createCommand($slqUpdateRight);
		$result=$command->query();						
		//mysql_query($slqUpdateRight,$this->_connect);
		
		
		$infoParentNode 	= $this->getNodeInfo($this->_parent);
		$levelMoveNode 		= $infoMoveNode['level'];
		$levelParentNode	= $infoParentNode['level'];
		$newLevelMoveNode  = $levelParentNode + 1;
		
		$slqUpdateLevel = 'UPDATE {{'.$table.'}} 
						  SET level = (level  -  ' . $levelMoveNode . ' + ' . $newLevelMoveNode . ')
						  WHERE rgt <= 0';
		$command=$this->_connection->createCommand($slqUpdateLevel);
		$result=$command->query();				  
		//mysql_query($slqUpdateLevel,$this->_connect);
		
		$newParent 	= $infoParentNode['id'];
		$newLeft 	= $infoBrotherNode['lft'];
		$newRight 	= $infoBrotherNode['lft'] + $widthMoveNode - 1;
		$slqUpdateParent = 'UPDATE {{'.$table.'}}  
						  SET parents = ' . $newParent . ',  
						      lft = ' . $newLeft . ',  
						  	  rgt = ' . $newRight . '  
						  WHERE id = ' . $this->_id;
		$command=$this->_connection->createCommand($slqUpdateParent);
		$result=$command->query();				  
		//mysql_query($slqUpdateParent,$this->_connect);
		
		$slqUpdateNode = 'UPDATE {{'.$table.'}}  
						  SET rgt = (rgt +  ' . $newRight . '), 
						   	  lft = (lft +  ' . $newLeft . ') 
						  WHERE rgt <0';
		$command=$this->_connection->createCommand($slqUpdateNode);
		$result=$command->query();					
		//mysql_query($slqUpdateNode,$this->_connect);
	}
	/**
	* Processing move node to after position of other node
	* 
	* @author chiennv
	*
	* @param int ID of node which you want move current node to after postion
	* 
	* @return Change tree structure
	* 
	*/
	protected function movetAfter($table,$brother_id){

		$infoMoveNode = $this->getNodeInfo($this->_id);
		
		$lftMoveNode = $infoMoveNode['lft'];
		$rgtMoveNode = $infoMoveNode['rgt'];
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);
		
		
		$sqlReset = 'UPDATE {{'.$table.'}} 
					 SET rgt = (rgt -  ' . $rgtMoveNode . '),  
					 	 lft = (lft -  ' . $lftMoveNode . ')   
					  WHERE lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		$command=$this->_connection->createCommand($sqlReset);
		$result=$command->query();
		//mysql_query($sqlReset,$this->_connect);
		
		$slqUpdateRight = 'UPDATE {{'.$table.'}}  
						   SET rgt = (rgt -  ' . $widthMoveNode . ')  
							WHERE rgt > ' . $rgtMoveNode;
		$command=$this->_connection->createCommand($slqUpdateRight);
		$result=$command->query();					
		///mysql_query($slqUpdateRight,$this->_connect);
		
		$slqUpdateLeft = 'UPDATE {{'.$table.'}} 
						  SET lft = (lft -  ' . $widthMoveNode . ') 
						  WHERE lft > ' . $rgtMoveNode;	
		$command=$this->_connection->createCommand($slqUpdateLeft);
		$result=$command->query();						  
		//mysql_query($slqUpdateLeft,$this->_connect);
		
		
		$infoBrotherNode = $this->getNodeInfo($brother_id);
		$rgtBrotherNode = $infoBrotherNode['rgt'];		
		
		$slqUpdateLeft = 'UPDATE {{'.$table.'}} 
						  SET lft = (lft +  ' . $widthMoveNode . ') 
						  WHERE lft > ' . $rgtBrotherNode . ' 
						  AND rgt>0';
		$command=$this->_connection->createCommand($slqUpdateLeft);
		$result=$command->query();					
		//mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE {{'.$table.'}}  
						   SET rgt = (rgt +  ' . $widthMoveNode . ')  
							WHERE rgt > ' . $rgtBrotherNode;
		$command=$this->_connection->createCommand($slqUpdateRight);
		$result=$command->query();					
		//mysql_query($slqUpdateRight,$this->_connect);
		
		
		$infoParentNode = $this->getNodeInfo($this->_parent);
		$levelMoveNode 		= $infoMoveNode['level'];
		$levelParentNode	= $infoParentNode['level'];
		$newLevelMoveNode  = $levelParentNode + 1;
		
		$slqUpdateLevel = 'UPDATE {{'.$table.'}} 
						  SET level = (level  -  ' . $levelMoveNode . ' + ' . $newLevelMoveNode . ')
						  WHERE rgt <= 0';
		$command=$this->_connection->createCommand($slqUpdateLevel);
		$result=$command->query();				  
		//mysql_query($slqUpdateLevel,$this->_connect);		
		
		$newParent 	= $infoParentNode['id'];
		$newLeft 	= $infoBrotherNode['rgt'] + 1;
		$newRight 	= $infoBrotherNode['rgt'] + $widthMoveNode;
		$slqUpdateParent = 'UPDATE {{'.$table.'}}  
						  SET parents = ' . $newParent . ',  
						      lft = ' . $newLeft . ',  
						  	  rgt = ' . $newRight . '  
						  WHERE id = ' . $this->_id;	
		$command=$this->_connection->createCommand($slqUpdateParent);
		$result=$command->query();				  
		//mysql_query($slqUpdateParent,$this->_connect);		
		
		$slqUpdateNode = 'UPDATE {{'.$table.'}}  
						  SET rgt = (rgt +  ' . $newRight . '), 
						   	  lft = (lft +  ' . $newLeft . ') 
						  WHERE rgt <0';
		$command=$this->_connection->createCommand($slqUpdateNode);
		$result=$command->query();				  
		//mysql_query($slqUpdateNode,$this->_connect);
	}
	/**
	* Processing move node to left position of other node
	* 
	* @author chiennv
	*
	* @return Change tree structure
	* 
	*/
	protected function moveLeft($table){
		
		$infoMoveNode = $this->getNodeInfo($this->_id);
		
		$lftMoveNode = $infoMoveNode['lft'];
		$rgtMoveNode = $infoMoveNode['rgt'];
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);
		
		$sqlReset = 'UPDATE {{'.$table.'}} 
					 SET rgt = (rgt -  ' . $rgtMoveNode . '),  
					 	 lft = (lft -  ' . $lftMoveNode . ')   
					  WHERE lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		$command=$this->_connection->createCommand($sqlReset);
		$result=$command->query();			  
		//mysql_query($sqlReset,$this->_connect);
		
		$slqUpdateRight = 'UPDATE {{'.$table.'}}  
						   SET rgt = (rgt -  ' . $widthMoveNode . ')  
							WHERE rgt > ' . $rgtMoveNode;
		$command=$this->_connection->createCommand($slqUpdateRight);
		$result=$command->query();					
		//mysql_query($slqUpdateRight,$this->_connect);
		
		$slqUpdateLeft = 'UPDATE {{'.$table.'}} 
						  SET lft = (lft -  ' . $widthMoveNode . ') 
						  WHERE lft > ' . $rgtMoveNode;
		$command=$this->_connection->createCommand($slqUpdateLeft);
		$result=$command->query();
		//mysql_query($slqUpdateLeft,$this->_connect);
		
		$infoParentNode = $this->getNodeInfo($this->_parent);
		$lftParentNode = $infoParentNode['lft'];
		
		$slqUpdateLeft = 'UPDATE {{'.$table.'}} 
						  SET lft = (lft +  ' . $widthMoveNode . ') 
						  WHERE lft > ' . $lftParentNode . '
						  AND rgt > 0 
						  ';
		$command=$this->_connection->createCommand($slqUpdateLeft);
		$result=$command->query();				  
		//mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE {{'.$table.'}}  
						   SET rgt = (rgt +  ' . $widthMoveNode . ')  
							WHERE rgt > ' . $lftParentNode;	
		$command=$this->_connection->createCommand($slqUpdateRight);
		$result=$command->query();					
		//mysql_query($slqUpdateRight,$this->_connect);
		
		$levelMoveNode 		= $infoMoveNode['level'];
		$levelParentNode	= $infoParentNode['level'];
		$newLevelMoveNode  = $levelParentNode + 1;
		
		$slqUpdateLevel = 'UPDATE {{'.$table.'}} 
						  SET level = (level  -  ' . $levelMoveNode . ' + ' . $newLevelMoveNode . ')
						  WHERE rgt <= 0';
		$command=$this->_connection->createCommand($slqUpdateLevel);
		$result=$command->query();				  
		//mysql_query($slqUpdateLevel,$this->_connect);
		
		
		$newParent 	= $infoParentNode['id'];
		$newLeft 	= $infoParentNode['lft'] + 1;
		$newRight 	= $infoParentNode['lft'] + $widthMoveNode;
		$slqUpdateParent = 'UPDATE {{'.$table.'}}  
						  SET parents = ' . $newParent . ',  
						      lft = ' . $newLeft . ',  
						  	  rgt = ' . $newRight . '  
						  WHERE id = ' . $this->_id;
		$command=$this->_connection->createCommand($slqUpdateParent);
		$result=$command->query();				  
		//mysql_query($slqUpdateParent,$this->_connect);
		
		
		$slqUpdateNode = 'UPDATE {{'.$table.'}}  
						  SET rgt = (rgt +  ' . $newRight . '), 
						   	  lft = (lft +  ' . $newLeft . ') 
						  WHERE rgt <0';
		$command=$this->_connection->createCommand($slqUpdateNode);
		$result=$command->query();				  
		//mysql_query($slqUpdateNode,$this->_connect);
		
	}
	/**
	* Processing move node to right position of other node
	* 
	* @author chiennv
	*
	* @return Change tree structure
	* 
	*/
	protected function moveRight($table){
		
		$infoMoveNode = $this->getNodeInfo($this->_id);
		
		$lftMoveNode = $infoMoveNode['lft'];
		$rgtMoveNode = $infoMoveNode['rgt'];
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);
		
		$sqlReset = 'UPDATE {{'.$table.'}} 
					 SET rgt = (rgt -  ' . $rgtMoveNode . '),  
					 	 lft = (lft -  ' . $lftMoveNode . ')   
					  WHERE lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		$command=$this->_connection->createCommand($sqlReset);
		$result=$command->query();			  
		//mysql_query($sqlReset,$this->_connect);
		
		$slqUpdateRight = 'UPDATE {{'.$table.'}}  
						   SET rgt = (rgt -  ' . $widthMoveNode . ')  
							WHERE rgt > ' . $rgtMoveNode;
		$command=$this->_connection->createCommand($slqUpdateRight);
		$result=$command->query();					
		//mysql_query($slqUpdateRight,$this->_connect);
		
		$slqUpdateLeft = 'UPDATE {{'.$table.'}} 
						  SET lft = (lft -  ' . $widthMoveNode . ') 
						  WHERE lft > ' . $rgtMoveNode;
		$command=$this->_connection->createCommand($slqUpdateLeft);
		$result=$command->query();				  
		//mysql_query($slqUpdateLeft,$this->_connect);
		
		$infoParentNode = $this->getNodeInfo($this->_parent);
		$rgtParentNode = $infoParentNode['rgt'];
		
		$slqUpdateLeft = 'UPDATE {{'.$table.'}} 
						  SET lft = (lft +  ' . $widthMoveNode . ') 
						  WHERE lft >= ' . $rgtParentNode . '
						  AND rgt > 0 
						  ';
		$command=$this->_connection->createCommand($slqUpdateLeft);
		$result=$command->query();				  
		//mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE {{'.$table.'}}  
						   SET rgt = (rgt +  ' . $widthMoveNode . ')  
							WHERE rgt >= ' . $rgtParentNode;
		$command=$this->_connection->createCommand($slqUpdateRight);
		$result=$command->query();					
		//mysql_query($slqUpdateRight,$this->_connect);
		
		$levelMoveNode 		= $infoMoveNode['level'];
		$levelParentNode	= $infoParentNode['level'];
		$newLevelMoveNode  = $levelParentNode + 1;
		
		$slqUpdateLevel = 'UPDATE {{'.$table.'}} 
						  SET level = (level  -  ' . $levelMoveNode . ' + ' . $newLevelMoveNode . ')
						  WHERE rgt <= 0';
		$command=$this->_connection->createCommand($slqUpdateLevel);
		$result=$command->query();				  
		//mysql_query($slqUpdateLevel,$this->_connect);
		
		$newParent 	= $infoParentNode['id'];
		$newLeft 	= $infoParentNode['rgt'];
		$newRight 	= $infoParentNode['rgt'] + $widthMoveNode - 1;
		$slqUpdateParent = 'UPDATE {{'.$table.'}}  
						  SET parents = ' . $newParent . ',  
						      lft = ' . $newLeft . ',  
						  	  rgt = ' . $newRight . '  
						  WHERE id = ' . $this->_id;
		$command=$this->_connection->createCommand($slqUpdateParent);
		$result=$command->query();				  
		//mysql_query($slqUpdateParent,$this->_connect);
		
		$slqUpdateNode = 'UPDATE {{'.$table.'}}  
						  SET rgt = (rgt +  ' . $newRight . '), 
						   	  lft = (lft +  ' . $newLeft . ') 
						  WHERE rgt <0';
		$command=$this->_connection->createCommand($slqUpdateNode);
		$result=$command->query();	
		mysql_query($slqUpdateNode,$this->_connect);
		
	}
	/**
	* Insert a new node to tree (move: left - right - before - after)
	* 
	* @author chiennv
	*
	* @param  array An array store info of new node
	* @param  int ID of parent node which you want insert new node
	* @param  array Case when you apply new node (apply: left position - right position - before position - after position)
	*
	* @return Change tree structure.
	*/
	public function insertNode($data, $parent = 0, $options = null) {
		$this->_data 	= $data; 
		$this->_parent 	= $parent;

		if($options['position'] == 'right' || $options == null)	$this->insertRight();
		
		if($options['position'] == 'left')	$this->insertLeft();
		
		if($options['position'] == 'after')	$this->insertAfter($options['brother_id']);
		
		if($options['position'] == 'before') $this->insertBefore($options['brother_id']);
		
	}
	/**
	* Insert a new node to right position of other node
	* 
	* @author chiennv
	*
	* @return Change tree structure
	* 
	*/
	protected function insertRight($table){
		
		$parentInfo =  $this->getNodeInfo($this->_parent);
		$parentRight = $parentInfo['rgt'];
		
		
		$slqUpdateLeft = 'UPDATE {{'.$table.'}} 
						  SET lft = lft + 2 
						  WHERE lft > ' . $parentRight;
		$command=$this->_connection->createCommand($slqUpdateLeft);
		$result=$command->query();				  
		//mysql_query($slqUpdateLeft,$this->_connect);
		
		
		$slqUpdateRight = 'UPDATE {{'.$table.'}} 
						  SET rgt = rgt + 2 
						  WHERE rgt >= ' . $parentRight;
		$command=$this->_connection->createCommand($slqUpdateRight);
		$result=$command->query();				  
		//mysql_query($slqUpdateRight,$this->_connect);
		
		$data = $this->_data;	
		$data['parents']	= $this->_parent;
		$data['lft'] 		= $parentRight;
		$data['rgt'] 		= $parentRight + 1;
		$data['level'] 		= $parentInfo['level'] + 1;
		$newData = $this->createInsertQuery($data);
		
		$slqInsert = 'INSERT INTO ' . $this->_table . 
					 '(' . $newData['cols'] . ') ' . 'VALUES(' . $newData['values'] . ')'; 
               
		$command=$this->_connection->createCommand($slqInsert);
		$result=$command->query();
		//mysql_query($slqInsert,$this->_connect);
	}
	/**
	* Insert a new node to left position of other node
	* 
	* @author chiennv
	*
	* @return Change tree structure
	* 
	*/
	protected function insertLeft($table){
		
		$parentInfo =  $this->getNodeInfo($this->_parent);
		$parentLeft = $parentInfo['lft'];
		
		$slqUpdateLeft = 'UPDATE {{'.$table.'}} 
						  SET lft = lft + 2 
						  WHERE lft > ' . $parentLeft;
		$command=$this->_connection->createCommand($slqUpdateLeft);
		$result=$command->query();
		//mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE {{'.$table.'}} 
						  SET rgt = rgt + 2 
						  WHERE rgt > ' . ($parentLeft + 1);	
		$command=$this->_connection->createCommand($slqUpdateRight);
		$result=$command->query();				  
		//mysql_query($slqUpdateRight,$this->_connect);
		
		$data = $this->_data;		
		$data['parents']	= $this->_parent;
		$data['lft'] 		= $parentLeft + 1;
		$data['rgt'] 		= $parentLeft + 2;
		$data['level'] 		= $parentInfo['level'] + 1;
		
		$newData = $this->createInsertQuery($data);
		
		$slqInsert = 'INSERT INTO {{'.$table.'}}(' . $newData['cols'] . ') ' . 'VALUES(' . $newData['values'] . ')';
		$command=$this->_connection->createCommand($slqInsert);
		$result=$command->query();
		//mysql_query($slqInsert,$this->_connect);
	}
	/**
	* Insert a new node to after position of other node
	* 
	* @author chiennv
	* 
	* @param int ID of node which you want insert new node to after postion
	*
	* @return Change tree structure
	* 
	*/
	protected function insertAfter($table,$brother_id){
		
		$parentInfo =  $this->getNodeInfo($this->_parent);		
		$brotherInfo =  $this->getNodeInfo($brother_id);		
		
		$slqUpdateLeft = 'UPDATE {{'.$table.'}} 
						  SET lft = lft + 2 
						  WHERE lft > ' . $brotherInfo['rgt'];
		$command=$this->_connection->createCommand($slqUpdateLeft);
		$result=$command->query();
		//mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE {{'.$table.'}} 
						  SET rgt = rgt + 2 
						  WHERE rgt > ' . $brotherInfo['rgt'];
		$command=$this->_connection->createCommand($slqUpdateRight);
		$result=$command->query();
		//mysql_query($slqUpdateRight,$this->_connect);
		
		$data = $this->_data;		
		$data['parents']	= $this->_parent;
		$data['lft'] 		= $brotherInfo['rgt'] + 1;
		$data['rgt'] 		= $brotherInfo['rgt'] + 2;
		$data['level'] 		= $parentInfo['level'] + 1;
		
		$newData = $this->createInsertQuery($data);
		
		$slqInsert = 'INSERT INTO {{'.$table.'}}(' . $newData['cols'] . ') ' . 'VALUES(' . $newData['values'] . ')';
		$command=$this->_connection->createCommand($slqInsert);
		$result=$command->query();
		//mysql_query($slqInsert,$this->_connect);
	}
	/**
	* Insert a new node to before position of other node
	* 
	* @author chiennv
	* 
	* @param int ID of node which you want insert new node to before postion
	*
	* @return Change tree structure
	* 
	*/
	protected function insertBefore($table,$brother_id){
		
		$parentInfo =  $this->getNodeInfo($this->_parent);		
		$brotherInfo =  $this->getNodeInfo($brother_id);		
		
		$slqUpdateLeft = 'UPDATE {{'.$table.'}} 
						  SET lft = lft + 2 
						  WHERE lft >= ' . $brotherInfo['lft'];
		$command=$this->_connection->createCommand($slqUpdateLeft);
		$result=$command->query();
		//mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE {{'.$table.'}} 
						  SET rgt = rgt + 2 
						  WHERE rgt >= ' . ($brotherInfo['lft'] + 1);
		$command=$this->_connection->createCommand($slqUpdateRight);
		$result=$command->query();
		//mysql_query($slqUpdateRight,$this->_connect);
		
		
		$data = $this->_data;		
		$data['parents']	= $this->_parent;
		$data['lft'] 		= $brotherInfo['lft'];
		$data['rgt'] 		= $brotherInfo['lft'] + 1;
		$data['level'] 		= $parentInfo['level'] + 1;
		
		$newData = $this->createInsertQuery($data);
		
		$slqInsert = 'INSERT INTO {{'.$table.'}}(' . $newData['cols'] . ') ' . 'VALUES(' . $newData['values'] . ')';
		$command=$this->_connection->createCommand($slqInsert);
		$result=$command->query();
		//mysql_query($slqInsert,$this->_connect);
	}
	/**
	* Create a string from a data array 
	* 
	* @author chiennv
	* 
	* @param array a data array 
	*
	* @return string
	* 
	*/
	protected function createUpdateQuery($data){
		if (count ( $data ) > 0) {
			$result = '';			
			$i = 1;
			foreach ( $data as $key => $val ) {
				if ($i == 1) {
					$result .= " " . $key . " = '" . $val . "' ";
				} else {
					$result .= " ," . $key . " = '" . $val . "' ";
				}
				$i ++;
			}
		}
		return $result;
	}
	
	/**
	* Create a string from a data array 
	* 
	* @author chiennv
	* 
	* @param array a data array 
	*
	* @return string
	* 
	*/
	public function createInsertQuery($data){
		if (count ( $data ) > 0) {
			$cols = '';
			$values = '';
			$i = 1;
			foreach ( $data as $key => $val ) {
				if ($i == 1) {
					$cols .= "`" . $key . "`";
					$values .= "'" . $val . "'";
				} else {
					$cols .= ",`" . $key . "`";
					$values .= ",'" . $val . "'";
				}
				$i ++;
			}
		}
		$result['cols'] 	= $cols;
		$result['values'] 	= $values;
		return $result;
	}	


	/**
	* Calculate total nodes
	* 
	* @author chiennv
	* 
	* @param int ID of parent node
	* 
	* @return int Total nodes
	*
	*/
	public function totalNode($table,$parents = 0){
		$sql = 'SELECT lft,rgt FROM {{'.$table.'}} WHERE parents = ' . $parents;
		$command=$this->_connection->createCommand($sql);
		$result=$command->query();
		//$result = mysql_query($sql,$this->_connect);
		$lft = mysql_result($result, 0,'lft');
		$rgt = mysql_result($result, 0,'rgt');
		$total = ($rgt - $lft + 1)/2;
		return $total;
	}

	/**
	* Width of a branch of tree
	* 
	* @author chiennv
	* 
	* @param int Left value of node
	* @param int Right value of node
	* 
	* @return int width of node
	*
	*/
	public function widthNode($lft,$rgt){
		$width = $rgt - $lft + 1;
		return $width;
	}
	
	/**
	* Remove a node of tree
	* 
	* @author chiennv
	* 
	* @param int ID of node which you want remove
	* @param string. If it is 'branch', delete a branch of tree
	* 				 If it is 'node', delete a node of tree and update all nodes of branch
	* 
	* @return Change tree structure
	*
	*/

	public function removeNode($id, $options = 'branch'){
		$this->_id = $id;
		
		if($options == 'branch') $this->removeBranch();
		if($options == 'node') $this->removeOne();
	}
	
	/**
	* Remove a branch of tree
	* 
	* @author chiennv
	* 
	* @return Change tree structure
	*
	*/
	protected  function removeBranch($table){
		
		$infoNodeRemove =  $this->getNodeInfo($this->_id);
	
		$rgtNodeRemove 		= $infoNodeRemove['rgt'];
		$lftNodeRemove 		= $infoNodeRemove['lft'];
		$widthNodeRemove 	= $this->widthNode($lftNodeRemove,$rgtNodeRemove);
		
		$slqDelete = 'DELETE FROM {{'.$table.'}} 
					  WHERE lft BETWEEN ' . $lftNodeRemove . ' AND ' . $rgtNodeRemove;
		$command=$this->_connection->createCommand($slqDelete);
		$result=$command->query();			  
		//mysql_query($slqDelete,$this->_connect);
		
		$slqUpdateLeft = 'UPDATE {{'.$table.'}} 
						  SET lft = (lft - ' . $widthNodeRemove . ')  
						  WHERE lft > ' . $rgtNodeRemove;
		$command=$this->_connection->createCommand($slqUpdateLeft);
		$result=$command->query();
		//mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE {{'.$table.'}} 
						  SET rgt = (rgt - ' . $widthNodeRemove . ')  
						  WHERE rgt > ' . $rgtNodeRemove;
		$command=$this->_connection->createCommand($slqUpdateRight);
		$result=$command->query();
		//mysql_query($slqUpdateRight,$this->_connect);
		
		
		
	}
	
	/**
	* Remove an one of tree
	* 
	* @author chiennv
	* 
	* @return Change tree structure
	*
	*/
	protected function removeOne($table){
		
		$nodeInfo = $this->getNodeInfo($this->_id);
		$sql = 'SELECT id 
				FROM {{'.$table.'}} 
				WHERE parents = ' . $nodeInfo['id'] . ' 
				ORDER BY lft ASC ';
		$command=$this->_connection->createCommand($sql);
		$result=$command->query();		
		//$result = mysql_query($sql,$this->_connect);
		while ($row = mysql_fetch_assoc($result)){
			$childIds[] =  $row['id'];
		}
		
		rsort($childIds);
		
		if(count($childIds)>0){
			foreach ($childIds as $key => $val){
				$id = $val;
				$parent = $nodeInfo['parents'];
				$options = array('position'=>'after','brother_id'=>$nodeInfo['id']);
				$this->moveNode($id, $parent, $options);
			}
			$this->removeNode($nodeInfo['id']);
		}
	}
	
	/**
	* Get info node of tree
	* 
	* @author chiennv
	* 
	* @param int ID of node which you want get info
	*  
	* @return Change tree structure
	*
	*/
	public function getNodeInfo($table,$id){
		$sql = 'SELECT * FROM {{'.$table.'}} WHERE id = ' . $id;
		$command=$this->_connection->createCommand($sql);
		$result=$command->query();
		//$result = mysql_query($sql,$this->_connect);
		$row = mysql_fetch_assoc($result);
		return $row;
	}
	
	/**
	* Get tree
	* 
	* @author chiennv
	* 
	* @param int ID of parent node
	* @param string A case of get node list
	* @param int ID of node which you don't want get info
	* @param int level of tree
	*  
	* @return array Node list
	*
	*/
	public function listItem($table,$parents = 0,$items = 'all',$exclude_id = null,$level = 0){
		
		$sqlParents = 'SELECT @parentLeft := lft,@parentRight := rgt     
					   FROM {{'.$table.'}}  
					   WHERE parents = ' . $parents . ';';
		$command=$this->_connection->createCommand($sqlParents);
		$result=$command->query();			   
		//$result = mysql_query($sqlParents,$this->_connect);
		
		$sqlItems = 'SELECT node.*    
					 FROM {{'.$table.'}} AS node ';
		
		if($items == 'all'){
			$sqlItemsLR = ' WHERE node.lft >= @parentLeft
					       AND node.rgt <= @parentRight ';
		}else{
			$sqlItemsLR = ' WHERE node.lft > @parentLeft
					       AND node.rgt < @parentRight ';
		}
		$lftExclude=0;	$rgtExclude=0;				
		if($exclude_id != null && (int)$exclude_id >0){
			$sqlExclude = '	SELECT lft, rgt     
					   		FROM {{'.$table.'}}  
					   		WHERE id = ' . $exclude_id;
							$command=$this->_connection->createCommand($sqlExclude);
							$resultExclude=$command->query();
			//$resultExclude = mysql_query($sqlExclude,$this->_connect);
			$rowExclude = mysql_fetch_assoc($resultExclude); 
			$lftExclude = $rowExclude['lft'];
			$rgtExclude = $rowExclude['rgt'];
		}
		
		$sqlItems .= $sqlItemsLR;
		
		if($level !=0 ){
			$sqlItems .= ' AND node.level <=  ' . $level . ' '; 
		}
		
		$sqlItems .= ' ORDER BY node.lft ';
		//echo '<br>' . $sqlItems;
		$result = mysql_query($sqlItems,$this->_connect);
		$dataArr = array();
		if($result){
		//	echo '<br>' . $sqlParents;
			while ($row = mysql_fetch_assoc($result)){
				if($row['lft'] < $lftExclude || $row['lft'] > $rgtExclude){
					$dataArr[] = $row;
				}
			}
		}
		return $dataArr;
	}
	
}