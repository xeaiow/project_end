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

			$response['result']  = $result;
			$response['status'] = true;
		}
		else {

			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

	// 取得我點過的粉專
	public function getEvents() {

        $result = $this->meet_model->get_events();


		if ($result) {

			$response['result']  = $result;
			$response['status'] = true;
		}
		else {

			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

	// 取得我打卡過的地方
	public function getPlace() {

        $result = $this->meet_model->get_places();


		if ($result) {

			$response['result']  = $result;
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

	// // 取得該使用者關鍵字
	public function getKeyWords () {

		$result = $this->meet_model->get_keywords();

		if ($result) {

			$response['result'] = $result;
			$response['status'] = true;

		}
		else {
			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 聊天頁面 取得該使用者關鍵字
	public function getUserKeyWords () {

		$result = $this->meet_model->get_user_keywords();

		if ($result) {

			$response['result'] = $result;
			$response['status'] = true;

		}
		else {
			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 聊天頁面 取得該使用者d3
	public function getUserMatchKeyWords () {

		$result = $this->meet_model->get_user_keywords_d3();

		if ($result) {

			$response['result'] = $result;
			$response['status'] = true;

		}
		else {
			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 聊天頁面 取得跟我有相符的關鍵字之使用者
	public function getUserMatchKeyWordsCount () {

		$result = $this->meet_model->get_user_keywords_count();

		if ($result) {

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

	// 儲存我管理的社團內的貼文
	public function setGroupsFeed () {

		$result = $this->meet_model->set_groups_feed();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);

	}

	// 儲存我打卡/備標記過的地方
	public function setPlace () {

		$result = $this->meet_model->set_place();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);

	}

	// 判斷我是否今天以分析過
	// public function isToday () {
	//
	// 	$result = $this->meet_model->is_today();
	//
	// 	if ($result) {
	//
	// 		$response['result'] = $result;
	// 		$response['status'] = true;
	//
	// 	}
	// 	else {
	// 		$response['status'] = false;
	// 	}
	//
	// 	echo json_encode($response, JSON_UNESCAPED_UNICODE);
	//
	// }


	// 儲存關鍵字最終結果 (d3文字雲用)
	public function setKeyResult () {

		$result = $this->meet_model->set_key_result();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 聊天 - 找出該使用者關鍵字
	public function setKeywordAndCount ($id) {

		$result = $this->meet_model->get_KeywordsAndCounts($id);

		echo json_encode($result, JSON_UNESCAPED_UNICODE);
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
		$data['aa'] = "安安";
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

	public function chat ($id) {

		$header['page_title'] = "";
		$data['id'] = $id;
		$this->load->view('templates/header', $header);
        $this->load->view('templates/navbar');
        $this->load->view('meet/chat', $data);
        $this->load->view('templates/footer');
	}

	public function distance () {

		$header['page_title'] = "距離 - Meet覓";
		$this->load->view('templates/header', $header);
        $this->load->view('templates/navbar');
        $this->load->view('meet/distance');
        $this->load->view('templates/footer');
	}

}
