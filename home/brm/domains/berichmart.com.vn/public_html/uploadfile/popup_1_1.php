<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
</head>
<style type="text/css">
body
{
    margin: 0px;
}
#modalPage
{
    display: none;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0px; left: 0px;
}
.modalBackground
{
    filter: Alpha(Opacity=40); -moz-opacity:0.4; opacity: 0.4;
    width: 100%; height: 100%; background-color: #999999;
    position: absolute;
    z-index: 500;
    top: 0px; left: 0px;
}
.modalContainer
{    
    width: 1000px;
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto;
    z-index: 750;
}
.modal
{
    background-color: white;
    border: solid 4px black; position: relative;
    z-index: 1000;
    width: 1000px;    
    padding: 0px;
}
.modalTop
{
    width: 992px;
    background-color: #000099;
    padding: 4px;
    color: #ffffff;
    text-align: right;
}
.modalTop a, .modalTop a:visited
{
    color: #ffffff;
}
.modalBody
{
    padding: 10px;
    height: 540px;
}
.modalBody .navi{
    float: left;
}
.modalBody .navi span{
    display: block;
    float: left;
    padding: 5px;
    background-color: #60BF60;
    margin-right: 10px;
    cursor: pointer;
}
.modalBody .navi span:hover,.modalBody .navi span.active{
    color: red;
    text-decoration: underline;
}
.modalBody iframe{
    width: 100%;
    margin-top: 10px;
    height: 470px;
}
</style>
<script language="javascript" type="text/javascript">
function revealModal(divID)
{
    window.onscroll = function () { document.getElementById(divID).style.top = document.body.scrollTop; };
    document.getElementById(divID).style.display = "block";
    document.getElementById(divID).style.top = document.body.scrollTop;
}

function hideModal(divID)
{
    document.getElementById(divID).style.display = "none";
}
function changeURL(id,url){
    object = document.getElementById(id)
    object.setAttribute('src',url);
}
function getImage(url){
    alert(url);
    hideModal('modalPage');
}
$(function(){
    $('.navi span').click(function(){
        $('.active').removeClass('active');
        $(this).addClass('active');
    });
});
</script>
<body>
<div id="modalPage">
    <div class="modalBackground">
    </div>
    <div class="modalContainer">
        <div class="modal">
            <div class="modalTop"><a onclick="hideModal('modalPage'); return false;">[X]</a></div>
            <div class="modalBody">
                <p class="navi">
                    <span id="upload_file" class="active" onclick="changeURL('content_frame','upload.php');">Duyệt từ máy tính</span>
                    <span id ="select_file" onclick="changeURL('content_frame','loadImages.php');">Duyệt trên server</span>
                </p>
                <div class="upload">                
                    <iframe id="content_frame" src="upload.php"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<span onclick="revealModal('modalPage');">show</span>
<a href="google.com">google</a>
</body>
</html>