<?

	include_once("../wb_include/lib.php");
	require_once("admin_chk.php");
	
	function all_chk_form($val) {
		return '<input name="all_chk[]" type="checkbox" id="all_chk[]" value="'.$val.'" style="border:#FFAAAA solid;">';
	}
	function group_chk_form($val) {
		return '<input name="group_chk[]" type="checkbox" id="group_chk[]" value="'.$val.'" style="border:#AAAAFF solid;">';
	}
	function chk_form($val) {
		$_result=all_chk_form($val);
		$_result.=group_chk_form($val);
		return $_result;
	}
	
	
	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_where("bbs_num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // 정보가 올바르지 않다면
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		// 그룹 변경모드인경우
		if($gr_change=='1' && $gr_num!='') {
			$rs->add_field("gr_num","$gr_num");
			$rs->update();
			rg_href("?$_get_param[3]&mode=$mode&num=$num");
		}
		$data=$rs->fetch();
	} else {
		if($gr_change=='1' && $gr_num!='') {
			$data['gr_num']=$gr_num;
		} else {
			$rs->clear();
			$rs->set_table($_table['group']);
			$rs->add_field('gr_num');
			$rs->set_limit('1');
			$rs->fetch('tmp');
			$data['gr_num']=$tmp;
		}
	}

	$rs->clear();
	$rs->set_table($_table['group']);
	$rs->add_where("gr_num={$data['gr_num']}");
	$rs->select();
	if($rs->num_rows()==1) { // 해당 그룹이 있다면
		$group_info=$rs->fetch();
		if($group_info['gr_level_type']==0)
			$auth_level=$_level_info;
		else
			$auth_level=unserialize($group_info['gr_level_info']);
	}
	if(!$auth_level[0]) $auth_level[0]='비회원';
	if(!$auth_level[100]) $auth_level[100]='사용안함';
	foreach($auth_level as $k => $v) {
		$auth_level[$k]="($k) $v";
	}
	
	if($mode=='delete') {	// 삭제
		// 연결된 게시판이 있는지 확인
		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_where("bbs_num<>$num");
		$rs->add_where("bbs_db_num=$num");
		$rs->select();
		if($rs->num_rows()==1)
			rg_href('','삭제 불가:\n연결된 게시판이 있습니다.\n연결된 게시판 부터 삭제/변경 해주세요.','back');
		
		// 코멘트 삭제
		$rs->clear();
		$rs->set_table($_table['bbs_comment']);
		$rs->add_where("bbs_db_num=$num");
		$rs->delete();
		
		// 첨부파일 삭제
		$rs->clear();
		$rs->set_table($_table['bbs_body']);
		$rs->add_where("bbs_db_num=$num");
		while($data=$rs->fetch()) {
			$data['bd_files']=unserialize($data['bd_files']);
			upload_file_delete($_path['bbs_data'],$data['bd_files']);
		}
		
		// 글삭제
		$rs->delete();
		
		// 카테고리 삭제
		$rs->clear();
		$rs->set_table($_table['bbs_category']);
		$rs->add_where("bbs_db_num=$num");
		$rs->delete();
		
		// 게시판 설정삭제
		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_where("bbs_num=$num");
		$rs->delete();

		$rs->commit();
		rg_href("bbs_list.php?$_get_param[3]");
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST' && $gr_change!='1') {
		$bbs_code=strtolower(trim($bbs_code));
		$bbs_db=strtolower(trim($bbs_db));
		
		if($mode=='modify') {
			$bbs_code=$data['bbs_code'];
		} else {
			if($bbs_code=='')
				rg_href('','게시판코드를 입력해주세요.','back');
		}
		
		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_where("bbs_code='".$dbcon->escape_string($bbs_code)."'");
		if($mode=='modify') $rs->add_where("bbs_num<>$num");
		$rs->select();
		if($rs->num_rows()>0) {
			rg_href('','이미 사용중인 아이디 입니다.','back');
		}
		
		if($bbs_db=='')
			$bbs_db=$bbs_code;
		else if($bbs_db!=$bbs_code) {
			$rs->clear();
			$rs->set_table($_table['bbs_cfg']);
			$rs->add_where("bbs_code='".$dbcon->escape_string($bbs_db)."'");
			if($mode=='modify') $rs->add_where("bbs_num<>$num");
			$rs->select();
			if($rs->num_rows()==0) {
				rg_href('','디비정보를 찾을수 없습니다.','back');
			}
		}

		$list_cfg=serialize($list_cfg);
		$write_cfg=serialize($write_cfg);
		$reply_cfg=serialize($reply_cfg);
		$view_cfg=serialize($view_cfg);

		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_field("bbs_db","$bbs_db");
		$rs->add_field("bbs_name","$bbs_name");
		$rs->add_field("bbs_skin","$bbs_skin");
		$rs->add_field("use_category","$use_category");
		$rs->add_field("default_content","$default_content");
		$rs->add_field("header_file","$header_file");
		$rs->add_field("header_tag","$header_tag");
		$rs->add_field("footer_tag","$footer_tag");
		$rs->add_field("footer_file","$footer_file");
		$rs->add_field("auth_list","$auth_list");
		$rs->add_field("auth_view","$auth_view");
		$rs->add_field("auth_write","$auth_write");
		$rs->add_field("auth_reply","$auth_reply");
		$rs->add_field("auth_modify","$auth_modify");
		$rs->add_field("auth_delete","$auth_delete");
		$rs->add_field("auth_comment","$auth_comment");
		$rs->add_field("auth_secret","$auth_secret");
		$rs->add_field("list_cfg","$list_cfg");
		$rs->add_field("write_cfg","$write_cfg");
		$rs->add_field("reply_cfg","$reply_cfg");
		$rs->add_field("view_cfg","$view_cfg");
		$rs->add_field("mailing_mb_id","$mailing_mb_id");
		$rs->add_field("admin_mb_id","$admin_mb_id");
		$rs->add_field("point_write","$point_write");
		$rs->add_field("point_reply","$point_reply");
		$rs->add_field("point_comment","$point_comment");
		$rs->add_field("admin_memo","$admin_memo");
		$rs->add_field("bbs_ext1","$bbs_ext1");
		$rs->add_field("bbs_ext2","$bbs_ext2");
		$rs->add_field("bbs_ext3","$bbs_ext3");
		$rs->add_field("bbs_ext4","$bbs_ext4");
		$rs->add_field("bbs_ext5","$bbs_ext5");
		$rs->add_field("deny_word","$deny_word");
		$rs->add_field("deny_html","$deny_html");
		$rs->add_field("deny_ip","$deny_ip");
		$rs->add_field("bbsnpage","$bbsnpage");
		$rs->add_field("pcmobile","$pcmobile");
		
		if($mode=='modify') {
			$rs->add_where("bbs_num=$num");
			$rs->update();
		} else {
			$rs->add_field("bbs_code","$bbs_code");
			$rs->add_field("gr_num","$gr_num");
			$rs->add_field("reg_date",time());
			$rs->insert();
			$num=$rs->get_insert_id();		
		}
		
		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_where("bbs_code='".$dbcon->escape_string($bbs_db)."'");
		$rs->fetch("bbs_db_num");
		
		$rs->clear();
		$rs->set_table($_table['bbs_cfg']);
		$rs->add_field("bbs_db_num","$bbs_db_num");
		$rs->add_where("bbs_num=$num");
		$rs->update();
		
		if($mode!='modify') {
			// 등록이라면 기본카테고리 입력
			if(RG_DBTYPE==RG_DB_CUBRID) {
				include_once($_path['inc']."cubrid_schema.inc.php");
			} else if(RG_DBTYPE==RG_DB_MYSQL) {
				include_once($_path['inc']."mysql_schema.inc.php");
			} else if(RG_DBTYPE==RG_DB_ORACLE) {
				include_once($_path['inc']."oracle_schema.inc.php");
			}
			$rs->clear();
			$rs->set_table($_table['bbs_category']);
			foreach($db_bbs_catrgory_data as $v) {
				$rs->clear_field();
				$rs->add_field("bbs_db_num","$bbs_db_num");
				$rs->add_field("cat_order","$v[0]");
				$rs->add_field("cat_name","$v[1]");
				$rs->add_field("cat_count","0");
				$rs->insert(true);
			}
		}
		$rs->commit();

		if(is_array($all_chk) && is_array($group_chk)) {
			$group_chk=array_diff($group_chk,$all_chk);
		}
		
		$rs2 = new recordset($dbcon);
		if(is_array($all_chk)) {
			$rs->clear();
			$rs->set_table($_table['bbs_cfg']);
			$fields=$rs->list_fields();
			
			$rs2->set_table($_table['bbs_cfg']);

			while($R=$rs->fetch()) {
				$rs2->clear();
				$rs2->add_where("bbs_num=$R[bbs_num]");
				
				$cfg=array();
				$cfg['list_cfg']=unserialize($R['list_cfg']);
				$cfg['write_cfg']=unserialize($R['write_cfg']);
				$cfg['reply_cfg']=unserialize($R['reply_cfg']);
				$cfg['view_cfg']=unserialize($R['view_cfg']);
				
				$update_cfg_fields=array();
				
				foreach($all_chk as $item) {
					list($item1,$item2)=explode(':',$item);
					if(!in_array($item1,$fields['Field']))
						rg_href('','정상적인 접근이 아닙니다.','back');
				
					if($item2 != '') {
						$cfg[$item1][$item2]=$_POST[$item1][$item2];
						$update_cfg_fields[]=$item1;
					} else if($item1 != '') {
						$rs2->add_field($item1,$_POST[$item1]);
					}
				}
				$update_cfg_fields=array_unique($update_cfg_fields);
				foreach($update_cfg_fields as $field) {
					$cfg[$field]=serialize($cfg[$field]);
					$rs2->add_field($field,$cfg[$field]);
				}
				$rs2->update();
				unset($cfg);
			}
		}
		
		if(is_array($group_chk) && count($group_chk) > 0) {
			$rs->clear();
			$rs->set_table($_table['bbs_cfg']);
			$fields=$rs->list_fields();
			$rs->add_where("gr_num={$data['gr_num']}");

			$rs2->set_table($_table['bbs_cfg']);

			while($R=$rs->fetch()) {
				$rs2->clear();
				$rs2->add_where("bbs_num=$R[bbs_num]");
				
				$cfg=array();
				$cfg['list_cfg']=unserialize($R['list_cfg']);
				$cfg['write_cfg']=unserialize($R['write_cfg']);
				$cfg['reply_cfg']=unserialize($R['reply_cfg']);
				$cfg['view_cfg']=unserialize($R['view_cfg']);
				
				$update_cfg_fields=array();
				
				foreach($group_chk as $item) {
					list($item1,$item2)=explode(':',$item);
					if(!in_array($item1,$fields['Field']))
						rg_href('','정상적인 접근이 아닙니다.','back');
				
					if($item2 != '') {
						$cfg[$item1][$item2]=$_POST[$item1][$item2];
						$update_cfg_fields[]=$item1;
					} else if($item1 != '') {
						$rs2->add_field($item1,$_POST[$item1]);
					}
				}
				$update_cfg_fields=array_unique($update_cfg_fields);
				foreach($update_cfg_fields as $field) {
					$cfg[$field]=serialize($cfg[$field]);
					$rs2->add_field($field,$cfg[$field]);
				}
				$rs2->update();
				unset($cfg);
			}
		}
		$rs->commit();
		
		rg_href("bbs_list.php?$_get_param[3]");
	}
	if($mode=='modify') {
		$sub_cfg_toggle='▲';
		$sub_cfg_dispay='';
//		$sub_cfg_toggle='▼';
//		$sub_cfg_dispay='display:none;';
		$list_cfg=unserialize($data['list_cfg']);
		$write_cfg=unserialize($data['write_cfg']);
		$reply_cfg=unserialize($data['reply_cfg']);
		$view_cfg=unserialize($data['view_cfg']);
	} else {
		$sub_cfg_toggle='▲';
		$sub_cfg_dispay='';
		$data['use_category']='0';

		$data['pcmobile']='0';

		if($bbsnpage == "1"){
			//권한설정
			$data['bbsnpage']='1';
			$data['bbs_skin']='page';
			$data['auth_list']='90';
			$data['auth_secret']='100';
			$data['auth_modify']='90';
			$data['auth_write']='90';
			$data['auth_comment']='100';
			$data['auth_delete']='90';

			//글쓰기
			$write_cfg['use_notice']='100';
			$write_cfg['use_secret']='100';
			$write_cfg['use_html']='90';
			$write_cfg['use_home']='90';
			$write_cfg['use_reply_mail']='100';


			//글보기
			$view_cfg['view_comment']='100';
			$view_cfg['use_download']='100';
			$view_cfg['view_list']='100';
			$view_cfg['btn_list']='90';
			$view_cfg['btn_modify']='90';
			$view_cfg['btn_reply']='100';
			$view_cfg['view_image']='100';
			$view_cfg['view_signature']='100';
			$view_cfg['btn_prev_next']='100';
			$view_cfg['btn_del']='90';


			

			

			
			
		}else{
			//권한설정
			$data['bbsnpage']='0';
			$data['bbs_skin']='';
			$data['auth_list']='0';
			$data['auth_secret']='50';
			$data['auth_modify']='0';
			$data['auth_write']='0';
			$data['auth_comment']='0';
			$data['auth_delete']='0';

			//글쓰기
			$write_cfg['use_notice']='50';
			$write_cfg['use_secret']='0';
			$write_cfg['use_html']='0';
			$write_cfg['use_home']='0';
			$write_cfg['use_reply_mail']='0';

			//글보기
			$view_cfg['view_comment']='0';
			$view_cfg['use_download']='0';
			$view_cfg['view_list']='0';
			$view_cfg['btn_list']='0';
			$view_cfg['btn_modify']='0';
			$view_cfg['btn_reply']='0';
			$view_cfg['view_image']='0';
			$view_cfg['view_signature']='1';
			$view_cfg['btn_prev_next']='0';
			$view_cfg['btn_del']='0';
		}

		

		
		$data['auth_reply']='100';
		$list_cfg['new_time']='24';
		$list_cfg['date_format']='%Y-%m-%d';
		$list_cfg['list_count']='20';
		$list_cfg['page_count']='10';
		$list_cfg['subject_limit']='60';
		$list_cfg['use_mb_icon']='1';
		
		
		
		
		
		$write_cfg['use_upload']='100';
		$write_cfg['use_link']='100';
		$write_cfg['upload_count']='2';
		$write_cfg['link_count']='2';
		$write_cfg['write_deny_time']='5';
		$write_cfg['reply_delete']='4';
		$write_cfg['writer_modify']='90';
		$write_cfg['writer_name']='3';
		$write_cfg['spam_chk']='0';
		
		$reply_cfg['subject_prefix']='[답변]';
		$reply_cfg['quote_use']='1';
		$reply_cfg['quote_subject']='{NAME} 님의 글입니다.';
		$reply_cfg['quote_mark']='>';
		
		$view_cfg['date_format']='%Y-%m-%d %H:%M:%S';
		
		
		
		
		
		
		
		
		
		
		$view_cfg['c_date_format']='%Y-%m-%d %H:%M:%S';
		$view_cfg['vote_yes']='100';
		$view_cfg['vote_no']='100';

		$data['deny_word']='8억,새끼,개새끼,소새끼,병신,지랄,씨팔,십팔,니기미,찌랄,지랄,쌍년,쌍놈,빙신,좆까,니기미,좆같은게,잡놈,벼엉신,바보새끼,씹새끼,씨발,씨팔,시벌,씨벌,떠그랄,좆밥,추천인,추천id,추천아이디,추천id,추천아이디,추/천/인,쉐이,등신,싸가지,미친놈,미친넘,찌랄,죽습니다,님아,님들아,씨밸넘';
		$data['deny_html']='script,xml';

		$data['point_write']='1';
		$data['point_reply']='1';
		$data['point_comment']='1';
	}
	$MENU_L='m4';
