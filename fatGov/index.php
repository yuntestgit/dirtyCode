<?php
$banner_height="50";

date_default_timezone_set("Asia/Taipei");
$con = mysqli_connect("localhost", "root", "12345678");
mysqli_query($con, "set names utf8");
$bchiu=11;
$m=date("n");
$bmonth=$m;
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<!--<link rel="shortcut icon" href="test.ico">-->
		<!--<link rel="stylesheet" href="test.css">-->
		<title>Fat豪</title>
		<style>
			* {
				padding:0px;
				margin:0px;
			}
			
			body {
				text-align:center;
			}
		</style>
		<!--<script src="test.js"></script>-->
		<script type="text/javascript">
			function $(obj)
			{
				return document.getElementById(obj);
			}
			
			//
			
			function show_insert()
			{
				$("div_insert").style.display="";
			}
			
			function hide_insert()
			{
				$("div_insert").style.display="none";
				$("chiu1").checked = true;
				$("chiu2").checked = false;
				$("west").style.display="";
				$("east").style.display="none";
				$("west").selectedIndex = 0;
				$("east").selectedIndex = 0;
				$("organiser").selectedIndex = 0;
				$("v1").value="";
				$("v2").value="";
				$("v3").value="";
				$("v4").value="";
				$("v5").value="";
			}
			
			function radio_onchange()
			{
				if($("chiu1").checked)
				{
					$("west").style.display="";
					$("east").style.display="none";
				}
				else
				{
					$("west").style.display="none";
					$("east").style.display="";
				}
			}
			
			function insert()
			{
				var chiu;
				var li;
				if($("chiu1").checked)
				{
					chiu=11;
					li=$("west").value;
					$("bchiu1").checked = true;
				}
				else
				{
					chiu=22;
					li=$("east").value;
					$("bchiu2").checked = true;
				}
				$("bmonth").selectedIndex=<?php echo $m; ?>-1;
				
				var organiser = $("organiser").value;
				var v1 = $("v1").value;
				var v2 = $("v2").value;
				var v3 = $("v3").value;
				var v4 = $("v4").value;
				var v5 = $("v5").value;
				
				var url = "oop.php?mode=insert&chiu="+chiu+"&li="+li+"&organiser="+organiser+"&v1="+v1+"&v2="+v2+"&v3="+v3+"&v4="+v4+"&v5="+v5;
				ajax("insert", url);
				hide_insert();
			}
			
			function banner_onchange()
			{
				var bchiu;
				if($("bchiu1").checked)
				{
					bchiu=11;
				}
				else
				{
					bchiu=22;
				}
				var bmonth = $("bmonth").value;
				var url = "oop.php?mode=display&bchiu="+bchiu+"&bmonth="+bmonth;
				ajax("", url);
			}
			
			function update_onclick(id)
			{
				$("op1"+id).style.display="none";
				$("op2"+id).style.display="";
				
				var s1nid = $("s1n"+id).innerHTML;
				s1nid=s1nid.replace(/<br>/g, '\r\n');
				$("t1d"+id).innerHTML="<textarea id='t1a"+id+"' style='width:100%; height:100%; resize:none;'>"+s1nid+"</textarea>";
				
				var s2nid = $("s2n"+id).innerHTML;
				s2nid=s2nid.replace(/<br>/g, '\r\n');
				$("t2d"+id).innerHTML="<textarea id='t2a"+id+"' style='width:100%; height:100%; resize:none;'>"+s2nid+"</textarea>";
				
				var s3nid = $("s3n"+id).innerHTML;
				s3nid=s3nid.replace(/<br>/g, '\r\n');
				$("t3d"+id).innerHTML="<textarea id='t3a"+id+"' style='width:100%; height:100%; resize:none;'>"+s3nid+"</textarea>";
				
				var s4nid = $("s4n"+id).innerHTML;
				s4nid=s4nid.replace(/<br>/g, '\r\n');
				$("t4d"+id).innerHTML="<textarea id='t4a"+id+"' style='width:100%; height:100%; resize:none;'>"+s4nid+"</textarea>";
				
				var s5nid = $("s5n"+id).innerHTML;
				s5nid=s5nid.replace(/<br>/g, '\r\n');
				$("t5d"+id).innerHTML="<textarea id='t5a"+id+"' style='width:100%; height:100%; resize:none;'>"+s5nid+"</textarea>";
			}
			
			function cancel_onclick(id)
			{
				$("op1"+id).style.display="";
				$("op2"+id).style.display="none";
				
				var t1aid = $("t1a"+id).value;
				t1aid=t1aid.replace(/\r?\n/g, '<br>');
				$("t1d"+id).innerHTML="<span id='s1n"+id+"'>"+t1aid+"</span>";
				
				var t2aid = $("t2a"+id).value;
				t2aid=t2aid.replace(/\r?\n/g, '<br>');
				$("t2d"+id).innerHTML="<span id='s2n"+id+"'>"+t2aid+"</span>";
				
				var t3aid = $("t3a"+id).value;
				t3aid=t3aid.replace(/\r?\n/g, '<br>');
				$("t3d"+id).innerHTML="<span id='s3n"+id+"'>"+t3aid+"</span>";
				
				var t4aid = $("t4a"+id).value;
				t4aid=t4aid.replace(/\r?\n/g, '<br>');
				$("t4d"+id).innerHTML="<span id='s4n"+id+"'>"+t4aid+"</span>";
				
				var t5aid = $("t5a"+id).value;
				t5aid=t5aid.replace(/\r?\n/g, '<br>');
				$("t5d"+id).innerHTML="<span id='s5n"+id+"'>"+t5aid+"</span>";
			}
			
			function save_onclick(id)
			{
				$("op1"+id).style.display="";
				$("op2"+id).style.display="none";
				
				var t1aid = $("t1a"+id).value;
				var v1 = t1aid;
				t1aid=t1aid.replace(/\r?\n/g, '<br>');
				$("t1d"+id).innerHTML="<span id='s1n"+id+"'>"+t1aid+"</span>";
				
				var t2aid = $("t2a"+id).value;
				var v2 = t2aid;
				t2aid=t2aid.replace(/\r?\n/g, '<br>');
				$("t2d"+id).innerHTML="<span id='s2n"+id+"'>"+t2aid+"</span>";
				
				var t3aid = $("t3a"+id).value;
				var v3 = t3aid;
				t3aid=t3aid.replace(/\r?\n/g, '<br>');
				$("t3d"+id).innerHTML="<span id='s3n"+id+"'>"+t3aid+"</span>";
				
				var t4aid = $("t4a"+id).value;
				var v4 = t4aid;
				t4aid=t4aid.replace(/\r?\n/g, '<br>');
				$("t4d"+id).innerHTML="<span id='s4n"+id+"'>"+t4aid+"</span>";
				
				var t5aid = $("t5a"+id).value;
				var v5 = t5aid;
				t5aid=t5aid.replace(/\r?\n/g, '<br>');
				$("t5d"+id).innerHTML="<span id='s5n"+id+"'>"+t5aid+"</span>";
				
				
				var url = "oop.php?mode=update&id="+id+"&v1="+v1+"&v2="+v2+"&v3="+v3+"&v4="+v4+"&v5="+v5;
				ajax("update", url);
			}
			
			function delete_onclick(id)
			{
				if(confirm("你要刪除序號"+id+"的資料嗎?"))
				{
					var bchiu;
					if($("bchiu1").checked)
					{
						bchiu=11;
					}
					else
					{
						bchiu=22;
					}
					var bmonth = $("bmonth").value;
					var url = "oop.php?mode=delete&id="+id+"&bchiu="+bchiu+"&bmonth="+bmonth;
					ajax("", url);
				}
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
						_response(mode, httpRequest);
					}
				}
			}
			
			function _response(mode, httpRequest)
			{
				if(mode!="update")
				{
					$("div_display").innerHTML = httpRequest.responseText;
				}
			}
		</script>
	</head>
	
	<body>
		<div style="width:100%; height:<?php echo $banner_height; ?>px; background-color:#fff; margin-left:auto; margin-right:auto; position:fixed;">
			<div style="width:1350px; height:<?php echo $banner_height; ?>px; margin-left:auto; margin-right:auto; background-color:#fff;">
				<input type="button" value="新增資料" style="width:80px; height:30px; margin-top:10px; margin-right:200px;" onclick="show_insert();">
				區別：
				<label><input id="bchiu1" name="bchiu" type="radio" onchange="banner_onchange();" checked="checked">&nbsp;西區</label>&nbsp;&nbsp;&nbsp;
				<label><input id="bchiu2" name="bchiu" type="radio" onchange="banner_onchange();">&nbsp;東區</label>
				<span style="margin-left:200px;">月份：<span>
				<select id="bmonth" onchange="banner_onchange();">
					<?php
						for($i=1; $i<=12; $i++)
						{
							if($i==$m)
							{
								echo "<option value='$i' selected='selected'>$i</option>";
							}
							else
							{
								echo "<option value='$i'>$i</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
		
		<div style="width:1350px; background-color:#fff; margin-left:auto; margin-right:auto;">
			<div style="width:100%; height:<?php echo $banner_height; ?>px;"></div>
			<div id="div_display" style="width:100%; background-color:#fff;">
				<?php
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
				?>
			</div>
		</div>
		
		<div id="div_insert" style="width:366px; height:456px; background-color:#777; position:fixed; top:50%; left:50%; margin-left:-183px; margin-top:-228px; display:none;">
			<div style="width:355px; height:445px; margin-left:5px; margin-top:5px; background-color:#fff;">
				<table>
					<tr>
						<td style="height:30px;">區別</td>
						<td>
							<label><input id="chiu1" name="chiu" type="radio" onchange="radio_onchange();" checked="checked">&nbsp;西區</label>&nbsp;&nbsp;&nbsp;
							<label><input id="chiu2" name="chiu" type="radio" onchange="radio_onchange();">&nbsp;東區</label>
						</td>
					</tr>
					
					<tr>
						<td style="height:30px;">里別</td>
						<td>
							<select id="west">
								<?php
									$q=mysqli_query($con, "select * from `chiayi`.`chiuli` WHERE `區別` = '11' ORDER BY `id` ASC");
									while($n=mysqli_fetch_array($q))
									{
										echo "<option value='{$n['id']}'>{$n['里別']}</option>";
									}
								?>
							</select>
							
							<select id="east" style="display:none;">
								<?php
									$q=mysqli_query($con, "select * from `chiayi`.`chiuli` WHERE `區別` = '22' ORDER BY `id` ASC");
									while($n=mysqli_fetch_array($q))
									{
										echo "<option value='{$n['id']}'>{$n['里別']}</option>";
									}
								?>
							</select>
						</td>
					</tr>
					
					<tr>
						<td style="height:30px;">主辦單位</td>
						<td>
							<select id="organiser">
								<?php
									$q=mysqli_query($con, "select * from `chiayi`.`organiser` ORDER BY `id` ASC");
									while($n=mysqli_fetch_array($q))
									{
										echo "<option value='{$n['id']}'>{$n['name']}</option>";
									}
								?>
							</select>
						</td>
					</tr>
					
					<tr>
						<td style="height:60px;">案由</td>
						<td>
							<textarea id="v1" style="width:250px; height:60px; resize:none;"></textarea>
						</td>
					</tr>
					
					<tr>
						<td style="height:60px;">辦理情形</td>
						<td>
							<textarea id="v2" style="width:250px; height:60px; resize:none;"></textarea>
						</td>
					</tr>
					
					<tr>
						<td style="height:60px;">處理情形</td>
						<td>
							<textarea id="v3" style="width:250px; height:60px; resize:none;"></textarea>
						</td>
					</tr>
					
					<tr>
						<td style="height:60px;">業務單位意見</td>
						<td>
							<textarea id="v4" style="width:250px; height:60px; resize:none;"></textarea>
						</td>
					</tr>
					
					<tr>
						<td style="height:60px;">企劃處意見</td>
						<td>
							<textarea id="v5" style="width:250px; height:60px; resize:none;"></textarea>
						</td>
					</tr>
					
					<tr>
						<td colspan="2" style="height:35px;">
							<input type="button" style="float:right; width:50px; height:25px; margin-left:10px;" value="新增" onclick="insert();">
							<input type="button" style="float:right; width:50px; height:25px;" value="取消" onclick="hide_insert();">
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>