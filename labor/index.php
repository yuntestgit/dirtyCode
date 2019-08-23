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
				margin-top:17px;
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
			
			function login_response(httpRequest)
			{
				if(httpRequest.responseText=="1")
				{
					ajax("custom", "oop.php?method=custom&authority=1");
				}			
				else if(httpRequest.responseText=="0")
				{
					ajax("custom", "oop.php?method=custom&authority=0");
				}
				else if(httpRequest.responseText=="-1")
				{
					alert("帳號或密碼無效。");
					$("acc").value="";
					$("psw").value="";
				}
			}
			
			function custom_response(httpRequest)
			{
				$("custom").innerHTML=httpRequest.responseText;
				index();
			}
			
			function index()
			{
				ajax("index", "oop.php?method=index");
			}
			
			function index_response(httpRequest)
			{
				$("main").innerHTML=httpRequest.responseText;
			}
			
			
			function logout()
			{
				ajax("logout", "oop.php?method=logout");
			}
			
			function logout_response(httpRequest)
			{
				$("custom").innerHTML=httpRequest.responseText;
				login_show();
			}
			
			
			function record()
			{
				ajax("record", "oop.php?method=record");
			}
			
			function record_response(httpRequest)
			{
				$("main").innerHTML=httpRequest.responseText;
			}
			
			
			function newlabor_show()
			{
				ajax("newlabor_show", "oop.php?method=newlabor_show");
			}
			
			function newlabor_show_response(httpRequest)
			{
				$("main").innerHTML=httpRequest.responseText;
			}
			
			function newlaborfinish()
			{
				$("main").innerHTML="上傳完成";
			}
			
			function select_lab_show()
			{
				ajax("select_lab_show", "oop.php?method=select_lab_show");
			}
			
			function select_lab_show_response(httpRequest)
			{
				$("main").innerHTML=httpRequest.responseText;
			}
			
			
			function selected_lab(id)
			{
				if(confirm("確定選取此工人嗎？"))
				{
					isselected(id);
				}
			}
			
			function isselected(id)
			{
				ajax("isselected", "oop.php?method=isselected&id="+id);
			}
			
			function isselected_response(httpRequest)
			{
				$("main").innerHTML=httpRequest.responseText;
			}
			
			
			function insert_user_show()
			{
				ajax("insert_user_show", "oop.php?method=insert_user_show");
			}
			
			function insert_user_show_response(httpRequest)
			{
				$("main").innerHTML=httpRequest.responseText;
			}
			
			
			function insert_user()
			{
				var acc = $("acc").value;
				var psw = $("psw").value;
				var authority = $("authority").value;
				$("authority").selectedIndex=0;
				$("acc").value="";
				$("psw").value="";
				ajax("insert_user", "oop.php?method=insert_user&acc="+acc+"&psw="+psw+"&authority="+authority);
			}
			
			function insert_user_response(httpRequest)
			{
				$("list").innerHTML=httpRequest.responseText;
			}
			
			
			function lab_update_show()
			{
				ajax("lab_update_show", "oop.php?method=lab_update_show");
			}
			
			function lab_update_show_response(httpRequest)
			{
				$("main").innerHTML=httpRequest.responseText;
			}
			
			
			function lab_update(id)
			{
				var price=$(id+"_price").value;
				var agency=$(id+"_agency").value;
				var passport=$(id+"_passport").value;
				var _name=$(id+"_name").value;
				var employer=$(id+"_employer").value;
				ajax("lab_update", "oop.php?method=lab_update&id="+id+"&price="+price+"&agency="+agency+"&passport="+passport+"&name="+_name+"&employer="+employer);
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
			echo "<div style='position:fixed; height:50px; width:100%; background-color:#45619d; text-align:center;'>";
			echo "<div style='width:800px; margin-left:auto; margin-right:auto; background-color:#45619d;'>";
			echo "<div style='float:left; color:#fff; font-size:20px; font-weight:bold; margin-top:8px;'>印尼選工系統</div>";
			echo "<div style='float:left; color:#fff; font-size:12px; font-weight:bold; margin-top:30px; margin-left:-15px;'>家庭 廠工 漁工</div>";
			echo "<div id='custom'>";
			if($authority==-1)
			{
				echo "<div class='custom' onclick='login_show();'>登入</div>";
			}
			else
			{
				if($authority==0)
				{
					echo "
					<div class='custom' onclick='logout();'>登出</div>
					<div class='custom' style='margin-right:10px;' onclick='record();'>成交紀錄</div>
					<div class='custom' style='margin-right:10px;' onclick='select_lab_show();'>挑選工人</div>
					";
				}
				elseif($authority==1)
				{
					echo "
					<div class='custom' onclick='logout();'>登出</div>
					<div class='custom' style='margin-right:10px;' onclick='record();'>成交紀錄</div>
					<div class='custom' style='margin-right:10px;' onclick='newlabor_show();'>履歷上傳</div>
					<div class='custom' style='margin-right:10px;' onclick='lab_update_show();'>外勞基本資料維護</div>
					<div class='custom' style='margin-right:10px;' onclick=''>工人</div>
					<div class='custom' style='margin-right:10px;' onclick='insert_user_show()'>新增帳號</div>
					";
				}
			}
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "<div style='height:50px; width:100%;'></div>";
			
			echo "
			<div id='main' style='text-align:center;'>
				<div style='margin-left:auto; margin-right:auto; width:800px; margin-top:30px;'>
					<div style='color:#45619d; font-size:100px; font-weight:bold;'>印尼選工系統</div>
					<div style='color:#45619d; font-size:90px; font-weight:bold; margin-top:80px;'>家庭&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;廠工&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;漁工</div>
				</div>
			</div>";
		?>
	</body>
</html>