?>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="1" cellpadding="6" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr>
    <td bgcolor="#F7F7F7">게시판/페이지정보 등록/수정</td>
  </tr>
</table>
<br>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
  <tr> 
    <td width="40" align="center" bgcolor="#EDEDED"><input type="checkbox" style="border:#FFAAAA solid;" onclick="set_checkbox(bbs_cfg_form,'all_chk[]',this.checked)"></td>
    <td height="30"bgcolor="f7f7f7">&nbsp;<- 체크가 되어 있을경우에는 전체에 적용 됩니다.</td>
    <td width="160" height="30" align="center" bgcolor="f7f7f7">&nbsp;</td>
  </tr>
  <tr> 
    <td width="40" align="center" bgcolor="#EDEDED"><input type="checkbox" style="border:#AAAAFF solid;" onclick="set_checkbox(bbs_cfg_form,'group_chk[]',this.checked)"></td>
    <td height="30" bgcolor="f7f7f7">&nbsp;<- 체크가 되어 있을경우에는 동일그룹에 적용 됩니다.</td>
    <td width="160" height="30" align="center" bgcolor="f7f7f7">&nbsp;</td>
  </tr>
</table>
<form name="bbs_cfg_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="gr_change" value="" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title">게시판기본정보</td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" style="table-layout:fixed;">

	<tr>
	  <td width="50" align="center">&nbsp;</td>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>분류</strong></td>
		<td>
		<label style="cursor:pointer;"><input type="radio" name="bbsnpage" value="0" <?if($data['bbsnpage'] == '0'){ echo "checked";}?> onclick="location.href='/wb_admin/bbs_edit.php?&page=<?=$page?>'">게시판</label>
		&nbsp;&nbsp;
		<label style="cursor:pointer;"><input type="radio" name="bbsnpage" value="1" <?if($data['bbsnpage'] == '1'){ echo "checked";}?> onclick="location.href='/wb_admin/bbs_edit.php?&page=<?=$page?>&bbsnpage=1'">페이지</label>		
