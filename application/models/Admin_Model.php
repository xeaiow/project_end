<?php
class Admin_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // 取得該編號文章資料
	public function get_article_by_id ($rndcode = NULL) {

		$this->db->select('article.art_name, article.content, article.author, article.author_rndcode, article.type, article.time, article.art_del, article.top, article.id AS art_id, di_code, di_name, member.rndcode, dept.de_name, school.sc_name');
		$this->db->from('article, discuss, member, school, dept');

        // 如果是帶 rndcode 參數的就給單筆資料
        if ($rndcode !== NULL) {

            $this->db->where('article.id', $rndcode );
        }
        // 否則用輸入文章編號 (art_id) 的方式取得
        else{

            $this->db->where('article.id', $this->input->post('id') );
        }

		$this->db->where('article.type = discuss.di_numb');
		$this->db->where('article.author_rndcode = member.rndcode');
		$this->db->where('school = school.sc_id ');
		$this->db->where('department = dept.de_id');

		$this->db->limit(1);
		$query = $this->db->get();

		return ( $query->num_rows() > 0 ) ? $query->row_array() : false;

	}

    // 刪除或復原文章
    public function article_remove () {

        if ($this->input->post('art_del') == '1') {

            $data = array(
                'art_del' => 0,
            );
        }
        else{

            $data = array(
                'art_del' => 1,
            );
        }

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('article', $data);

        return ($this->db->affected_rows() == 1 ? true : false);
    }

    // 置頂或取消置頂文章
    public function article_top () {

        if ($this->input->post('top') == '1') {

            $data = array(
                'top' => 0,
            );
        }
        else{

            $data = array(
                'top' => 1,
            );
        }

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('article', $data);

        return ($this->db->affected_rows() == 1 ? true : false);
    }


	// 搜尋使用者列表
	public function get_member($rndcode = NULL) {

		$this->db->select('member.*, school.sc_name, dept.de_name');
		$this->db->from('member, school, dept');
        $this->db->where('member.school = school.sc_id AND member.department = dept.de_id');

        $this->db->group_start();
			$this->db->or_like('rndcode', $this->input->post('member_keyword') );
			$this->db->or_like('email', $this->input->post('member_keyword') );
			$this->db->or_like('firstname', $this->input->post('member_keyword') );
		$this->db->group_end();

		$this->db->limit(100);

        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result_array() : false;

	}

    // 取得單筆使用者資料
    public function get_member_info () {

        $this->db->select('member.*, school.sc_name, dept.de_name');
		$this->db->from('member, school, dept');
        $this->db->where('member.school = school.sc_id AND member.department = dept.de_id');

        $this->db->where('rndcode', $this->input->post('memberRndcode'));
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row_array() : false;

    }

    // 取得使用者發過的文章
    public function get_member_article () {

        $this->db->select('article.art_name, article.type, article.time, article.id, discuss.di_name, discuss.di_code');
        $this->db->from('article, discuss');

        $this->db->where('author_rndcode', $this->input->post('memberRndcode'));
        $this->db->where('discuss.di_numb = article.type');

        $this->db->order_by('article.id', 'desc');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }

    // 取得使用者違規紀錄
    public function get_member_record ($rndcode) {

        $this->db->select('wrn_title, wrn_content, wrn_read, wrn_solve, wrn_time');
        $this->db->from('wrn');
        $this->db->where('wrn_rndcode', $rndcode);

        $this->db->order_by('wrn.wrn_id', 'desc');
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }
}
