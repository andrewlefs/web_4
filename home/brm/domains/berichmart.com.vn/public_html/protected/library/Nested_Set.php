<?php
/**
 * PHP Class
 *
 * LICENSE
 *
 * Processing Nested Set Model
 *
 * @category   	PHP classes
 * @package    	Database
 * @copyright  	Copyright (c) 2007-2012 Professional World company(http://www.worldprovn.com/)  
 *									   & Vietnam Zend Framework community (http://www.zend.vn/)
 * @author		KhanhPham (khanhpham@worldprovn.com)
 * @license    	GNU General Public License Version 2 or later (the "GPL")
 * @version     v1.0 5:46:57 PM Feb 20, 2012
 */

class Nested_Set {
	
	/**
	 * Resource of connection from Database
	 * 
	 * @var resource
	 * 
	 */
	public $_connect;
	
	/**
	 * Name of table in database
	 * 
	 * @var string
	 * 
	 */
	private $_table;
	
	/**
	* Name of database
	*
	* @var string
	*/
	private $_db;
	
	public  $_parent = 0; 
	
	public 	$_data; 
	
	public 	$_id; 
	
	public 	$_orderArr; 
	
	/**
	* Construct
	* 
	* @author KhanhPham
	*
	* @param  array Create connection to database.
	* @param  string Database adapter
	*
	* @return MySQL connection.
	*/
	public function __construct($params = array(), $adapter = 'mysql') {
		
		if (count ( $params ) > 0) {
			if ($adapter == 'mysql') {                         
                        $connection = $params->connectionString;
                        $connection= explode(';', $connection); 
                        $host= explode('=',$connection[0]);
                        $dbname= explode('=',$connection[1]);                        
			$link = mysql_connect ( $host[1], $params->username, $params->password );
                        mysql_set_charset('utf8',$link);
                        if (! $link) {
                                die ( 'Could not connect: ' . mysql_error () );
                        } else {
                                $this->_connect = $link;
                                $this->_table 	= 'members';
                                $this->_db 		= $dbname[1];
                                $this->setDb();
                        }	
                        
                        /*
                                $link = mysql_connect ( $params ['localhost'], $params ['user'], $params ['password'] );
				if (! $link) {
					die ( 'Could not connect: ' . mysql_error () );
				} else {
					$this->_connect = $link;
					$this->_table 	= $params ['table'];
					$this->_db 		= $params ['db'];
					$this->setDb();
				}
                                 * 
                                 */
			}
		}
	}
	
	/**
	* Update info of node
	* 
	* @author KhanhPham
	*
	* @param  array Data array store node info.
	* @param  int ID of node which you modify.
	* @param  int ID of parent node if you change parent node when you update current node
	*
	* @return A node modified and node info save to database.
	*/
	
