<?
	if(realpath($_SERVER['SCRIPT_FILENAME']) == realpath(__FILE__)) exit;
?>

<script type="text/javascript">
<!--
var res_w = screen.width;
var res_h = screen.height;
	
if( typeof("parent.document") != "unknown" ){
	eval("try{ pre_url = parent.document.URL ;}catch(_e){ pre_url='';}");
}

if( document.referrer == pre_url ){ 
	eval("try{ ref = parent.document.referrer ;}catch(_e){ ref = '';}");
}
else{
	ref = document.referrer ; 
}
ref=escape(ref)



var filter = "win16|win32|win64|mac";
if( navigator.platform  ){
	if( filter.indexOf(navigator.platform.toLowerCase())<0 ){
	
		//alert("모바일 기기에서 접속");
		document.write('<img src="<?=$site_path?>wb_counter/m_check.php?referrer='+ref+'&amp;res_w='+res_w+'&amp;res_h='+res_h+'" width="0" height="0" style="display:none;">');
	}else{
		//alert("PC에서 접속");
		document.write('<img src="<?=$site_path?>wb_counter/check.php?referrer='+ref+'&amp;res_w='+res_w+'&amp;res_h='+res_h+'" width="0" height="0" style="display:none;">');
	}
}

//-->
</script>