&nbsp;</td>



	
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>PC/모바일</strong></td>
		<td>
		<label style="cursor:pointer;"><input type="radio" name="pcmobile" value="0" <?if($data['pcmobile'] == '0'){ echo "checked";}?>>PC</label>
		&nbsp;&nbsp;
		<label style="cursor:pointer;"><input type="radio" name="pcmobile" value="1" <?if($data['pcmobile'] == '1'){ echo "checked";}?>>모바일</label>		
&nbsp;</td>
	</tr>

	<tr>
	  <td width="50" align="center">&nbsp;</td>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>게시판코드</strong></td>
		<td colspan="3"><input name="bbs_code" type="text" value="<?=$data['bbs_code']?>" class="input">
&nbsp;</td>
	</tr>
	<tr>
	  <td align="center">&nbsp;</td>
		<td align="center" bgcolor="#F0F0F4"><strong>디비명</strong></td>
		<td colspan="3"><input name="bbs_db" type="text" value="<?=$data['bbs_db']?>" class="input"> 
		(비워둘 경우 게시판코드로 설정) </td>
	</tr>
	<tr style="display:none;">
	  <td align="center">&nbsp;</td>
		<td align="center" bgcolor="#F0F0F4"><strong>그룹</strong></td>
		<td><select name="gr_num">
