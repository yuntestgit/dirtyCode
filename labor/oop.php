<?php
session_start();
include("connect.php");
date_default_timezone_set("Asia/Taipei");

$oop = new myoop();

$method=$_GET['method'];
if($method=="login_show")
{
	echo $oop->login_show();
}
elseif($method=="login")
{
	echo $oop->login();
}
elseif($method=="logout")
{
	echo $oop->logout();
}
elseif($method=="custom")
{
	$authority=$_GET['authority']*1;
	echo $oop->custom($authority);
}
elseif($method=="record")
{
	echo $oop->record();
}
elseif($method=="newlabor_show")
{
	echo $oop->newlabor_show();
}
elseif($method=="select_lab_show")
{
	echo $oop->select_lab_show();
}
elseif($method=="isselected")
{
	echo $oop->isselected();
}
elseif($method=="insert_user_show")
{
	echo $oop->insert_user_show();
}
elseif($method=="insert_user")
{
	echo $oop->insert_user();
}
elseif($method=="lab_update_show")
{
	echo $oop->lab_update_show();
}
elseif($method=="lab_update")
{
	$oop->lab_update();
}
elseif($method=="index")
{
	echo $oop->index();
}

class myoop
{
	public function index()
	{
		$r="<div style='margin-left:auto; margin-right:auto; width:800px; margin-top:30px;'>
				<div style='color:#45619d; font-size:100px; font-weight:bold;'>印尼選工系統</div>
				<div style='color:#45619d; font-size:90px; font-weight:bold; margin-top:80px;'>家庭&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;廠工&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;漁工</div>
			</div>";
		return $r;
	}
	
	public function login_show()
	{
		$r="
		<div style='margin-left:auto; margin-right:auto; width:800px; margin-top:30px;'>
			<table>
				<tr>
					<td>帳號：</td>
					<td><input type='text' id='acc' style='width:150px;' onkeypress='login_key_press()'></td>
				</tr>
				
				<tr>
					<td>密碼：</td>
					<td><input type='password' id='psw' style='width:150px;' onkeypress='login_key_press()'></td>
				</tr>
				
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type='button' value='登入' style='float:right; width:60px;' onclick='login();'>
						<input type='button' value='管理員' style='float:right; width:60px;' onclick='login1();'>
						<input type='button' value='新禾' style='float:right; width:60px;' onclick='login2();'>
					</td>
				</tr>
			</table>
		</div>
		";
		
		return $r;
	}
	
	public function login()
	{
		$acc=$_GET['acc'];
		$psw=$_GET['psw'];
		$q=mysql_query("select * from `labor`.`user`");
		while($n=mysql_fetch_array($q))
		{
			if($acc==$n[id])
			{
				if($psw==$n[password])
				{
					$_SESSION['user']=$n[id];
					//$sql="";
					return $n[authority];
				}
			}
		}
		
		return -1;
	}
	
	public function logout()
	{
		$_SESSION['user']="";
		return "<div class='custom' onclick='login_show();'>登入</div>";
	}
	
	public function custom($_authority)
	{
		if($_authority==-1)
		{
			return "<div class='custom' onclick='login_show();'>登入</div>";
		}
		elseif($_authority==0)
		{
			$r="
			<div class='custom' onclick='logout();'>登出</div>
			<div class='custom' style='margin-right:10px;' onclick='record();'>成交紀錄</div>
			<div class='custom' style='margin-right:10px;' onclick='select_lab_show();'>挑選工人</div>
			";
			return $r;
		}
		elseif($_authority==1)
		{
			$r="
			<div class='custom' onclick='logout();'>登出</div>
			<div class='custom' style='margin-right:10px;' onclick='record();'>成交紀錄</div>
			<div class='custom' style='margin-right:10px;' onclick='newlabor_show();'>履歷上傳</div>
			<div class='custom' style='margin-right:10px;' onclick='lab_update_show();'>外勞基本資料維護</div>
			<div class='custom' style='margin-right:10px;' onclick=''>工人</div>
			<div class='custom' style='margin-right:10px;' onclick='insert_user_show()'>新增帳號</div>
			";
			return $r;
		}		
	}
	
