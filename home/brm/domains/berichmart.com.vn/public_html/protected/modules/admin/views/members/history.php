<style>
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
<div class="top-main"><p>xem lich su hoa hong cua 1 thanh vien</p></div>

<div class="middle-main"> 
    <form method="post">
        Nhap ma member (bat buoc) : <input type="text" name="member_id"><input type="submit" value="xem lich su hoa hong">
        <div>
            <h3 style=" margin-top: 20px;"> Xem chi tiet (khong bat buoc)</h3>
            <div>
                <p style=" margin-top: 20px; margin-bottom: 20px;"> Thang <input type="text" name="month"> nam <input type="text" name="year"></p>
                <p style=" margin-top: 20px; margin-bottom: 20px;"> cap do level <input type="text" name="level"></p>
            </div>
        </div>
    </form>
    <?php if(isset($data)){?>
    <h2 style=" margin-top: 20px; margin-bottom: 20px;">HOA hong thanh vien ma so : <?php echo $member['id'].' : '.$member['name'];?></h2>
    <table id="list" width="100%" >
 		<thead>
 			<tr class="textCenter bold">
 				<td width="50">Member</td>
 				<td width="50">Level</td>
 				<td width="70">Hoa Hong</td>
 				<td>Reason</td>
 				<td width="50">Date</td>
 			</tr>
 		</thead>
 		<tbody>
 	
 	<?php 
 		if(count($data)>0){
 			foreach ($data as $val){
		?>
			<tr class="textCenter" style="text-align: ">
 				<td><?php echo $val->submember_id;?></td>
 				<td><?php echo $val->submember_level;?></td>
 				<td><?php echo $val->money.' D';?></td>
 				<td class="textLeft"><?php echo $val->reason;?></td>
 				<td><?php echo $val->created;?></td>
 			</tr>
		<?php 
 			}
 		}
 	?>
 		</tbody>
 	</table>
    <?php } ?>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->