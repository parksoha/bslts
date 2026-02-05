<?php


if($file_name=="index.php" || $file_name=="_index.php" || $file_name=="index1.php" || $file_name=="index2_j.php" || $file_name=="index3.php" || $file_name=="index4.php") $bodyClass="Main"; else $bodyClass="Sub";

$sub1=array('会社案内','組織も','いらっしゃる道');
$sub2=array('半導体装備','ディスプレー装備','ユーティリティ');
$sub3=array('ISO 9001','SSQ','STQA');
$sub4=array('製造*生産設備');
$sub5=array('主要取引先案内');
$sub6=array('お知らせ','Q&A','人材採用');

//if($_site_info[shop_chk] == "1"){
//	$sub5[] = '전자결제';
//}


$menu_names=array('会社案内','事業内容/Service','品質認証/Introduction','生産設備/Customer','主要顧客企業/Membership','顧客支援/Membership');
$menu_info=array($sub1,$sub2,$sub3,$sub4,$sub5,$sub6);

//보드일경우
$board_array=array("sub6_2_j"=>"6:2","sub6_1_j"=>"6:1","sub6_3_j"=>"6:3","data4"=>"5:3","sub2_1"=>"2:1","sub4_1_j"=>"4:1","sub2_3"=>"2:3","sub6_2"=>"6:2","sub2_1_j"=>"2:1","sub2_2_j"=>"2:2","sub2_3_j"=>"2:3");

//member 페이지
$member_log=array("로그인:login","아이디찾기:find_id","비밀번호찾기:find_pass","회원가입:join");
$member_mem=array("로그아웃:logout","정보수정:modify","탈퇴:leave");
$member=array($member_log,$member_mem);


//현재불러올 leftmenu 추출
if(!isset($bbs_code)){
	$file_name2=str_replace(".php","",$file_name); //php가 아닌 파일명을 포함하는 페이지를 만들경우는 소스를 수정해줘야 한다.
	$file_name2=explode("_",$file_name2);
	$menu_num=substr($file_name2[0],3);
	$sub_num=$file_name2[1];
}
if($bbs_code){
	$file_num=explode(":",$board_array[$bbs_code]);
	$menu_num= $file_num[0];
	$sub_num= $file_num[1];
}

if($menu_num){
	$cur_menu=$menu_names[$menu_num-1];
	$cur_sub=$menu_info[$menu_num-1][$sub_num-1];
}


if(str_replace($file_name,"",$_SERVER['PHP_SELF'])=="/wb_member/"){
	//멤버폴더일경우
	$file_name2=str_replace(".php","",$file_name);
	for($i=0;$i<count($member);$i++){
		for($k=0;$k<count($member[$i]);$k++){
			$k_file=$member[$i][$k];
			$k_file=explode(":",$k_file);
			if($file_name2==$k_file[1]){
				if($i==0) $menu_num="log"; else $menu_num="mem";
				$sub_num=$k;
				$cur_menu="Member";
				$cur_sub=$k_file[0];
				$is_member='true';
			}
		}
	}
};


//예외
if($file_name=="sitemap.php"){
	$menu_num="";
	$sub_num="";
	$cur_menu="";
	$cur_sub="Sitemap";
	$add_class="wide";
}



if($file_name=="join_success.php"){
	$menu_num="log";
	$sub_num="3";
	$cur_menu="Member";
	$cur_sub="회원가입완료";
	$add_class="wide";
	$is_member = true;
}



if($file_name=="data1"){
	$menu_num="6";
	$sub_num="2";
	$cur_menu="";
	$cur_sub="Q&A";
	$add_class="";
}
if($file_name=="use_info.php"){
	$menu_num="";
	$sub_num="";
	$cur_menu="";
	$cur_sub="이용약관";
	$add_class="wide";
}
if($file_name=="free_form.php"){
	$menu_num="";
	$sub_num="";
	$cur_menu="고객지원/Online";
	$cur_sub="제품문의";
	$add_class="wide";
}
if($file_name=="card.php"){
	$menu_num="5";
	$sub_num="4";
	$cur_menu="커뮤니티/Community";
	$cur_sub="전자결제";
	$add_class="";
}

if($file_name=="calendar.php"){
	$menu_num="2";
	$sub_num="1";
	$cur_menu="온라인예약";
	$cur_sub="온라인예약";
	$add_class="";
}
?>

