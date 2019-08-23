function $(_obj, eleby)
{
	eleby = eleby || "id";
	switch(eleby)
	{
		case "id":
			return document.getElementById(_obj);
		break;
		
		case "name":
			return document.getElementByName(_obj);
		break;
		
		case "class":
			return document.getElementByClassName(_obj);
		break;
	}
}

function ajax(url, data, func, method)
{
	method = method || "get";
	method.toLowerCase();
	
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
	
	httpRequest.onreadystatechange = function()
	{
		if(httpRequest.readyState == 4)
		{
			if(httpRequest.status == 200)
			{
				var evalfunc = eval(func);
				evalfunc(httpRequest.responseText);
			}
		}
	};
	
	data = encodeURI(data);
	
	if(method=="get")
	{
		httpRequest.open('get', url+"?"+data, true);
		httpRequest.send('');
	}
	else if(method=="post")
	{
		httpRequest.open('post', url, true);
		httpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		httpRequest.send(data);
	}
}

window.onload = function()
{
	p3_insert_page.divResize();
}

function jump(page)
{
	if(page==3)
	{
		global.change_page(3);
	}
	else
	{
		var text = $("jump_hidden_text").value;
		var id = $("jump_hidden_id").value;
		if(page==33)
		{
			global.set_titlebar("題庫 >> 新增資料 >> "+text);
			ajax("ajax.php", "page=3_insert_page&id="+id, "global.displayer_refresh");
		}
		else if(page==32)
		{
			global.set_titlebar("題庫 >> 修改資料 >> "+text);
			ajax("ajax.php", "page=3_update_page&id="+id, "global.displayer_refresh");
		}
	}
}

var global=
{
	index_onclick:function(id)
	{
		//$("global_masker2").style.display="";
		$("index"+15).style.display="none";
		$("index"+35).style.display="none";
		$("index"+46).style.display="none";
		$("index"+59).style.display="none";
		
		$("index"+id).style.display="";
	},
	
	masker2_onclick:function()
	{
		$("index15").style.display="none";
		$("index35").style.display="none";
		$("index46").style.display="none";
		$("index59").style.display="none";
		$("global_masker2").style.display="none";
	},
	
	btn_back_onmouseover:function()
	{
		$("backbg").style.borderColor="#fff";
		$("backer").style.color="#fff";
	},
	
	btn_back_onmouseout:function()
	{
		$("backbg").style.borderColor="#e0e0e0";
		$("backer").style.color="#e0e0e0";
	},
	
	btn_back_onclick:function(id)
	{
		this.change_page(id);
	},
	
	btn_displayer_visible:function()
	{
		var displayer_visible = $("displayer_visible").value;
		if(displayer_visible=="1")
		{
			$("displayer_visible").value="0";
			$("mainbg").style.display="none";
			$("displayer").style.display="none";
			$("displayer_visible_img").style.opacity=1;
		}
		else
		{
			$("displayer_visible").value="1";
			$("mainbg").style.display="";
			$("displayer").style.display="";
			$("displayer_visible_img").style.opacity=0.7;
		}
	},
	
	btn_onmouseover:function(page)
	{
		var global_hide_nowpage = $("global_hide_nowpage").value;
		if(global_hide_nowpage!=page)
		{
			$("global_btn_bg"+page).style.opacity=0.6;
			$("global_btn"+page).style.cursor="pointer";
		}
		else
		{
			$("global_btn"+page).style.cursor="context-menu";
		}
	},

	btn_onmouseout:function(page)
	{
		var global_hide_nowpage = $("global_hide_nowpage").value;
		if(global_hide_nowpage!=page)
		{
			$("global_btn_bg"+page).style.opacity=0.5;
		}
	},
	
	btn_onclick:function(page)
	{
		var global_hide_nowpage = $("global_hide_nowpage").value;
		if(global_hide_nowpage!=page)
		{
			for(var i=1; i<=3; i++)
			{
				if(i==page)
				{
					$("global_btn_bg"+i).style.opacity=0.3;
					$("global_btn"+i).style.cursor="context-menu";
				}
				else
				{
					$("global_btn_bg"+i).style.opacity=0.5;
					$("global_btn"+i).style.cursor="pointer";
				}
			}
			$("global_hide_nowpage").value=page;
			this.change_page(page);
		}
	},
	
	change_page:function(page)
	{
		var title;
		if(page==1)
		{
			title="首頁";
		}
		else if(page==2)
		{
			title="測驗";
		}
		else if(page==3)
		{
			title="題庫";
		}
		ajax("ajax.php", "page="+page, "global.displayer_refresh");
		this.set_titlebar(title);
	},
	
	set_titlebar:function(text)
	{
		$("titlebar").innerHTML=text;
	},
	
	displayer_refresh:function(response)
	{
		$("displayer").innerHTML = response;
	},
	
	displayer_norefresh:function(response)
	{
		
	}
}

