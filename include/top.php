<div class="top">
        	<div class="mo_logo">
            <ul>
            <li class="mo_top_home"><a href="javascript:home();"><img src="../images/mo_home.jpg"></a></li>            
            <li class="mo_top_back"><img src="../images/mo_back.jpg" style='cursor:pointer' onclick='history.back(-1)'></li>
            </ul>
            </div>
       	  <div class="logo"><a href="javascript:home();"><img src="../images/logo.jpg"></a></div>        


            <div class="top_hsc">
            <ul>
            <li><a href="javascript:home();">Contact Us</a></li>
            <li class="sitemap_btn"><a href="javascript:sitemap();">Sitemap</a></li>
            <li><a href="javascript:home();">HOME</a></li>
            </ul>
            </div>
            <div class="menu">
            <ul class="mo_menu">
            <li>
            <script type="text/javascript">
			function selectMatch(select){
				var form = select.form;
				var value = select[select.selectedIndex].value;
				form.elements.nt_area.value = form.elements[value].value;
			}
            </script>
              <form name="form" id="form" class="mo_jump_menu">
                <select name="jumpMenu" id="jumpMenu" onChange="window.open(this.options[this.selectedIndex].value,'_self')" class="mo_jump_menu2">
                  <option value="/index.php">---MENU---</option>
                  <option value="/sub1_1.php">Company</option>
                  <option value="/sub1_1.php">-인사말</option>
                  <option value="/sub1_2.php">-약도</option>
                  <option value="/sub2_1.php" >Business</option>
                  <option value="/sub3_1.php" selected>Product</option>
                  <option value="/sub3_1.php">-제품1</option>
                  <option value="/sub3_2.php">-제품2</option>
                  <option value="/sub3_3.php">-제품3</option>
                  <option value="/main/free_form.php">Online</option>
                  <option value="/wb_board/list.php?bbs_code=qna">Customer</option>
                  <option value="/wb_board/list.php?bbs_code=qna">-문의게시판</option>
                  <option value="/wb_board/list.php?bbs_code=data">-자료실</option>
                  <option value="/main/sitemap.php">Sitemap</option>
                </select>
              </form>
            </li>
            </ul>
            
            
            <script type="text/javascript">
	var timeout         = 0;
var closetimer		= 0;
var ddmenuitem      = 0;

function ttrp_open()
{	ttrp_canceltimer();
	ttrp_close();
	ddmenuitem = $(this).find('ul').eq(0).css('display', 'block');}

function ttrp_close()
{	if(ddmenuitem) ddmenuitem.css('display', 'none');}

function ttrp_timer()
{	closetimer = window.setTimeout(ttrp_close, timeout);}

function ttrp_canceltimer()
{	if(closetimer)
	{	window.clearTimeout(closetimer);
		closetimer = null;}}

$(document).ready(function()
{	$('.ttrp > li').bind('mouseover', ttrp_open);
	$('.ttrp > li').bind('mouseout',  ttrp_timer);});

document.onclick = ttrp_close;
</script>
            <ul class="ttrp">
            <li><a href="javascript:menu1sub1();" id="asd1" onMouseOver=this.id="asd2" onMouseOut=this.id="asd1" >Company</a>
            <ul class="menu_sub">
            <li><a href="javascript:menu1sub1();">인사말</a></li>
            <li><a href="javascript:menu1sub2();">약도</a></li>
            </ul>
            </li>
            <li><a href="javascript:menu2sub1();" id="asd1" onMouseOver=this.id="asd2" onMouseOut=this.id="asd1">Business</a>
            <ul class="menu_sub3">
            <li><a href="javascript:menu2sub1();">사업내용</a></li>
            </ul>
            </li>
            <li><a href="javascript:menu3sub1();" id="asd1" onMouseOver=this.id="asd2" onMouseOut=this.id="asd1">Product</a>
            <ul class="menu_sub2">
            <li><a href="javascript:menu3sub1();">제품1</a></li>
            <li><a href="javascript:menu3sub2();">제품2</a></li>
            <li><a href="javascript:menu3sub3();">제품3</a></li>        
            </ul>
            </li>
            <li><a href="javascript:menu4sub1();" id="asd1" onMouseOver=this.id="asd2" onMouseOut=this.id="asd1">Online</a>
            <ul class="menu_sub3">
            <li><a href="javascript:menu4sub1();">온라인문의</a></li>                  
            </ul>
            </li>
            <li><a href="javascript:menu5sub1();" id="asd1" onMouseOver=this.id="asd2" onMouseOut=this.id="asd1">Customer</a>
            <ul class="menu_sub">
            <li><a href="javascript:menu5sub1();">문의게시판</a></li>
            <li><a href="javascript:menu5sub2();">자료실</a></li>                    
            </ul>
            </li>
            </ul>
            
            <ul class="ttrp1">
            <li><a href="javascript:menu1sub1();" id="asd1" onMouseOver=this.id="asd2" onMouseOut=this.id="asd1"  >Company</a></li>
            <li><a href="javascript:menu2sub1();" id="asd1" onMouseOver=this.id="asd2" onMouseOut=this.id="asd1">Business</a></li>
            <li><a href="javascript:menu3sub1();" id="asd1" onMouseOver=this.id="asd2" onMouseOut=this.id="asd1">Product</a></li>
            <li><a href="javascript:menu4sub1();" id="asd1" onMouseOver=this.id="asd2" onMouseOut=this.id="asd1">Online</a></li>
            <li><a href="javascript:menu5sub1();" id="asd1" onMouseOver=this.id="asd2" onMouseOut=this.id="asd1">Customer</a></li>
            </ul>
            
            <ul class="sub_700">
            <?
				$sub=$menu_info[$menu_num-1];
				for($i=0; $i<count($sub);$i++){
					if($sub_num==($i+1)) $selected="class='selected'"; else $selected="";
					echo "<li><a href='javascript:menu".$menu_num."sub".($i+1)."()'>".$sub[$i]."</a></li>";
				}
				?>
            </ul>
            
            </div>
        </div>