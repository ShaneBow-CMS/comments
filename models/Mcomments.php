<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

// See https://www.sitepoint.com/hierarchical-data-database/

class Mcomments extends MY_Model {
	protected $table_name = 'comments';

	public function __construct() {
		parent::__construct();
		}

	public function add($otype, $uid, &$data) {
		$data['otype'] = $otype;
		if (!isset($data['debut']) || !$data['debut'])
			$data['debut'] = time();
		$data['uid'] = $uid;
		while (!$this->insert_ignore($this->table_name, $data))
			++$data['debut'];
		}

	public function add_threaded() {
		$sql = 'UPDATE tree SET rgt=rgt+2 WHERE rgt>5';
		$sql = 'UPDATE tree SET lft=lft+2 WHERE lft>5';
		$sql = "INSERT INTO tree SET lft=6, rgt=7, title='Strawberry'";
		$this->db->query($sql);
		}

	public function get_for_obj($otype, $oid) {
		// SELECT * FROM tree WHERE lft BETWEEN 2 AND 11 ORDER BY lft ASC;
		return $this->db
			->select('comments.*,u.fullname,u.nickname')
			->join('users u', 'u.id = comments.uid')
			->order_by('lft ASC, debut')
			->get_where($this->table_name, ['oid' => $oid, 'otype' => $otype])
			->result_array();
		}

	public function get_latest($limit = 5, $order_by = 'debut DESC', $where = []) {
		if (count($where)) $this->db->where($where);
		$it = $this->db
			->select('comments.*,u.nickname')
			->join('users u', 'u.id = uid')
			->order_by($order_by)
			->limit($limit)
			->get($this->table_name)
			->result_array();
		for ($i = 0; $i < $limit; $i++) {
			$it[$i]['entry'] = strip_tags($it[$i]['entry']);
			$it[$i]['href'] = ($it[$i]['otype'] == OTYPE_BLOG)? '/blog/number/'.$it[$i]['oid'].'#comments'
			                : '#';
			}
		return $it;
		}
	}
/* _lib/cms/blog/ci/models/Mcomments.php */