<?
	$rs->clear();
	$rs->set_table($_table['group']);
?>
<?=rg_sql_html_option($rs->select(),$data['gr_num'],'gr_num','gr_name')?>
</select>
		  <input type="button" class="button" onClick="bbs_cfg_form.gr_change.value='1';bbs_cfg_form.submit();" value="변경"> 
		  그룹 변경시 수정된 내용은 취소됩니다.</td>
	</tr>
	<tr>
	  <td align="center">&nbsp;</td>
		<td align="center" bgcolor="#F0F0F4"><strong>이름</strong></td>
		<td colspan="3"><input name="bbs_name" type="text" value="<?=$data['bbs_name']?>" class="input"></td>
	</tr>
	<tr>
	  <td align="center"><?=chk_form('bbs_skin')?></td>
		<td align="center" bgcolor="#F0F0F4"><strong>스킨</strong></td>
		<td colspan="3"><select name="bbs_skin" id="bbs_skin">
<?=rg_html_option(rg_get_filelist($_path['bbs_skin'],'d'),$data['bbs_skin'],'','',true)?>
        </select>		</td>
	</tr>
	<tr>
	  <td align="center"><?=chk_form('use_category')?></td>
		<td align="center" bgcolor="#F0F0F4"><strong>카테고리</strong></td>
		<td colspan="3"><?=rg_html_radio("use_category",array(0=>"사용안함","사용함"),$data['use_category'],NULL,NULL,'','','','&nbsp;&nbsp;')?></td>
	</tr>
	<tr>
	  <td align="center"><?=chk_form('default_content')?></td>
    <td align="center" bgcolor="#F0F0F4"><strong>기본글</strong></td>
	  <td colspan="3"><textarea name="default_content" cols="60" rows="3"><?=$data['default_content']?></textarea></td>
	  </tr>
	<tr>
	  <td align="center">&nbsp;</td>
    <td align="center" bgcolor="#F0F0F4"><strong>관리자메모</strong></td>
	  <td colspan="3"><textarea name="admin_memo" cols="60" rows="3"><?=$data['admin_memo']?></textarea></td>
	  </tr>
