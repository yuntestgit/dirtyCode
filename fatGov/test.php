<style>
* {
	margin:0px;
	padding:0px;
}
</style>
<?
$str="<table border='1' style='text-align:center; table-layout: fixed; word-break: break-all; background-color:#eee;'>";
for($i=0; $i<10; $i++)
{
	$str.="<tr>";
	for($j=0; $j<10; $j++)
	{
		$str.="<td id='t$i$j' style='width:50px; height:50px;'>$i$j</td>";
	}
	$str.="</tr>";
}
$str.="</table>";
echo $str;
?>
<br><br>
<input type="button" onclick="test();" value="test">
<textarea>12</textarea>
<script>
function $(obj)
			{
				return document.getElementById(obj);
			}
			
function test()
{
	$("t12").innerHTML = "<textarea style='width:100%; height:100%; resize:none;'>12</textarea>";
	//alert($("t12").innerHTML);
}
</script>