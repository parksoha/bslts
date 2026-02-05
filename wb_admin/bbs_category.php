<?

	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");
	
	$rs->clear();
	$rs->set_table($_table['bbs_category']);
	
	if($act=='ok' && $mode=='order') {
		$rs->clear();
		$rs->add_field("cat_order","$up_ord");
		$rs->add_where("bbs_db_num=$bbs_db_num");
		$rs->add_where("cat_num=$up_num");
		$rs->update();

		$rs->clear();
		$rs->add_field("cat_order","$dn_ord");
		$rs->add_where("bbs_db_num=$bbs_db_num");
		$rs->add_where("cat_num=$dn_num");
		$rs->update();
		$rs->commit();
		rg_href("bbs_category.php?bbs_db_num=$bbs_db_num");
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST') {
		switch($mode) {
			case 'edit' : 
				while(list($key,$val)=each($cat_names)) {
					$rs->clear();
					$rs->add_field("cat_name","$val");
					$rs->add_where("bbs_db_num=$bbs_db_num");
					$rs->add_where("cat_num=$key");
					$rs->update();
				}
				break;
			case 'move' :
				if($tar_cat_sel_num && $src_cat_sel_num) {
					$rs->clear();
					$rs->set_table($_table['bbs_body']);
					$rs->add_field("cat_num","$tar_cat_sel_num");
					$rs->add_where("bbs_db_num=$bbs_db_num");
					$rs->add_where("cat_num=$src_cat_sel_num");
					$rs->update();
				}
				break;
			case 'delete' :
				if($tar_cat_sel_num && $src_cat_sel_num) {
					$rs->clear();
					$rs->set_table($_table['bbs_body']);
					$rs->add_field("cat_num","$tar_cat_sel_num");
					$rs->add_where("bbs_db_num=$bbs_db_num");
					$rs->add_where("cat_num=$src_cat_sel_num");
					$rs->update();

					$rs->clear();
					$rs->set_table($_table['bbs_category']);
					$rs->add_field("cat_order");
					$rs->add_where("bbs_db_num=$bbs_db_num");
					$rs->add_where("cat_num=$src_cat_sel_num");
					$rs->fetch("cat_order");

					$rs->db->query("
								UPDATE {$_table['bbs_category']}
								SET cat_order = cat_order-1
								WHERE bbs_db_num=$bbs_db_num
								  AND cat_order>$cat_order
					");
					
					$rs->delete();
				}
				break;
			case 'reg' :
				if($new_cat_name) {
					$rs->clear();
					$rs->add_field("max(cat_order) as cat_order");
					$rs->add_where("bbs_db_num=$bbs_db_num");
					$rs->fetch("cat_order");
					$cat_order++;

					$rs->clear();
					$rs->add_field("bbs_db_num","$bbs_db_num");
					$rs->add_field("cat_order","$cat_order");
					$rs->add_field("cat_name","$new_cat_name");
					$rs->add_field("cat_count","0");
					$rs->insert();
				}		
				break;
		}
		$rs->commit();
		rg_href("bbs_category.php?bbs_db_num=$bbs_db_num");
	}

	$rs->clear();
	$rs->add_where("bbs_db_num=$bbs_db_num");
	$rs->add_order("cat_order");
	unset($cat_list);
	while($R=$rs->fetch()) {
		$cat_list[]=$R;
	}
?>
<? include("_header.php"); ?>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">카테고리 관리</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form action="?" method="post" enctype="multipart/form-data" name="cat_edit" id="cat_edit">
<input name="mode" type="hidden" value="">
<input name="bbs_db_num" type="hidden" value="<?=$bbs_db_num?>">
  <tr> 
    <td align="center">
        <table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr>
            <td width="30" align="center" bgcolor="#F0F0F4" >선택</td>
            <td width="30" align="center" bgcolor="#F0F0F4">No</td>
            <td align="center" bgcolor="#F0F0F4">분류명</td>
            <td width="40" align="center" bgcolor="#F0F0F4">△▽</td>
          </tr>
          <?
	for($i=0;$i<count($cat_list);$i++) {
		$no = $i + 1;
		$next = $i + 1;
		$prev = $i - 1;
		extract($cat_list[$i]);
		if($i==0) {
			$up_link = "△";
		} else {
			$up_link = "<a href='?bbs_db_num=$bbs_db_num&act=ok&mode=order&up_num={$cat_list[$prev][cat_num]}&up_ord={$cat_order}&dn_num={$cat_num}&dn_ord={$cat_list[$prev][cat_order]}' title='순서를 한단계위로 올립니다.'>△</a>";
		}
		if($i==(count($cat_list)-1)) {
			$dn_link = "▽";
		} else {
			$dn_link = "<a href='?bbs_db_num=$bbs_db_num&act=ok&mode=order&up_num={$cat_list[$next][cat_num]}&up_ord={$cat_order}&dn_num={$cat_num}&dn_ord={$cat_list[$next][cat_order]}' title='순서를 한단계아래로 내립니다.'>▽</a>";
		}
?>
          <tr>
            <td align="center"><input type="radio" name="src_cat_sel_num" value="<?=$cat_num?>"></td>
            <td align="center">
              <?=$no?>
            </td>
            <td> 
              <input name="cat_names[<?=$cat_num?>]" type="text" id="cat_names[<?=$cat_num?>]" value="<?=$cat_name?>" style="width:100%" class="input"> </td>
            <td height="22" align="center"><?=$up_link?><?=$dn_link?></td>
          </tr>
          <?
	}
?>
        </table>
        <table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td height="22" align="center"><input type="submit" value="수 정 사 항 적 용" style="width:100%" onClick="cat_edit.mode.value='edit'" class="button"></td>
          </tr>
          <tr> 
            <td height="22"> &nbsp;&nbsp;선택한 분류의 글을 
              <select name="tar_cat_sel_num" id="tar_cat_sel_num">
                <?=rg_html_option($cat_list,'','cat_num','cat_name')?>
              </select>
              으로 </td>
          </tr>
          <tr>
            <td height="22" align="right"><input type="submit" onClick="if(!confirm('확실합니까')) return false;cat_edit.mode.value='move'" value=" 변 경 " class="button">
              후 분류를 
              <input type="submit" value=" 삭 제 " onClick="if(!confirm('확실합니까')) return false;cat_edit.mode.value='delete'" class="button">
              &nbsp;&nbsp;</td>
          </tr>
          <tr> 
            <td height="22">&nbsp;&nbsp;분류명 
              <input name="new_cat_name" type="text" id="new_cat_name" class="input">
              (을)를 
              <input type="submit" value=" 추 가 " onClick="cat_edit.mode.value='reg'" class="button"></td>
          </tr>
        </table>
      </td>
  </tr>
  </form>
</table>


<br>
<? include("_footer.php"); ?>