</table>	
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_design,span_design,'▲','▼')" style="cursor:hand">디자인관련 <span id="span_design"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id='tbl_design' style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="50" align="center"><?=chk_form('header_file')?></td>
    <td width="120" align="center" bgcolor="#F0F0F4"><strong>헤더파일</strong></td>
	  <td><input name="header_file" type="text" class="input" value="<?=$data['header_file']?>" size="60"></td>
	  </tr>
	<tr>
	  <td align="center"><?=chk_form('header_tag')?></td>
		<td align="center" bgcolor="#F0F0F4"><strong>헤더태그</strong></td>
		<td><textarea name="header_tag" cols="60" rows="10" style="width:100%"><?=$data['header_tag']?></textarea></td>
	</tr>
	<tr>
	  <td align="center"><?=chk_form('footer_tag')?></td>
		<td align="center" bgcolor="#F0F0F4"><strong>풋터태그</strong></td>
		<td><textarea name="footer_tag" cols="60" rows="10" style="width:100%"><?=$data['footer_tag']?></textarea></td>
	</tr>
	<tr>
	  <td align="center"><?=chk_form('footer_file')?></td>
    <td align="center" bgcolor="#F0F0F4"><strong>풋터파일</strong></td>
	  <td><input name="footer_file" type="text" class="input" value="<?=$data['footer_file']?>" size="60"></td>
	  </tr>
</table>	
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_auth,span_auth,'▲','▼')" style="cursor:hand">권한설정 <span id="span_auth"><?=$sub_cfg_toggle?></span> (해당레벨이상 이용가능)</td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id='tbl_auth' style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="50" align="center"><?=chk_form('auth_list')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>글목록보기</strong></td>
	  <td><select name="auth_list" class="input" id="auth_list">
      <?=rg_html_option($auth_level,$data['auth_list'])?>
    </select></td>
	  <td width="50" align="center"><?=chk_form('auth_write')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>글쓰기</strong></td>
	  <td><select name="auth_write" class="input" id="auth_write">
      <?=rg_html_option($auth_level,$data['auth_write'])?>
    </select></td>
	  </tr>
	<tr>
	  <td align="center"><?=chk_form('auth_view')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>글보기</strong></td>
	  <td><select name="auth_view" class="input" id="auth_view">
      <?=rg_html_option($auth_level,$data['auth_view'])?>
    </select></td>
	  <td align="center"><?=chk_form('auth_reply')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>답변글</strong></td>
	  <td><select name="auth_reply" class="input" id="auth_reply">
      <?=rg_html_option($auth_level,$data['auth_reply'])?>
    </select></td>
	  </tr>
	<tr>
	  <td align="center"><?=chk_form('auth_secret')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>비밀글 접근 </strong></td>
	  <td><select name="auth_secret" class="input" id="auth_secret">
      <?=rg_html_option($auth_level,$data['auth_secret'])?>
    </select></td>
	  <td align="center"><?=chk_form('auth_comment')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>코멘트</strong></td>
	  <td><select name="auth_comment" class="input" id="auth_comment">
      <?=rg_html_option($auth_level,$data['auth_comment'])?>
    </select></td>
	  </tr>
	<tr>
	  <td align="center"><?=chk_form('auth_modify')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>글수정</strong></td>
	  <td><select name="auth_modify" class="input" id="auth_modify">
        <?=rg_html_option($auth_level,$data['auth_modify'])?>
    </select><br>
		해당레벨미만 수정불가			</td>
	  <td align="center"><?=chk_form('auth_delete')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>글삭제</strong></td>
	  <td><select name="auth_delete" class="input" id="auth_delete">
        <?=rg_html_option($auth_level,$data['auth_delete'])?>
    </select><br>
		해당레벨미만 삭제불가			</td>
	</tr>
</table>	
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_list_cfg,span_list_cfg,'▲','▼')" style="cursor:hand">글목록 <span id="span_list_cfg"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_list_cfg" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="50" align="center"><?=chk_form('list_cfg:list_count')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>목록글수</strong></td>
	  <td><input name="list_cfg[list_count]" type="text" class="input" value="<?=$list_cfg['list_count']?>" size="4" dir="rtl"></td>
	  <td width="50" align="center"><?=chk_form('list_cfg:new_time')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>new 아이콘시간</strong></td>
	  <td><input name="list_cfg[new_time]" type="text" class="input" value="<?=$list_cfg['new_time']?>" size="4" dir="rtl">시간</td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('list_cfg:subject_limit')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>제목글자수</strong></td>
	  <td><input name="list_cfg[subject_limit]" type="text" class="input" value="<?=$list_cfg['subject_limit']?>" size="4" dir="rtl"></td>
	  <td width="40" align="center"><?=chk_form('list_cfg:page_count')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>페이지이동</strong></td>
	  <td><input name="list_cfg[page_count]" type="text" class="input" value="<?=$list_cfg['page_count']?>" size="4" dir="rtl"></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('list_cfg:date_format')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>날짜형식</strong></td>
	  <td><input name="list_cfg[date_format]" type="text" class="input" value="<?=$list_cfg['date_format']?>" size="20"></td>
	  <td width="40" align="center"><?=chk_form('list_cfg:use_mb_icon')?></td>
	  <td align="center" bgcolor="#F0F0F4"><b>회원아이콘표시</b></td>
	  <td><select name="list_cfg[use_mb_icon]" class="input" id="list_cfg[use_mb_icon]">
      <?=rg_html_option($auth_level,$list_cfg['use_mb_icon'])?>
    </select></td>
	</tr>
