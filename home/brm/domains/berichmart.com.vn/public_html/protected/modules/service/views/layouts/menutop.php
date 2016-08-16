<style>
    #menu-top  .menu2{
        float: right;
        font-weight: bold;
    }
    #menu-top  .menu2 li a,#menu-top  .menu2 li{
        padding-right: 10px;
    }
    #menu-top  .menu2 a{
        color:#7a1aa4;
    }
    #menu-top  .menu2 a:hover{
        text-decoration: underline;
    }
    #menu-top  .menu2 .hello a{
        color: #2894df;
        text-transform: capitalize;
    }
</style>
<?php
$member = Member::model()->findByPk(Yii::app()->session['member']['id']);
?>
<div id="menu-top">
    <div class="wrap-content">
        <ul class="menu2">
        <li class="hello"><span>Chào </span><a href="<?php echo getUrl();?>member"><?php echo $member->fullname;?></a>|</li>        
        <li><a href="<?php echo getUrl();?>thong-tin-tai-khoan">Thông tin cá nhân</a>|</li>
        <li><a href="<?php echo getUrl();?>member/account/changePassword">Đổi mật khẩu</a>|</li>
        <li><a href="<?php echo getUrl();?>home/members/logout">Thoát</a></li>
        </ul>
    </div>
</div>