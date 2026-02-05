if (REQUIRE_ONCE_COMMON == null)
{
	// 한번만 실행되게
	var REQUIRE_ONCE_COMMON = true;
	
	// 숫자 포맷
	function number_format(numString) { 
		alert(numString);
		var arrStr = numString.split('.'); 
		var re = /(-?\d+)(\d{3})/; 
		
		while (re.test(arrStr[0])) { 
			arrStr[0] = arrStr[0].replace(re, "$1,$2"); 
		} 
		
		if(arrStr[1]) { 
			return arrStr[0] +'.' + arrStr[1]; 
		} else { 
			return arrStr[0]; 
		} 
	} 

	
	// 삭제 검사 확인
	function confirm_del(href) 
	{
		if(confirm("정말 삭제하시겠습니까?")) 
				document.location.href = href;
	}

	// 체크박스의 값을 변경한다.
	function set_checkbox(form,fname,val) {
		var chk_count=0;
		for(i=0;i<form.length;i++) {
			if(form[i].type=="checkbox" && form[i].name==fname) {
				if(val=='inv') {
					form[i].checked=!form[i].checked;
				} else {
					form[i].checked=val;
				}
				chk_count++;
			}
		}
		return chk_count;
	}

	function memberPersms(ReHand,Hand,Name,Content,Err)
	{
		cw=screen.availWidth;     //화면 넓이
		ch=screen.availHeight;    //화면 높이

		sw=460;    //띄울 창의 넓이
		sh=649;    //띄울 창의 높이

		ml=((cw-sw)/2)-220;        //가운데 띄우기위한 창의 x위치
		mt=(ch-sh)/2;         //가운데 띄우기위한 창의 y위치


		if(Err)
		{
			alert("휴대전화 정보가 올바르지 않습니다.");
		}
		else
		{
			if(Name) {
				window.open("/wb_admin/sms_write.php?rehand="+ReHand+"&hand="+Hand+"&username="+Name+"&content="+Content,"","scrollbars=yes,left="+ml+",top="+mt+",width="+sw+",height="+sh);
			} else {
				window.open("/wb_admin/sms_write.php?rehand="+ReHand+"&hand="+Hand+"&username="+Name+"&content="+Content,"","scrollbars=yes,left="+ml+",top="+mt+",width="+sw+",height="+sh);
			}
		}
	}

	function goodsPersms(Idx_Ary)
	{
		if(Idx_Ary){
			window.open("/wb_admin/member_sms1.php?Idx_Ary="+Idx_Ary,"","scrollbars=yes,left=200,top=200,width=440,height=440");
		}else{
			alert("올바른 접근이 아닙니다");
		}
		
	}

	// 체크박스에 하나라도 val값과 일치라면 참
	function chk_checkbox(form,fname,val) {
		var Check_List=false;
		for(i=0;i<form.length;i++) {
			if(form[i].type=="checkbox" && form[i].name==fname) {
				if(form[i].checked==val) Check_List=true;
			}
		}
		return Check_List;
	}
	
	// open 함수 재정의
	function window_open() {
		var a=window_open.arguments;
		if(a.length==1)
			window.open(a[0]);
		else if(a.length==2)
			window.open(a[0],a[1]);
		else
			window.open(a[0],a[1],a[2]);
	}
	
	// 우편번호검색
	function search_post(url_path,form_info) {
		window_open(url_path+'search_post.php?form_info='+form_info,'search_post','scrollbars=yes,width=470,height=400');
	}
	// 우편번호검색
	function search_post_m(url_path,form_info) {
		window_open(url_path+'search_post_m.php?form_info='+form_info,'search_post','scrollbars=yes,width=470,height=400');
	}
	
	// 아이디중복확인
	function search_mb_id(url_path,form_info,mb_id) {


		cw=screen.availWidth;     //화면 넓이
		ch=screen.availHeight;    //화면 높이

		sw=450;    //띄울 창의 넓이
		sh=200;    //띄울 창의 높이

		ml=(cw-sw)/2;        //가운데 띄우기위한 창의 x위치
		mt=(ch-sh)/2;         //가운데 띄우기위한 창의 y위치




		window.open(url_path+'search_id.php?form_info='+form_info+'&mb_id='+mb_id,"","scrollbars=no,left="+ml+",top="+mt+",width="+sw+",height="+sh);

		
	}


	// 관리자에서아이디중복확인
	function search_mb_id2(url_path,form_info,mb_id) {


		cw=screen.availWidth;     //화면 넓이
		ch=screen.availHeight;    //화면 높이

		sw=450;    //띄울 창의 넓이
		sh=200;    //띄울 창의 높이

		ml=(cw-sw)/2;        //가운데 띄우기위한 창의 x위치
		mt=(ch-sh)/2;         //가운데 띄우기위한 창의 y위치




		window.open(url_path+'search_id2.php?form_info='+form_info+'&mb_id='+mb_id,"","scrollbars=no,left="+ml+",top="+mt+",width="+sw+",height="+sh);

		
	}

	// 아이디중복확인
	function search_mb_id_m(url_path,form_info,mb_id) {
		window_open(url_path+'search_id_m.php?form_info='+form_info+'&mb_id='+mb_id,'search_id','scrollbars=no,width=350,height=300');
	}
	
	// 쪽지쓰기
	function note_write(url_path,recv_id) {
		window_open(url_path+'note_write.php?recv_id='+recv_id,'note_write','scrollbars=no,width=370,height=380');
	}
	
	// 쪽지보기
	function note_view(url_path,mode,num) {
		window_open(url_path+'note_view.php?mode='+mode+'&num='+num,'note_view','scrollbars=no,width=370,height=380');
	}
	
	// 상위태그 검색해서 객체 반환
	function find_parent_tag(e,tag)
	{
		if(e.target)
			var obj = e.target
		else
			var obj = e.srcElement
		while (obj.tagName.toLowerCase() != tag)
		{
			if(obj.parentNode)
				obj = obj.parentNode
			else
				obj = obj.parentElement
			if(typeof(obj.tagName)=='undefined') break;
		}
		return obj
	}
	
	var list_tmp_color="";
	// 리스트위에 마우스 올라 갔을 경우 색상변환
	function list_over_color(e,color,title_idx) {
		var obj=find_parent_tag(e,'tr');
		if(!obj.style) return;
		var idx = obj.rowIndex;
		if(idx>=title_idx)	 {
			list_tmp_color=obj.style.backgroundColor;
			obj.style.backgroundColor=color
		}
	}
	function list_out_color(e) {
		var obj=find_parent_tag(e,'tr');
		if(obj.style) obj.style.backgroundColor=list_tmp_color
	}
	
	// 토글함수
	function toggle_display_object() {
		var a=toggle_display_object.arguments;
		var target=a[0];
		var disp=a[1];
		var on=a[2];
		var off=a[3];
		if(target.style.display=='') {
			target.style.display='none';
			disp.innerHTML=off;
		} else {
			target.style.display='';
			disp.innerHTML=on;
		}
	}
	
	
	// 글보기에서 이미지 처리를 위한 부분
	var img_width=Array();
	var img_array=Array();
	
	function set_img_width_init() {
		var img = eval((navigator.appName=='Netscape') ? nsdoc+'.view_image' : 'document.all.view_image');
		if(typeof(img)!='undefined') {
			if(img.length>0) {
				for(i=0;i<img.length;i++) {
					img_width[i] = img[i].width;
					img_array[i] = img[i];
				}
			} else {
				img_width[0] = img.width;
				img_array[0] = img;
			}
			setInterval(set_width_img, 100);
		}
		if(set_img_old_onload) set_img_old_onload();
	}
	
	function set_width_img(){
		var view_image_width = eval((navigator.appName=='Netscape') ?
																 nsdoc+'.view_image_width' :
																 'document.all.view_image_width');
		
		if(img_array.length>0) {
			for(i=0;i<img_array.length;i++){ 
				if(img_width[i] > view_image_width.offsetWidth) {
					img_array[i].width = view_image_width.offsetWidth;
				} else if(img_width[i] < view_image_width.offsetWidth) {
					img_array[i].width = img_width[i];
				}
			}
		}
	}
	
	function view_image_popup(img) {
		var img_window=window.open('',img_window,'scrollbars=yes,resizable=yes,width=100,height=100');
		if(img_window) {
			img_window.document.writeln('<html>');
			img_window.document.writeln('<title>이미지보기</title>');

			img_window.document.writeln('<scr'+'ipt>');
			img_window.document.writeln('function load_image() {');
			img_window.document.writeln('if((view_image.width+30)>(screen.width-5)) ');
			img_window.document.writeln('imgWidth=screen.width-5;');
			img_window.document.writeln('else');
			img_window.document.writeln('imgWidth=view_image.width+30;');
			
			img_window.document.writeln('if((view_image.height+55)>(screen.height-30)) ');
			img_window.document.writeln('imgHeight=screen.height-30;');
			img_window.document.writeln('else');
			img_window.document.writeln('imgHeight=view_image.height+55;');
			
			img_window.document.writeln('var x=screen.width/2-imgWidth/2;');
			img_window.document.writeln('var y=(screen.height-30)/2-imgHeight/2;');
			img_window.document.writeln('self.resizeTo(imgWidth,imgHeight);');
			img_window.document.writeln('self.moveTo(x,y);');			
			img_window.document.writeln('}');
			img_window.document.writeln('</scr'+'ipt>');		}

			img_window.document.writeln('<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">');
			img_window.document.writeln('<img src="'+img.src+'" id="view_image" onclick="self.close()" style="cursor:hand;" onload="load_image()">');
			img_window.document.writeln('</body>');
			img_window.document.writeln('</html>');
	}
	

	var layername = 'rg_layer_div'

	function rg_layer_action(name, status)
	{
		var obj = document.all[name];

		if (typeof(obj) == 'undefined') {
			return;
		}

		if (status) {
			obj.style.visibility = status;
		} else {
			if(obj.style.visibility == 'visible')
				obj.style.visibility='hidden';
			else
				obj.style.visibility='visible';
		}
	}

	var bbs_url = '';
	var member_url = '';
	var skin_url = '';

	function set_url(bbs,member,skin) {
		bbs_url=bbs;
		member_url=member;
		skin_url=skin;
	}

	function rg_bbs_layer(bbs_code,num,name,id,homepage,email,profile,memo)
	{
		// event.clientX : 클릭한곳의 X 좌표
		// event.clientY : 클릭한곳의 Y 좌표
		// obj.offsetWidth  : DIV 오브젝트의 폭
		// obj.offsetHeight : DIV 오브젝트의 높이
		// document.body.clientWidth  : 브라우저의 폭
		// document.body.clientHeight : 브라우저의 높이
		// document.body.scrollLeft : 스크롤 Left
		// document.body.scrollTop  : 스크롤 Top
		// obj.style.posLeft : DIV 오브젝트의 X 좌표
		// obj.style.posTop  : DIV 오브젝트의 Y 좌표

		var obj = document.all[layername];
		var x, y;
		var body = "";
		var height = 0;

		x = event.clientX + document.body.scrollLeft - 20;
		y = event.clientY + document.body.scrollTop - 20;
		obj.style.posLeft = x;
		obj.style.posTop = y;
		
	
		if (name) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"location.href='"+bbs_url+"list.php?bbs_code="+bbs_code+"&ss[sn]=1&kw="+name+"';\"><td height=20>&nbsp; <IMG src="+skin_url+"images/namesearch_icon.gif border=0 width='12' height='12'> &nbsp;이름으로 검색&nbsp;&nbsp;</td></tr>";
			height += 20;
		}

		if (homepage) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+bbs_url+"layer_action.php?mode=homepage&data="+homepage+"');\"><td height=20>&nbsp; <IMG src="+skin_url+"images/home_icon.gif border=0 width='12' height='12'> &nbsp;홈페이지&nbsp;&nbsp;</td></tr>";
			height += 20;
		}

		if (email) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+bbs_url+"layer_action.php?mode=email&data="+email+"');\"><td height=20>&nbsp; <IMG src="+skin_url+"images/home_icon.gif border=0 width='12' height='12'> &nbsp;이메일&nbsp;&nbsp;</td></tr>";
			height += 20;
		}
		
		if (profile && id) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+member_url+"view_profile.php?mb_id="+id+"','profile','left=50,top=50,width=550,height=400,scrollbars=1');\"><td height=20>&nbsp; <IMG src="+skin_url+"images/home_icon.gif border=0 width='12' height='12'> &nbsp;회원정보&nbsp;&nbsp;</td></tr>";
			height += 20;
		}

		if (memo && id) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"note_write('"+member_url+"','"+id+"');\"><td height=20>&nbsp; <IMG src="+skin_url+"images/memo_icon.gif border=0 width='12' height='12'> &nbsp;쪽지보내기&nbsp;&nbsp;</td></tr>";
			height += 20;
		}

		if (body) {
			var layer_body = "<table border=0 width=100%><tr><td colspan=3 height=10></td></tr><tr><td width=5></td><td bgcolor=222222 style='cursor:hand'><table border=0 cellspacing=0 cellpadding=3 width=100% height=100% bgcolor=e5e5e5>"+body+"</table></td><td width=10></td></tr><tr><td colspan=3 height=10></td></tr></table>";
			obj.innerHTML = layer_body;
			obj.style.width = 150;
			obj.style.height = height;
			obj.style.visibility='visible';
		}
	}


	function rg_init_layer(layername)
	{
		document.writeln("<div id="+layername+" style='position:absolute; left:1px; top:1px; width:1px; height:1px; z-index:1; visibility: hidden' onmousedown=\"rg_layer_action('"+layername+"', 'hidden')\" onmouseout=\"rg_layer_action('"+layername+"', 'hidden')\" onmouseover=\"rg_layer_action('"+layername+"', 'visible')\">");
		document.writeln("</div>");
	}
	
	rg_init_layer('rg_layer_div');	

	 // 새 창
    function popup_window(url, winname, opt)
    {
        window.open(url, winname, opt);
    }

	 // 쿠키 입력
    function set_cookie(name, value, expirehours, domain) 
    {
        var today = new Date();
        today.setTime(today.getTime() + (60*60*1000*expirehours));
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
        if (domain) {
            document.cookie += "domain=" + domain + ";";
        }
    }

    // 쿠키 얻음
    function get_cookie(name) 
    {
        var find_sw = false;
        var start, end;
        var i = 0;

        for (i=0; i<= document.cookie.length; i++)
        {
            start = i;
            end = start + name.length;

            if(document.cookie.substring(start, end) == name) 
            {
                find_sw = true
                break
            }
        }

        if (find_sw == true) 
        {
            start = end + 1;
            end = document.cookie.indexOf(";", start);

            if(end < start)
                end = document.cookie.length;

            return document.cookie.substring(start, end);
        }
        return "";
    }

    // 쿠키 지움
    function delete_cookie(name) 
    {
        var today = new Date();

        today.setTime(today.getTime() - 1);
        var value = get_cookie(name);
        if(value != "")
            document.cookie = name + "=" + value + "; path=/; expires=" + today.toGMTString();
    }
}