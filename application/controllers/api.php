<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @deprecated API
 * @version 1.0.0 12-10-22 下午9:39
 * @author 张浩
 */

class Api extends CI_Controller {

	private $_data = array();

	public function __construct() {
		parent::__construct();
		$this->load->model('base_mdl', 'base');
	}

	/**
	 * 默认方法
	 */
	public function index() {
		$this->login();
	}

	/**
	 * 登录
	 */
	public function login() {
		if(!defined("SESS_LOGGED")) define ('SESS_LOGGED', $this->session->userdata('logged'));
		if(!defined("SESS_ACCOUNT")) define ('SESS_ACCOUNT', $this->session->userdata('uid'));
		$this->_data['slider'] = $this->load->view('api/slider', array('active'=>__FUNCTION__), TRUE);
		$this->load->view('api/login', $this->_data);
	}

	/**
	 * 注册
	 */
	public function register() {
		$this->_data['slider'] = $this->load->view('api/slider', array('active'=>__FUNCTION__), TRUE);
		$this->load->view('api/register', $this->_data);
	}

	/**
	 * 资源下载
	 */
	public function down() {
		$this->_data['slider'] = $this->load->view('api/slider', array('active'=>__FUNCTION__), TRUE);
		$this->load->view('api/down', $this->_data);
	}

	public function state_code() {
		$this->_data['slider'] = $this->load->view('api/slider', array('active'=>__FUNCTION__), TRUE);
		$this->_data['state_code'] = array(
			array('code' => 1000, 'msg' => '请求重复', 'info'=>''),
			array('code' => 1001, 'msg' => '验证不通过', 'info'=>''),
			array('code' => 1002, 'msg' => '书本不存在', 'info'=>''),
			array('code' => 1003, 'msg' => '文件不存在', 'info'=>''),
			array('code' => 1004, 'msg' => '参数缺失', 'info'=>''),
			array('code' => 1005, 'msg' => '邮箱格式错误', 'info'=>''),
			array('code' => 2000, 'msg' => 'token获取失败', 'info'=>''),
			array('code' => 2001, 'msg' => 'token错误', 'info'=>''),
			array('code' => 2002, 'msg' => 'token过期', 'info'=>''),
			array('code' => 2003, 'msg' => 'bookid不匹配', 'info'=>''),
			array('code' => 3000, 'msg' => 'bookid不匹配', 'info'=>''),
		);
		$this->load->view('api/state_code', $this->_data);
	}
}