//

var data = new Array();
var ldata = new Array();

function Data(q, a1, a2, a3, a4, a5, ans)
{
	q = q || "";
	a1 = a1 || "";
	a2 = a2 || "";
	a3 = a3 || "";
	a4 = a4 || "";
	a5 = a5 || "";
	ans = ans || -1;
	
	this.q = q;
	this.a1 = a1;
	this.a2 = a2;
	this.a3 = a3;
	this.a4 = a4;
	this.a5 = a5;
	this.ans = ans;
}

var DataAPI=
{
	//public:
	getfrom:function(_obj, remove)
	{
		remove = remove || false;
		var rData = new Array();
		var str = $(_obj).value;
		var ex1 = this.exp(str);
		for(var i=0; i<ex1.length; i++)
		{
			var ex2 = this.exp(ex1[i], 1);
			if(remove==true)
			{
				ex2[0]=this.removeheader(ex2[0]);
			}
			rData[i] = new Data(ex2[0], ex2[1], ex2[2], ex2[3], ex2[4], ex2[5]);
		}
		return rData;
	},
	
	outhtml:function(datatype)
	{
		var out="";
		for(var i=0; i<datatype.length; i++)
		{
			if(i==datatype.length-1)
			{
				out+="<div style=' background-color:#fff;'>";
			}
			else
			{
				out+="<div style=' margin-bottom:20px; background-color:#fff;'>";
			}
			out+=datatype[i].q+"<br>";
			if(datatype[i].a1!="")
			{
				var check="";
				if(datatype[i].ans==1)
				{
					check="checked='checked'";
				}
				out+="<div style='margin-top:5px;'><label><input type='radio' name='r"+i+"' onchange='DataAPI.select_answer("+i+", 1)' "+check+">"+datatype[i].a1+"</label></div>";
			}
			if(datatype[i].a2!="")
			{
				var check="";
				if(datatype[i].ans==2)
				{
					check="checked='checked'";
				}
				out+="<div style='margin-top:5px;'><label><input type='radio' name='r"+i+"' onchange='DataAPI.select_answer("+i+", 2)' "+check+">"+datatype[i].a2+"</label></div>";
			}
			if(datatype[i].a3!="")
			{
				var check="";
				if(datatype[i].ans==3)
				{
					check="checked='checked'";
				}
				out+="<div style='margin-top:5px;'><label><input type='radio' name='r"+i+"' onchange='DataAPI.select_answer("+i+", 3)' "+check+">"+datatype[i].a3+"</label></div>";
			}
			if(datatype[i].a4!="")
			{
				var check="";
				if(datatype[i].ans==4)
				{
					check="checked='checked'";
				}
				out+="<div style='margin-top:5px;'><label><input type='radio' name='r"+i+"' onchange='DataAPI.select_answer("+i+", 4)' "+check+">"+datatype[i].a4+"</label></div>";
			}
			if(datatype[i].a5!="")
			{
				var check="";
				if(datatype[i].ans==5)
				{
					check="checked='checked'";
				}
				out+="<div style='margin-top:5px;'><label><input type='radio' name='r"+i+"' onchange='DataAPI.select_answer("+i+", 5)' "+check+">"+datatype[i].a5+"</label></div>";
			}
			out+="</div>";
		}
		return out;
	},
	
	//event
	select_answer:function(index, ans)
	{
		ldata[index].ans=ans;
		p3_insert_page.page1_enable();
	},
	
	//private:
	exp:function(str, secrnd)
	{
		secrnd = secrnd || 0;
		if(secrnd==0)
		{
			var rStr = new Array();
			rStr[0]="";
			var len=0;
			
			var datePart = str.split(/[\n]/g);
			
			var temparr = new Array();
			var templen=-1;
			for(var i=0; i<datePart.length; i++)
			{
				if(datePart[i]!="")
				{
					templen+=1;
					temparr[templen]=datePart[i];
				}
			}
			
			for(var i=0; i<temparr.length; i++)
			{
				rStr[len]+=temparr[i];
				var reg = new RegExp(/[\(]{1}[A-Ea-e1-5]{1}[\)]{1}/);
				if(i<temparr.length-1)
				{
					if(reg.test(temparr[i]))
					{
						if(!reg.test(temparr[i+1]))
						{
							len+=1;
							rStr[len]="";
						}
					}
				}
			}
			
			return rStr;
		}
		else
		{
			var rStr = str.split(/[\(]{1}[A-Ea-e1-5]{1}[\)]{1}/g);
			return rStr;
		}
	},
	
	removeheader:function(s)
	{
		var reg = new RegExp(/[0-9\.\-\s]/);
		var str = s.substring(0, 1);
		while(reg.test(str))
		{
			s = s.substring(1, s.length);
			str = s.substring(0, 1);
		}
		return s;
	}
}
//

