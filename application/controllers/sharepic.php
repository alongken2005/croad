<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 千岛湖
 * @datetime (12-10-8 下午3:03)
 * @author ZhangHao
 */

class Sharepic extends CI_Controller {

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
		$data = file_get_contents("php://input");
		$picName = "data/".uniqid().".jpg";
		file_put_contents($picName, $data);
		$this->_data = array('picName'=> base_url($picName), 'content'=> rawurldecode($_GET['content']), 'title'=>rawurldecode($_GET['title']), 'url'=>rawurldecode($_GET['url']));

		$this->load->view(THEME.'/sharepic', $this->_data);
	}

}