</table>	
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_write_cfg,span_write_cfg,'▲','▼')" style="cursor:hand">글쓰기 <span id="span_write_cfg"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_write_cfg" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="50" align="center"><?=chk_form('write_cfg:use_notice')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>공지사항</strong></td>
	  <td><select name="write_cfg[use_notice]" class="input" id="use_notice">
        <?=rg_html_option($auth_level,$write_cfg['use_notice'])?>
      </select></td>
	  <td width="50" align="center"><?=chk_form('write_cfg:use_html')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>html 사용</strong></td>
	  <td><select name="write_cfg[use_html]" class="input" id="use_html">
        <?=rg_html_option($auth_level,$write_cfg['use_html'])?>
      </select></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('write_cfg:use_secret')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>비밀글</strong></td>
	  <td><select name="write_cfg[use_secret]" class="input" id="use_secret">
        <?=rg_html_option($auth_level,$write_cfg['use_secret'])?>
      </select></td>
	  <td width="40" align="center"><?=chk_form('write_cfg:use_home')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>홈페이지링크</strong></td>
	  <td><select name="write_cfg[use_home]" class="input" id="use_home">
        <?=rg_html_option($auth_level,$write_cfg['use_home'])?>
      </select></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('write_cfg:use_link')?></td>
    <td align="center" bgcolor="#F0F0F4"><strong>링크</strong></td>
	  <td><select name="write_cfg[use_link]" class="input" id="use_link">
        <?=rg_html_option($auth_level,$write_cfg['use_link'])?>
      </select></td>
	  <td width="40" align="center"><?=chk_form('write_cfg:link_count')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>링크갯수</strong></td>
	  <td><input name="write_cfg[link_count]" type="text" class="input" value="<?=$write_cfg['link_count']?>" size="4" dir="rtl"></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('write_cfg:use_upload')?></td>
    <td align="center" bgcolor="#F0F0F4"><strong>업로드</strong></td>
	  <td><select name="write_cfg[use_upload]" class="input" id="use_upload">
        <?=rg_html_option($auth_level,$write_cfg['use_upload'])?>
      </select></td>
	  <td width="40" align="center"><?=chk_form('write_cfg:upload_count')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>업로드수</strong></td>
	  <td><input name="write_cfg[upload_count]" type="text" class="input" value="<?=$write_cfg['upload_count']?>" size="4" dir="rtl"></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('write_cfg:writer_name')?></td>
	  <td align="center" bgcolor="#F0F0F4"><b>작성자표시</b></td>
	  <td><select name="write_cfg[writer_name]" class="input" id="writer_name">
      <?=rg_html_option(array(1=>'이름','아이디','닉네임'),$write_cfg['writer_name'])?>
    </select></td>
	  <td width="40" align="center"><?=chk_form('write_cfg:writer_modify')?></td>
	  <td align="center" bgcolor="#F0F0F4"><b>작성자명변경</b></td>
	  <td><select name="write_cfg[writer_modify]" class="input" id="writer_modify">
      <?=rg_html_option($auth_level,$write_cfg['writer_modify'])?>
    </select>
	    해당레벨이상 변경가능 </td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('write_cfg:spam_chk')?></td>
	  <td align="center" bgcolor="#F0F0F4"><b>광고글방지</b></td>
	  <td><select name="write_cfg[spam_chk]" class="input" id="spam_chk">
      <?=rg_html_option($auth_level,$write_cfg['spam_chk'])?>
    </select>
	  해당레벨미만</td>
	  <td width="40" align="center"></td>
	  <td align="center" bgcolor="#F0F0F4">&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('write_cfg:write_deny_time')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>도배기준시간</strong></td>
	  <td><input name="write_cfg[write_deny_time]" type="text" class="input" value="<?=$write_cfg['write_deny_time']?>" size="4" dir="rtl">
	    초 </td>
	  <td width="40" align="center"><?=chk_form('write_cfg:use_reply_mail')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>답변메일수신</strong></td>
	  <td><select name="write_cfg[use_reply_mail]" class="input" id="reply_mail">
        <?=rg_html_option($auth_level,$write_cfg['use_reply_mail'])?>
    </select></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('write_cfg:reply_delete')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>관련글 있을경우 </strong></td>
	  <td colspan="4"><?=rg_html_radio("write_cfg[reply_delete]",array(0=>'제한없음', '수정/삭제불가', '수정불가', '삭제불가', '삭제표시만'),$write_cfg['reply_delete'],NULL,NULL,'','','','&nbsp;&nbsp;')?></td>
	  </tr>