	public function record()
	{
		
		$id=$_SESSION['user'];
		$q=mysql_query("select * from `labor`.`user` where `id` = '$id'");
		$n=mysql_fetch_array($q);
		$authority=$n[authority];
		if($authority==1)
		{
			$sql="select * from `labor`.`record`";
		}
		elseif($authority==0)
		{
			$sql="select * from `labor`.`record` where `agc_id` = '$id'";
		}
		
		$r="<div style='margin-left:auto; margin-right:auto; width:800px; margin-top:30px;'>";
		$r.="<table border='1' style='border-spacing:0px;'>";
		$r.="
		<tr>
			<td style='font-weight:bold; height:30px;'>確定選工日期</td>
			<td style='font-weight:bold; height:30px;'>工號</td>
			<td style='font-weight:bold; height:30px;'>台仲</td>
			<td style='font-weight:bold; height:30px;'>金額</td>
			<td style='font-weight:bold; height:30px;'>聘工表</td>
			<td style='font-weight:bold; height:30px;'>取消交易</td>
		</tr>
		";
		$q=mysql_query($sql);
		while($n=mysql_fetch_array($q))
		{
			$r.="
			<tr>
				<td style='height:30px; width:150px;'>$n[time]</td>
				<td style='height:30px; width:100px;'>$n[lab_id]</td>
				<td style='height:30px; width:100px;'>$n[agc_id]</td>
				<td style='height:30px; width:100px;'>$n[price]</td>
				<td style='height:30px; width:200px;'><a href='resume/$n[resume]' style='color:#00f;'>$n[resume]</a></td>
				<td style='height:30px; width:100px;'>&nbsp;</td>
			</tr>
			";
		}
		$r.="</table>";
		$r.="</div>";
		return $r;
	}
	
	public function newlabor_show()
	{
		$r="
			<div style='margin-left:auto; margin-right:auto; width:800px; margin-top:30px;'>
				<form action='upload.php' method='post' enctype='multipart/form-data' target='itemp'>
					<table border='1' style='border-spacing:0px;'>
						<tr>
							<td style='text-align:left; width:150px;'>請輸入工號：</td>
							<td style='text-align:left;'><input name='id' type='text' style='width:200px; border-style:none;'></td>
						</tr>
						
						<tr>
							<td style='text-align:left;'>請輸入金額：</td>
							<td style='text-align:left;'><input name='price' type='text' style='width:200px; border-style:none;'></td>
						</tr>
						
						<tr>
							<td style='text-align:left;'>請上傳履歷表：</td>
							<td style='text-align:left;'><input name='resume' type='file' style='width:200px;'></td>
						</tr>
						
						<tr>
							<td style='text-align:left;'>請上傳照片：</td>
							<td style='text-align:left;'><input name='picture' type='file' style='width:200px;'></td>
						</tr>
						
						<tr>
							<td style='text-align:left; width:150px;'>工人種類：</td>
							<td style='text-align:left;'>
								<select name='sort'>
									<option value='家庭'>家庭</option>
									<option value='廠工'>廠工</option>
									<option value='漁工'>漁工</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td style='text-align:left;'>印仲名稱：</td>
							<td style='text-align:left;'><input name='agency' type='text' style='width:200px; border-style:none;'></td>
						</tr>
						
						<tr>
							<td style='text-align:left;'>護照號碼：</td>
							<td style='text-align:left;'><input name='passport' type='text' style='width:200px; border-style:none;'></td>
						</tr>
						
						<tr>
							<td style='text-align:left;'>外勞姓名：</td>
							<td style='text-align:left;'><input name='name' type='text' style='width:200px; border-style:none;'></td>
						</tr>
						
						<tr>
							<td style='text-align:left;'>雇主：</td>
							<td style='text-align:left;'><input name='employer' type='text' style='width:200px; border-style:none;'></td>
						</tr>
						
						<tr>
							<td colspan='2'><input type='submit' value='提交' style='float:right; width:60px;'></td>
						</tr>
					</table>
				</form>
			</div>

			<iframe id='itemp' name='itemp' style='display:none;'></iframe>
		";
		return $r;
	}
	
