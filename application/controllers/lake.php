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
		$this->_data['piclist'] = $this->base->get_data('pics', array('place'=>4))->result_array();
		$this->_data['toplist'] = $this->db->query("SELECT s.title, s.cover, s.hits, s.id, a.name, g.title gname FROM ab_subject s LEFT JOIN ab_grade g ON s.grade=g.id LEFT JOIN ab_author a ON s.authorid=a.id WHERE s.top=1")->result_array();
		$this->_data['camplist'] = $this->db->query("SELECT s.title, s.cover, s.hits, s.id, a.name, g.title gname FROM ab_subject s LEFT JOIN ab_grade g ON s.grade=g.id LEFT JOIN ab_author a ON s.authorid=a.id WHERE s.type='lakeCamp'")->result_array();
		$this->_data['readlist'] = $this->db->query("SELECT s.title, s.cover, s.hits, s.id, a.name, g.title gname FROM ab_subject s LEFT JOIN ab_grade g ON s.grade=g.id LEFT JOIN ab_author a ON s.authorid=a.id WHERE s.type='lakeRead'")->result_array();
		$this->_data['authorlist'] = $this->base->get_data('author')->result_array();
		$this->load->view(THEME.'/lake', $this->_data);
	}

	/**
	 * 课程
	 */
	public function subject() {
		$id = (int)$this->input->get('id');

		$this->_data['subject'] = $subject = $this->db->query("SELECT * FROM ab_subject WHERE id=".$id)->row_array();
		$this->_data['author'] = $this->db->query("SELECT * FROM ab_author WHERE id=".$subject['authorid'])->row_array();
		$this->_data['attachs'] = $this->base->get_data('attach', array('kind'=>'lake', 'relaid'=>$id), '*', 0, 0, 'sort DESC, ctime DESC')->result_array();
		$this->_data['author_subject'] = $this->base->get_data('subject', array('authorid'=>$subject['authorid']), '*', 0, 0, 'sort DESC, ctime DESC')->result_array();
		$this->load->view(THEME.'/lake_subject', $this->_data);
	}

	/**
	 * 作者
	 */
	public function author() {
		$id = (int)$this->input->get('id');

		$this->_data['author'] = $this->base->get_data('author', array('id'=>$id))->row_array();
		$this->_data['author_subject'] = $this->base->get_data('subject', array('authorid'=>$id), '*', 0, 0, 'sort DESC, ctime DESC')->result_array();
		$this->_data['author_top'] = $this->base->get_data('author', array('top'=>1), '*', 0, 0, 'sort DESC, id DESC')->result_array();
		$this->load->view(THEME.'/lake_author', $this->_data);
	}

	/**
	 * 搜索
	 */
	public function search() {
		$type = (int)$this->input->get('type');
		$stype = $this->input->get('stype') ? $this->input->get('stype') : 'subject';
		$keyword = $this->input->get('keyword');

		$where = 'WHERE 1';
		if($stype == 'subject') {			//课件搜索
			if($type == 1) {
				$where .= ' AND s.top=1';
			} elseif($type == 2) {
				$where .= ' AND s.type="lakeCamp"';
			} elseif($type == 3) {
				$where .= ' AND s.type="lakeRead"';
			}

			if($keyword) {
				$where .= ' AND s.title LIKE "%'.$keyword.'%"';
			}

			$this->_data['lists'] = $this->db->query('SELECT s.*, a.name FROM ab_subject s LEFT JOIN ab_author a ON a.id=s.authorid '.$where)->result_array();
		} elseif($stype == 'author') {		//作者搜索
			if($keyword) {
				$where .= ' AND name LIKE "%'.$keyword.'%"';
			}
			$this->_data['lists'] = $this->db->query('SELECT * FROM ab_author '.$where)->result_array();
		} else {
			$this->_data['lists'] = array();
		}
		$this->_data['stype'] = $stype;
		$this->_data['type'] = $type;
		$this->load->view(THEME.'/lake_search', $this->_data);
	}
}