var p2=
{
	examgo:function()
	{
		var index = $("p2_topic_select").selectedIndex;
		var text = $("p2_topic_select").options[index].text
		global.set_titlebar("題庫 >> 測驗 >> "+text);
		var id=$("p2_topic_select").value;
		var numeric=$("p2_topic_numeric").value;
		ajax("ajax.php", "page=2_examgo&id="+id+"&numeric="+numeric, "global.displayer_refresh");
	},
	
	examing_updown:function(updown)
	{
		this.examing_change_topic($("p2_examing_displaying").value*1+updown);
	},
	
	examing_change_topic:function(topicno)
	{
		var total = $("p2_examing_total").value;
		if(topicno==total)
		{
			$("p2_examing_back").disabled = false;
			$("p2_examing_next").disabled = true;
		}
		else if(topicno==1)
		{
			$("p2_examing_back").disabled = true;
			$("p2_examing_next").disabled = false;
		}
		else
		{
			$("p2_examing_back").disabled = false;
			$("p2_examing_next").disabled = false;
		}
		
		$("ingborder"+$("p2_examing_displaying").value).style.backgroundColor="";
		$("ingborder"+topicno).style.backgroundColor="f99";
		
		$("topic"+$("p2_examing_displaying").value).style.display="none";
		$("topic"+topicno).style.display="";
		
		$("p2_examing_displaying").value=topicno;
	},
	
	examing_change_answer:function(topicno, answer)
	{
		$("answer"+topicno).value=answer;
		$("alreadybg"+topicno).style.backgroundColor="9f9";
		
		if($("auto_next").checked==true)
		{
			this.examing_updown(1);
		}
	},
	
	examing_end:function()
	{
		var total=$("p2_examing_total").value;
		var notyet=false;
		for(var i=1; i<=total; i++)
		{
			if($("answer"+i).value=="")
			{
				notyet=true;
			}
		}
		if(notyet)
		{
			$("global_masker").style.display="";
			$("p2_examing_notyet").style.display="";
		}
		else
		{
			this.sendend();
		}
	},
	
	sendend:function()
	{
		var total=$("p2_examing_total").value;
		var str="page=p2_examing_end&total="+total;
		for(var i=1; i<=total; i++)
		{
			str+="&realid[]="+$("realid"+i).value;
			str+="&answer[]="+$("answer"+i).value;
		}
		ajax("ajax.php", str, "global.displayer_refresh", "post");
	},
	
	notyet_cancel:function()
	{
		$("global_masker").style.display="none";
		$("p2_examing_notyet").style.display="none";
	},
	
	notyet_confirm:function()
	{
		$("global_masker").style.display="none";
		$("p2_examing_notyet").style.display="none";
		this.sendend();
	}
}

