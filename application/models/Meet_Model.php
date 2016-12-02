<?php
class Meet_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->model('account_model');
    }

    // 取得使用者喜歡的粉專
    public function get_likes () {

        $user = $this->session->userdata('rndcode');

		$this->db->where('username', $user);
		$query = $this->db->get('meet_likes');

        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }

    // 取得使用者喜歡的活動
    public function get_events () {

        $user = $this->session->userdata('rndcode');

		$this->db->where('username', $user);
		$query = $this->db->get('meet_events');

        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }

    // 取得我打卡過的地方
    public function get_places () {

        $user = $this->session->userdata('rndcode');

		$this->db->where('username', $user);
		$query = $this->db->get('meet_place');

        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }


    // // 取得該粉專抓取時資訊
    public function get_fanspage_info () {

        $id = $_POST['id']; // 粉專之id
        $query = $this->db->where('pageId', $id);
        return $query->get('meet_likes');
    }

    // // 取得該粉專所有資訊
    public function get_fanspage_info_all () {

        $id = $_POST['id']; // 粉專之id
        $query = $this->db->where('pageId', $id);
        return $query->get('meet_fanspage');
    }

    // 儲存使用者喜歡的粉專
    public function set_likes () {

        $name         = $this->input->post('name');
        $id           = $this->input->post('id');
        $createTime   = $this->input->post('time');
        $user         = $this->session->userdata('rndcode');

        $data = array(
            'name'          =>  $name, // 名稱
            'pageId'        =>  $id, // 編號
            'createTime'    =>  $createTime, // 建立粉專時間
            'username'      =>  $user, // 使用者
            'fetchDay'      =>  date("Y-m-d"), // 抓取日
            'fetchTime'     =>  date("H:i:s") // 抓取時間
        );

        return $this->db->insert('meet_likes', $data);
    }

    // 儲存使用者參與的活動
    public function set_event () {

        $name         = $this->input->post('name'); // 名稱
        $id           = $this->input->post('id'); // 編號
        $timezone     = $this->input->post('timezone'); // 時區
        $cover        = $this->input->post('cover'); // 封面
        $description  = $this->input->post('description'); // 描述
        $user         = $this->session->userdata('rndcode');

        $data = array(
            'name'          =>  $name,
            'eventId'       =>  $id,
            'timezone'      =>  $timezone,
            'cover'         =>  $cover,
            'description'   =>  $description,
            'fetchTime'     =>  date("Y-m-d"),
            'username'      =>  $user
        );

        return $this->db->insert('meet_events', $data);
    }

    // 儲存我管理的粉專
    public function set_accounts () {

        $id         = $_POST['id'];
        $name       = $_POST['name'];
        $about      = $_POST['about'];
        $category   = $_POST['category'];
        $cover      = $_POST['cover'];
        $user       = $this->session->userdata('rndcode');

        $data = array(
            'pageId'    => $id,
            'name'      => $name,
            'about'     => $about,
            'category'  => $category,
            'cover'     => $cover,
            'fetchTime' => date("Y-m-d"),
            'username'  => $user,
        );

        return $this->db->insert('meet_accounts', $data);
    }

    // 儲存我管理的社團
    public function set_groups () {

        $id         = $_POST['id'];
        $name       = $_POST['name'];
        $user       = $this->session->userdata('rndcode');

        $data = array(
            'groupId'   => $id,
            'name'      => $name,
            'fetchTime' => date("Y-m-d"),
            'username'  => $user,
        );

        return $this->db->insert('meet_groups', $data);
    }

    // 儲存我管理的社團內的貼文
    public function set_groups_feed () {

        $group_id   = $_POST['group_id'];
        $post_id    = $_POST['post_id'];
        $message    = $_POST['message'];
        $user       = $this->session->userdata('rndcode');

        $data = array(
            'groupId'   => $group_id,
            'postId'    => $post_id,
            'message'   => $message,
            'fetchTime' => date("Y-m-d"),
            'username'  => $user,
        );

        return $this->db->insert('meet_groups_feed', $data);
    }

    // 儲存我打卡/備標記過的地方
    public function set_place () {

        $post_id    = $_POST['post_id'];
        $locat_id   = $_POST['locat_id'];
        $name       = $_POST['name'];
        $city       = $_POST['city'];
        $country    = $_POST['country'];
        $lat        = $_POST['lat'];
        $lng        = $_POST['lng'];
        $street     = $_POST['street'];
        $user       = $this->session->userdata('rndcode');

        $data = array(
            'post_id'   => $post_id,
            'locat_id'  => $locat_id,
            'name'      => $name,
            'city'      => $city,
            'country'   => $country,
            'lat'       => $lat,
            'lng'       => $lng,
            'street'    => $street,
            'fetchTime' => date("Y-m-d"),
            'username'  => $user,
        );

        return $this->db->insert('meet_place', $data);
    }

    // 儲存使用者喜愛的影片
    public function set_video () {

        $id             = $_POST['id']; // 編號
        $permalink_url  = $_POST['permalink_url']; // 影片完整網址
        $description    = $_POST['description']; // 描述
        $user           = $this->session->userdata('rndcode');

        $data = array(
            'postId'        =>  $id,
            'permalink_url' =>  $permalink_url,
            'description'   =>  $description,
            'fetchTime'     =>  date("Y-m-d"),
            'username'      =>  $user
        );

        return $this->db->insert('meet_videos', $data);
    }

    // 儲存我的動態牆上的貼文
    public function set_posts () {

        $id             = $_POST['id'];
        $story          = $_POST['story'];
        $message        = $_POST['message'];
        $createdtime    = $_POST['createdtime'];
        $user           = $this->session->userdata('rndcode');

        $data = array(
            'postId'        => $id,
            'story'         => $story,
            'message'       => $message,
            'createdtime'   => $createdtime,
            'fetchTime'     => date("Y-m-d"),
            'username'      => $user
        );

        return $this->db->insert('meet_posts', $data);
    }

    // 儲存某影片留言內容
    public function set_videos_comments () {

        $post_id  = $this->input->post('post_id');
        $comments = $this->input->post('comments');
        $user     = $this->session->userdata('rndcode');

        $data = array(
            'postId'    => $post_id,
            'comments'  => $comments,
            'fetchTime' => date("Y-m-d"),
            'username'  => $user
        );

        return $this->db->insert('meet_videos_comments', $data);
    }


    // 儲存某粉專的相關資訊
    public function set_fanpage_info () {

        $name       = $this->input->post('name');
        $page_id    = $this->input->post('page_id');
        $fan_count  = $this->input->post('fan_count');
        $about      = $this->input->post('about');
        $website    = $this->input->post('website');
        $location   = $this->input->post('location');
        $cover      = $this->input->post('cover');
        $user       = $this->session->userdata('rndcode');

        $data   = array(
            'name'       =>  $name,
            'pageId'     =>  $page_id,
            'about'      =>  $about,
            'fan_count'  =>  $fan_count,
            'website'    =>  $website,
            'location'   =>  $location,
            'cover'      =>  $cover,
            'fetchTime'  =>  date("Y-m-d"),
            'username'   =>  $user,
        );
        return $this->db->insert('meet_fanspage', $data);
    }

    // 取得該使用者關鍵字
    public function get_keywords () {

        $user  = $this->session->userdata('rndcode');
        $query = $this->db->where('username', $user)->get('meet_keywords');
        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }

    // 聊天頁面 取得該使用者關鍵字
    public function get_user_keywords () {

        $user  = $this->input->post('id');
        $query = $this->db->where('username', $user)->get('meet_keywords');
        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }

    // 聊天頁面 取得該使用者d3
    public function get_user_keywords_d3 () {

        $user  = $this->input->post('id');
        $query = $this->db->query('SELECT keywords, count(keywords) AS counts FROM meet_keywords WHERE username = "'. $user .'" GROUP BY keywords');
        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }

    // 聊天頁面 取得該使用者與我相符關鍵字
    public function get_user_matchkeywords () {

        $user  = $this->input->post('id');
        $query = $this->db->query('SELECT keywords, count(keywords) AS counts FROM meet_keywords WHERE username = "'. $user .'" GROUP BY keywords');
        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }

    // 聊天頁面 取得該使用者與我相符關鍵字
    public function get_user_keywords_count () {

        $user  = $this->session->userdata('rndcode');
        $keywords = $this->input->post('keywords');
        $query = $this->db->query('SELECT username FROM meet_keywords WHERE keywords REGEXP ("' . implode("|",$keywords) . '") AND username != "'.$user.'"');
        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }

    // 取得前三多關鍵字使用者
    public function get_match_keywords_three () {

        $matchUsername = $this->input->post('matchUsername');
        $query = $this->db->query('SELECT * FROM member, school, dept WHERE member.rndcode = "'.$matchUsername.'" AND member.school = school.sc_code AND member.department = dept.de_code');
        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }

}
