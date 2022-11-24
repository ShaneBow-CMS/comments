<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

// See https://www.sitepoint.com/hierarchical-data-database/

class Mcomments_tree extends MY_Model {
	protected $table_name = 'comments';

	public function __construct() {
		parent::__construct();
		}

	public function add_comment() {
		$sql = 'UPDATE tree SET rgt=rgt+2 WHERE rgt>5';
		$sql = 'UPDATE tree SET lft=lft+2 WHERE lft>5';
		$sql = "INSERT INTO tree SET lft=6, rgt=7, title='Strawberry'";
		$this->db->query($sql);
		}

	public function get_for_page($page_id) {
		// SELECT * FROM tree WHERE lft BETWEEN 2 AND 11 ORDER BY lft ASC;
		return $this->db
			->select('comments.*,u.fullname,u.nickname')
			->join('users u', 'u.id = comments.uid')
			->order_by('lft ASC')
			->get_where($this->table_name, ['pid' => $page_id])
//			->get($this->table_name)
			->result_array();
		}

	public function get_latest($limit = '5', $order_by = 'debut DESC', $where = []) {
		if (count($where)) $this->db->where($where);
		return $this->db
			->select('comments.*,u.fullname,u.nickname')
			->join('users u', 'u.id = uid')
			->order_by($order_by)
			->limit($limit)
			->get($this->table_name)
			->result_array();
		}
	}
/* _lib/cms/blog/ci/models/Mcomments_tree.php */