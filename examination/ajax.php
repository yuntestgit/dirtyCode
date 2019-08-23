<?php
$conn = mysqli_connect("localhost", "root", "12345678");
mysqli_query($conn, "set names utf8");

$get_page=$_GET['page'];
$post_page=$_POST['page'];
if(empty($get_page))
{
	$pagevalue=$post_page;
}
else
{
	$pagevalue=$get_page;
}
display($pagevalue);

function display($page)
{
	$mydatabase="examination";
	
	$table_topic="topic";
	$table_data="data";
	
	$rstr="";
	
	switch ($page)
	{
		case "1":
			$rstr="
				<div style='margin-top:20px; padding-top:10px; font-size:20px; font-weight:bolder; border-radius: 20px 20px 0px 0px; border-top:#000 1px solid; border-left:#000 1px solid; border-right:#000 1px solid; width:800px; height:35px; margin-left:auto; margin-right:auto; background-image:linear-gradient(to bottom, #999, #fff);'>
					吉澤線上測驗系統
				</div>
				
				<div style='text-align:left; padding-top:20px; font-size:18px; border-radius: 0px 0px 20px 20px; border-bottom:#000 1px solid; border-left:#000 1px solid; border-right:#000 1px solid; padding-left:20px; padding-right:20px; padding-bottom:20px; width:760px; margin-left:auto; margin-right:auto; background-color:#fff;'>
					吉澤線上測驗系統主要功能包含了多功能測驗、快速新增編輯題庫。測驗部分為了方便使用者使用，我們讓測驗題數範圍可以自己選擇，測驗結束後將會有評分，讓使用者了解自己的學習成果。吉澤測驗系統強大的地方在於題庫的編輯，使用者可以新增多個題庫資料，在輸入測驗題庫時，我們使用了智慧輸入讓使用者能夠方便快速的輸入題庫，新增後可以隨時修改題庫的內容，大大提升自我學習與自我測驗的便利性。
					<br><br>
					指導老師：許金童
					<br><br>
					設計師：<span style='text-decoration:underline; color:0000ff; cursor:pointer;' onclick='global.index_onclick(15);'>蔡宏皓</span>、<span style='text-decoration:underline; color:0000ff; cursor:pointer;' onclick='global.index_onclick(35);'>馬建峰</span>、<span style='text-decoration:underline; color:0000ff; cursor:pointer;' onclick='global.index_onclick(46);'>邢豫</span>、<span style='text-decoration:underline; color:0000ff; cursor:pointer;' onclick='global.index_onclick(59);'>尹新勻</span>
					
					<div id='index15' style='margin-top:20px; margin-left:auto; margin-right:auto; width:515px; font-size:15px; display:none;'>
						<table style='background-color:#ccc; color:#000;'>
							<tr>
								<td style='background-color:fff; width:80px;'>姓名：</td>
								<td style='background-color:fff; width:100px;'>蔡宏皓</td>
								<td rowspan='8'><img src='img/15.jpg' style='width:300px;'></td>
							</tr>
							<tr>
								<td style='background-color:fff; margin-left:10px;'>學號：</td>
								<td style='background-color:fff; margin-left:10px;'>102104215</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>班級：</td>
								<td style='background-color:fff;'>電子4B</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>星座：</td>
								<td style='background-color:fff;'>牡羊座</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>血型：</td>
								<td style='background-color:fff;'>O型</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>身高：</td>
								<td style='background-color:fff;'>171</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>體重：</td>
								<td style='background-color:fff;'>72</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>興趣：</td>
								<td style='background-color:fff;'>Angela Baby</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>FB：</td>
								<td style='background-color:fff; height:48px' colspan='2'><a href='https://www.facebook.com/profile.php?id=100006832625778' target='_blank'>https://www.facebook.com/profile.php?id=100006832625778</a></td>
							</tr>
						</table>
					</div>
					
					<div id='index35' style='margin-top:20px; margin-left:auto; margin-right:auto; width:515px; font-size:15px; display:none;'>
						<table style='background-color:#ccc; color:#000;'>
							<tr>
								<td style='background-color:fff; width:80px;'>姓名：</td>
								<td style='background-color:fff; width:100px;'>馬建峰</td>
								<td rowspan='8'><img src='img/35.jpg' style='width:300px;'></td>
							</tr>
							<tr>
								<td style='background-color:fff; margin-left:10px;'>學號：</td>
								<td style='background-color:fff; margin-left:10px;'>102104235</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>班級：</td>
								<td style='background-color:fff;'>電子4B</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>星座：</td>
								<td style='background-color:fff;'>天蠍座</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>血型：</td>
								<td style='background-color:fff;'>O型</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>身高：</td>
								<td style='background-color:fff;'>170</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>體重：</td>
								<td style='background-color:fff;'>75</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>興趣：</td>
								<td style='background-color:fff;'>小黑人</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>FB：</td>
								<td style='background-color:fff; height:35px' colspan='2'><a href='https://www.facebook.com/profile.php?id=100002385634023' target='_blank'>https://www.facebook.com/profile.php?id=100002385634023</a></td>
							</tr>
						</table>
					</div>
					
					<div id='index46' style='margin-top:20px; margin-left:auto; margin-right:auto; width:515px; font-size:15px; display:none;'>
						<table style='background-color:#ccc; color:#000;'>
							<tr>
								<td style='background-color:fff; width:80px;'>姓名：</td>
								<td style='background-color:fff; width:100px;'>邢豫</td>
								<td rowspan='8'><img src='img/46.jpg' style='width:300px;'></td>
							</tr>
							<tr>
								<td style='background-color:fff; margin-left:10px;'>學號：</td>
								<td style='background-color:fff; margin-left:10px;'>102104246</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>班級：</td>
								<td style='background-color:fff;'>電子4B</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>星座：</td>
								<td style='background-color:fff;'>摩羯座</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>血型：</td>
								<td style='background-color:fff;'>O型</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>身高：</td>
								<td style='background-color:fff;'>183</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>體重：</td>
								<td style='background-color:fff;'>74</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>興趣：</td>
								<td style='background-color:fff;'>彩虹人</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>FB：</td>
								<td style='background-color:fff; height:48px' colspan='2'><a href='https://www.facebook.com/profile.php?id=100001998797468' target='_blank'>https://www.facebook.com/profile.php?id=100001998797468</a></td>
							</tr>
						</table>
					</div>
					
					<div id='index59' style='margin-top:20px; margin-left:auto; margin-right:auto; width:515px; font-size:15px; display:none;'>
						<table style='background-color:#ccc; color:#000;'>
							<tr>
								<td style='background-color:fff; width:80px;'>姓名：</td>
								<td style='background-color:fff; width:100px;'>尹新勻</td>
								<td rowspan='8'><img src='img/59.png' style='width:300px;'></td>
							</tr>
							<tr>
								<td style='background-color:fff; margin-left:10px;'>學號：</td>
								<td style='background-color:fff; margin-left:10px;'>102104259</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>班級：</td>
								<td style='background-color:fff;'>電子4B</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>星座：</td>
								<td style='background-color:fff;'>水瓶座</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>血型：</td>
								<td style='background-color:fff;'>O型</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>身高：</td>
								<td style='background-color:fff;'>168</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>體重：</td>
								<td style='background-color:fff;'>50</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>興趣：</td>
								<td style='background-color:fff;'>小白人</td>
							</tr>
							<tr>
								<td style='background-color:fff;'>FB：</td>
								<td style='background-color:fff; height:33px' colspan='2'><a href='https://www.facebook.com/yinxinyun' target='_blank'>https://www.facebook.com/yinxinyun</a></td>
							</tr>
						</table>
					</div>
				</div>
			";
		break;
		
		case "2":
			$select="<select id='p2_topic_select' style='width:100px;'>";
			$conn = mysqli_connect("localhost", "root", "12345678");
			$q=mysqli_query($conn, "select * from `$mydatabase`.`$table_topic` ORDER BY `id` ASC");
			while($n=mysqli_fetch_array($q))
			{
				$select.="<option value='{$n[id]}'>{$n[name]}</option>";
			}
			$select.="</select>";
			$button="<input type='button' value='出題' style='width:80px; float:right;' onclick='p2.examgo();'>";
			$numeric="
				<select id='p2_topic_numeric' style='width:100px;'>
					<option value='10'>10</option>
					<option value='20'>20</option>
					<option value='25'>25</option>
					<option value='50'>50</option>
					<option value='100'>100</option>
				</select>
			";
			
			$rstr.="<div style='margin-top:20px;'>";
			$rstr.="
				<table style='margin-left:auto; margin-right:auto;'>
				<tr>
					<td style='height:30px;'>題庫：</td>
					<td>$select</td>
				</tr>
				<tr>
					<td style='height:30px;'>數量：</td>
					<td>$numeric</td>
				</tr>
				<tr>
					<td colspan='2'>$button</td>
				</tr>
				</table>
			";
			$rstr.="</div>";
		break;
		
		case "2_examgo":
			$rstr.="<div id='backbg' style='position:fixed; top:60px; width:50px; height:50px; cursor:pointer; border-radius: 0px 0px 50px 0px; border-right:#e0e0e0 1px solid; border-bottom:#e0e0e0 1px solid; text-align:left;' onmouseover='global.btn_back_onmouseover();' onmouseout='global.btn_back_onmouseout()' onclick='global.btn_back_onclick(2);'>
					<div id='backer' style='font-size:30px; color:#e0e0e0; margin-top:5px; margin-left:10px;'>&lt;</div>
				</div>";
			$id=$_GET['id'];
			$numeric=$_GET['numeric'];
			$conn = mysqli_connect("localhost", "root", "12345678");
			$q=mysqli_query($conn, "select * from `$mydatabase`.`$table_data` where `topic` = '$id'");
			$num=mysqli_num_rows($q);
			
			$rstr.="<div style='padding-top:20px; padding-bottom:20px;'>";
			if($num==0)
			{
				$rstr.="題庫中沒有題目";
			}
			else
			{
				$rstr.="<div style='width:500px; height:30px; margin-left:auto; margin-right:auto;'>";
				$rstr.="
					<div style='float:left; height:24px; width:24px; border:#f99 3px solid;'></div><div style='float:left; margin-top:2px; margin-left:8px; font-size:20px;'>- 正在作答</div>
					<div style='float:left; margin-left:65px; height:30px; width:30px; background-color:#ff9;'></div><div style='float:left; margin-top:2px; margin-left:8px; font-size:20px;'>- 尚未作答</div>
					<div style='float:left; margin-left:65px; height:30px; width:30px; background-color:#9f9;'></div><div style='float:left; margin-top:2px; margin-left:8px; font-size:20px;'>- 已作答</div>
				";
				$rstr.="</div>";
				
				if($num>=$numeric)
				{
					$total=$numeric;
				}
				else
				{
					$total=$num;
				}
				$rstr.="<input type='hidden' id='p2_examing_total' value='$total'>";
				$rstr.="<input type='hidden' id='p2_examing_displaying' value='1'>";
				
				$cheight=ceil($total/25)*36;
				if($total>=25)
				{
					$cwidth=900;
				}
				else
				{
					$cwidth=$total*36;
				}
				$rstr.="<div style='width:{$cwidth}px; height:{$cheight}px; margin-top:20px; margin-left:auto; margin-right:auto;'>";
				$border[1]="background-color:#f99;";
				for($i=1; $i<=$total; $i++)
				{
					$rstr.="
						<div id='ingborder$i' style='width:36px; height:36px; $border[$i] float:left; cursor:pointer;' onclick='p2.examing_change_topic($i);'>
							<div id='alreadybg$i' style='margin-top:3px; margin-left:3px; font-size:15px; padding-top:8px; height:22px; width:30px; background-color:#ff9;'>
								$i
							</div>
						</div>
					";
				}
				$rstr.="</div>";
				
				$rstr.="<div style='width:900px; margin-top:20px; margin-left:auto; margin-right:auto;'>";
				$rstr.="
					<input type='button' style='width:100px; height:40px;' value='上一題' id='p2_examing_back' onclick='p2.examing_updown(-1);' disabled='true'>
					<input type='button' style='margin-left:100px; margin-right:100px; width:120px; height:40px;' value='結束作答' onclick='p2.examing_end();'>
					<input type='button' style='width:100px; height:40px;' value='下一題' id='p2_examing_next' onclick='p2.examing_updown(1);'>
					<div style='margin-top:20px;'>
						<label><input id='auto_next' type='checkbox' checked='checked'>&nbsp;選完答案自動跳下一題</label>
					</div>
				";
				$rstr.="</div>";
				
				$rstr.="<div style='width:800px; margin-top:20px; margin-left:auto; margin-right:auto; text-align:left;'>";
				$sql="SELECT * FROM `$mydatabase`.`$table_data` where `topic` = '$id' ORDER BY RAND() LIMIT 0,$total;";
				$index=0;
				$conn = mysqli_connect("localhost", "root", "12345678");
				$q=mysqli_query($conn, $sql);
				while($n=mysqli_fetch_array($q))
				{
					$index++;
					if($index==1)
					{
						$display="";
					}
					else
					{
						$display="style='display:none;'";
					}
					$rstr.="<div id='topic$index' $display>";
					$rstr.="<input type='hidden' id='answer$index' value=''>";
					$rstr.="<input type='hidden' id='realid$index' value='$n[id]'>";
					$rstr.="<div>$index.$n[q]</div>";
					for($i=1; $i<=5; $i++)
					{
						$optiontext=$n["a".$i];
						if($optiontext!="")
						{
							$rstr.="<div style='margin-top:5px;'><label><input type='radio' name='r$n[id]' onchange='p2.examing_change_answer($index, $i);'>$optiontext</labe></div>";
						}
					}
					$rstr.="</div>";
				}
				$rstr.="</div>";
			}
			$rstr.="</div>";
		break;
		
		case "p2_examing_end":
			$rstr.="<div id='backbg' style='position:fixed; top:60px; width:50px; height:50px; cursor:pointer; border-radius: 0px 0px 50px 0px; border-right:#e0e0e0 1px solid; border-bottom:#e0e0e0 1px solid; text-align:left;' onmouseover='global.btn_back_onmouseover();' onmouseout='global.btn_back_onmouseout()' onclick='global.btn_back_onclick(2);'>
					<div id='backer' style='font-size:30px; color:#e0e0e0; margin-top:5px; margin-left:10px;'>&lt;</div>
				</div>";
				
			$total=$_POST['total'];
			$realid=$_POST['realid'];
			$answer=$_POST['answer'];
			
			$content="";
			$correct=0;
			
			for($i=0; $i<$total; $i++)
			{
				$conn = mysqli_connect("localhost", "root", "12345678");
				$q=mysqli_query($conn, "select * from `$mydatabase`.`$table_data` where `id` = '$realid[$i]'");
				$n=mysqli_fetch_array($q);
				
				if($n[ans]==$answer[$i])
				{
					$correct++;
					$bgcolor="style='background-color:#fff;'";
				}
				else
				{
					$bgcolor="style='background-color:#fee;'";
				}
				$number=$i+1;
				$content.="
					<tr $bgcolor>
						<td style='text-align:center;'>$answer[$i]</td>
						<td style='text-align:center;'>$n[ans]</td>
						<td style='padding:10px;'><div>$number.$n[q]</div>
				";
				if($n[a1]!="")
				{
					$content.="<div style='margin-top:5px;'>(1)$n[a1]</div>";
				}
				if($n[a2]!="")
				{
					$content.="<div style='margin-top:5px;'>(2)$n[a2]</div>";
				}
				if($n[a3]!="")
				{
					$content.="<div style='margin-top:5px;'>(3)$n[a3]</div>";
				}
				if($n[a4]!="")
				{
					$content.="<div style='margin-top:5px;'>(4)$n[a4]</div>";
				}
				if($n[a5]!="")
				{
					$content.="<div style='margin-top:5px;'>(5)$n[a5]</div>";
				}
				$content.="</td></tr>";
			}
			
			$mistake=$total-$correct;
			$score=round(($correct/$total)*100);
			$rstr.="
				<div style='margin-top:20px;'>
					<span>正確：$correct</span>
					<span style='margin-left:100px;'>錯誤：$mistake</span>
					<span style='margin-left:100px;'>分數：$score</span>
				<div>
			";
			$rstr.="
			<table border='1' style='width:800px; background-color:#fff; margin-top:20px; margin-bottom:20px; margin-left:auto; margin-right:auto; opacity:0.8;'>
				<tr>
					<td style='width:80px;'>選的答案</td>
					<td style='width:80px;'>標準答案</td>
					<td style='height:50px;'>題目</td>
				</tr>
			";
			$rstr.=$content;
			$rstr.="</table>";
		break;
		
		case "3":
			$conn = mysqli_connect("localhost", "root", "12345678");
			$q=mysqli_query($conn, "select * from `$mydatabase`.`$table_topic` ORDER BY `id` ASC");
			$num=mysqli_num_rows($q);
			if($num!=0)
			{
				$rstr.="<table border='1' id='p3_topic_table' style='margin-top:55px; margin-bottom:20px; margin-left:auto; margin-right:auto; background-color:#fff; opacity:0.7; font-size:15px;'>";
				$rstr.="<tr style='text-align:center; background-color:#555; color:#fff;'>
							<td style='width:200px; height:60px;'>題庫</td>
							<td style='width:80px;'>題目數量</td>
							<td style='width:80px;'>刪除題庫</td>
							<td style='width:80px;'>修改資料</td>
							<td style='width:80px;'>新增資料</td>
						</tr>";
				
				while($n=mysqli_fetch_array($q))
				{
					$conn2 = mysqli_connect("localhost", "root", "12345678");
					$q2=mysqli_query($conn2, "select * from `$mydatabase`.`$table_data` where `topic` = '{$n['id']}'");
					$topicnum=mysqli_num_rows($q2);
				
					$rstr.="<tr><input type='hidden' id='p3_hide_td_mode{$n['id']}' value='text'>";
					$rstr.="<td id='p3_td_update_topic{$n['id']}' style='text-align:center; height:80px; cursor:context-menu;' ondblclick='p3.td_update_topic_ondblclick({$n['id']});'>{$n['name']}</td>";
					$rstr.="<td style='text-align:center;'>$topicnum</td>";
					$rstr.="<td style='text-align:center; cursor:pointer;' onclick='p3.btn_delete_data({$n['id']});'><img src='img/delete.png' style='width:40px; height:40px;'></td>";
					$rstr.="<td style='text-align:center; cursor:pointer;' onclick='p3.btn_update_data({$n['id']});'><img src='img/pen.png' style='width:45px; height:45px;'></td>";
					$rstr.="<td style='text-align:center; cursor:pointer;' onclick='p3.btn_insert_data({$n['id']});'><img src='img/plus.png' style='width:45px; height:45px;'></td>";
					$rstr.="</tr>";
				}
				$rstr.="</table>";
			}
			else
			{
				$rstr.="<div style='width:100%; height:65px;'></div>";
			}
			$rstr.="<div style='position:fixed; top:80; left:50%; margin-left:-125px; width:250px;'>
						<input type='text' id='p3_text_insert_topic' style='width:150px; height:25px;' onkeypress='p3.text_insert_topic_onkeypress(event);'>
						<input type='button' value='新增題庫' style='width:80px; height:25px;' onclick='p3.btn_insert_topic_onclick();'>
					</div>";
		break;
		
		//
		
		case "3_insert_topic":
			$value=$_GET['value'];
			$q="INSERT INTO  `$mydatabase`.`$table_topic` (`id` ,`name`)
				VALUES (NULL ,  '$value');
			";
			$conn = mysqli_connect("localhost", "root", "12345678");
			mysqli_query($conn, $q);
			display("3");
		break;
		
		//
		
		case "3_update_topic":
			$id=$_GET['id'];
			$value=$_GET['value'];
			$q="UPDATE  `$mydatabase`.`$table_topic` 
				SET  `name` =  '$value' WHERE  `id` = '$id';
			";
			$conn = mysqli_connect("localhost", "root", "12345678");
			mysqli_query($conn, $q);
		break;
		
		//
		
		case "3_delete_topic";
			$id=$_GET['id'];
			$conn = mysqli_connect("localhost", "root", "12345678");
			mysqli_query($conn, "delete from `$mydatabase`.`$table_topic` where `id` = '$id';");
			mysqli_query($conn, "delete from `$mydatabase`.`$table_data` where `topic` = '$id';");
		break;
		
		//
		
		case "3_insert_page":
			$id=$_GET['id'];
			$rstr.="<input type='hidden' id='p3_insert_page_id' value='$id'>";
			$rstr.="<div id='backbg' style='position:fixed; top:60px; width:50px; height:50px; cursor:pointer; border-radius: 0px 0px 50px 0px; border-right:#e0e0e0 1px solid; border-bottom:#e0e0e0 1px solid; text-align:left;' onmouseover='global.btn_back_onmouseover();' onmouseout='global.btn_back_onmouseout()' onclick='global.btn_back_onclick(3);'>
						<div id='backer' style='font-size:30px; color:#e0e0e0; margin-top:5px; margin-left:10px;'>&lt;</div>
					</div>";
			$rstr.="
			<div style='width:800px; margin-top:20px; margin-left:auto; margin-right:auto; margin-bottom:20px;'>
				<div style='position:absolute; left:75px; width:120px; height:30px; background-color:#000; opacity:0.7; cursor:pointer;' onclick='p3_insert_page.btn_input_page1_onclick();'>
					<div id='p3_insert_page_input_page_bg1' style='margin-top:1px; margin-left:1px; width:118px; height:29px; background-color:#fff;'>
						<div style='width:118px; height:7px;'></div>
						<div style='width:118px; height:15px; font-size:15px;'>智慧輸入</div>
					</div>
				</div>
				<div style='position:absolute; left:195px; width:119px; height:30px; background-color:#000; opacity:0.7; cursor:pointer;' onclick='p3_insert_page.btn_input_page2_onclick();'>
					<div id='p3_insert_page_input_page_bg2' style='margin-top:1px; width:118px; height:29px; background-color:#eee;'>
						<div style='width:118px; height:7px;'></div>
						<div style='width:118px; height:15px; font-size:15px;'>智障輸入</div>
					</div>
				</div>
				
				<div style='width:800px; height:30px;'></div>
				<div style='width:800px; height:1px; opacity:0.7;'>
					<div style='float:left; width:1px; height:1px; background-color:#000;'></div>
					<div id='p3_insert_page_input_page_border1' style='float:left; width:118px; height:1px; background-color:#fff;'></div>
					<div style='float:left; width:1px; height:1px; background-color:#000;'></div>
					<div id='p3_insert_page_input_page_border2' style='float:left; width:118px; height:1px; background-color:#000;'></div>
					<div style='float:left; width:562px; height:1px; background-color:#000;'></div>
				</div>
				
				<div style='background-color:#fff; opacity:0.7; border-left:#000 1px solid; border-right:#000 1px solid; border-bottom:#000 1px solid; font-size:12px;'>
					<div style='height:10px;'></div>
					
					<div id='p3_insert_page_input_page_display1' style='width:100%; background-color:#fff; margin-bottom:10px;'>
						<div style='float:left; width:320px; text-align:left; bottom:30px;'>
							<textarea id='p3_insert_page_page1_textarea' style='position:fixed; top:120px; bottom:30px; margin-left:10px; width:300px; resize:none;' onkeyup='p3_insert_page.page1_textarea_onchange();' oninput='p3_insert_page.page1_textarea_onchange();' onkeydown='p3_insert_page.page1_textarea_onkeydown(event);'></textarea>
						</div>
						
						<div id='p3_insert_page_heightspacer' style='float:left; width:10px;'></div>
						<div style='float:right; width:478px; background-color:#fff;'>
							<div style='width:388px; height:30px; background-color:#fff;'>
								<div style='float:left; font-size:17px;'>
									<label><input id='p3_insert_page_page1_checkbox' type='checkbox' checked='checked' onchange='p3_insert_page.page1_textarea_onchange();'>刪除題號</label>
								</div>
								<div style='float:right;'>
									<input type='button' value='批次設定答案' style='position:fixed; margin-left:-120px; width:100px; height:20px; font-size:12px;' onclick='p3_insert_page.page1_set_answer_onclick();'>
								</div>
								<div style='float:right;'>
									<input type='button' id='p3_insert_page_page1_enablebtn' disabled='true' value='寫入資料庫' style='position:fixed; width:80px; height:20px; font-size:12px;' onclick='p3_insert_page.page1_insert_data_onclick();'>
									<input id='qnum' type='hidden'>
								</div>
							</div>
						</div>
						<div id='p3_insert_page_page1_displayer' style='float:right; margin-right:10px; width:468px; bottom:30px; text-align:left; background-color:#fff;'>
							
						</div>
						<div style='clear:both;'></div>
					</div>
					
					<div id='p3_insert_page_input_page_display2' style='width:100%; margin-bottom:10px; display:none;'>
						<div style='text-align:left;'>
							<div style='margin-left:10px; text-align:left;'>
								<div style='width:600px; margin-left:auto; margin-right:auto;'>
									<div>
										<textarea id='page2_topic' style='width:600px; height:200px; resize:none;'></textarea>
									</div>
									
									<div id='page2_ans1' style='margin-top:5px;'>
										<input id='page2_r1' name='page2_ansr' type='radio' style='margin-right:5px;' value='1' onchange='p3_insert_page.page2_select_answer(1);'>
										<input id='page2_ans1_text' type='text' style='width:555px; height:25px;' onkeydown='p3_insert_page.page2_insert_answer_keydown(1);'>
										<img id='page2_img1' src='img/delete2.png' style='margin-left:5px; width:15px; height:15px; display:none;' onclick='p3_insert_page.page2_delete_answer(1);'>
									</div>
									<div id='page2_ans2' style='margin-top:5px;'>
										<input id='page2_r2' name='page2_ansr' type='radio' style='margin-right:5px;' value='2' onchange='p3_insert_page.page2_select_answer(2);'>
										<input id='page2_ans2_text' type='text' style='width:555px; height:25px;' onkeydown='p3_insert_page.page2_insert_answer_keydown(2);'>
										<img id='page2_img2' src='img/delete2.png' style='margin-left:5px; width:15px; height:15px; display:none;' onclick='p3_insert_page.page2_delete_answer(2);'>
									</div>
									<div id='page2_ans3' style='margin-top:5px; display:none;'>
										<input id='page2_r3' name='page2_ansr' type='radio' style='margin-right:5px;' value='3' onchange='p3_insert_page.page2_select_answer(3);'>
										<input id='page2_ans3_text' type='text' style='width:555px; height:25px;' onkeydown='p3_insert_page.page2_insert_answer_keydown(3);'>
										<img id='page2_img3' src='img/delete2.png' style='margin-left:5px; width:15px; height:15px; display:none;' onclick='p3_insert_page.page2_delete_answer(3);'>
									</div>
									<div id='page2_ans4' style='margin-top:5px; display:none;'>
										<input id='page2_r4' name='page2_ansr' type='radio' style='margin-right:5px;' value='4' onchange='p3_insert_page.page2_select_answer(4);'>
										<input id='page2_ans4_text' type='text' style='width:555px; height:25px;' onkeydown='p3_insert_page.page2_insert_answer_keydown(4);'>
										<img id='page2_img4' src='img/delete2.png' style='margin-left:5px; width:15px; height:15px; display:none;' onclick='p3_insert_page.page2_delete_answer(4);'>
									</div>
									<div id='page2_ans5' style='margin-top:5px; display:none;'>
										<input id='page2_r5' name='page2_ansr' type='radio' style='margin-right:5px;' value='5' onchange='p3_insert_page.page2_select_answer(5);'>
										<input id='page2_ans5_text' type='text' style='width:555px; height:25px;' onkeydown='p3_insert_page.page2_insert_answer_keydown(5);'>
										<img id='page2_img5' src='img/delete2.png' style='margin-left:5px; width:15px; height:15px; display:none;' onclick='p3_insert_page.page2_delete_answer(5);'>
									</div>
									
									<div style='width:600px; height:20px; margin-top:5px;'>
										<input id='page2_r0' name='page2_ansr' type='radio' style='display:none;' value='-1'>
										<input type='hidden' id='page2_answer' value='-1'>
										<input type='hidden' id='page2_answer_num' value='2'>
										<input type='button' value='寫入資料庫' style='width:80px; height:20px; float:right;' onclick='p3_insert_page.page2_insert_data_onclick();'>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			";
		break;
		
		case "3_insert_page2_insert":
			$topicid=$_POST['topicid'];
			$q=$_POST['q'];
			$a1=$_POST['a1'];
			$a2=$_POST['a2'];
			$a3=$_POST['a3'];
			$a4=$_POST['a4'];
			$a5=$_POST['a5'];
			$ans=$_POST['ans'];
			
			$q="INSERT INTO  `$mydatabase`.`$table_data` (`id` ,`topic` ,`q` ,`a1` ,`a2` ,`a3` ,`a4` ,`a5` ,`ans`)
				VALUES (NULL ,
				'$topicid',
				'$q',
				'$a1',
				'$a2',
				'$a3',
				'$a4',
				'$a5',
				'$ans');
			";
			
			$conn = mysqli_connect("localhost", "root", "12345678");
			mysqli_query($conn, $q);
			
			$q=mysqli_query($conn, "select * from `$mydatabase`.`$table_topic` where `id` = '$topicid'");
			while($n=mysqli_fetch_array($q))
			{
				$topic_name=$n['name'];
			}
			
			$rstr="
				<div style='margin-top:20px;'>寫入完成</div>
				<div style='margin-top:20px;'>
					<span style='text-decoration:underline; cursor:pointer;' onclick='jump(3);'>題庫首頁</span>
					<span style='margin-left:100px; text-decoration:underline; cursor:pointer;' onclick='jump(33);'>新增資料</span>
					<span style='margin-left:100px; text-decoration:underline; cursor:pointer;' onclick='jump(32);'>修改資料</span>
					<input type='hidden' id='jump_hidden_id' value='$topicid'>
					<input type='hidden' id='jump_hidden_text' value='$topic_name'>
				</div>
			";
		break;
		
		case "3_insert_page_insert":
			$id=$_POST['id'];
			$num=$_POST['num'];
			$arr=$_POST['arr'];
			
			for($i=0; $i<$num; $i++)
			{
				$insq=$arr[$i][0];
				$insa1=$arr[$i][1];
				$insa2=$arr[$i][2];
				$insa3=$arr[$i][3];
				$insa4=$arr[$i][4];
				$insa5=$arr[$i][5];
				$insans=$arr[$i][6];
				$q="INSERT INTO  `$mydatabase`.`$table_data` (`id` ,`topic` ,`q` ,`a1` ,`a2` ,`a3` ,`a4` ,`a5` ,`ans`)
					VALUES (NULL ,
					'$id',
					'$insq',
					'$insa1',
					'$insa2',
					'$insa3',
					'$insa4',
					'$insa5',
					'$insans');
				";
				$conn = mysqli_connect("localhost", "root", "12345678");
				mysqli_query($conn, $q);
			}
			
			$conn = mysqli_connect("localhost", "root", "12345678");
			$q=mysqli_query($conn, "select * from `$mydatabase`.`$table_topic` where `id` = '$id'");
			while($n=mysqli_fetch_array($q))
			{
				$topic_name=$n['name'];
			}
			
			$rstr="
				<div style='margin-top:20px;'>寫入完成</div>
				<div style='margin-top:20px;'>
					<span style='text-decoration:underline; cursor:pointer;' onclick='jump(3);'>題庫首頁</span>
					<span style='margin-left:100px; text-decoration:underline; cursor:pointer;' onclick='jump(33);'>新增資料</span>
					<span style='margin-left:100px; text-decoration:underline; cursor:pointer;' onclick='jump(32);'>修改資料</span>
					<input type='hidden' id='jump_hidden_id' value='$id'>
					<input type='hidden' id='jump_hidden_text' value='$topic_name'>
				</div>
			";
		break;
		
		case "3_update_page":
			$id=$_GET['id'];
			$rstr.="<input type='hidden' id='id33insert' value='$id'>";
			$rstr.="<input type='hidden' id='3_update_page_delete_data_id' value=''>";
			$rstr.="<div id='backbg' style='position:fixed; top:60px; width:50px; height:50px; cursor:pointer; border-radius: 0px 0px 50px 0px; border-right:#e0e0e0 1px solid; border-bottom:#e0e0e0 1px solid; text-align:left;' onmouseover='global.btn_back_onmouseover();' onmouseout='global.btn_back_onmouseout()' onclick='global.btn_back_onclick(3);'>
						<div id='backer' style='font-size:30px; color:#e0e0e0; margin-top:5px; margin-left:10px;'>&lt;</div>
					</div>";
					
			$conn = mysqli_connect("localhost", "root", "12345678");
			$q=mysqli_query($conn, "select * from `$mydatabase`.`$table_data` where `topic` = '$id' ORDER BY `id` DESC");
			$num=mysqli_num_rows($q);
			if($num!=0)
			{
				while($n=mysqli_fetch_array($q))
				{
					$ansnum=1;
					for($i=1; $i<=5; $i++)
					{
						if($n["a".$i]!="")
						{
							$ansnum=$i;
						}
					}
					
					$delete_display="";
					if($ansnum==2)
					{
						$delete_display="display:none;";
					}
					
					$temp="
						<input type='hidden' id='p3_update_page_temp_q{$n[id]}' value='{$n[q]}'>
						<input type='hidden' id='p3_update_page_temp_ans{$n[id]}' value='{$n[ans]}'>
						<input type='hidden' id='p3_update_page_temp_ans_num{$n[id]}' value='{$ansnum}'>
					";
					$displayer="";
					$controller="";
					
					for($i=1; $i<=5; $i++)
					{
						$temp.="<input type='hidden' id='p3_update_page_temp{$n[id]}a{$i}' value='{$n['a'.$i]}'>";
						if($n["ans"]==$i)
						{
							$radioenable="checked='checked'";
						}
						else
						{
							$radioenable="";
						}
						if($i<=$ansnum)
						{
							$displayer.="
								<div id='p3_update_page_displayer_div{$n[id]}a{$i}' style='margin-top:5px;'>
									<input id='p3_update_page_displayer_radio{$n[id]}a{$i}' name='p3_update_page_displayer_radio{$n[id]}a{$i}' type='radio' onclick='return false;' {$radioenable}>
									<span id='p3_update_page_displayer_span{$n[id]}a{$i}'>{$n['a'.$i]}</span>
								</div>
							";
							$controller.="
								<div id='p3_update_page_controller_div{$n[id]}a{$i}' style='margin-top:5px;'>
									<input id='p3_update_page_controller_radio{$n[id]}a{$i}' name='p3_update_page_controller_radio{$n[id]}' type='radio' style='margin-right:5px;' value='$i' $radioenable onchange='p3_update_page.select_answer({$n[id]}, {$i});'>
									<input id='p3_update_page_controller_text{$n[id]}a{$i}' type='text' style='width:550px; height:25px;' value='{$n['a'.$i]}' onkeydown='p3_update_page.insert_answer_keydown({$n[id]}, {$i});'>
									<img id='p3_update_page_controller_img{$n[id]}a{$i}' src='img/delete2.png' style='margin-left:5px; width:15px; height:15px; $delete_display' onclick='p3_update_page.delete_answer({$n[id]}, {$i});'>
								</div>
							";
						}
						else
						{
							$displayer.="
								<div id='p3_update_page_displayer_div{$n[id]}a{$i}' style='margin-top:5px; display:none;'>
									<input id='p3_update_page_displayer_radio{$n[id]}a{$i}' name='p3_update_page_displayer_radio{$n[id]}a{$i}' type='radio' onclick='return false;' {$radioenable}>
									<span id='p3_update_page_displayer_span{$n[id]}a{$i}'>{$n['a'.$i]}</span>
								</div>
							";
							$controller.="
								<div id='p3_update_page_controller_div{$n[id]}a{$i}' style='margin-top:5px; display:none;'>
									<input id='p3_update_page_controller_radio{$n[id]}a{$i}' name='p3_update_page_controller_radio{$n[id]}' type='radio' style='margin-right:5px;' value='$i' $radioenable onchange='p3_update_page.select_answer({$n[id]}, {$i});'>
									<input id='p3_update_page_controller_text{$n[id]}a{$i}' type='text' style='width:550px; height:25px;' value='{$n['a'.$i]}' onkeydown='p3_update_page.insert_answer_keydown({$n[id]}, {$i});'>
									<img id='p3_update_page_controller_img{$n[id]}a{$i}' src='img/delete2.png' style='margin-left:5px; width:15px; height:15px; $delete_display' onclick='p3_update_page.delete_answer({$n[id]}, {$i});'>
								</div>
							";
						}
					}
					$rstr.="
					<div id='p3_update_page_data_div{$n[id]}' style='padding:10px; margin-top:20px; margin-bottom:20px; margin-left:auto; margin-right:auto; font-size:15px; border:#000 1px solid; width:700px; word-break:break-all; background-color:#fff; opacity:0.7; text-align:left;'>
						$temp
						
						<div id='p3_update_page_displayer{$n[id]}' style=''>
							<div>
								<div id='p3_update_page_displayer_q{$n[id]}'>$n[q]</div>
								$displayer
							</div>
							<div style='width:100%; height:30px; background-color:#fff;'>
								<div onclick='p3_update_page.displayer_update({$n[id]})' style='float:right; width:30px; height:30px; cursor:pointer;'><img src='img/pen.png' style='width:30px; height:30px;'></div>
								<div onclick='p3_update_page.displayer_delete({$n[id]})' style='float:right; margin-right:10px; width:30px; height:30px; cursor:pointer;'><img src='img/delete.png' style='margin-top:3px; margin-left:3px; width:25px; height:25px;'></div>
							</div>
						</div>
						
						<div id='p3_update_page_controller{$n[id]}' style='width:600px; margin-top:5px; margin-left:auto; margin-right:auto; display:none;'>
							<div>
								<textarea id='p3_update_page_controller_q{$n[id]}' style='width:600px; height:200px; resize:none;'>$n[q]</textarea>
							</div>
							$controller
							<div style='width:600px; height:20px; margin-top:5px;'>
								<input id='p3_update_page_controller_radio{$n[id]}a0' name='p3_update_page_controller_radio{$n[id]}' type='radio' style='display:none;' value='-1'>
								<input type='hidden' id='p3_update_page_controller_hidden_answer{$n[id]}' value='{$n[ans]}'>
								<input type='hidden' id='p3_update_page_controller_hidden_answer_num{$n[id]}' value='{$ansnum}'>
								<input type='button' value='儲存' style='width:60px; height:20px; float:right;' onclick='p3_update_page.update_data_onclick({$n[id]});'>
								<input type='button' value='取消' style='margin-right:10px; width:60px; height:20px; float:right;' onclick='p3_update_page.undo_displayer({$n[id]});'>
							</div>
						</div>
						
					</div>
					";
				}
			}
			else
			{
				$q=mysqli_query("select * from `$mydatabase`.`$table_topic` where `id` = '$id'");
				while($n=mysqli_fetch_array($q))
				{
					$topicname=$n['name'];
				}
				$rstr.="<div style='width:100%; height:35px;'>
							<div style='margin-top:20px; font-size:15px;'>
							題庫&nbsp;-&nbsp;{$topicname}&nbsp;&nbsp;&nbsp;&nbsp;沒有資料
							</div>
						</div>";
			}
		break;
		
		case "3_update_page_update":
			$id=$_POST['id'];
			$q=$_POST['q'];
			$a1=$_POST['a1'];
			$a2=$_POST['a2'];
			$a3=$_POST['a3'];
			$a4=$_POST['a4'];
			$a5=$_POST['a5'];
			$ans=$_POST['ans'];
			
			$q="
				UPDATE  `$mydatabase`.`$table_data` SET  `q` =  '$q',
				`a1` =  '$a1',
				`a2` =  '$a2',
				`a3` =  '$a3',
				`a4` =  '$a4',
				`a5` =  '$a5',
				`ans` =  '$ans' WHERE `id` = '$id';
			";
			$conn = mysqli_connect("localhost", "root", "12345678");
			mysqli_query($conn, $q);
		break;
		
		case "3_update_page_delete":
			$id=$_GET['id'];
			$conn = mysqli_connect("localhost", "root", "12345678");
			mysqli_query($conn, "delete from `$mydatabase`.`$table_data` where `id` = '$id';");
		break;
	}
	
	echo $rstr;
}
?>