var p3=
{
	text_insert_topic_onkeypress:function(e)
	{
		var keycode;
		if(window.event)
		{
			keycode = window.event.keyCode;
		}
		else if(e)
		{
			keycode = e.which;
		}
		else
		{
			return true;
		}
		if (keycode == 13)
		{
			this.btn_insert_topic_onclick();
		}
	},
	
	btn_insert_topic_onclick:function()
	{
		var v = $("p3_text_insert_topic").value;
		if(v!="")
		{
			ajax("ajax.php", "page=3_insert_topic&value="+v, "global.displayer_refresh");
		}
	},
	
	td_update_topic_ondblclick:function(id)
	{
		var p3_hide_td_mode = $("p3_hide_td_mode"+id).value;
		if(p3_hide_td_mode=="text")
		{
			$("p3_hide_td_mode"+id).value="input";
			var text = $("p3_td_update_topic"+id).innerHTML;
			$("p3_td_update_topic"+id).innerHTML="<input type='text' id='p3_td_text"+id+"' style='width:195px; height:75px; font-size:15px; text-align:center;' value='"+text+"' onkeypress='p3.td_text_onkeypress("+id+", event)' onblur='p3.td_text_onblur("+id+")'>";
			$("p3_td_text"+id).select();
		}
	},
	
	td_text_onkeypress:function(id, e)
	{
		var keycode;
		if(window.event)
		{
			keycode = window.event.keyCode;
		}
		else if(e)
		{
			keycode = e.which;
		}
		else
		{
			return true;
		}
		if (keycode == 13)
		{
			this.td_text_onblur(id);
		}
	},
	
	td_text_onblur:function(id)
	{
		var p3_hide_td_mode = $("p3_hide_td_mode"+id).value;
		if(p3_hide_td_mode=="input")
		{
			$("p3_hide_td_mode"+id).value="text";
			var text = $("p3_td_text"+id).value;
			$("p3_td_update_topic"+id).innerHTML=text;
			ajax("ajax.php", "page=3_update_topic&id="+id+"&value="+text, "global.displayer_norefresh");
		}
	},
	
	btn_insert_data:function(id)
	{
		var text = $("p3_td_update_topic"+id).innerHTML;
		global.set_titlebar("題庫 >> 新增資料 >> "+text);
		ajax("ajax.php", "page=3_insert_page&id="+id, "global.displayer_refresh");
	},
	
	btn_update_data:function(id)
	{
		var text = $("p3_td_update_topic"+id).innerHTML;
		global.set_titlebar("題庫 >> 修改資料 >> "+text);
		ajax("ajax.php", "page=3_update_page&id="+id, "global.displayer_refresh");
	},
	
	btn_delete_data:function(id)
	{
		var text = $("p3_td_update_topic"+id).innerHTML;
		$("p3_delete_topic_name").innerHTML=text;
		$("p3_delete_topic_id").value=id;
		
		$("global_masker").style.display="";
		$("p3_delete_topic").style.display="";
	},
	
	btn_delete_data_yes:function()
	{		
		var id=$("p3_delete_topic_id").value;
		var index = $("p3_td_update_topic"+id).parentNode.rowIndex;
		$("p3_topic_table").deleteRow(index);
		
		ajax("ajax.php", "page=3_delete_topic&id="+id, "global.displayer_norefresh");
		
		$("p3_delete_topic").style.display="none";
		$("global_masker").style.display="none";
	},
	
	btn_delete_data_no:function()
	{
		$("p3_delete_topic").style.display="none";
		$("global_masker").style.display="none";
	}
}

//

