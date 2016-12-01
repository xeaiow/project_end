<?php
class Meet_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->model('account_model');
    }

    // 取得使用者喜歡的粉專
    // public function get_likes () {
    //
    //     $user = $this->session->userdata('rndcode');
    //
    //     $my_likes  = $this->mongo_db->where('username', $user)->get('likes');
    //     $my_events = $this->mongo_db->where('username', $user)->get('events');
    //
    //     return array(
    //         'likes' => $my_likes,
    //         'events' => $my_events,
    //     );
    // }
    //
    //
    // // 取得該粉專抓取時資訊
    // public function get_fanspage_info () {
    //
    //     $id = $_POST['id']; // 粉專之id
    //     $query = $this->mongo_db->where('id', $id);
    //     return $query->get('likes');
    // }
    //
    // // 取得該粉專所有資訊
    // public function get_fanspage_info_all () {
    //
    //     $id = $_POST['id']; // 粉專之id
    //     $query = $this->mongo_db->where('id', $id);
    //     return $query->get('fansInfo');
    // }

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

    // 儲存關鍵字最終結果 (d3文字雲用)
    // public function set_key_result () {
    //
    //     $keywords = $this->input->post('keywords');
    //     $counts   = $this->input->post('counts');
    //     $user     = $this->session->userdata('rndcode');
    //
    //     $data = array(
    //         'text'   => $keywords,
    //         'size'     => $counts,
    //         // 'createdate' => date("Y-m-d"),
    //         // 'username'   => $user,
    //     );
    //
    //     return $this->mongo_db->insert('keywords_result', $data);
    // }
    //
    // // 聊天 - 找出該使用者關鍵字
    // public function get_KeywordsAndCounts ($id) {
    //
    //     return $this->mongo_db->get('keywords_result');
    // }
    //
    // public function is_today () {
    //
    //     $this->mongo_db->where('username', $this->session->userdata('rndcode'));
    //     $this->mongo_db->where('fetchDay', date("Y-m-d"));
    //     return $this->mongo_db->get('likes');
    //
    // }

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
        $fan_count  = $this->input->post('fan_count');
        $about      = $this->input->post('about');
        $website    = $this->input->post('website');
        $location   = $this->input->post('location');
        $cover      = $this->input->post('cover');
        $user       = $this->session->userdata('rndcode');

        $data   = array(
            'name'       =>  $name,
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
    // public function get_keywords_events () {
    //
    //     $id = $_POST['id']; // userId
    //     $query = $this->mongo_db->where('username', $id);
    //     return $query->get('events_h');
    // }
    //
    // public function get_keywords_accounts () {
    //
    //     $id = $_POST['id']; // userId
    //     $query = $this->mongo_db->where('username', $id);
    //     return $query->get('accounts_h');
    // }
    //
    // public function get_keywords_fansinfo () {
    //
    //     $id = $_POST['id']; // userId
    //     $query = $this->mongo_db->where('username', $id);
    //     return $query->get('fansInfo_h');
    // }
    //
    // public function get_keywords_posts () {
    //
    //     $id = $_POST['id']; // userId
    //     $query = $this->mongo_db->where('username', $id);
    //     return $query->get('posts_h');
    // }
    //
    // public function get_keywords_videos () {
    //
    //     $id = $_POST['id']; // userId
    //     $query = $this->mongo_db->where('username', $id);
    //     return $query->get('videos_h');
    // }

}
