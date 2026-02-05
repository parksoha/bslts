<?
/* =====================================================
  프로그램명 : 알지보드 V4
  화일명 : mysql_class.php (mysql3 클래스,상위버전도 사용가능)
  작성일 : 2006. 12. 09
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 2007-07-10
2007-07-16 디비클래스에 escape_string 함수추가
 ===================================================== */
if (!defined('MYSQL_INC_INCLUDED')) 
{
	define('MYSQL_INC_INCLUDED', 1);
// *-- MYSQL_INC_INCLUDED START --*
	class recordset
	{
		var $db;
		var $rs;
		var $table;
		var $table_attr;
		var $fields;
		var $field_sql;
		var $field_sql_select;
		var $where;
		var $where_sql;
		var $order;
		var $order_sql;
		var $group_sql;
		var $limit;
		
		function clear()
		{
//			$this->table='';
//			$this->table_attr=NULL;
			$this->fields=NULL;
			$this->field_sql='';
			$this->field_sql_select='';
			$this->where=NULL;
			$this->where_sql='';
			$this->order=NULL;
			$this->order_sql='';
			$this->group_sql='';
			$this->limit='';
//			if($this->rs)
			$this->free_result($this->rs);
		}
		
		function recordset(&$db)
		{
			$this->db=$db;
			$this->table='';
			$this->table_attr=NULL;
			$this->fields=NULL;
			$this->field_sql='';
			$this->field_sql_select='';
			$this->where=NULL;
			$this->where_sql='';
			$this->order=NULL;
			$this->order_sql='';
			$this->group_sql='';
			$this->limit='';
			$this->rs=NULL;
		}
		
		function commit() { return $this->db->commit(); }
		function rollback() { return $this->db->rollback(); }
		
		function list_fields() {
			if(!$this->table_attr) $this->table_attr=$this->db->list_fields($this->table);;
			return $this->table_attr;
		}
				
		function free_result() { if($this->rs) $this->db->free_result($this->rs); $this->rs=NULL; }

		function affected_rows() { return $this->db->affected_rows(); }


		function set_db(&$db) { $this->db=$db; }
		function get_db() { return $this->db; }

		function set_table($table) { $this->table=$this->db->escape_string($table); $this->table_attr=NULL; }
		function get_table() { return $this->table; }

		function num_rows() { if(!$this->rs) $this->select(); return $this->db->num_rows($this->rs); }

		function clear_where() { $this->where=NULL; $this->where_sql=''; }
		function add_where($where) { $this->where[]=$where; }
		function set_where($where) { $this->where=$where; }
		function get_where() { return $this->where; }
		function parse_where() { $this->where_sql=@implode("\nAND ",$this->where); }

		function clear_order() { $this->order=NULL; $this->order_sql=''; }
		function add_order($order) { $this->order[]=$order; }
		function set_order($order) { $this->order=$order; }
		function get_order() { return $this->order; }
		function parse_order() { $this->order_sql=@implode(",",$this->order); }

		function set_limit($limit) { $this->limit=$limit; }
		function get_limit() { return $this->limit; }

		function clear_field() { $this->fields=NULL; $this->field_sql=''; $this->field_sql_select=''; }
		function add_field($field,$value='') { $this->fields[$field]=$value; }
		function set_fields($fields) { $this->fields=$fields; }
		function get_field($field) { return $this->fields[$field]; }
		function get_fields() { return $this->fields; }
		function parse_field($type='') {
			if(is_array($this->fields)) {
				if($type=='insert' || $type=='update') {
					$tmp=array();
					foreach($this->fields as $k => $v) $tmp[]="`$k`='".$this->db->escape_string($v)."'";
					$this->field_sql=implode(",\n",$tmp);
				} else			
					$this->field_sql_select=implode(",\n",array_keys($this->fields));
			} else {
				$this->field_sql='';
				$this->field_sql_select='';
			}
		}

		function get_insert_id() { return $this->db->insert_id(); }

		function insert($re_parse=false,$test=false)
		{
			if($re_parse) $this->field_sql = '';
			
			$sql="INSERT `".$this->table."` SET \n";
			if($this->field_sql=='') $this->parse_field('insert');
			if($this->field_sql=='') return false;
			$sql.=$this->field_sql."\n";
			$this->db->query($sql,$test);
			
		}
		
		function update($re_parse=false,$test=false)
		{
			if($re_parse) $this->where_sql = $this->field_sql = '';
			
			$sql="UPDATE `".$this->table."` SET \n";
			if($this->field_sql=='') $this->parse_field('update');
			if($this->field_sql=='') return false;
			$sql.=$this->field_sql."\n";
			if($this->where_sql=='') $this->parse_where();
			if($this->where_sql!='')
				$sql.= "WHERE ".$this->where_sql."\n";
			$this->db->query($sql,$test);
		}
		
		function select($re_parse=false)
		{
			if($re_parse)
				$this->order_sql = $this->where_sql = $this->field_sql_select = '';

			$sql="SELECT ";
			if($this->field_sql_select=='') $this->parse_field('select');
			if($this->field_sql_select=='')
				$sql.="*\n";
			else
				$sql.=$this->field_sql_select."\n";
				
			$sql.="FROM ".$this->table."\n";
			
			if($this->where_sql=='') $this->parse_where();
			if($this->where_sql!='')
				$sql.= "WHERE ".$this->where_sql."\n";

			if($this->group_sql!='')
				$sql.= "GROUP BY ".$this->group_sql."\n";
				
			if($this->order_sql=='') $this->parse_order();
			if($this->order_sql!='')
				$sql.= "ORDER BY ".$this->order_sql."\n";

			if($this->limit!='')
				$sql.= "LIMIT ".$this->limit."\n";

			$this->rs=$this->db->query($sql);
			return $this->rs;
		}
		
		function delete($re_parse=false,$delete_all=false,$test=false)
		{
			if($re_parse) $this->where_sql = '';
				
			$sql="DELETE FROM `".$this->table."`\n";

			if($this->where_sql=='') $this->parse_where();
			if(!$delete_all && $this->where_sql=='') {
				echo "DELETE 조건절이 빠져 있습니다.";
				return false;
			}
			if($this->where_sql!='')
				$sql.= "WHERE ".$this->where_sql."\n";
				
			$this->db->query($sql,$test);
		}
		
		function fetch($vars=NULL)
		{
			if(!$this->rs) $this->select();
			$this->fields=$this->db->fetch($this->rs,$vars,MYSQL_ASSOC);
			return $this->fields;
		}
		
		function select_list(&$page,$page_size=20,$display_page=10)
		{
			$tmp_fileds=$this->get_fields();
			$this->clear_field();
			$this->add_field("count(*) as row_count");
			$this->select();
			$tmp=$this->fetch();
			$page_info=rg_navigation($page,$tmp['row_count'],$page_size,$display_page);
			$this->clear_field();
			$this->set_fields($tmp_fileds);
			$this->limit="{$page_info['offset']},{$page_info['rows']}";
			$this->select();
			
			return $page_info;
		}
		
	}
	
	class mysql
	{
		var $dbcon;
		var $debug;	// 디버그 모드 0:디버그 모드 아님, 1:에러메시지, 2:경고메시지, 3:전부출력
		var $dbname;
		var $escape_ch;

/******************************************************************************
기능 : ESCAPE 문자변환
사용법 : 
******************************************************************************/
		function escape_string($str,$like=0,$decode=0) {
			$source[] = "/'/";
			$target[] = "\'";
			if($like) { // LIKE 문의 문자열인경우
				$source[] = '/%/';
				$target[] = $this->escape_ch.'%';
				$source[] = '/_/';
				$target[] = $this->escape_ch.'_';
			}
			if($decode)
				return preg_replace($target, $source, $str);
			else
				return preg_replace($source, $target, $str);
		}

		function set_debug($debug) { $this->debug=$debug; }
		function get_debug($debug) { return $this->debug; }
		function free_result(&$rs) { return @mysql_free_result($rs); }
		function affected_rows() { return @mysql_affected_rows($this->dbcon); }
		
		function mysql()
		{
			$this->dbcon=NULL;
			$this->debug=0;
			$this->dbname='';
			$this->escape_ch=chr(27);
/*
			if($host!='' && $user!='' && $pass !='')
			{
				$this->connect($host,$user,$pass);
			}
			
			if($this->dbcon && $dbname!='')
			{
				$this->select_db($dbname);
			}*/
		}
		
		// 데이타베이스 초기화
		function connect($host,$user,$pass,$dbname=NULL,$port='') {
//			if($this->debug > 2)
//				echo "DB Server 접속 시도(HOST : $host,USER : $user,PASS : $pass)";
			if($port!='') $host.=':'.$port;
			$this->dbcon = @mysql_connect($host, $user, $pass);
			if(!$this->dbcon) 
			{
				if($this->debug > 0) 
				{
					echo '에러(connect) : '.mysql_error();
					exit;
				}
				return false;
			}
			
			if($this->debug > 2)
				echo "DB Server 접속 성공(HOST : $host,USER : $user)\n";
				
			if($dbname!=NULL) {
				if(!$this->select_db($dbname)) {
					$this->dbcon=NULL;
					return false;
				}
			}
	
			return $this->dbcon;
		}
	
		function select_db($dbname) {
			if(!@mysql_select_db($dbname,$this->dbcon)) {
				if($this->debug > 0)	{
					echo "에러(select) : ".mysql_error();
					exit;
				}
				return false;
			}	
			
			$this->dbname=$dbname;
			if($this->debug > 2)
				echo "DB Select 성공(DBNAME : $dbname)\n";
			return true;
		}
		
		// 데이타베이스 닫기
		function dbclose() {
			if($this->dbcon) {
				$result_ = @mysql_close($this->dbcon);
				if(!$result_) {
					if($this->debug>0)	{ 
						echo "에러(close) : ".mysql_error();
						exit;
					}
				}
				return $result_;
			}
		}
	
		// 결과를 읽어서 변수에 저장(변수는 ,로 구분)
		function fetch($rs,$vars=NULL,$mode='') {
			if($mode=='')  $mode=MYSQL_BOTH;
			$_cols = @mysql_fetch_array($rs,$mode);
			if($vars!=NULL)
			{
				$vars=str_replace(' ','',$vars);
				$vars=explode(',',$vars);
			}
			
			if (is_array($vars))
			{
				foreach($vars as $v)
				{
					unset($GLOBALS[$v]); // 변수 초기화
				}
			}
			
			if ($_cols && is_array($vars))
			{
				if($mode==MYSQL_BOTH)
				{
					for ($i = 0; ($i < count($vars)) && ( $i < count($_cols) ); $i++)
					{
						$GLOBALS[$vars[$i]] = $_cols[$i]; // 숫자로 된 필드가 있을 경우 오작동
					}				
				}
				else
				{
					$i=0;
					foreach($_cols as $v)
					{
						$GLOBALS[$vars[$i]] = $v;
						$i++;
						if($i>count($vars)) break;
					}
				}
			}
			
			if($this->debug > 3)
			{
				echo "fetch 성공\n";
				print_r($_cols);
			}
			
			return $_cols;
		}
		
		function query_fetch($query,$vars=NULL,$rs_name=NULL,$test=false){
			$result_ = $this->query($query,$test);
			if($rs_name) $GLOBALS[$rs_name]=$result_;
			if(!$result_)
				return false;
	
			$_cols = $this->fetch($result_,$vars,$test);
			if(!$_cols)
				return false;
			return $_cols;
		}
		
		// 데이타 베이스로 질의문 전송
		function query($query,$test=false)
		{
			if($test)
			{
				// 테스트 모드 이고 SELETC 문이 아니라면 실행하지 않고 보여준다.
				if(!eregi('^SELECT',$query))
				{
					echo $query;
					return true;
				}
			}
			
			//$result_ = mysql_query("set names utf-8");
			$result_ = mysql_query($query,$this->dbcon);
			if(!$result_)
			{
				if($this->debug > 0) echo "$query<br>".mysql_error();
				exit;
			}
			
			if($this->debug > 2)
			{
				echo "query 성공\n$query\n";
			}
			
			return $result_;
		}
		
		function update_result() {
			$ttmp=mysql_info($this->dbcon);
			if($this->debug > 2)
			{
				echo "MYSQL INFO : $ttmp\n";
			}
			
			if(eregi('^일치하는 Rows : ([0-9].*)개.*변경됨: ([0-9].*)개.*경고: ([0-9].*)개$',
					$ttmp,$tmp))
			{
				$tmp['mysql_info']=$tmp[0];
				$tmp['match']=$tmp[1];
				$tmp['update']=$tmp[2];
				$tmp['warning']=$tmp[3];
			} else $tmp=false;
			return $tmp;
		}
		
		//필드리스트을 구한다.
		function list_fields($table)
		{
			$result = $this->query("SHOW COLUMNS FROM $table");
			if(!$result)
			{
				if($this->debug > 1) echo "에러(list_fields) : ".mysql_error();
				exit;
			}
			if($this->num_rows($result) > 0) {
				$field_list=array();
				while ($row = $this->fetch($result,NULL,MYSQL_ASSOC)) {
					$field_list['Field'][]=$row['Field'];
					$field_list['Type'][]=$row['Type'];
					$field_list['Null'][]=$row['Null'];
					$field_list['Key'][]=$row['Key'];
					$field_list['Default'][]=$row['Default'];
					$field_list['Extra'][]=$row['Extra'];
				}
				if($this->debug > 3)
				{
					echo "field list 성공\n";
					print_r($field_list);
				}
				return $field_list;
			} else {
				return false;
			}
		}
		
		//테이블 목록을 구한다.
		function list_tables($table=NULL)
		{
			if($table!='')
				$result = $this->query("SHOW TABLES LIKE '$table'");
			else
				$result = $this->query("SHOW TABLES");
			if(!$result)
			{
				if($this->debug > 1) echo "에러(list_tables) : ".mysql_error();
				exit;
			}
			if($this->num_rows($result) > 0) {
				$table_list=array();
				while ($row = $this->fetch($result,NULL,MYSQL_NUM)) {
					$table_list[]=$row[0];
				}
				if($this->debug > 3)
				{
					echo "talbe list 성공\n";
					print_r($table_list);
				}
				return $table_list;
			} else {
				return false;
			}
		}
		
		// 결과 행수
		function num_rows($rs)
		{
			$_result=mysql_num_rows($rs);
			if($_result===FALSE)
			{
				if($this->debug > 1) echo "에러(num_rows) : ".mysql_error();
				exit;
			}
			if($this->debug > 2)
			{
				echo "num_rows 성공($_result)\n";
			}
			return $_result;
		}
		
		function insert_id()
		{
			return mysql_insert_id($this->dbcon);
		}
		
		function commit()
		{
			return true;
		}

		function rollback()
		{
			return false;
		}
		
		function error()
		{
			return mysql_error();
		}
	}
} // *-- MYSQL_INC_INCLUDED END --*
?>