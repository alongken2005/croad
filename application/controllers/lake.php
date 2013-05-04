<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 千岛湖
 * @datetime (12-10-8 下午3:03)
 * @author ZhangHao
 */

class Lake extends CI_Controller {

	private $_data;

	public function __construct() {
		parent::__construct();
		$this->load->model('base_mdl', 'base');
	}

	/**
	 * 默认方法
	 */
	public function index() {
		$this->main();
	}

	public function main() {
		$this->_data['toplist'] = $this->base->get_data('lake_stuff', array('top'=>1))->result_array();
		$this->load->view(THEME.'/lake', $this->_data);
	}

	public function detail() {
		$id = $this->input->get('id');

		$this->_data['movie'] = $this->base->get_data('movie', array('id'=>$id))->row_array();

		//赏析
		$this->_data['mviews'] = $this->base->get_data('mview', array('mid'=>$id), '*', 0, 0, 'sort DESC')->result_array();

		//片花
		$this->_data['mclips'] = $this->base->get_data('mclips', array('mid'=>$id), '*', 0, 0, 'sort DESC')->result_array();

		//图片
		$this->_data['mimage'] = $this->base->get_data('pics', array('place_id'=>$id, 'place'=>2), '*', 0, 0, 'sort DESC')->result_array();

		//还喜欢
		$this->_data['likes'] = $this->db->query("SELECT * FROM ab_movie WHERE id IN (SELECT mid FROM ab_movie_tag WHERE tid IN (SELECT tid FROM ab_movie_tag WHERE mid=".$id.")) AND id!=".$id)->result_array();

		$this->load->view(THEME.'/movie_detail', $this->_data);
	}

	/**
	 * 索票页面
	 */
	public function get_ticket() {
		$id = $this->input->get('id');
		$this->permission->login_check(site_url('movie/detail?id='.$id));
		$uid = $this->session->userdata('uid');
		$this->_data['user'] = $this->base->get_data('account', array('id'=>$uid), 'email, first_name, middle_name, last_name')->row_array();
		$this->_data['action'] = 'index';
		$this->_data['weeks'] = $this->_weeks;
		$this->_data['tickets'] = $this->base->get_data('mticket', array('mid'=>$id), '*', 0, 0, 'stime ASC')->result_array();
		$this->_data['movie'] = $this->base->get_data('movie', array('id'=>$id))->row_array();

		$this->load->view(THEME.'/movie_ticket', $this->_data);
	}

	/**
	 * 申请索票提交
	 */
	public function ticket_submit() {
		$id = $this->input->get('id');
		$num = $this->input->post('num');
		$name = $this->input->post('name');
		$movie = $this->input->post('movie');

		$this->permission->login_check();
		$uid = $this->session->userdata('uid');
		$email = $this->session->userdata('email');
		$ticket = $this->base->get_data('mticket', array('id'=>$id))->row_array();
		if($ticket['total']-$ticket['used'] < $num) {
			echo json_encode(array('result'=>'no'));exit;
		}

		$uniqid = uniqid();
		$weeks = $this->_weeks;
		$endtime = date('m月d日', $ticket['stime']).'（'.$weeks[date('N', $ticket['stime'])].'）'.date('H:i', $ticket['stime']);

		$insert_data = array(
			'tid'	=> $id,
			'uniqid'=> $uniqid,
			'mid'	=> $ticket['mid'],
			'num'	=> $num,
			'email'	=> $email,
			'ctime'	=> time(),
		);

		if($email) {
			write_log($email, 'ticket', 'ticket');
			$this->load->config('email');
			$configemail = $this->config->item('smtp');
			$this->load->library('email');
			$this->email->initialize($configemail);
			$this->email->from('ticket@chiildroad.com', '儿童之路');
			$this->email->to($this->session->userdata('email'));
			$this->email->subject("恭喜你，索票成功");
			$message_file = $this->load->view(THEME.'/email_ticket', array('uniqid'=>$uniqid, 'endtime'=>$endtime, 'num'=>$num, 'name'=>$name, 'movie'=>$movie), TRUE);

			$this->email->message($message_file);
			error_reporting(0);
			if($this->email->send()) {
				write_log($email.'---success', 'ticket', 'ticket');
				$insert_data['state'] = 1;
			}
			write_log($this->email->print_debugger(), 'email', 'ticket');
		}

		if($this->base->insert_data('mticket_log', $insert_data)) {
			$this->db->query('UPDATE ab_mticket SET used = used+'.$num.' WHERE id='.$id);
			echo json_encode(array('uniqid'=>$uniqid, 'endtime'=>$endtime, 'num'=>$num, 'result'=>'yes'));exit;
		} else {
			echo json_encode(array('result'=>'no'));exit;
		}
	}
}