var p3_insert_page=
{
	divResize:function()
	{
		try
		{
			var _target = $("p3_insert_page_heightspacer");
			if(document.contains(_target))
			{
				_target.style.height=$("p3_insert_page_page1_textarea").offsetHeight-2+"px";
			}
		}
		catch(e)
		{
		}
		setTimeout("p3_insert_page.divResize()",1);
	},
	
	btn_input_page1_onclick:function()
	{
		$("p3_insert_page_input_page_bg1").style.backgroundColor="#fff";
		$("p3_insert_page_input_page_bg2").style.backgroundColor="#eee";
		
		$("p3_insert_page_input_page_border1").style.backgroundColor="#fff";
		$("p3_insert_page_input_page_border2").style.backgroundColor="#000";
		
		$("p3_insert_page_input_page_display2").style.display="none";
		$("p3_insert_page_input_page_display1").style.display="";
	},
	
	btn_input_page2_onclick:function()
	{
		$("p3_insert_page_input_page_bg1").style.backgroundColor="#eee";
		$("p3_insert_page_input_page_bg2").style.backgroundColor="#fff";
		
		$("p3_insert_page_input_page_border1").style.backgroundColor="#000";
		$("p3_insert_page_input_page_border2").style.backgroundColor="#fff";
		
		$("p3_insert_page_input_page_display1").style.display="none";
		$("p3_insert_page_input_page_display2").style.display="";
	},
	
	page1_textarea_onkeydown:function()
	{
		var keycode, kctrl;
		if(window.event)
		{
			keycode = window.event.keyCode;
			kctrl = window.event.ctrlKey;
		}
		else if(e)
		{
			keycode = e.which;
			kctrl = e.ctrlKey;
		}
		else
		{
			return true;
		}
		if(kctrl && keycode==65)
		{
			$("p3_insert_page_page1_textarea").select();
		}
	},
	
	page1_textarea_onchange:function()
	{
		data = DataAPI.getfrom("p3_insert_page_page1_textarea", $("p3_insert_page_page1_checkbox").checked);
		for(var i=0; i<data.length; i++)
		{
			for(var j=0; j<ldata.length; j++)
			{
				if(data[i].q==ldata[j].q && data[i].a1==ldata[j].a1 && data[i].a2==ldata[j].a2 && data[i].a3==ldata[j].a3 && data[i].a4==ldata[j].a4 && data[i].a5==ldata[j].a5)
				{
					data[i].ans=ldata[j].ans;
				}
			}
		}
		$("p3_insert_page_page1_displayer").innerHTML=DataAPI.outhtml(data);
		ldata=data;
		this.page1_enable();
	},
	
	page1_set_answer_onclick:function()
	{
		$("global_masker").style.display="";
		$("p3_insert_page_page1_set_answer").style.display="";
		$("p3_insert_page_page1_answer").focus();
	},
	
	page1_set_answer_cancel:function()
	{
		$("global_masker").style.display="none";
		$("p3_insert_page_page1_set_answer").style.display="none";
		$("p3_insert_page_page1_answer").value="";
	},
	
	page1_set_answer_confirm:function()
	{
		$("global_masker").style.display="none";
		$("p3_insert_page_page1_set_answer").style.display="none";
		var answer = $("p3_insert_page_page1_answer").value;
		answer.split("");
		for(var i=0; i<ldata.length; i++)
		{
			if(answer[i]=="1" || answer[i]=="A" || answer[i]=="a")
			{
				ldata[i].ans=1;
			}
			else if(answer[i]=="2" || answer[i]=="B" || answer[i]=="b")
			{
				ldata[i].ans=2;
			}
			else if(answer[i]=="3" || answer[i]=="C" || answer[i]=="c")
			{
				ldata[i].ans=3;
			}
			else if(answer[i]=="4" || answer[i]=="D" || answer[i]=="d")
			{
				ldata[i].ans=4;
			}
			else if(answer[i]=="5" || answer[i]=="E" || answer[i]=="e")
			{
				ldata[i].ans=5;
			}
			else
			{
				ldata[i].ans=-1;
			}
		}
		$("p3_insert_page_page1_displayer").innerHTML=DataAPI.outhtml(ldata);
		$("p3_insert_page_page1_answer").value="";
		this.page1_enable();
	},
	
	page1_enable:function()
	{
		var cansend=true;
		for(var i=0; i<ldata.length; i++)
		{
			if(ldata[i].ans==-1)
			{
				cansend=false;
				break;
			}
		}
		if(cansend==true)
		{
			$("p3_insert_page_page1_enablebtn").disabled=false;
		}
		else
		{
			$("p3_insert_page_page1_enablebtn").disabled=true;
		}
	},
	
	page1_insert_data_onclick:function()
	{
		var id = $("p3_insert_page_id").value;
		var num = ldata.length;
		var poststr="page=3_insert_page_insert&id="+id+"&num="+num;
		for(var i=0; i<ldata.length; i++)
		{
			poststr+="&arr["+i+"][]="+ldata[i].q;
			poststr+="&arr["+i+"][]="+ldata[i].a1;
			poststr+="&arr["+i+"][]="+ldata[i].a2;
			poststr+="&arr["+i+"][]="+ldata[i].a3;
			poststr+="&arr["+i+"][]="+ldata[i].a4;
			poststr+="&arr["+i+"][]="+ldata[i].a5;
			poststr+="&arr["+i+"][]="+ldata[i].ans;
		}
		ajax("ajax.php", poststr, "global.displayer_refresh", "post");
		ldata = new Array();
	},
	
	//
	
	page2_select_answer:function(id)
	{
		$("page2_answer").value=id;
	},
	
	page2_insert_answer_keydown:function(id)
	{
		var keycode;
		if(window.event)
		{
			keycode = window.event.keyCode;
		}
		else if(e)
		{
			keycode = e.which;
		}
		else
		{
			return true;
		}
		if(keycode==13)
		{
			this.page2_insert_answer(id);
		}
	},
	
	page2_insert_answer:function(id)
	{
		var num = $("page2_answer_num").value;
		if(num<5)
		{
			var newnum = num*1+1;
			$("page2_ans"+newnum).style.display="";
			$("page2_answer_num").value=newnum;
			
			if(id!=num)
			{
				for(var i=newnum; i>id; i--)
				{
					$("page2_ans"+i+"_text").value=$("page2_ans"+(i-1)+"_text").value;
				}
				$("page2_ans"+(id+1)+"_text").value="";
			}
			
			var page2_answer = $("page2_answer").value;
			if(page2_answer>id)
			{
				var newans=page2_answer*1+1;
				$("page2_answer").value=newans;
				$("page2_r"+newans).checked=true;
			}
			
			$("page2_ans"+(id+1)+"_text").focus();
			
			this.page2_answer_num_change();
		}
	},
	
	page2_delete_answer:function(id)
	{
		var num = $("page2_answer_num").value;
		if(num>2)
		{
			if(id!=num)
			{
				for(var i=id; i<num; i++)
				{
					$("page2_ans"+i+"_text").value=$("page2_ans"+(i+1)+"_text").value;
				}
			}
			
			var newnum = num*1-1;
			$("page2_ans"+num).style.display="none";
			$("page2_ans"+num+"_text").value="";
			$("page2_answer_num").value=newnum;
			
			var page2_answer = $("page2_answer").value;
			if(page2_answer==id)
			{
				$("page2_r0").checked=true;
				$("page2_answer").value=-1;
			}
			else if(page2_answer>id)
			{
				var newans=page2_answer*1-1;
				$("page2_answer").value=newans;
				$("page2_r"+newans).checked=true;
			}
			
			this.page2_answer_num_change();
		}
	},
	
	page2_answer_num_change:function()
	{
		var num = $("page2_answer_num").value;
		var display="";
		if(num==2)
		{
			display="none";
		}
		for(var i=1; i<=5; i++)
		{
			$("page2_img"+i).style.display=display;
		}
	},
	
	page2_insert_data_onclick:function()
	{
		var answer_space=true;
		var topic_space=true;
		var set_answer=true;
		
		var num = $("page2_answer_num").value;
		for(var i=1; i<=num; i++)
		{
			if($("page2_ans"+i+"_text").value=="")
			{
				answer_space=false;
			}
		}
		
		if($("page2_topic").value=="")
		{
			topic_space=false;
		}
		
		if($("page2_answer").value==-1)
		{
			set_answer=false;
		}
		
		if(answer_space && topic_space && set_answer)
		{
			this.page2_insert_to_database();
		}
		else
		{
			if(answer_space)
			{
				$("page2_answer_space_ok").style.display="";
				$("page2_answer_space_no").style.display="none";
			}
			else
			{
				$("page2_answer_space_ok").style.display="none";
				$("page2_answer_space_no").style.display="";
			}
			
			if(topic_space)
			{
				$("page2_topic_space_ok").style.display="";
				$("page2_topic_space_no").style.display="none";
			}
			else
			{
				$("page2_topic_space_ok").style.display="none";
				$("page2_topic_space_no").style.display="";
			}
			
			if(set_answer)
			{
				$("page2_set_answer_ok").style.display="";
				$("page2_set_answer_no").style.display="none";
			}
			else
			{
				$("page2_set_answer_ok").style.display="none";
				$("page2_set_answer_no").style.display="";
			}
			
			$("global_masker").style.display="";
			$("p3_insert_page_page2_confirm").style.display="";
		}
	},
	
	page2_insert_data_confirm:function()
	{
		$("global_masker").style.display="none";
		$("p3_insert_page_page2_confirm").style.display="none";
	},
	
	page2_insert_to_database:function()
	{
		var topicid=$("p3_insert_page_id").value;
		var poststr="page=3_insert_page2_insert&topicid="+topicid;
		poststr+="&q="+$("page2_topic").value;
		
		var num = $("page2_answer_num").value;
		for(var i=1; i<=5; i++)
		{
			if(i<=num)
			{
				poststr+="&a"+i+"="+$("page2_ans"+i+"_text").value;
			}
			else
			{
				poststr+="&a"+i+"="+"";
			}
		}
		poststr+="&ans="+$("page2_answer").value;
		ajax("ajax.php", poststr, "global.displayer_refresh", "post");
	}
}

