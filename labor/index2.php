<?php
session_start();
$user=$_SESSION['user'];

include("connect.php");

$authority=-1;
$q=mysql_query("select * from `labor`.`user`");
while($n=mysql_fetch_array($q))
{
	if($user==$n[id])
	{
		$authority=$n[authority];
	}
}
$customer="";
$admin="<div style='margin-top:15px;'><div class='custom' onclick=''>挑選工人</div><div class='custom' style='margin-right:10px;' onclick=''>刪除工人</div><div class='custom' style='margin-right:10px;' onclick='lab_update_show();'>外勞基本資料維護</div><div class='custom' style='margin-right:10px;' onclick=''>最新消息</div></div><div style='margin-top:45px;'><div class='custom' onclick='logout();'>登出</div><div class='custom' style='margin-right:10px;' onclick='record();'>成交紀錄</div><div class='custom' style='margin-right:10px;' onclick=''>登入紀錄</div><div class='custom' style='margin-right:10px;' onclick='newlabor_show();'>履歷上傳</div><div class='custom' style='margin-right:10px;' onclick='insert_user_show()'>新增帳號</div></div>";
$keyin="<div style='margin-top:30px;'><div class='custom' onclick='logout();'>登出</div></div>";
$_user="<div style='margin-top:30px;'><div class='custom' onclick='logout();'>登出</div><div class='custom' style='margin-right:10px;' onclick='record();'>成交紀錄</div><div class='custom' style='margin-right:10px;' onclick='select_lab_show();'>挑選工人</div><div class='custom' style='margin-right:10px;' onclick=''>最新消息</div></div>";

$cutomer_color="777";
$admin_color="9d4561";
$keyin_color="459d61";
$_user_color="45619d";

if($authority==-1) //訪客
{
	$custom=$customer;
	$color=$cutomer_color;
}
else
{
	if($authority==0) //管理員
	{
		$custom=$admin;
		$color=$admin_color;
	}
	elseif($authority==1) //key-in
	{
		$custom=$keyin;
		$color=$keyin_color;
	}
	elseif($authority==2) //台仲
	{
		$custom=$_user;
		$color=$_user_color;
	}
}

$banner="
<div id='banner' style='position:fixed; height:75px; width:100%; background-color:#{$color}; text-align:center;'>
	<div style='width:800px; margin-left:auto; margin-right:auto;'>
		<div style='float:left; color:#fff; font-size:30px; font-weight:bold; margin-top:11px;'>印尼選工系統</div>
		<div style='float:left; color:#fff; font-size:18px; font-weight:bold; margin-top:41px; margin-left:-30px;'>家庭 廠工 漁工</div>
		<div id='custom' style='height:75px; float:right;'>
			{$custom}
		</div>
	</div>
</div>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<!--<link rel="shortcut icon" href="test.ico">-->
		<!--<link rel="stylesheet" href="test.css">-->
		<title>印尼選工系統</title>
		<style>
			* {
				margin:0px;
				padding:0px;
			}
			
			body {
				overflow-y:scroll;
			}
			
			.custom {
				float:right;
				color:#fff;
				font-size:15px;
				font-weight:bold;
				cursor:pointer;
			}
			
			.custom:hover {
				text-decoration:underline;
			}
		</style>
		<!--<script src="test.js"></script>-->
		<script type="text/javascript">
			function $(obj)
			{
				return document.getElementById(obj);
			}
			
			//
			
			function login_show()
			{
				ajax("login_show", "oop.php?method=login_show");
			}
			
			function login_show_response(httpRequest)
			{
				$("main").innerHTML=httpRequest.responseText;
			}
			
			
			function login_key_press(e)
			{
				if (window.event) keycode = window.event.keyCode;
				else if (e) keycode = e.which;

				if (keycode == 13)
				{
					login();
				}
			}
			
			function login()
			{
				var acc = $("acc").value;
				var psw = $("psw").value;
				ajax("login", "oop.php?method=login&acc="+acc+"&psw="+psw);
			}
			
			
			function login1()
			{
				var acc = "sean";
				var psw = "z00003867";
				ajax("login", "oop.php?method=login&acc="+acc+"&psw="+psw);
			}
			
			function login2()
			{
				var acc = "新禾";
				var psw = "Z53403164";
				ajax("login", "oop.php?method=login&acc="+acc+"&psw="+psw);
			}
			
			function login3()
			{
				var acc = "test";
				var psw = "1234";
				ajax("login", "oop.php?method=login&acc="+acc+"&psw="+psw);
			}
			
			function login_response(httpRequest)
			{
				if(httpRequest.responseText=="-1")
				{
					alert("帳號或密碼無效。");
					$("acc").value="";
					$("psw").value="";
				}
				else if(httpRequest.responseText=="0")
				{
					$("custom").innerHTML="<? echo $admin; ?>";
					$("banner").style.backgroundColor="#<? echo $admin_color; ?>";
				}			
				else if(httpRequest.responseText=="1")
				{
					$("custom").innerHTML="<? echo $keyin; ?>";
					$("banner").style.backgroundColor="#<? echo $keyin_color; ?>";
				}
				else if(httpRequest.responseText=="2")
				{
					$("custom").innerHTML="<? echo $_user; ?>";
					$("banner").style.backgroundColor="#<? echo $_user_color; ?>";
				}
			}
			
			function logout()
			{
				ajax("logout", "oop.php?method=logout");
			}
			
			//
			
			function ajax(mode, url)
			{
				var httpRequest;

				if(window.XMLHttpRequest)
				{
					httpRequest = new XMLHttpRequest();
					if(httpRequest.overrideMimeType)
					{
						httpRequest.overrideMimeType('text/xml');
					}
				}
				else if (window.ActiveXObject)
				{
					try
					{
						httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
					}
					catch (e)
					{
						try
						{
							httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
						}
						catch (e)
						{}
					}
				}
				httpRequest.onreadystatechange = function() { ajax_response(mode, httpRequest); };
				url = encodeURI(url);
				httpRequest.open('GET', url, true);
				httpRequest.send('');
			}

			function ajax_response(mode, httpRequest)
			{
				if(httpRequest.readyState == 4)
				{
					if(httpRequest.status == 200)
					{
						if(mode=="login_show")
						{
							login_show_response(httpRequest);
						}
						else if(mode=="login")
						{
							login_response(httpRequest);
						}
						else if(mode=="custom")
						{
							custom_response(httpRequest);
						}
						else if(mode=="index")
						{
							index_response(httpRequest);
						}
						else if(mode=="logout")
						{
							logout_response(httpRequest);
						}
						else if(mode=="record")
						{
							record_response(httpRequest);
						}
						else if(mode=="newlabor_show")
						{
							newlabor_show_response(httpRequest);
						}
						else if(mode=="select_lab_show")
						{
							select_lab_show_response(httpRequest);
						}
						else if(mode=="isselected")
						{
							isselected_response(httpRequest);
						}
						else if(mode=="insert_user_show")
						{
							insert_user_show_response(httpRequest);
						}
						else if(mode=="insert_user")
						{
							insert_user_response(httpRequest);
						}
						else if(mode=="lab_update_show")
						{
							lab_update_show_response(httpRequest);
						}
					}
				}
			}
			
		</script>
	</head>
	
	<body>
		<?php
			echo $banner;
			$login_page="<div style='margin-left:auto; margin-right:auto; width:800px; margin-top:30px;'><table><tr><td>帳號：</td><td><input type='text' id='acc' style='width:150px;' onkeypress='login_key_press()'></td></tr><tr><td>密碼：</td><td><input type='password' id='psw' style='width:150px;' onkeypress='login_key_press()'></td></tr><tr><td>&nbsp;</td><td><input type='button' value='登入' style='float:right; width:60px;' onclick='login();'><input type='button' value='管理員' style='float:right; width:60px;' onclick='login1();'><input type='button' value='新禾' style='float:right; width:60px;' onclick='login2();'><input type='button' value='keyin' style='float:right; width:60px;' onclick='login3();'></td></tr></table></div>";