</table>	
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_reply_cfg,span_reply_cfg,'▲','▼')" style="cursor:hand">답변글 <span id="span_reply_cfg"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_reply_cfg" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="50" align="center"><?=chk_form('reply_cfg:subject_prefix')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>제목접두문자</strong></td>
	  <td><input name="reply_cfg[subject_prefix]" type="text" class="input" value="<?=$reply_cfg['subject_prefix']?>" size="20">
	     제목앞부분에 붙는 문자 </td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('reply_cfg:quote_use')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>원본글인용여부</strong></td>
	  <td><?=rg_html_radio("reply_cfg[quote_use]",array(0=>"사용안함","사용함"),$reply_cfg['quote_use'],NULL,NULL,'','','','&nbsp;&nbsp;')?></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('reply_cfg:quote_subject')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>표제인용글</strong></td>
	  <td><input name="reply_cfg[quote_subject]" type="text" class="input" value="<?=$reply_cfg['quote_subject']?>" size="50"></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('reply_cfg:quote_mark')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>원본글인용부호</strong></td>
	  <td><input name="reply_cfg[quote_mark]" type="text" class="input" value="<?=$reply_cfg['quote_mark']?>" size="4"></td>
	  </tr>
</table>	
<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_view_cfg,span_view_cfg,'▲','▼')" style="cursor:hand">글보기 <span id="span_view_cfg"><?=$sub_cfg_toggle?></span><font color="#fff600">[버튼노출관리]</font></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_view_cfg" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="50" align="center"><?=chk_form('view_cfg:view_comment')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>코멘트보기</strong></td>
	  <td><select name="view_cfg[view_comment]" class="input" id="view_comment">
        <?=rg_html_option($auth_level,$view_cfg['view_comment'])?>
      </select></td>
	  <td width="50" align="center"><?=chk_form('view_cfg:view_image')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>이미지파일 보기 </strong></td>
	  <td><select name="view_cfg[view_image]" class="input" id="view_image">
        <?=rg_html_option($auth_level,$view_cfg['view_image'])?>
      </select></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('view_cfg:use_download')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>다운로드</strong></td>
	  <td><select name="view_cfg[use_download]" class="input" id="use_download">
        <?=rg_html_option($auth_level,$view_cfg['use_download'])?>
      </select></td>
	  <td width="40" align="center"><?=chk_form('view_cfg:view_signature')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>서명표시</strong></td>
	  <td><select name="view_cfg[view_signature]" class="input" id="view_signature">
        <?=rg_html_option($auth_level,$view_cfg['view_signature'])?>
      </select></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('view_cfg:view_list')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>글목록함께보기</strong></td>
	  <td><select name="view_cfg[view_list]" class="input" id="view_list">
        <?=rg_html_option($auth_level,$view_cfg['view_list'])?>
      </select></td>
	  <td width="40" align="center"></td>
	  <td align="center" bgcolor="#F0F0F4">&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('view_cfg:btn_list')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>리스트 버튼</strong></td>
	  <td><select name="view_cfg[btn_list]" class="input" id="btn_list">
        <?=rg_html_option($auth_level,$view_cfg['btn_list'])?>
      </select></td>
	  <td width="40" align="center"><?=chk_form('view_cfg:btn_prev_next')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>이전/다음글 버튼</strong></td>
	  <td><select name="view_cfg[btn_prev_next]" class="input" id="btn_prev_next">
        <?=rg_html_option($auth_level,$view_cfg['btn_prev_next'])?>
      </select></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('view_cfg:btn_modify')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>글수정 버튼</strong></td>
	  <td><select name="view_cfg[btn_modify]" class="input" id="btn_modify">
        <?=rg_html_option($auth_level,$view_cfg['btn_modify'])?>
      </select></td>
	  <td width="40" align="center"><?=chk_form('view_cfg:btn_del')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>글삭제 버튼</strong></td>
	  <td><select name="view_cfg[btn_del]" class="input" id="btn_del">
        <?=rg_html_option($auth_level,$view_cfg['btn_del'])?>
      </select></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('view_cfg:btn_reply')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>응답글 버튼</strong></td>
	  <td><select name="view_cfg[btn_reply]" class="input" id="btn_reply">
        <?=rg_html_option($auth_level,$view_cfg['btn_reply'])?>
      </select></td>
	  <td width="40" align="center"></td>
	  <td bgcolor="#F0F0F4">&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('view_cfg:vote_yes')?></td>
	  <td align="center" bgcolor="#F0F0F4"><b>추천사용</b></td>
	  <td><select name="view_cfg[vote_yes]" class="input" id="vote_no">
      <?=rg_html_option($auth_level,$view_cfg['vote_yes'])?>
    </select></td>
	  <td width="40" align="center"><?=chk_form('view_cfg:vote_no')?></td>
	  <td align="center" bgcolor="#F0F0F4"><b>반대사용</b></td>
	  <td><select name="view_cfg[vote_no]" class="input" id="vote_no">
      <?=rg_html_option($auth_level,$view_cfg['vote_no'])?>
    </select></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('view_cfg:date_format')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>날짜형식</strong></td>
	  <td colspan="4"><input name="view_cfg[date_format]" type="text" class="input" value="<?=$view_cfg['date_format']?>" size="40"></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('view_cfg:c_date_format')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>코멘트날짜형식</strong></td>
	  <td colspan="4"><input name="view_cfg[c_date_format]" type="text" class="input" value="<?=$view_cfg['c_date_format']?>" size="40">
      <br>
      <font color="#FF0000">%Y : 년도, %m : 월, %d : 일, %H : 시간, %M : 분, %S : 초 (strftime 함수   참고하세요)</font></td>
	  </tr>
