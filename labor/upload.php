<?php
include("connect.php");

$id=$_POST['id'];
$price=$_POST['price'];
$resume=$_FILES['resume'];
$picture=$_FILES['picture'];
$agency=$_POST['agency'];
$passport=$_POST['passport'];
$name=$_POST['name'];
$employer=$_POST['employer'];

$e1=explode(".", $resume[name]);
$ex1=$e1[count($e1)-1];
$resume_name=$id."_".$price.".".$ex1;
copy($resume[tmp_name], "resume/$resume_name");

$e2=explode(".", $picture[name]);
$ex2=$e2[count($e2)-1];
$picture_name=$id.".".$ex2;
copy($picture[tmp_name], "picture/$picture_name");

$q="INSERT INTO `labor`.`labors`(
`id`, `price`, `resume`, `picture`, `agency`, `passport`, `name`, `employer`, `enable`)
VALUES ('$id',  '$price',  '$resume_name',  '$picture_name',  '$agency',  '$passport',  '$name',  '$employer', '1');
";
mysql_query($q);
?>

<script>
window.onload = function()
{
	parent.newlaborfinish();
}
</script>