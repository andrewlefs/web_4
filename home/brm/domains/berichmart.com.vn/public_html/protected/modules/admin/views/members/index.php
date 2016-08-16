<style>
    input,select{
	border: solid 1px #ccc;
	padding: 3px;
	margin: 4px 0px;
}

.clr{ clear: both;}

.floatLeft{ float: left;}

.floatRight{ float: right;}

.textLeft{ text-align: left;}

.textRight{ text-align: right;}

.textCenter{ text-align: center;}

.bold{
	font-weight: bold;
}

.main{
	padding: 10px;
	width: 800px;
}
#list{
	
	border-left: solid 1px #ccc;
	border-top: solid 1px #ccc;
}

#list td {
	border-right: solid 1px #ccc;
	border-bottom: solid 1px #ccc;
	padding: 3px;	
}


</style>
<div class="top-main"><p>Danh sách thanh vien</p></div><!--.top-main--> <!--LUU Ý:TÊN CỦA VIEW PHẢI TRÙNG VS TÊN Ở CONTROLLER -->

<div class="middle-main"> 
<table id="list" width="100%" >
 		<thead>
 			<tr class="textCenter bold">
 				<td width="50">ID</td>
 				<td width="50">parents</td>
 				<td>Name</td>
 				<td width="50">Level</td>
 				<td width="50">left</td>
 				<td width="50">right</td>
 				<td width="80">Order</td>
 				<td width="100">Control</td>
 			</tr>
 		</thead>
 		<tbody>
 	
 	<?php 
 		if(count($data)>0){
 			foreach ($data as $key => $val){
 				$id 		= $val['id'];
 				$parents 	= $val['parents'];
 				$level 		= $val['level'];
 				$lft 		= $val['lft'];
 				$rgt 		= $val['rgt'];
 				$levelCss = '';
 				if($val['level'] == 0){
 					$name = '<b style="color:red">' . $val['name'] . '</b>';
 				}else if($val['level'] == 1){
	 				$name = '<b> + ' . $val['name'] . '</b>';
	 			}else{
	 				$name = '<b> - - ' . $val['name'] . '</b>';
	 				$levelCss =  'padding-left: ' . (20 * $val['level']) . 'px;';
	 			}
	 			
	 			$lnkEdit 	= getURL().'admin/members/edit/' . $val['id'];
	 			$lnkDelete 	= getURL().'admin/members/delete/' . $val['id'];
	 			$lnkMove 	= getURL().'admin/members/move/' . $val['id'];
	 			$orderName	= 'ordering[' . $val['lft'] . ']';
	 			$orderValue	= $model->getNodeOrdering($val['parents'],$val['lft']);
	 			$ordering	= '<input type="text" name="' . $orderName .'" 
	 							id="' . $orderName .'" 
	 							value="' . $orderValue . '" style ="width:50px; text-align: center;" />';
	 			
		?>
			<tr class="textCenter" style="text-align: ">
 				<td><?php echo $id;?></td>
 				<td><?php echo $parents;?></td>
 				<td class="textLeft" style="<?php echo $levelCss;?>"><?php echo $name;?></td>
 				<td><?php echo $level;?></td>
 				<td><?php echo $lft;?></td>
 				<td><?php echo $rgt;?></td>
 				<td><?php echo $ordering;?></td>
                               
 				<td>
 				<?php // if($val['level'] != 0):?>
					<a href="#<?php //echo $lnkEdit;?>">Edit</a> | 
					<a href="<?php echo $lnkDelete;?>">Delete</a>
				<?php // endif;?>
				</td>
 			</tr>
		<?php 
 			}
 		}
 	?>
 		</tbody>
 	</table>
    </div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->