	public function select_lab_show()
	{
		$r="<div style='margin-left:auto; margin-right:auto; width:800px; margin-top:30px;'>";
		$q=mysql_query("select * from `labor`.`labors` where `enable` = '1'");
		$line=0;
		$max=4;
		while($n=mysql_fetch_array($q))
		{
			if($line==0)
			{
				$r.="<table style='border-spacing:7px;'><tr>";
			}
			
			$r.="<td style='background-color:#000;'>
			<table style='border-spacing:0px;'>
			<tr><td style='width:192px; height:256px; background-color;#f00;'><img style='width:192px; max-height:256px; cursor:pointer;' src='picture/$n[picture]' onclick='selected_lab(\"$n[id]\");'/></td></tr>
			<tr>
			<td style='color:#fff; text-align:left;'>
				工號：$n[id]<span style='color:#f00;'>($n[price])</span><br>
				履歷表：<a href='resume/$n[resume]' style='color:#fff;'>$n[id]</a>
			</td>
			</tr>
			</table>
			</td>";
			
			if($line==$max-1)
			{
				$r.="</tr></table><br><br>";
				$line=0;
			}
			else
			{
				$line++;
			}
		}
		if($line!=0)
		{
			for($i=1; $i<=$max-$i; $i++)
			{
				$r.="<td>&nbsp;</td>";
			}
			$r.="</tr></table><br><br>";
		}
		$r.="</div>";
		
		return $r;
	}
	
