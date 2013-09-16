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
		$picName = "data/uploads/share/".uniqid().".jpg";
		file_put_contents($picName, $data);
		$this->_data = array('picName'=> base_url($picName), 'content'=> rawurldecode($_GET['content']), 'title'=>rawurldecode($_GET['title']), 'url'=>rawurldecode($_GET['url']));
		//$this->_data = array('picName'=> base_url("data/uploads/share/2cd0dd49de0a648a7aa2327a6cbdcef4.jpg"), 'content'=> '今日福克斯新闻主播克莱顿莫里斯的微博透露，苹果iPhone5S的A7芯片处理速度将比当前iphone 5的A6芯片快很多，比当前一代在运算频率上快近三分之一，达到31%。于此同时来自9to5Mac的报告指出，苹果的A7处理"器采"用的是64位构架', 'title'=>"用的是64位构架", 'url'=>"http://baidu.com");

		$this->load->view(THEME.'/sharepic', $this->_data);
	}

	public function com() {
		$data = file_get_contents("php://input");
		$picName = "data/uploads/share/".uniqid().".jpg";
		file_put_contents($picName, $data);
		$this->_data = array('picName'=> base_url($picName), 'content'=> rawurldecode($_GET['content']), 'title'=>rawurldecode($_GET['title']), 'url'=>rawurldecode($_GET['url']));
		//$this->_data = array('picName'=> base_url("data/uploads/share/2cd0dd49de0a648a7aa2327a6cbdcef4.jpg"), 'content'=> '今日福克斯新闻主播克莱顿莫里斯的微博透露，苹果iPhone5S的A7芯片处理速度将比当前iphone 5的A6芯片快很多，比当前一代在运算频率上快近三分之一，达到31%。于此同时来自9to5Mac的报告指出，苹果的A7处理"器采"用的是64位构架', 'title'=>"用的是64位构架", 'url'=>"http://baidu.com");

		$this->load->view(THEME.'/sharepiccom', $this->_data);
	}
}