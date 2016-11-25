<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('article_model');
		$this->load->model('account_model');
		$this->load->model('system_model');
		$this->load->model('admin_model');

		// import custom helper library
		$this->load->helper('security');

		// import form, form_validation helper for post
		$this->load->helper('form');
		$this->load->library('form_validation');

	}

	public function page_not_found()
	{
		// TODO: handle 錯誤頁面
	}

	public function article($art_id = NULL) {

		$data['art_id'] = $art_id;
		$this->load->view('admin/templates/header');

		$this->load->view('admin/templates/navbar');
		$this->load->view('admin/templates/menu');

		$this->load->view('admin/article/query', $data);

		$this->load->view('templates/footer');
	}

	public function get_article() {

		$result = $this->admin_model->get_article_by_id();

		// 如果有取得到我的文章
		if ($result) {
			$response['result'] = $result;
			$response['status'] = true;
		}
		else {
			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 使用 art_id 取得文章內容
	public function get_article_artid ($rndcode) {

		$data['article'] = $this->admin_model->get_article_by_id($rndcode);

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navbar');
		$this->load->view('admin/templates/menu');
		$this->load->view('admin/article/artid', $data);
		$this->load->view('templates/footer');

	}

	// 刪除或復原文章
	public function article_remove () {

		$result = $this->admin_model->article_remove();

		($result == true) ? $response['status'] = true : $response['status'] = false;

		echo json_encode($response, JSON_UNESCAPED_UNICODE);

	}

	// 置頂或取消置頂文章
	public function article_top () {

		$result = $this->admin_model->article_top();

		($result == true) ? $response['status'] = true : $response['status'] = false;

		echo json_encode($response, JSON_UNESCAPED_UNICODE);

	}

	// 會員搜尋頁面
	public function member() {

		$this->load->view('admin/templates/header');

		$this->load->view('admin/templates/navbar');
		$this->load->view('admin/templates/menu');

		$this->load->view('admin/member/query');

		$this->load->view('templates/footer');
	}

	// 搜尋關鍵字取得會員列表
	public function get_member() {

		// 取得相關會員列表
		$result = $this->admin_model->get_member();

		// TODO: 驗證

		if ($result) {
			$response['result'] = $result;
			$response['status'] = true;
		}
		else {
			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 取得單筆會員資料
	public function get_member_info() {

		// 取得相關會員列表
		$result = $this->admin_model->get_member_info();

		if ($result) {
			$response['result'] = $result;
			$response['status'] = true;
		}
		else {
			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 取得使用者發過的文章
	public function get_member_article() {

		// 取得相關會員列表
		$result = $this->admin_model->get_member_article();

		if ($result) {
			$response['result'] = $result;
			$response['status'] = true;
		}
		else {
			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}


	// 使用 rndcode 取得使用者資料
	public function get_member_rndcode ($rndcode) {

		$data['rndcode'] = $rndcode;
		// // 取得會員資料
		// $data['member']  = $this->admin_model->get_member($rndcode);
		//
		// // 取得會員發過的文章
		// $data['article'] = $this->admin_model->get_member_article($rndcode);
		//
		// // 取得會員違規記錄
		// $data['record']  = $this->admin_model->get_member_record($rndcode);

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navbar');
		$this->load->view('admin/templates/menu');
		$this->load->view('admin/member/rndcode', $data);
		$this->load->view('templates/footer');
	}

}
