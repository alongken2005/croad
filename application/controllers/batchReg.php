<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @用户批量导入
 * @see Book
 * @version 1.0.0 (12-10-8 下午3:03)
 * @author ZhangHao
 */

class BatchReg extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('base_mdl', 'base');
	}
	
	public function index() {
		$handle = fopen(base_url('data/users.csv'),"r");
		$i=1;
		while(!feof($handle)){
			$buffer = fgets($handle, 4096);
			
			list($name,$email,$password) = explode(',', $buffer);
			//debug($name."__".$email."__".$password."<br>",0);
			
			$timestamp = time();

			$count = $this->db->query('SELECT id FROM ab_account WHERE username = "'.mysql_escape_string($email).'" OR email = "'.mysql_escape_string($email).'"')->num_rows();
			
			if($count > 0) {
				echo "email re <br>";
				continue;
			}

			if($this->db->query("UPDATE ab_account_id SET id = LAST_INSERT_ID(id+1)")) {
				$uid = $this->db->insert_id();
				$insert_data = array(
					'id'			=> $uid,
					'site_id'		=> 1,
					'parent_id'		=> $uid,
					'username'		=> $email,
					'email'			=> $email,
					'password'		=> md5($password),
					'status'		=> 1,
					'first_name'	=> $name,
					'date_orig'		=> $timestamp,
					'date_last'		=> $timestamp,
				);
				$this->base->insert_data('account', $insert_data);
				
				$this->db->query("UPDATE ab_account_group_id SET id = LAST_INSERT_ID(id+1)");
				$gid = $this->db->insert_id();
				$gdata = array(
					'id' => $gid,
					'site_id' => 1,
					'date_orig' => $timestamp,
					'date_start' => strtotime('2013-09-01'),
					'date_expire' => strtotime('2014-09-01'),
					'account_id' => $uid,
					'group_id' => 1017,
					'active' => 1,
				);
				$this->base->insert_data('account_group', $gdata);
				echo $i."__".$name."ok<br>";
				$i++;
				exit;
			} else {
				echo $name."fail<br>";
			}	
		}
		fclose($handle);
	}
}
?>
