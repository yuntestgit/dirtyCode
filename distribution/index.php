<?php
$limit=20;
$num=140;

$div_num=ceil($num/$limit)+1;

$ptop=180;

$border=1;
$space=3;
$mistake=ceil(($border*2+$space)/2);

$cwidth=150;
$cheight=23;
$fontsize=15;

$pcwidth=$cwidth+$border*2;
$pcheight=$cheight+$border*2;

$pwidth=$cwidth*$div_num+$space*($div_num-1)+$border*$div_num*2;
$pheight=$cheight*$limit+$space*($limit-1)+$border*$limit*2+$ptop;

$content.="<input type='hidden' id='mistake' value='$mistake'>";
$content.="<input type='hidden' id='limit' value='$limit'>";
$content.="<input type='hidden' id='num' value='$num'>";
$content.="<div style='width:{$pwidth}px; height:{$pheight}px; margin-left:auto; margin-right:auto; background-color:#ccc;'>";
$content.="<div style='width:{$pwidth}px; height:{$ptop}px; margin-left:auto; margin-right:auto; background-color:#000;'>";

for($i=0; $i<$num; $i++)
{
	$name[$i]="社團$i";
}

for($i=1; $i<=$div_num; $i++)
{
	if($i==$div_num)
	{
		$content.="<div style='float:left; margin-left:{$space}px; width:{$pcwidth}px; height:{$pheight}px;'>";
		for($j=0; $j<$limit; $j++)
		{
			$ctop=$j*($pcheight+$space)+$ptop;
			$fix_num=$j+1;
			$content.="<div id='fixed[$j]' data-include='' class='fixed' style='width:{$cwidth}px; height:{$cheight}px; top:{$ctop}px;'><div style='height:100%; width:100%; display:table; text-align:center;'><div style='display:table-cell; vertical-align:middle; text-align:center;'>志願$fix_num</div></div></div>";
		}
		$content.="</div>";
	}
	else
	{
		if($i==1)
		{
			$content.="<div style='float:left; width:{$pcwidth}px; height:{$pheight}px;'>";
		}
		else
		{
			$content.="<div style='float:left; margin-left:{$space}px; width:{$pcwidth}px; height:{$pheight}px;'>";
		}
		
		for($j=0; $j<$limit; $j++)
		{
			$number=($i-1)*$limit+$j;
			if($number==$num)
			{
				break;
			}
			$ctop=$j*($pcheight+$space)+$ptop;
			$content.="<div id='asc[$number]' data-left='' data-top='' data-parent='' data-id='$number' class='movable' style='width:{$cwidth}px; height:{$cheight}px; top:{$ctop}px;' onmousedown='drag(this,event);'><div style='height:100%; width:100%; display:table; text-align:center;'><div style='display:table-cell; vertical-align:middle; text-align:center;'>$name[$number]</div></div></div>";
		}
		
		$content.="</div>";
	}
}
$content.="</div>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<title>distribution</title>
		<style>
			* {
				margin:0px;
				padding:0px;
				text-align:center;
			}
			
			.movable {
				z-index:1;
				position:absolute;
				font-size:<? echo $fontsize; ?>px;
				cursor:move;
				border: <? echo $border; ?>px solid black;
				border-radius: <? echo $border*3; ?>px;
				background-color:#ccf;
			}
			
			.fixed {
				z-index:0;
				position:absolute;
				font-size:<? echo $fontsize; ?>px;
				cursor:context-menu;
				border: <? echo $border; ?>px solid black;
				border-radius: <? echo $border*3; ?>px;
			}
		</style>
		
		<script type="text/javascript">
			var omitformtags=["input", "textarea", "select"]

			omitformtags=omitformtags.join("|")

			function disableselect(e){
			if (omitformtags.indexOf(e.target.tagName.toLowerCase())==-1)
			return false
			}

			function reEnable(){
			return true
			}

			if (typeof document.onselectstart!="undefined")
			document.onselectstart=new Function ("return false")
			else{
			document.onmousedown=disableselect
			document.onmouseup=reEnable
			}
			
			//
			
			var obj;
			var fromfixed = 0;
			function drag(elementToDrag,event)
			{
				var e=window.event||e;
				var value=e.button;
				
				if(value==2||value==3){}
				else
				{
					obj = elementToDrag;
					obj.style.zIndex=2;
					obj.style.backgroundColor="#ddf";
					var parentID = obj.getAttribute("data-parent");
					if(parentID=="")
					{
						fromfixed=-1;
					}
					else
					{
						fromfixed=1;
					}
					
					//
					
					var scroll = getScrollOffsets();
					var startX = event.clientX + scroll.x;
					var startY = event.clientY + scroll.y;

					var origX = elementToDrag.offsetLeft;
					var origY = elementToDrag.offsetTop;
					var deltaX = startX-origX;
					var deltaY = startY-origY;

					if(document.addEventListener)
					{
						document.addEventListener("mousemove",moveHandler,true);
						document.addEventListener("mouseup",upHandler,true);
					}
					else if(document.attachEvent)
					{
						elementToDrag.setCapture();
						elementToDrag.attachEvent("onmousemove",moveHandler);
						elementToDrag.attachEvent("onmouseup",upHandler);
					}

					if(event.preventDefault)
					{
						event.preventDefault();
					}
					else
					{
						event.returnValue=false;
					}

					function moveHandler(e)
					{
						if(!e)
						{
							e = window.event;
						}
						var scroll = getScrollOffsets();
						
						//
						
						var moveleft= e.clientX+scroll.x - deltaX;
						var movetop = e.clientY+scroll.y - deltaY;
						
						var over = false;
						if(fromfixed==-1)
						{
							var limit = $("limit").value*1;
							var mistake = $("mistake").value*1;
							
							var enter = false;
							
							for(var i=0; i<limit; i++)
							{
								var dx = Math.abs($("fixed["+i+"]").offsetLeft*1 - getnum(obj.style.left));
								var dy = Math.abs($("fixed["+i+"]").offsetTop*1 - getnum(obj.style.top));
								
								if(dx<=getnum($("fixed["+i+"]").style.width)/2 && dy<=getnum($("fixed["+i+"]").style.height)/2+mistake)
								{
									var includeId = $("fixed["+i+"]").getAttribute("data-include");
									if(includeId!="")
									{
										$("asc["+includeId+"]").style.left=$("fixed["+i+"]").offsetLeft*1+getnum($("fixed["+i+"]").style.width)+mistake*2+"px";
									}
									for(var j=0; j<limit; j++)
									{
										if(j!=i)
										{
											var tempId = $("fixed["+j+"]").getAttribute("data-include");
											if(tempId!="")
											{
												$("asc["+tempId+"]").style.left=$("fixed["+j+"]").offsetLeft+"px";
											}
										}
									}
									enter=true;
									break;
								}
							}
							if(enter==false)
							{
								for(var j=0; j<limit; j++)
								{
									var tempId = $("fixed["+j+"]").getAttribute("data-include");
									if(tempId!="")
									{
										$("asc["+tempId+"]").style.left=$("fixed["+j+"]").offsetLeft+"px";
									}
								}
							}
						}
						else if(fromfixed==1)
						{
							var limit = $("limit").value*1;
							var mistake = $("mistake").value*1;
							
							var last = limit-1;
							var moveout = false;
							if(moveleft>$("fixed[0]").offsetLeft*1+getnum($("fixed[0]").style.width)+mistake*2)
							{
								moveout = true;
							}
							else if(movetop>$("fixed["+last+"]").offsetTop*1+getnum($("fixed[0]").style.height)+mistake*2)
							{
								moveout = true;
							}
							else if(moveleft<$("fixed[0]").offsetLeft*1-getnum($("fixed[0]").style.width)-mistake*2)
							{
								moveout = true;
							}
							else if(movetop<$("fixed[0]").offsetTop*1-getnum($("fixed[0]").style.height)-mistake*2)
							{
								moveout = true;
							}
							
							if(moveout==true)
							{
								var parentID = obj.getAttribute("data-parent");
								$("fixed["+parentID+"]").setAttribute("data-include", "");
								obj.setAttribute("data-parent", "");
								over=true;
							}
							else
							{
								for(var i=0; i<limit; i++)
								{
									var dy = Math.abs($("fixed["+i+"]").offsetTop*1 - movetop);
									
									if(dy<=getnum($("fixed["+i+"]").style.height)/2+mistake)
									{
										var includeId = $("fixed["+i+"]").getAttribute("data-include");
										if(includeId!="")
										{
											var parentId = obj.getAttribute("data-parent");
											$("asc["+includeId+"]").style.top=$("fixed["+parentId+"]").offsetTop+"px";
											$("asc["+includeId+"]").setAttribute("data-parent", parentId);
											$("fixed["+parentId+"]").setAttribute("data-include", includeId);
											obj.setAttribute("data-parent", i);
											$("fixed["+i+"]").setAttribute("data-include", obj.getAttribute("data-id"));
										}
										else
										{
											var parentId = obj.getAttribute("data-parent");
											$("fixed["+parentId+"]").setAttribute("data-include", "");
											obj.setAttribute("data-parent", i);
											$("fixed["+i+"]").setAttribute("data-include", obj.getAttribute("data-id"));
										}
										break;
									}
								}
							}
						}
						
						//
						
						elementToDrag.style.left = (e.clientX+scroll.x - deltaX)+"px";
						elementToDrag.style.top = (e.clientY+scroll.y - deltaY)+"px";
						
						if(e.stopPropagation)
						{
							e.stopPropagation();
						}
						else
						{
							e.cancelBubble = true;
						}
						
						//
						
						if(over==true)
						{
							upHandler(e);
						}
						
					}

					function upHandler(e)
					{
						if(!e)
						{
							e = window.event;
						}
						if(document.removeEventListener)
						{
							document.removeEventListener("mouseup",upHandler,true);
							document.removeEventListener("mousemove",moveHandler,true);
						}
						else
						{
							elementToDrag.releaseCapture();
							elementToDrag.detachEvent("onmouseup",upHandler);
							elementToDrag.detachEvent("onmousemove",moveHandler);
						}
						if(e.stopPropagation)
						{
							e.stopPropagation();
						}
						else
						{
							e.cancelBubble = true;
						}
						
						//
						
						
						var limit = $("limit").value*1;
						var mistake = $("mistake").value*1;
						
						var enter = false;
						for(var i=0; i<limit; i++)
						{
							var dx = Math.abs($("fixed["+i+"]").offsetLeft*1 - getnum(obj.style.left));
							var dy = Math.abs($("fixed["+i+"]").offsetTop*1 - getnum(obj.style.top));
							
							if(dx<=getnum($("fixed["+i+"]").style.width)/2 && dy<=getnum($("fixed["+i+"]").style.height)/2+mistake)
							{
								enter = true;
								if(fromfixed==-1)
								{
									var includeId = $("fixed["+i+"]").getAttribute("data-include");
									if(includeId!="")
									{
										$("asc["+includeId+"]").style.left=$("asc["+includeId+"]").getAttribute("data-left")+"px";
										$("asc["+includeId+"]").style.top=$("asc["+includeId+"]").getAttribute("data-top")+"px";
										$("asc["+includeId+"]").setAttribute("data-parent", "");
									}
									obj.style.left=$("fixed["+i+"]").offsetLeft+"px";
									obj.style.top=$("fixed["+i+"]").offsetTop+"px";
									obj.setAttribute("data-parent", i);
									$("fixed["+i+"]").setAttribute("data-include", obj.getAttribute("data-id"));
									break;
								}
								else if(fromfixed==1)
								{
									obj.style.left=$("fixed["+i+"]").offsetLeft+"px";
									obj.style.top=$("fixed["+i+"]").offsetTop+"px";
								}
							}
						}
						if(enter==false)
						{
							if(fromfixed==-1)
							{
								obj.style.left = obj.getAttribute("data-left")+"px";
								obj.style.top = obj.getAttribute("data-top")+"px";
							}
							else if(fromfixed==1)
							{
								var parentId = obj.getAttribute("data-parent");
								if(parentId!="")
								{
									obj.style.left = $("fixed["+parentId+"]").offsetLeft+"px";
									obj.style.top = $("fixed["+parentId+"]").offsetTop+"px";
								}
								else
								{
									obj.style.left = obj.getAttribute("data-left")+"px";
									obj.style.top = obj.getAttribute("data-top")+"px";
								}
							}
							
						}
						//$("show").value=obj.style.left + ", " + obj.style.top;
						obj.style.zIndex=1;
						obj.style.backgroundColor="#ccf";
					}
				}
			}
			
			function getScrollOffsets(w)
			{
					w = w || window;
					if(w.pageXOffset != null)
					{
						return {x:w.pageXOffset,y:w.pageYOffset};
					}
					var d=w.document;
					if(document.compatMode == "CSS1Compat")
					{
						return {x:d.documentElement.scrollLeft,y:d.documentElement.scrollTop};
					}
					return {x:d.body.scrollLeft,y:d.body.scrollTop};                
			}
				
			//
			
			function $(_obj)
			{
				return document.getElementById(_obj);
			}
			
			function getnum(r)
			{
				var reg=/[^\d]+/img;
				var r2=r.replace(reg,"");
				return r2*1;
			}
			
			window.onload = function()
			{
				var num = $("num").value;
				for(var i=0; i<num; i++)
				{
					$("asc["+i+"]").setAttribute("data-left", $("asc["+i+"]").offsetLeft);
					$("asc["+i+"]").setAttribute("data-top", $("asc["+i+"]").offsetTop);
				}
			}
			
			function test()
			{
				var limit = $("limit").value*1;
				var r="";
				for(var i=0; i<limit; i++)
				{
					r += (i+1) + " - " + $("fixed["+i+"]").getAttribute("data-include") + "\n";
				}
				alert(r);
			}
		</script>
	</head>
	
	<body>
		<?php
			echo $content;
		?>
		<input type="text" id="show" style="">
		<input type="button" onclick="test()" value="test">
	</body>
</html>

<!--
a1
1
b2
2
c3
3
d4
4
e5
5
f6
6
g7
7
h8
8
i9
9
j10
-->