var p3_update_page=
{
	select_answer:function(id, index)
	{
		$("p3_update_page_controller_hidden_answer"+id).value=index;
	},
	
	insert_answer_keydown:function(id, index)
	{
		var keycode;
		if(window.event)
		{
			keycode = window.event.keyCode;
		}
		else if(e)
		{
			keycode = e.which;
		}
		else
		{
			return true;
		}
		if(keycode==13)
		{
			this.insert_answer(id, index);
		}
	},
	
	insert_answer:function(id, index)
	{
		var num = $("p3_update_page_controller_hidden_answer_num"+id).value;
		if(num<5)
		{
			var newnum = num*1+1;
			$("p3_update_page_controller_div"+id+"a"+newnum).style.display="";
			$("p3_update_page_controller_hidden_answer_num"+id).value=newnum;
			
			if(index!=num)
			{
				for(var i=newnum; i>index; i--)
				{
					$("p3_update_page_controller_text"+id+"a"+i).value=$("p3_update_page_controller_text"+id+"a"+(i-1)).value; //p3_update_page_controller_text{$n[id]}a{$i}
				}
				$("p3_update_page_controller_text"+id+"a"+(index+1)).value="";
			}
			
			var p3_update_page_controller_hidden_answer = $("p3_update_page_controller_hidden_answer"+id).value;
			if(p3_update_page_controller_hidden_answer>index)
			{
				var newans=p3_update_page_controller_hidden_answer*1+1;
				$("p3_update_page_controller_hidden_answer"+id).value=newans;
				$("p3_update_page_controller_radio"+id+"a"+newans).checked=true;
			}
			
			$("p3_update_page_controller_text"+id+"a"+(index+1)).focus();
			
			this.answer_num_change(id);
		}
	},
	
	delete_answer:function(id, index)
	{
		var num = $("p3_update_page_controller_hidden_answer_num"+id).value;
		if(num>2)
		{
			if(index!=num)
			{
				for(var i=index; i<num; i++)
				{
					$("p3_update_page_controller_text"+id+"a"+i).value=$("p3_update_page_controller_text"+id+"a"+(i+1)).value;
				}
			}
			
			var newnum = num*1-1;
			$("p3_update_page_controller_div"+id+"a"+num).style.display="none";
			$("p3_update_page_controller_text"+id+"a"+num).value="";
			$("p3_update_page_controller_hidden_answer_num"+id).value=newnum;
			
			var p3_update_page_controller_hidden_answer = $("p3_update_page_controller_hidden_answer"+id).value;
			if(p3_update_page_controller_hidden_answer==index)
			{
				$("p3_update_page_controller_radio"+id+"a0").checked=true;
				$("p3_update_page_controller_hidden_answer"+id).value=-1;
			}
			else if(p3_update_page_controller_hidden_answer>index)
			{
				var newans=p3_update_page_controller_hidden_answer*1-1;
				$("p3_update_page_controller_hidden_answer"+id).value=newans;
				$("p3_update_page_controller_radio"+id+"a"+newans).checked=true;
			}
			
			this.answer_num_change(id);
		}
	},
	
	answer_num_change:function(id)
	{
		var num = $("p3_update_page_controller_hidden_answer_num"+id).value;
		var display="";
		if(num==2)
		{
			display="none";
		}
		for(var i=1; i<=5; i++)
		{
			$("p3_update_page_controller_img"+id+"a"+i).style.display=display;
		}
	},
	
	update_data_onclick:function(id)
	{
		
		var answer_space=true;
		var topic_space=true;
		var set_answer=true;
		
		var num = $("p3_update_page_controller_hidden_answer_num"+id).value;
		for(var i=1; i<=num; i++)
		{
			if($("p3_update_page_controller_text"+id+"a"+i).value=="")
			{
				answer_space=false;
			}
		}
		
		if($("p3_update_page_controller_q"+id).value=="")
		{
			topic_space=false;
		}
		
		if($("p3_update_page_controller_hidden_answer"+id).value==-1)
		{
			set_answer=false;
		}
		
		if(answer_space && topic_space && set_answer)
		{
			this.update_to_database(id);
		}
		else
		{
			if(answer_space)
			{
				$("p3_update_page_answer_space_ok").style.display="";
				$("p3_update_page_answer_space_no").style.display="none";
			}
			else
			{
				$("p3_update_page_answer_space_ok").style.display="none";
				$("p3_update_page_answer_space_no").style.display="";
			}
			
			if(topic_space)
			{
				$("p3_update_page_topic_space_ok").style.display="";
				$("p3_update_page_topic_space_no").style.display="none";
			}
			else
			{
				$("p3_update_page_topic_space_ok").style.display="none";
				$("p3_update_page_topic_space_no").style.display="";
			}
			
			if(set_answer)
			{
				$("p3_update_page_set_answer_ok").style.display="";
				$("p3_update_page_set_answer_no").style.display="none";
			}
			else
			{
				$("p3_update_page_set_answer_ok").style.display="none";
				$("p3_update_page_set_answer_no").style.display="";
			}
			
			$("global_masker").style.display="";
			$("p3_update_page_confirm").style.display="";
		}
	},
	
	update_data_confirm:function()
	{
		$("global_masker").style.display="none";
		$("p3_update_page_confirm").style.display="none";
	},
	
	update_to_database:function(id)
	{
		var poststr="page=3_update_page_update&id="+id;
		poststr+="&q="+$("p3_update_page_controller_q"+id).value;
		
		var num = $("p3_update_page_controller_hidden_answer_num"+id).value;
		for(var i=1; i<=5; i++)
		{
			if(i<=num)
			{
				poststr+="&a"+i+"="+$("p3_update_page_controller_text"+id+"a"+i).value;
			}
			else
			{
				poststr+="&a"+i+"="+"";
			}
		}
		poststr+="&ans="+$("p3_update_page_controller_hidden_answer"+id).value;
		ajax("ajax.php", poststr, "global.displayer_norefresh", "post");
		this.update_displayer(id);
	},
	
	update_displayer:function(id)
	{
		var num = $("p3_update_page_controller_hidden_answer_num"+id).value;
		$("p3_update_page_temp_ans_num"+id).value = num;
		
		$("p3_update_page_displayer_q"+id).innerHTML = $("p3_update_page_controller_q"+id).value;
		$("p3_update_page_temp_q"+id).value = $("p3_update_page_controller_q"+id).value;
		
		var ans = $("p3_update_page_controller_hidden_answer"+id).value;
		$("p3_update_page_temp_ans"+id).value=ans;
		
		for(var i=1; i<=5; i++)
		{
			$("p3_update_page_displayer_span"+id+"a"+i).innerHTML = $("p3_update_page_controller_text"+id+"a"+i).value;
			$("p3_update_page_temp"+id+"a"+i).value = $("p3_update_page_controller_text"+id+"a"+i).value;
			
			if(i==ans)
			{
				$("p3_update_page_displayer_radio"+id+"a"+ans).checked=true;
			}
			else
			{
				$("p3_update_page_displayer_radio"+id+"a"+i).checked=false;
			}
			
			if(i<=num)
			{
				$("p3_update_page_displayer_div"+id+"a"+i).style.display="";
			}
			else
			{
				$("p3_update_page_displayer_div"+id+"a"+i).style.display="none";
			}
		}
		this.hide_controller(id);
	},
	
	undo_displayer:function(id)
	{
		var num = $("p3_update_page_temp_ans_num"+id).value;
		$("p3_update_page_controller_hidden_answer_num"+id).value = num;
		
		$("p3_update_page_controller_q"+id).value = $("p3_update_page_temp_q"+id).value;
		
		var ans = $("p3_update_page_temp_ans"+id).value;
		$("p3_update_page_controller_hidden_answer"+id).value = ans;
		
		for(var i=1; i<=5; i++)
		{
			$("p3_update_page_controller_text"+id+"a"+i).value = $("p3_update_page_temp"+id+"a"+i).value;
			
			if(i==ans)
			{
				$("p3_update_page_controller_radio"+id+"a"+ans).checked=true;
			}
			else
			{
				$("p3_update_page_controller_radio"+id+"a"+i).checked=false;
			}
			
			if(i<=num)
			{
				$("p3_update_page_controller_div"+id+"a"+i).style.display="";
			}
			else
			{
				$("p3_update_page_controller_div"+id+"a"+i).style.display="none";
			}
		}
		this.answer_num_change(id);
		this.hide_controller(id);
	},
	
	displayer_delete:function(id)
	{
		$("global_masker").style.display="";
		$("p3_update_page_delete").style.display="";
		
		$("3_update_page_delete_data_id").value=id;
	},
	
	displayer_delete_yes:function()
	{
		var id = $("3_update_page_delete_data_id").value;
		ajax("ajax.php", "page=3_update_page_delete&id="+id, "global.displayer_norefresh");
		
		$("p3_update_page_data_div"+id).style.display="none";
		
		$("global_masker").style.display="none";
		$("p3_update_page_delete").style.display="none";
	},
	
	displayer_delete_no:function()
	{
		$("global_masker").style.display="none";
		$("p3_update_page_delete").style.display="none";
	},
	
	displayer_update:function(id)
	{
		$("p3_update_page_controller"+id).style.display="";
		$("p3_update_page_displayer"+id).style.display="none";
	},
	
	hide_controller:function(id)
	{
		$("p3_update_page_controller"+id).style.display="none";
		$("p3_update_page_displayer"+id).style.display="";
	}
}
//global.displayer_refresh
//global.displayer_norefresh