<?php
date_default_timezone_set("Asia/Taipei");
$con = mysqli_connect("localhost", "root", "12345678");
mysqli_query($con, "set names utf8");

$mode=$_GET['mode'];
$fat = new fat;

if($mode=="insert")
{
	$fat->insert();
	$mm=date("n");
	$fat->display($_GET['chiu'], date("n"));
}
elseif($mode=="delete")
{
	$fat->delete();
	$fat->display($_GET['bchiu'], $_GET['bmonth']);
}
elseif($mode=="update")
{
	$fat->update();
}
else
{
	$fat->display($_GET['bchiu'], $_GET['bmonth']);
}

function len($str, $len)
{
	$r=$str;
	while(strlen($r)<$len)
	{
		$r="0".$r;
	}
	return $r;
}

class fat
{
	public function insert()
	{
		$chiu=$_GET['chiu'];
		$li=$_GET['li'];
		$organiser=$_GET['organiser'];
		$v1=$_GET['v1'];
		$v2=$_GET['v2'];
		$v3=$_GET['v3'];
		$v4=$_GET['v4'];
		$v5=$_GET['v5'];
		
		$y=date("Y")-1911;
		$m=date("n");
		
		$q=mysqli_query($con, "SELECT * FROM `chiayi`.`chinshinbio` WHERE `年` = '$y' AND `月` = '$m' AND `區別` = '$chiu'");
		$num=mysqli_num_rows($q)+1;
		$num2=len($y, 3).$chiu.len($num, 3);
		$q="
		INSERT INTO  `chiayi`.`chinshinbio` (`id` ,`序號` ,`列管號` ,`年` ,`月` ,`區別` ,`里別` ,`主辦單位` ,`案由` ,`辦理情形` ,`處理情形` ,`業務單位意見` ,`企劃處意見`, `刪除`)
		VALUES (NULL ,  '$num',  '$num2',  '$y',  '$m',  '$chiu',  '$li',  '$organiser',  '$v1',  '$v2',  '$v3',  '$v4',  '$v5', '0');
		";
		mysqli_query($con, $q);
	}
	
	public function delete()
	{
		$id=$_GET['id'];
		$q="UPDATE  `chiayi`.`chinshinbio` SET  `刪除` =  '1' WHERE  `chinshinbio`.`id` = '$id'";
		mysqli_query($con, $q);
	}
	
	public function update()
	{
		$id=$_GET['id'];
		$v1=$_GET['v1'];
		$v2=$_GET['v2'];
		$v3=$_GET['v3'];
		$v4=$_GET['v4'];
		$v5=$_GET['v5'];
		$q="
		UPDATE  `chiayi`.`chinshinbio` SET  
		`案由` =  '$v1',
		`辦理情形` =  '$v2',
		`處理情形` =  '$v3',
		`業務單位意見` =  '$v4',
		`企劃處意見` =  '$v5' 
		WHERE  `chinshinbio`.`id` = '$id';
		";
		mysqli_query($con, $q);
	}
	
	public function display($bchiu, $bmonth)
	{
		if(empty($bchiu))
		{
			$bchiu=11;
		}
		if(empty($bmonth))
		{
			$bmonth=date("n");
		}
		$str="
		<table border='1' style='text-align:center; margin-left:auto; margin-right:auto; table-layout:fixed; word-break:break-all; background-color:#eee;'>
			<tr>
				<td style='height:30px; width:50px; background-color:#ddd;'>序號</td>
				<td style='height:30px; width:90px; background-color:#ddd;'>列管號</td>
				<td style='height:30px; width:60px; background-color:#ddd;'>里別</td>
				<td style='height:30px; width:90px; background-color:#ddd;'>主辦單位</td>
				<td style='height:30px; width:60px; background-color:#ddd;'>案由</td>
				<td style='height:30px; width:180px; background-color:#ddd;'>辦理情形</td>
				<td style='height:30px; width:180px; background-color:#ddd;'>處理情形</td>
				<td style='height:30px; width:180px; background-color:#ddd;'>業務單位意見</td>
				<td style='height:30px; width:180px; background-color:#ddd;'>企劃處意見</td>
				<td style='height:30px; width:50px; background-color:#ddd;'>操作</td>
			</tr>
		";
		$q=mysqli_query($con, "SELECT * FROM `chiayi`.`chinshinbio` WHERE `區別` = '$bchiu' AND `月` = '$bmonth' AND `刪除` = '0' ORDER BY `id` ASC");
		while($n=mysqli_fetch_array($q))
		{
			
			$v1=str_replace(array("\r\n","\r","\n"),"<br>", $n['案由']);
			$v2=str_replace(array("\r\n","\r","\n"),"<br>", $n['辦理情形']);
			$v3=str_replace(array("\r\n","\r","\n"),"<br>", $n['處理情形']);
			$v4=str_replace(array("\r\n","\r","\n"),"<br>", $n['業務單位意見']);
			$v5=str_replace(array("\r\n","\r","\n"),"<br>", $n['企劃處意見']);
			
			$q2=mysqli_query($con, "SELECT * FROM `chiayi`.`chiuli` WHERE `id` = '{$n['里別']}'");
			while($n2=mysqli_fetch_array($q2))
			{
				$li=$n2['里別'];
			}
			
			$q3=mysqli_query($con, "SELECT * FROM `chiayi`.`organiser` WHERE `id` = '{$n['主辦單位']}'");
			while($n3=mysqli_fetch_array($q3))
			{
				$organiser=$n3['name'];
			}
			$str.="
			<tr>
				<td style='min-height:60px; width:50px; max-width:50px;'>{$n['序號']}</td>
				<td style='min-height:60px; width:90px; max-width:90px;'>{$n['列管號']}</td>
				<td style='min-height:60px; width:60px; max-width:60px;'>{$li}</td>
				<td style='min-height:60px; width:90px; max-width:90px;'>{$organiser}</td>
				<td style='min-height:60px; width:180px; max-width:180px;' id='t1d{$n['id']}'><span id='s1n{$n['id']}'>$v1</span></td>
				<td style='min-height:60px; width:180px; max-width:180px;' id='t2d{$n['id']}'><span id='s2n{$n['id']}'>$v2</span></td>
				<td style='min-height:60px; width:180px; max-width:180px;' id='t3d{$n['id']}'><span id='s3n{$n['id']}'>$v3</span></td>
				<td style='min-height:60px; width:180px; max-width:180px;' id='t4d{$n['id']}'><span id='s4n{$n['id']}'>$v4</span></td>
				<td style='min-height:60px; width:180px; max-width:180px;' id='t5d{$n['id']}'><span id='s5n{$n['id']}'>$v5</span></td>
				<td style='min-height:60px; width:50px;'>
					<div id='op1{$n['id']}'>
						<input type='button' value='修改' onclick='update_onclick({$n['id']});' style='margin-bottom:5px;'/>
						<input type='button' value='刪除' onclick='delete_onclick({$n['id']});'/>
					</div>
					<div id='op2{$n['id']}' style='display:none;'>
						<input type='button' value='儲存' onclick='save_onclick({$n['id']});' style='margin-bottom:5px;'/>
						<input type='button' value='取消' onclick='cancel_onclick({$n['id']});'/>
					</div>
				</td>
			</tr>
			";
		}
		$str.="</table>";
		echo $str;
	}
}
?>