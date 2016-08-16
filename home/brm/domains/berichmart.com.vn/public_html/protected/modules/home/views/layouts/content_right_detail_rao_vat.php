<div class="content-right">
<div class="member-info">
    <div class="title-box">Thông tin người đăng</div>
    <table cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
        <td class="name">Đăng bởi:</td>
        <td class="value"><a href=""><b class="red"><?php echo $this->member->name;?></b></a></a></td>
        </tr>
        <tr>
        <td></td>
        <td><ul>
            <li><a href="<?php echo getURL().'rao-vat-member-'.$this->member->id;?>?cat=252">Các tin rao vặt đã đăng</a></li>
            </ul></td>
        </tr>
        <tr>
        <td class="name">Họ tên :</td>
        <td class="value"><?php echo $this->member->fullname;?></td>
        </tr>
        <tr>
        <td class="name">Địa chỉ :</td>
        <td class="value">117 Lương Thế Vinh, Thanh Xuân</td>
        </tr>
        <tr>
        <td class="name">Điện thoại :</td>
        <td class="value">04-35539998</td>
        </tr>
        <tr>
        <td class="name">Email :</td>
        <td class="value"><a href="mailto:<?php echo $this->member->email;?>"><?php echo $this->member->email;?></a></td>
        </tr>
        <tr>
        <td class="name">Y!M :</td>
        <td class="value"></td>
        </tr>
    </tbody>
    </table>
</div>
<!--Member info-->
<div class="list-tinraomoi">
    <ul>
    <?php foreach($this->freshnews as $news){?>
    <li>HN:<a href="<?php echo getURL().'rao-vat-'.$news->id.'/'.$news->alias.'.html';?>"><?php echo $news->title;?></a></li>   
    <?php } ?>
    </ul>
</div>
<div class="adv"><a href=""><img src="<?php echo Yii::app()->controller->module->registerImage('qc2.jpg')?>" alt="" /></a> </div>
</div>
<!--Content right--> 