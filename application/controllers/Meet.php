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

		$is_login = $this->system_model->is_login();
		if ( !$is_login ) {
			redirect(base_url().'login/');
		}

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

	// 取得該使用者的粉專所有資訊
	public function getUserFansPageInfo() {

        $result = $this->meet_model->get_userfanspage_info();

		if ($result) {

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
		// $this->output->enable_profiler(TRUE);
	}


	// 抓到跟我相符的關鍵字存入，給聊天介面用的
	public function setMatchKeywords () {

		$result = $this->meet_model->set_match_keywords();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// ↑ 判斷是否以儲存關鍵字，沒儲存過才儲存
	public function juMatchKeywords () {

		$result = $this->meet_model->ju_match_keywords();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 取得該會員與我的相同關鍵字
	public function getMatchKeywords () {

		$result = $this->meet_model->get_match_keywords();

		if ($result) {

			$response['result'] = $result;
			$response['status'] = true;

		}
		else {
			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 取得關鍵字說明
	public function getKeywordsExplan () {

		$result = $this->meet_model->get_keywords_explan();

		if ($result) {

			$response['result'] = $result;
			$response['status'] = true;

		}
		else {
			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);

	}

	// D3.js 取得關鍵字
	public function d3getMatchKeywords () {

		$result = $this->meet_model->get_match_keywords();

		if ($result) {

			$response['children'] = $result;
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

	// 取得前三多關鍵字使用者
	public function getMatchKeywordsThree () {

		$result = $this->meet_model->get_match_keywords_three();

		if ($result) {

			$response['result'] = $result;
			$response['status'] = true;

		}
		else {
			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}


	// 儲存使用者參與的活動
	public function setEvent () {

		$result = $this->meet_model->set_event();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 分析前先刪除舊資料
	public function dropOld () {

		$result = $this->meet_model->set_drop_old();

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

	// 擷取或抓取個資
	public function profile () {

		$result = $this->meet_model->get_or_set_profile();

		if ($result) {

			$response['result'] = $result;
			$response['status'] = true;
		}
		else{

			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	public function setiSLab () {

		$result = $this->meet_model->set_islab();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);

	}

	// 聊天介面 - 擷取該使用者資料
	public function getChatProfile () {

		$result = $this->meet_model->get_chat_profile();

		if ($result) {

			$response['result'] = $result;
			$response['status'] = true;
		}
		else{

			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 儲存 graph api 抓到的資料
	public function setProfile () {

		$result = $this->meet_model->set_profile();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 取得我的打卡
	public function getSelfPlace () {

		$result = $this->meet_model->get_selfPlace();

		if ($result) {

			$response['result'] = $result;
			$response['status'] = true;
		}
		else{

			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	// 判斷這三天是否已經分析過
	public function isToday () {

		$result = $this->meet_model->is_today();

		if ($result) {

			$response['result'] = $result;
			$response['status'] = true;
		}
		else{

			$response['status'] = false;
		}

		echo json_encode($response, JSON_UNESCAPED_UNICODE);

	}

	// 儲存我利用關鍵字 >3 找到的好友
	public function setFriends () {

		$result = $this->meet_model->set_friends();

		( $result == true ? $response['status'] = true : $response['status'] = false );

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	public function getIsFriends () {

		$result = $this->meet_model->get_is_friend();

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
		$data['rndcode'] = $this->account_model->get_member_profile()['rndcode'];
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

		$header['page_title'] = "Meet 覓";
		$data['id'] = $id;
		$data['rndcode'] = $this->account_model->get_member_profile()['rndcode'];
		$this->load->view('templates/chat_header', $header);
        $this->load->view('templates/navbar');
        $this->load->view('meet/chat', $data);
        $this->load->view('templates/footer');
	}

	public function distance () {

		$header['page_title'] = "距離 - Meet覓";
		$this->load->view('templates/header', $header);
        $this->load->view('templates/navbar');
		$this->load->view('account/menu');
        $this->load->view('meet/distance');
        $this->load->view('templates/footer');
	}

	public function place ($id = NULL) {

		$data['id'] = $id;
		$header['page_title'] = "環遊 - Meet覓";
		$this->load->view('templates/header', $header);
        $this->load->view('templates/place_navbar');
        $this->load->view('meet/place', $data);
        $this->load->view('templates/footer');
	}

}