</table>


<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_deny,span_deny,'▲','▼')" style="cursor:hand">제한설정 <span id="span_deny"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_deny" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
    <tr>
      <td width="50" align="center"><?=chk_form('deny_word')?></td>
      <td width="120" align="center" bgcolor="#F0F0F4">제한할단어목록</td>
      <td><textarea name="deny_word" cols="60" rows="10" class="input"><?=$data['deny_word']?></textarea></td>
    </tr>
    <tr>
      <td width="40" align="center"><?=chk_form('deny_html')?></td>
      <td align="center" bgcolor="#F0F0F4">제한할HTML</td>
      <td><textarea name="deny_html" cols="60" rows="10" class="input"><?=$data['deny_html']?></textarea></td>
    </tr>
    <tr>
      <td width="40" align="center"><?=chk_form('deny_ip')?></td>
      <td width="120" align="center" bgcolor="#F0F0F4">접속제한 IP </td>
      <td><textarea name="deny_ip" cols="60" rows="10" class="input"><?=$data['deny_ip']?></textarea></td>
    </tr>
</table>


<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_etc_cfg,span_etc_cfg,'▲','▼')" style="cursor:hand">기타설정 <span id="span_etc_cfg"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_etc_cfg" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="50" align="center"><?=chk_form('mailing_mb_id')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>메일수신<br>
	    아이디목록</strong></td>
	  <td><textarea name="mailing_mb_id" cols="60" rows="3"><?=$data['mailing_mb_id']?></textarea><br>
글이 올라오면 해당 하는 아이디로 메일발송</td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('admin_mb_id')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>게시판관리자<br>
	    아이디목록</strong></td>
	  <td><textarea name="admin_mb_id" cols="60" rows="3"><?=$data['admin_mb_id']?></textarea><br>
해당 아이디는 수정,삭제가 자유로움 (게시판 설정의 수정은 안됨)</td>
	  </tr>
	<tr>
	  <td width="40" align="center"></td>
	  <td align="center" bgcolor="#F0F0F4">&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('point_write')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>글작성포인트</strong></td>
	  <td><input name="point_write" type="text" class="input" value="<?=$data['point_write']?>" size="4" dir="rtl"></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('point_reply')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>답변글포인트</strong></td>
	  <td><input name="point_reply" type="text" class="input" value="<?=$data['point_reply']?>" size="4" dir="rtl"></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('point_comment')?></td>
	  <td align="center" bgcolor="#F0F0F4"><strong>코멘트포인트</strong></td>
	  <td><input name="point_comment" type="text" class="input" value="<?=$data['point_comment']?>" size="4" dir="rtl"></td>
	  </tr>
</table>

<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center" bordercolordark="#E1E1E1" bordercolorlight="#FFFFFF">
	<tr>
		<td class="a_sub_title" onClick="toggle_display_object(tbl_ext_cfg,span_ext_cfg,'▲','▼')" style="cursor:hand">추가설정 <span id="span_ext_cfg"><?=$sub_cfg_toggle?></span></td>
	</tr>
</table>
<!-- 
<?if($data['bbs_code'] == "???"){
	$bbs_ext1_name = "SMS 사용(y/n)";
	$bbs_ext2_name = "SMS 회신번호";
	$bbs_ext3_name = "SMS 발신번호";
 } else { 
	$bbs_ext1_name = "추가설정1";
	$bbs_ext2_name = "추가설정2";
	$bbs_ext3_name = "추가설정3";
 } ?> 
 -->
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" id="tbl_ext_cfg" style="table-layout:fixed;<?=$sub_cfg_dispay?>">
	<tr>
	  <td width="50" align="center"><?=chk_form('bbs_ext1')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong><?=$bbs_ext1_name?></strong></td>
	  <td><input name="bbs_ext1" type="text" class="input" value="<?=$data[bbs_ext1]?>"></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('bbs_ext2')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong><?=$bbs_ext2_name?></strong></td>
	  <td><input name="bbs_ext2" type="text" class="input" value="<?=$data[bbs_ext2]?>"></td>
	  </tr>
	<tr>
	  <td width="40" align="center"><?=chk_form('bbs_ext3')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong><?=$bbs_ext3_name?></strong></td>
	  <td><input name="bbs_ext3" type="text" class="input" value="<?=$data[bbs_ext3]?>"></td>
	  </tr>
	<tr>
	  <td align="center"><?=chk_form('bbs_ext4')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>추가설정4</strong></td>
	  <td><input name="bbs_ext4" type="text" class="input" value="<?=$data[bbs_ext4]?>"></td>
	  </tr>
	<tr>
	  <td align="center"><?=chk_form('bbs_ext5')?></td>
	  <td width="120" align="center" bgcolor="#F0F0F4"><strong>추가설정5</strong></td>
	  <td><input name="bbs_ext5" type="text" class="input" value="<?=$data[bbs_ext5]?>"></td>
	  </tr>
</table>
<? if($mode=='modify') { ?>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>등록일</strong></td>
		<td><?=rg_date($data['reg_date'])?></td>
	</tr>
</table>
<? } ?>	
<br />
<table width="600" border="0" align="center">
	<tr>
		<td align="center">
			<input type="submit" value="등록/수정" class="button">
			<input type="button" value=" 취   소 " onClick="history.back();" class="button">
		</td>
	</tr>
</table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>