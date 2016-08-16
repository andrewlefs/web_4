<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo getURL() ; ?>js/jquery-1.5.2.min.js"></script>
<title>ADMIN CONTROL CPANEL</title>
<style type="text/css">
    *{ margin: 0px; padding: 0px; font-size: 13px;}
    #ad_wraper{ width: 600px; padding-top: 30px; padding-bottom: 60px; overflow: hidden;border: 1px solid #ccc; margin: auto; margin-top: 20px;}
    .congtyinfo{width: 200px; text-align: center;  }
    .title{ text-align: center; font-weight: bold; font-size: 20px;}
    #content{padding-top: 20px;}
    .ndcontent{margin: auto;}
    .ky{ float: right; margin-right: 40px; margin-top: 20px;}
    .ky li{float: left; list-style-type: none; margin-left: 50px;}
    .ngay{text-align: right; padding-right: 20px; margin-top: 20px;}
    .back{
        cursor: pointer;
    display: block;
    font-weight: bold;
    margin-top: 20px;
    text-align: center;
    text-decoration: underline;
    width: 100%;
    }
   
</style>
</head>

<body>
    <div id="ad_wraper">
    	<?php echo $content;?>
        
        
    </div>
    <div style="float: right;margin-top: 20px;text-align: center;width: 100%;">
            <input id="inphieu" value="In phiếu" type="button" onclick="window.print()" >
             <span class="back" onclick="window.back();">Quay lại</span>
    </div>   
</body>
</html>
