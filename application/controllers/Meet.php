<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meet extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('article_model');
		$this->load->model('account_model');
		$this->load->model('system_model');
		$this->load->model('meet_model');

		// import custom helper library
		$this->load->helper('security');
		$this->load->helper('text');

		// import form, form_validation helper for post
		$this->load->helper('form');
		$this->load->library('form_validation');

	}

	// 404 not found
	public function page_not_found()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/404');
		$this->load->view('templates/footer');
	}

	// 取得我點過的粉專
	public function getLikes() {

        $result = $this->meet_model->get_likes();


		if ($result) {

			$response['likes']  = $result['likes'];
			$response['events'] = $result['events'];
			$response['status'] = true;
		}
		else {

			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

	// 測試
	public function getMatch() {

        $result = $this->meet_model->get_match();

		if ($result) {

			$response['result'] = $result;
			$response['status'] = true;

		}
		else {
			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);

    }

	// 取得該粉專有誰喜歡
	public function getFansPageInfo() {

        $result = $this->meet_model->get_fanspage_info();
		$allInfo = $this->meet_model->get_fanspage_info_all();

		if ($result) {

			$response['allInfo'] = $allInfo;
			$response['result'] = $result;
			$response['status'] = true;

		}
		else {
			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);

    }

	// 儲存使用者喜歡的粉專
	public function setLikes () {

		$result = $this->meet_model->set_likes();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 儲存使用者參與的活動
	public function setEvent () {

		$result = $this->meet_model->set_event();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 儲存使用者喜愛的影片
	public function setVideo () {

		$result = $this->meet_model->set_video();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	public function setVideosComments () {

		$result = $this->meet_model->set_videos_comments();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 儲存我的動態牆上的貼文
	public function setPosts () {

		$result = $this->meet_model->set_posts();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 儲存我管理的粉專
	public function setAccounts () {

		$result = $this->meet_model->set_accounts();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);

	}

	// 儲存我管理的社團
	public function setGroups () {

		$result = $this->meet_model->set_groups();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);

	}


	// 儲存粉專的相關資訊
	public function setFanspageInfo () {

		$result = $this->meet_model->set_fanpage_info();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);

	}

	// Graph api 擷取頁面
    public function start ()
    {
		$header['page_title'] = "開始吧！ - Meet覓";
        $this->load->view('templates/header', $header);
        $this->load->view('templates/navbar');
        $this->load->view('account/menu');

		$data['profile'] = $this->account_model->get_member_profile();
        $this->load->view('meet/start', $data);
        $this->load->view('templates/footer');
    }

	public function fansPage ($id) {

		$header['page_title'] = "";
		$data['id'] = $id;
        $this->load->view('templates/header', $header);
        $this->load->view('templates/navbar');
        $this->load->view('account/menu');
        $this->load->view('meet/fanspage', $data);
        $this->load->view('templates/footer');
	}

}