	public function updateNode($data,$id = null,$newParentId = 0){
		if($id != null && $id != 0){
			$nodeInfo = $this->getNodeInfo($id);
			$strUpdate = $this->createUpdateQuery($data);
			$sql	= 'UPDATE ' . $this->_table . '  
					   SET ' . $strUpdate . '  
					   WHERE id = ' . $id;		
			mysql_query($sql,$this->_connect);
		
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
	* @author KhanhPham
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
	* @author KhanhPham
	*
	* @param  int ID of node which you want move to new position.
	* 
	* @return Change tree structure.
	* 
	*/
	public function moveUp($id){
		$nodeInfo = $this->getNodeInfo($id);		
		$parentInfo = $this->getNodeInfo($nodeInfo['parents']);
		
		$sql 	= 'SELECT * 
				   FROM ' . $this->_table . ' 
				   WHERE lft < ' . $nodeInfo['lft'] . '
				   AND parents = ' . $nodeInfo['parents'] . ' 
				   ORDER BY lft DESC 
				   LIMIT 1
				   ';
		$result = mysql_query($sql,$this->_connect);
		$nodeBrother = mysql_fetch_assoc($result);
		
		if(!empty($nodeBrother)){
			
			$options = array('position'=>'before','brother_id'=>$nodeBrother['id']);
			$this->moveNode($id,$parentInfo['id'],$options);
		}
		
	}
	
	/**
	* Move node to right postion a unit on a level
	* 
	* @author KhanhPham
	*
	* @param  int ID of node which you want move to new position.
	* 
	* @return Change tree structure.
	* 
	*/
	public function moveDown($id){
		$nodeInfo = $this->getNodeInfo($id);		
		$parentInfo = $this->getNodeInfo($nodeInfo['parents']);
		
		$sql 	= 'SELECT * 
				   FROM ' . $this->_table . ' 
				   WHERE lft > ' . $nodeInfo['lft'] . '
				   AND parents = ' . $nodeInfo['parents'] . ' 
				   ORDER BY lft ASC  
				   LIMIT 1
				   ';
		$result = mysql_query($sql,$this->_connect);
		$nodeBrother = mysql_fetch_assoc($result);
		
		if(!empty($nodeBrother)){
			
			$options = array('position'=>'after','brother_id'=>$nodeBrother['id']);
			$this->moveNode($id,$parentInfo['id'],$options);
		}
	}
	
	/**
	* Get info of parent node
	* 
	* @author KhanhPham
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
	* @author KhanhPham
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
	* @author KhanhPham
	*
	* @param  int Left value of node
	* 
	* @return array Node info.
	* 
	*/
	protected function getNodeByLeft($left){
		$sql = 'SELECT * FROM ' . $this->_table . ' WHERE lft = ' . $left;
		$result = mysql_query($sql,$this->_connect);
		$row = mysql_fetch_assoc($result);
		return $row;
	}
	
	/**
	* Create node groups
	* 
	* @author KhanhPham
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
                                }
		 		foreach ($data as $key => $val){
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
	* @author KhanhPham
	*
	* @param int ID of parent of current node
	* @param int Letf value of current node
	* 
	* @return int An value of ordering 
	* 
	*/
	public function getNodeOrdering($parent,$left){
            if($parent>0){
		$ordering = $this->_orderArr[$parent][$left] + 1;
		return $ordering;                
            }
	}
	
	/**
	* Create breadcrumbs for nodes of tree 
	* 
	* @author KhanhPham
	*
	* @param int ID of current node
	* @param int level of parent where you want get info
	* 
	* @return array An array store info of breadcrumbs
	* 
	*/
	public function breadcrumbs($id, $level_stop = null){
		$sql = 'SELECT parent.* 
				FROM ' . $this->_table . ' AS node,
			         ' . $this->_table . ' AS parent
				WHERE node.lft BETWEEN parent.lft AND parent.rgt
			      AND node.id = ' . $id;
		
		if(isset($level_stop)){
			$sql .= ' AND parent.level > ' . $level_stop;
		}
		
		$sql .= ' ORDER BY node.lft';
		
		//echo '<br>' . $sql;
		$result = mysql_query($sql,$this->_connect);
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
	* @author KhanhPham
	*
	* @param int ID of node which you want move current node to before postion
	* 
	* @return Change tree structure
	* 
	*/
	protected function moveBefore($brother_id){
		
		$infoMoveNode = $this->getNodeInfo($this->_id);
		
		$lftMoveNode = $infoMoveNode['lft'];
		$rgtMoveNode = $infoMoveNode['rgt'];
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);		
		
		$sqlReset = 'UPDATE ' . $this->_table . ' 
					 SET rgt = (rgt -  ' . $rgtMoveNode . '),  
					 	 lft = (lft -  ' . $lftMoveNode . ')   
					  WHERE lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		
		mysql_query($sqlReset,$this->_connect);
		
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt -  ' . $widthMoveNode . ')  
							WHERE rgt > ' . $rgtMoveNode;		
		
		mysql_query($slqUpdateRight,$this->_connect);
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft -  ' . $widthMoveNode . ') 
						  WHERE lft > ' . $rgtMoveNode;
		
		mysql_query($slqUpdateLeft,$this->_connect);
		
				
		$infoBrotherNode = $this->getNodeInfo($brother_id);
		$lftBrotherNode = $infoBrotherNode['lft'];
		
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft +  ' . $widthMoveNode . ') 
						  WHERE lft >= ' . $lftBrotherNode . ' 
						  AND rgt>0';
		
		mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt +  ' . $widthMoveNode . ')  
							WHERE rgt >= ' . $lftBrotherNode;		
		mysql_query($slqUpdateRight,$this->_connect);
		
		
		$infoParentNode 	= $this->getNodeInfo($this->_parent);
		$levelMoveNode 		= $infoMoveNode['level'];
		$levelParentNode	= $infoParentNode['level'];
		$newLevelMoveNode  = $levelParentNode + 1;
		
		$slqUpdateLevel = 'UPDATE ' . $this->_table . ' 
						  SET level = (level  -  ' . $levelMoveNode . ' + ' . $newLevelMoveNode . ')
						  WHERE rgt <= 0';
		mysql_query($slqUpdateLevel,$this->_connect);
		
		$newParent 	= $infoParentNode['id'];
		$newLeft 	= $infoBrotherNode['lft'];
		$newRight 	= $infoBrotherNode['lft'] + $widthMoveNode - 1;
		$slqUpdateParent = 'UPDATE ' . $this->_table . '  
						  SET parents = ' . $newParent . ',  
						      lft = ' . $newLeft . ',  
						  	  rgt = ' . $newRight . '  
						  WHERE id = ' . $this->_id;			
		mysql_query($slqUpdateParent,$this->_connect);
		
		$slqUpdateNode = 'UPDATE ' . $this->_table . '  
						  SET rgt = (rgt +  ' . $newRight . '), 
						   	  lft = (lft +  ' . $newLeft . ') 
						  WHERE rgt <0';				
		mysql_query($slqUpdateNode,$this->_connect);
	}
	
	/**
	* Processing move node to after position of other node
	* 
	* @author KhanhPham
	*
	* @param int ID of node which you want move current node to after postion
	* 
	* @return Change tree structure
	* 
	*/
	protected function movetAfter($brother_id){

		$infoMoveNode = $this->getNodeInfo($this->_id);
		
		$lftMoveNode = $infoMoveNode['lft'];
		$rgtMoveNode = $infoMoveNode['rgt'];
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);
		
		
		$sqlReset = 'UPDATE ' . $this->_table . ' 
					 SET rgt = (rgt -  ' . $rgtMoveNode . '),  
					 	 lft = (lft -  ' . $lftMoveNode . ')   
					  WHERE lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		
		mysql_query($sqlReset,$this->_connect);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt -  ' . $widthMoveNode . ')  
							WHERE rgt > ' . $rgtMoveNode;		
		mysql_query($slqUpdateRight,$this->_connect);
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft -  ' . $widthMoveNode . ') 
						  WHERE lft > ' . $rgtMoveNode;		
		mysql_query($slqUpdateLeft,$this->_connect);
		
		
		$infoBrotherNode = $this->getNodeInfo($brother_id);
		$rgtBrotherNode = $infoBrotherNode['rgt'];		
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft +  ' . $widthMoveNode . ') 
						  WHERE lft > ' . $rgtBrotherNode . ' 
						  AND rgt>0';		
		mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt +  ' . $widthMoveNode . ')  
							WHERE rgt > ' . $rgtBrotherNode;		
		mysql_query($slqUpdateRight,$this->_connect);
		
		
		$infoParentNode = $this->getNodeInfo($this->_parent);
		$levelMoveNode 		= $infoMoveNode['level'];
		$levelParentNode	= $infoParentNode['level'];
		$newLevelMoveNode  = $levelParentNode + 1;
		
		$slqUpdateLevel = 'UPDATE ' . $this->_table . ' 
						  SET level = (level  -  ' . $levelMoveNode . ' + ' . $newLevelMoveNode . ')
						  WHERE rgt <= 0';
		mysql_query($slqUpdateLevel,$this->_connect);		
		
		$newParent 	= $infoParentNode['id'];
		$newLeft 	= $infoBrotherNode['rgt'] + 1;
		$newRight 	= $infoBrotherNode['rgt'] + $widthMoveNode;
		$slqUpdateParent = 'UPDATE ' . $this->_table . '  
						  SET parents = ' . $newParent . ',  
						      lft = ' . $newLeft . ',  
						  	  rgt = ' . $newRight . '  
						  WHERE id = ' . $this->_id;	
		mysql_query($slqUpdateParent,$this->_connect);		
		
		$slqUpdateNode = 'UPDATE ' . $this->_table . '  
						  SET rgt = (rgt +  ' . $newRight . '), 
						   	  lft = (lft +  ' . $newLeft . ') 
						  WHERE rgt <0';		
		mysql_query($slqUpdateNode,$this->_connect);
	}
	
	/**
	* Processing move node to left position of other node
	* 
	* @author KhanhPham
	*
	* @return Change tree structure
	* 
	*/
	protected function moveLeft(){
		
		$infoMoveNode = $this->getNodeInfo($this->_id);
		
		$lftMoveNode = $infoMoveNode['lft'];
		$rgtMoveNode = $infoMoveNode['rgt'];
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);
		
		$sqlReset = 'UPDATE ' . $this->_table . ' 
					 SET rgt = (rgt -  ' . $rgtMoveNode . '),  
					 	 lft = (lft -  ' . $lftMoveNode . ')   
					  WHERE lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		mysql_query($sqlReset,$this->_connect);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt -  ' . $widthMoveNode . ')  
							WHERE rgt > ' . $rgtMoveNode;		
		mysql_query($slqUpdateRight,$this->_connect);
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft -  ' . $widthMoveNode . ') 
						  WHERE lft > ' . $rgtMoveNode;
		mysql_query($slqUpdateLeft,$this->_connect);
		
		$infoParentNode = $this->getNodeInfo($this->_parent);
		$lftParentNode = $infoParentNode['lft'];
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft +  ' . $widthMoveNode . ') 
						  WHERE lft > ' . $lftParentNode . '
						  AND rgt > 0 
						  ';
		mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt +  ' . $widthMoveNode . ')  
							WHERE rgt > ' . $lftParentNode;		
		mysql_query($slqUpdateRight,$this->_connect);
		
		$levelMoveNode 		= $infoMoveNode['level'];
		$levelParentNode	= $infoParentNode['level'];
		$newLevelMoveNode  = $levelParentNode + 1;
		
		$slqUpdateLevel = 'UPDATE ' . $this->_table . ' 
						  SET level = (level  -  ' . $levelMoveNode . ' + ' . $newLevelMoveNode . ')
						  WHERE rgt <= 0';
		mysql_query($slqUpdateLevel,$this->_connect);
		
		
		$newParent 	= $infoParentNode['id'];
		$newLeft 	= $infoParentNode['lft'] + 1;
		$newRight 	= $infoParentNode['lft'] + $widthMoveNode;
		$slqUpdateParent = 'UPDATE ' . $this->_table . '  
						  SET parents = ' . $newParent . ',  
						      lft = ' . $newLeft . ',  
						  	  rgt = ' . $newRight . '  
						  WHERE id = ' . $this->_id;
		mysql_query($slqUpdateParent,$this->_connect);
		
		
		$slqUpdateNode = 'UPDATE ' . $this->_table . '  
						  SET rgt = (rgt +  ' . $newRight . '), 
						   	  lft = (lft +  ' . $newLeft . ') 
						  WHERE rgt <0';
		mysql_query($slqUpdateNode,$this->_connect);
		
	}
	
	/**
	* Processing move node to right position of other node
	* 
	* @author KhanhPham
	*
	* @return Change tree structure
	* 
	*/
	protected function moveRight(){
		
		$infoMoveNode = $this->getNodeInfo($this->_id);
		
		$lftMoveNode = $infoMoveNode['lft'];
		$rgtMoveNode = $infoMoveNode['rgt'];
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);
		
		$sqlReset = 'UPDATE ' . $this->_table . ' 
					 SET rgt = (rgt -  ' . $rgtMoveNode . '),  
					 	 lft = (lft -  ' . $lftMoveNode . ')   
					  WHERE lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		mysql_query($sqlReset,$this->_connect);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt -  ' . $widthMoveNode . ')  
							WHERE rgt > ' . $rgtMoveNode;	
		mysql_query($slqUpdateRight,$this->_connect);
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft -  ' . $widthMoveNode . ') 
						  WHERE lft > ' . $rgtMoveNode;
		mysql_query($slqUpdateLeft,$this->_connect);
		
		$infoParentNode = $this->getNodeInfo($this->_parent);
		$rgtParentNode = $infoParentNode['rgt'];
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft +  ' . $widthMoveNode . ') 
						  WHERE lft >= ' . $rgtParentNode . '
						  AND rgt > 0 
						  ';		
		mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt +  ' . $widthMoveNode . ')  
							WHERE rgt >= ' . $rgtParentNode;		
		mysql_query($slqUpdateRight,$this->_connect);
		
		$levelMoveNode 		= $infoMoveNode['level'];
		$levelParentNode	= $infoParentNode['level'];
		$newLevelMoveNode  = $levelParentNode + 1;
		
		$slqUpdateLevel = 'UPDATE ' . $this->_table . ' 
						  SET level = (level  -  ' . $levelMoveNode . ' + ' . $newLevelMoveNode . ')
						  WHERE rgt <= 0';
		mysql_query($slqUpdateLevel,$this->_connect);
		
		$newParent 	= $infoParentNode['id'];
		$newLeft 	= $infoParentNode['rgt'];
		$newRight 	= $infoParentNode['rgt'] + $widthMoveNode - 1;
		$slqUpdateParent = 'UPDATE ' . $this->_table . '  
						  SET parents = ' . $newParent . ',  
						      lft = ' . $newLeft . ',  
						  	  rgt = ' . $newRight . '  
						  WHERE id = ' . $this->_id;
		mysql_query($slqUpdateParent,$this->_connect);
		
		$slqUpdateNode = 'UPDATE ' . $this->_table . '  
						  SET rgt = (rgt +  ' . $newRight . '), 
						   	  lft = (lft +  ' . $newLeft . ') 
						  WHERE rgt <0';
			
		mysql_query($slqUpdateNode,$this->_connect);
		
	}
	
	/**
	* Insert a new node to tree (move: left - right - before - after)
	* 
	* @author KhanhPham
	*
	* @param  array An array store info of new node
	* @param  int ID of parent node which you want insert new node
	* @param  array Case when you apply new node (apply: left position - right position - before position - after position)
	*
	* @return Change tree structure.
	*/
	public function insertNode($data, $parent = 0, $options = null) {
                if(isset($data['captcha']))
                    unset ($data['captcha']);
		$this->_data 	= $data; 
		$this->_parent 	= $parent;

		if($options['position'] == 'right' || $options == null)	return $this->insertRight();
		
		if($options['position'] == 'left')	return $this->insertLeft();
		
		if($options['position'] == 'after')	return $this->insertAfter($options['brother_id']);
		
		if($options['position'] == 'before') return $this->insertBefore($options['brother_id']);
		
                
	}
	
	/**
	* Insert a new node to right position of other node
	* 
	* @author KhanhPham
	*
	* @return Change tree structure
	* 
	*/
	protected function insertRight(){
		
		$parentInfo =  $this->getNodeInfo($this->_parent);
               
		$parentRight = $parentInfo['rgt'];
		
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = lft + 2 
						  WHERE lft > ' . $parentRight;
                
		mysql_query($slqUpdateLeft,$this->_connect);
		
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . ' 
						  SET rgt = rgt + 2 
						  WHERE rgt >= ' . $parentRight;
                
		mysql_query($slqUpdateRight,$this->_connect);
		
		$data = $this->_data;
                
		$data['parents']	= $this->_parent;
		$data['lft'] 		= $parentRight;
		$data['rgt'] 		= $parentRight + 1;
		$data['level'] 		= $parentInfo['level'] + 1;
		$newData = $this->createInsertQuery($data);
		
		$slqInsert = 'INSERT INTO ' . $this->_table . 
					 '(' . $newData['cols'] . ') ' . 'VALUES(' . $newData['values'] . ')'; 
               
		
		return mysql_query($slqInsert,$this->_connect);
	}
	
	/**
	* Insert a new node to left position of other node
	* 
	* @author KhanhPham
	*
	* @return Change tree structure
	* 
	*/
	protected function insertLeft(){
		
		$parentInfo =  $this->getNodeInfo($this->_parent);
		$parentLeft = $parentInfo['lft'];
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = lft + 2 
						  WHERE lft > ' . $parentLeft;
		mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . ' 
						  SET rgt = rgt + 2 
						  WHERE rgt > ' . ($parentLeft + 1);		
		mysql_query($slqUpdateRight,$this->_connect);
		
		$data = $this->_data;		
		$data['parents']	= $this->_parent;
		$data['lft'] 		= $parentLeft + 1;
		$data['rgt'] 		= $parentLeft + 2;
		$data['level'] 		= $parentInfo['level'] + 1;
		
		$newData = $this->createInsertQuery($data);
		
		$slqInsert = 'INSERT INTO ' . $this->_table . 
					 '(' . $newData['cols'] . ') ' . 'VALUES(' . $newData['values'] . ')';
		return mysql_query($slqInsert,$this->_connect);
	}
	
	/**
	* Insert a new node to after position of other node
	* 
	* @author KhanhPham
	* 
	* @param int ID of node which you want insert new node to after postion
	*
	* @return Change tree structure
	* 
	*/
	protected function insertAfter($brother_id){
		
		$parentInfo =  $this->getNodeInfo($this->_parent);		
		$brotherInfo =  $this->getNodeInfo($brother_id);		
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = lft + 2 
						  WHERE lft > ' . $brotherInfo['rgt'];
		
		mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . ' 
						  SET rgt = rgt + 2 
						  WHERE rgt > ' . $brotherInfo['rgt'];
		
		mysql_query($slqUpdateRight,$this->_connect);
		
		$data = $this->_data;		
		$data['parents']	= $this->_parent;
		$data['lft'] 		= $brotherInfo['rgt'] + 1;
		$data['rgt'] 		= $brotherInfo['rgt'] + 2;
		$data['level'] 		= $parentInfo['level'] + 1;
		
		$newData = $this->createInsertQuery($data);
		
		$slqInsert = 'INSERT INTO ' . $this->_table . 
					 '(' . $newData['cols'] . ') ' . 'VALUES(' . $newData['values'] . ')';
		
		return mysql_query($slqInsert,$this->_connect);
	}
	
	/**
	* Insert a new node to before position of other node
	* 
	* @author KhanhPham
	* 
	* @param int ID of node which you want insert new node to before postion
	*
	* @return Change tree structure
	* 
	*/
	protected function insertBefore($brother_id){
		
		$parentInfo =  $this->getNodeInfo($this->_parent);		
		$brotherInfo =  $this->getNodeInfo($brother_id);		
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = lft + 2 
						  WHERE lft >= ' . $brotherInfo['lft'];
		
		mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . ' 
						  SET rgt = rgt + 2 
						  WHERE rgt >= ' . ($brotherInfo['lft'] + 1);
		
		mysql_query($slqUpdateRight,$this->_connect);
		
		
		$data = $this->_data;		
		$data['parents']	= $this->_parent;
		$data['lft'] 		= $brotherInfo['lft'];
		$data['rgt'] 		= $brotherInfo['lft'] + 1;
		$data['level'] 		= $parentInfo['level'] + 1;
		
		$newData = $this->createInsertQuery($data);
		
		$slqInsert = 'INSERT INTO ' . $this->_table . 
					 '(' . $newData['cols'] . ') ' . 'VALUES(' . $newData['values'] . ')';
		
		return mysql_query($slqInsert,$this->_connect);
	}
	
	/**
	* Create a string from a data array 
	* 
	* @author KhanhPham
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
	* @author KhanhPham
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
	* Set database name
	* 
	* @author KhanhPham
	* 
	* @param string Name of database
	*
	*/
	public function setDb($db_name = null){
		if($db_name != null){
			$this->_db = $db_name;
		}
		mysql_select_db($this->_db, $this->_connect);
	}
	
	/**
	* Set connection to database
	* 
	* @author KhanhPham
	* 
	* @param resource Resource of connection
	*
	*/
	public function setConnect($connect) {
		$this->_connect = $connect;
	}
	
	/**
	* Set table name
	* 
	* @author KhanhPham
	* 
	* @param string Name of table
	*
	*/
	public function setTable($table) {
		$this->_table = $table;
	}

	/**
	* Calculate total nodes
	* 
	* @author KhanhPham
	* 
	* @param int ID of parent node
	* 
	* @return int Total nodes
	*
	*/
	public function totalNode($parents = 0){
		$sql = 'SELECT lft,rgt FROM ' . $this->_table . ' WHERE parents = ' . $parents;
		$result = mysql_query($sql,$this->_connect);
		$lft = mysql_result($result, 0,'lft');
		$rgt = mysql_result($result, 0,'rgt');
		$total = ($rgt - $lft + 1)/2;
		return $total;
	}

	/**
	* Width of a branch of tree
	* 
	* @author KhanhPham
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
	* @author KhanhPham
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
	* @author KhanhPham
	* 
	* @return Change tree structure
	*
	*/
	protected  function removeBranch(){
		
		$infoNodeRemove =  $this->getNodeInfo($this->_id);
	
		$rgtNodeRemove 		= $infoNodeRemove['rgt'];
		$lftNodeRemove 		= $infoNodeRemove['lft'];
		$widthNodeRemove 	= $this->widthNode($lftNodeRemove,$rgtNodeRemove);
		
		$slqDelete = 'DELETE FROM ' . $this->_table . ' 
					  WHERE lft BETWEEN ' . $lftNodeRemove . ' AND ' . $rgtNodeRemove;
		mysql_query($slqDelete,$this->_connect);
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft - ' . $widthNodeRemove . ')  
						  WHERE lft > ' . $rgtNodeRemove;
		
		mysql_query($slqUpdateLeft,$this->_connect);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . ' 
						  SET rgt = (rgt - ' . $widthNodeRemove . ')  
						  WHERE rgt > ' . $rgtNodeRemove;
		
		mysql_query($slqUpdateRight,$this->_connect);
		
		
		
	}
	
	/**
	* Remove an one of tree
	* 
	* @author KhanhPham
	* 
	* @return Change tree structure
	*
	*/
	protected function removeOne(){
		
		$nodeInfo = $this->getNodeInfo($this->_id);
		$sql = 'SELECT id 
				FROM ' . $this->_table . ' 
				WHERE parents = ' . $nodeInfo['id'] . ' 
				ORDER BY lft ASC ';
		$result = mysql_query($sql,$this->_connect);
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
	* @author KhanhPham
	* 
	* @param int ID of node which you want get info
	*  
	* @return Change tree structure
	*
	*/
	public function getNodeInfo($id){
		$sql = 'SELECT * FROM ' . $this->_table . ' WHERE id = ' . $id;
		$result = mysql_query($sql,$this->_connect);
		$row = mysql_fetch_assoc($result);
		return $row;
	}
	
	/**
	* Get tree
	* 
	* @author KhanhPham
	* 
	* @param int ID of parent node
	* @param string A case of get node list
	* @param int ID of node which you don't want get info
	* @param int level of tree
	*  
	* @return array Node list
	*
	*/
	public function listItem($parents = 0,$items = 'all',$exclude_id = null,$level = 0){
		
		$sqlParents = 'SELECT @parentLeft := lft,@parentRight := rgt     
					   FROM ' . $this->_table . '  
					   WHERE parents = ' . $parents . ';';
		$result = mysql_query($sqlParents,$this->_connect);
		$sqlItems = 'SELECT node.*    
					 FROM ' . $this->_table . ' AS node ';
		
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
					   		FROM ' . $this->_table . '  
					   		WHERE id = ' . $exclude_id;
			$resultExclude = mysql_query($sqlExclude,$this->_connect);
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
	
	/**
	* destruct function
	* 
	* @author KhanhPham
	* 
	*/
	public function __destruct() { 
		//mysql_close ( $this->_connect );
	}

}