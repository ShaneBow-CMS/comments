<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->require_role(ROLE_ADMIN);
		}

/****
	public function index() {
		show_404(current_url(), FALSE);
		}

	public function index() {
		$this->load->model(['musers','mcomments']);
		$cats = $this->mcomments->get_cats();
		$data['blog_cats'] = $cats;
		$summaries = $this->mblogs->get_summaries(0,10);
		$data['title'] = 'Comments';
		$data['summaries'] = $summaries;
		$this->def_view('blog-index', $data);
		}

	public function post() {
		$this->load->helper('ajax');
		$usr = $this->session->userdata('usr');
		if (!$this->_usr)
			respond(EXIT_ERR_LOGIN, "Log in required", '/user/login');
		$this->load->library('form_validation');
		if ($this->form_validation->run('comment-post') == FALSE)
			dieInvalidFields();

		$this->load->model('mcomments');
		try { $id = $this->mcomments->add_comment($_POST); }
		catch (Exception $e) {db_error($e->getMessage());}
		respond(0, "SUCCESS", $id);
		}
****/

	public function seed() {
		$this->load->model('mseeder');
		$this->mseeder->reseed_tables('Create Comments Tables', [
			'comments'
			]);
		}
	}