	public function isselected()
	{
		$id=$_GET['id'];
		$q=mysql_query("select * from `labor`.`labors` where `id` = '$id'");
		$n=mysql_fetch_array($q);
		$price=$n[price];
		$resume=$n[resume];
		
		$q="UPDATE  `labor`.`labors` SET  `enable` =  '0' WHERE `id` = '$id'";
		mysql_query($q);
		$d=date("Y/m/d H:i:s");
		$agc=$_SESSION['user'];
		
		$q="INSERT INTO  `labor`.`record` (
		`id`,`time`, `lab_id`, `agc_id`, `price`, `resume`, `cancel`)
		VALUES(NULL, '$d', '$id', '$agc', '$price', '$resume', '');";
		mysql_query($q);
		$r="選擇成功";
		return $r;
	}
	
	public function insert_user_show()
	{
		$r="<div style='margin-left:auto; margin-right:auto; width:800px; margin-top:30px;'>";
		$r.="<div id='list' style='float:right;'><table border='1' style='border-spacing:0px;'>";
		$r.="
		<tr>
			<td style='font-weight:bold;'>帳號</td>
			<td style='font-weight:bold;'>密碼</td>
			<td style='font-weight:bold;'>權限</td>
		</tr>
		";
		$q=mysql_query("select * from `labor`.`user` ORDER BY  `user`.`authority` DESC");
		while($n=mysql_fetch_array($q))
		{
			if($n[authority]==1)
			{
				$authority="管理員";
			}
			else
			{
				$authority="台仲";
			}
			$r.="
			<tr>
			<td style='text-algin:left; width:100px;'>$n[id]</td>
			<td style='text-algin:left; width:100px;'>$n[password]</td>
			<td style='text-algin:left; width:100px;'>$authority</td>
			</tr>
			";
		}
		$r.="</table></div>";
		
		$r.="
		<table style='float:left;'>
			<tr>
				<td>帳號：</td>
				<td><input type='text' id='acc' style='width:150px;'></td>
			</tr>
			
			<tr>
				<td>密碼：</td>
				<td><input type='text' id='psw' style='width:150px;'></td>
			</tr>
			
			<tr>
				<td>權限：</td>
				<td style='text-align:left;'>
					<select id='authority'>
						<option value='0'>台仲</option>
						<option value='1'>管理員</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
				<td><input type='button' value='新增' style='float:right; width:60px;' onclick='insert_user();'>
				</td>
			</tr>
		</table>
		";
		
		$r.="</div>";
		return $r;
	}
	
	public function insert_user()
	{
		$acc=$_GET['acc'];
		$psw=$_GET['psw'];
		$authority=$_GET['authority'];
		$q="INSERT INTO  `labor`.`user` (
		`id` ,
		`password` ,
		`authority`
		)
		VALUES (
		'$acc',  '$psw',  '$authority'
		);
		";
		mysql_query($q);
		
		$r="<table border='1' style='border-spacing:0px;'>";
		$r.="
		<tr>
			<td style='font-weight:bold;'>帳號</td>
			<td style='font-weight:bold;'>密碼</td>
			<td style='font-weight:bold;'>權限</td>
		</tr>
		";
		$q=mysql_query("select * from `labor`.`user` ORDER BY  `user`.`authority` DESC");
		while($n=mysql_fetch_array($q))
		{
			if($n[authority]==1)
			{
				$authority="管理員";
			}
			else
			{
				$authority="台仲";
			}
			$r.="
			<tr>
			<td style='text-algin:left; width:100px;'>$n[id]</td>
			<td style='text-algin:left; width:100px;'>$n[password]</td>
			<td style='text-algin:left; width:100px;'>$authority</td>
			</tr>
			";
		}
		$r.="</table>";
		return $r;
	}
	
	public function lab_update_show()
	{
		$r="<div style='margin-left:auto; margin-right:auto; width:800px;'>";
		$q=mysql_query("select * from `labor`.`labors`");
		$line=0;
		while($n=mysql_fetch_array($q))
		{
			if($line==0)
			{
				$style="float:left; margin-top:30px;";
				$line=1;
			}
			else
			{
				$style="float:right; margin-top:30px;";
				$line=0;
			}
			$r.="
			<table border='1' style='border-spacing:0px; $style'>
				<tr>
					<td rowspan='8' style='width:150px; height:200px; background-color;#f00;'><img style='width:150px; max-height:200px;' src='picture/$n[picture]'/></td>
				</tr>
				
				<tr>
					<td style='text-align:left;'>工號：</td>
					<td style='text-align:left;'>$n[id]</td>
				</tr>
				
				<tr>
					<td style='text-align:left;'>金額：</td>
					<td><input type='text' id='{$n[id]}_price' style='width:150px;' value='$n[price]'/></td>
				</tr>
				
				<tr>
					<td style='text-align:left;'>印仲名稱：</td>
					<td><input type='text' id='{$n[id]}_agency' style='width:150px;' value='$n[agency]'/></td>
				</tr>
				
				<tr>
					<td style='text-align:left;'>護照號碼：</td>
					<td><input type='text' id='{$n[id]}_passport' style='width:150px;' value='$n[passport]'/></td>
				</tr>
				
				<tr>
					<td style='text-align:left;'>外勞姓名：</td>
					<td><input type='text' id='{$n[id]}_name' style='width:150px;' value='$n[name]'/></td>
				</tr>
				
				<tr>
					<td style='text-align:left;'>雇主：</td>
					<td><input type='text' id='{$n[id]}_employer' style='width:150px;' value='$n[employer]'/></td>
				</tr>
				
				<tr>
					<td colspan='2'><input type='button' value='修改' style='margin-right:5px; float:right; width:60px;' onclick='lab_update(\"$n[id]\");'/></td>
				</tr>
			</table>
			";
		}
		$r.="</div>";
		return $r;
	}
	
	public function lab_update()
	{
		$id=$_GET['id'];
		$price=$_GET['price'];
		$agency=$_GET['agency'];
		$passport=$_GET['passport'];
		$name=$_GET['name'];
		$employer=$_GET['employer'];
		
		$q="UPDATE  `labor`.`labors` SET
		`price` =  '$price',
		`agency` =  '$agency',
		`passport` =  '$passport',
		`name` =  '$name',
		`employer` =  '$employer'
		WHERE `id` = '$id'
		";
		mysql_query($q);
	}
}
?>