$logo_admin="
<div style='margin-left:auto; margin-right:auto; width:800px; margin-top:30px;'>
<div style='color:#{$admin_color}; font-size:100px; font-weight:bold;'>印尼選工系統</div>
<div style='color:#{$admin_color}; font-size:90px; font-weight:bold; margin-top:30px;'>家庭&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;廠工&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;漁工</div>
</div>
";
$logo_keyin="
<div style='margin-left:auto; margin-right:auto; width:800px; margin-top:30px;'>
<div style='color:#{$keyin_color}; font-size:100px; font-weight:bold;'>印尼選工系統</div>
<div style='color:#{$keyin_color}; font-size:90px; font-weight:bold; margin-top:30px;'>家庭&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;廠工&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;漁工</div>
</div>
";
$logo_user="
<div style='margin-left:auto; margin-right:auto; width:800px; margin-top:30px;'>
<div style='color:#{$_user_color}; font-size:100px; font-weight:bold;'>印尼選工系統</div>
<div style='color:#{$_user_color}; font-size:90px; font-weight:bold; margin-top:30px;'>家庭&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;廠工&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;漁工</div>
<div style='color:#{$_user_color}; font-size:100px; font-weight:bold; margin-top:30px;'>歡迎{$user}公司</div>
</div>
";
				
			if($authority==2)
			{
				$logo=$logo_user;
			}
			else
			{
				$logo=$logo_other;
			}
			
			$q=mysql_query("select * from `labor`.`news` where `id` = '0'");
			$n=mysql_fetch_array($q);
			$news=$n[content];
			
			
			if($authority==0)
			{
				$news="<textarea style='resize:none; width:100%; height:200px;'>$news</textarea>
				<div style='width:100%; height:5px;'></div>
				<input type='button' value='儲存' style='margin-top:10px; float:right; width:50px; height:20px;'>
				";
			}
			else
			{
				$news=str_replace("\n", "<br>", $news);
			}
			
			$news_page="
				<div style='margin-left:auto; margin-right:auto; width:800px; margin-top:30px; text-align:left;'>
					<div id='explore' style='margin-top:20px; margin-left:auto; margin-right:auto; border:10px #{$color} solid; border-radius:10px; width:600px; background-color:#fff;'>
						<div style='color:#{$color}; font-weight:bolder; margin-top:10px; margin-left:2.5%;'>最新消息</div>
						<div style='width:95%; background-color:#fff; color:#{$color}; margin-top:10px; margin-bottom:10px; margin-left:auto; margin-right:auto; text-align:left; border-top-style:solid; border-bottom-style:solid;'>
						<br>$news<br><br>
						</div>
					</div>
				</div>
			";
			
			if($authority==-1)
			{
				$main=$login_page;
			}
			elseif($authority==0)
			{
				$main=$logo.$news_page;
			}
			elseif($authority==1)
			{
				$main=$logo.$news_page;
			}
			elseif($authority==2)
			{
				$main=$logo.$news_page;
			}
			
			echo "
				<div style='height:75px; width:100%;'></div>
				<div id='main' style='text-align:center;'>
					{$main}
				</div>
			";
		?>
	</body>
</html>