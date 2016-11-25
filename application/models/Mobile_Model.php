<?php
class Mobile_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->model('account_model');
    }

	public function get_type_list()
	{
		$this->db->select('di_numb, di_code, di_sch, di_name');
		$query = $this->db->get('discuss');

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else {
			return false;
		}
	}


	public function get_type_name()
	{

		$this->db->select('di_name, di_numb, di_code');
		$this->db->where('di_code', $this->uri->segment(2, 0));
		$query = $this->db->get('discuss');

		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else {
			return false;
		}

	}

	public function get_list()
	{

		// TODO: 直接丟回板名中文名稱

		$this->db->select('art_name, author, gender, type, time, id, badge_use, like_count, reply_count');

		// 過濾已刪除文章 1=已刪除
		$this->db->where('art_del', '0');

		$this->db->order_by('id', 'DESC');
        $query = $this->db->get('article', 20, $this->input->post('offset'));

		// TODO: 判斷有無文章
		return $query->result_array();

	}

	// 搜尋文章
    public function get_search()
	{

		$this->db->select('art_name, author, gender, type, time, id, badge_use, like_count, reply_count');

		// 過濾已刪除文章 1=已刪除
		$this->db->like('art_name', $this->input->post('keywords'));
        $this->db->where('art_del', '0');
        $this->db->where('time >=', "NOW() - INTERVAL 3 MONTH", false);

		$this->db->order_by('id', 'DESC');

        $query = $this->db->get('article');

        if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else {

			return false;
		}

	}

	// 列出熱門文章 (條件: 一週內的文章，上限50篇，排序愛心數)
	public function get_hot($type = NULL)
	{

		$this->db->select('art_name, author, gender, type, time, id, badge_use, like_count, reply_count');

		// 過濾已刪除文章 1=已刪除
		$this->db->where('art_del', '0');
		if ($type != NULL) {
			$this->db->where('type', $type);
		}
		$this->db->where('time >=', "CURRENT_DATE - INTERVAL 7 DAY", false); //TODO: 上線前改回7天
		$this->db->order_by('like_count', 'DESC');

		$query = $this->db->get('article', 50);

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else {

			return false;
		}

	}


	public function get_list_by_type($type = FALSE)
	{

		$this->db->select('art_name, author, gender, type, time, id, badge_use, like_count, reply_count');

		// 多一個板名
		$this->db->where('type', $type);

		// 過濾已刪除文章 1=已刪除
		$this->db->where('art_del', '0');

		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('article', 20,  $this->input->post('offset'));
		return $query->result_array();

	}


	public function get_article()
	{

		// TODO: 判斷 num_rows()

		$this->db->select('art_name, author_rndcode, author, gender, content, signature, type, time, public, id, badge_use, like_count, di_code, di_name');
		$this->db->from('article, discuss');

		// 括號開始
		$this->db->group_start();
			$this->db->where('type', $this->input->post('type'));
			$this->db->where('id', $this->input->post('aid'));

		// 括號結束
		$this->db->group_end();

		// 過濾已刪除文章 1=已刪除
		$this->db->where('art_del', '0');
		$this->db->where('article.type = discuss.di_numb');

		$query = $this->db->get();
		return $query->row_array();

	}

	public function get_article_for_header($type, $id)
	{

		$this->db->select('art_name, content, public, time');
		$this->db->from('article');

		// 括號開始
		$this->db->group_start();
			$this->db->where('type', $type);
			$this->db->where('id', $id);

		// 括號結束
		$this->db->group_end();

		// 過濾已刪除文章 1=已刪除
		$this->db->where('art_del', '0');

		$query = $this->db->get();
		return $query->row_array();

	}


	public function get_reply()
	{

		$this->db->select('IF ( reply_del = 0, id, NULL ) AS id, '.
						  'IF ( reply_del = 0, content, NULL ) AS content, '.
						  'IF ( reply_del = 0, reply_gender, NULL ) AS reply_gender, '.
						  'IF ( reply_del = 0, reply_author, NULL ) AS reply_author, '.
						  'reply_time, '.
						  'IF ( reply_del = 0, reply_like_count, NULL ) AS reply_like_count, '.
						  'reply_del');

		// 括號開始
		$this->db->group_start();
			$this->db->where('art_reply_type', $this->input->post('reply_type'));
			$this->db->where('reply_post', $this->input->post('reply_aid'));

		// 括號結束
		$this->db->group_end();

		$query = $this->db->get('reply', 20,  $this->input->post('reply_offset'));
		return $query->result_array();

	}

	public function get_reply_yuanPO($author_rndcode = NULL)
	{
		// SELECT * FROM `reply` WHERE `art_reply_type` = '7' AND `reply_post` = '6599' AND `reply_rndcode` = '19595332'

		$this->db->select('reply.id AS reply_id');

		// 括號開始
		$this->db->group_start();
			$this->db->where('art_reply_type', $this->input->post('type'));
			$this->db->where('reply_post', $this->input->post('aid'));

		// 括號結束
		$this->db->group_end();

		$this->db->where('reply_rndcode', $author_rndcode);
		$query = $this->db->get('reply');

		return $query->result_array();

	}

	// 取得文章是否「按讚」(like)
	public function get_article_is_like() {

		// 假如有結果 (已按喜歡) ，會傳回 is_like 這個欄位，而且值是 true
		$this->db->select('"TRUE" AS is_like');

		$this->db->where('likes_post', $this->input->post('aid'));
		$this->db->where('likes_rndcode', $this->session->userdata('rndcode'));

		$query = $this->db->get('likes', 1);

		// 如果有查到記錄，傳回 true
		if ($query->num_rows() > 0)
		{
			return true;
		}
		else {
			return false;
		}
	}

	// 取得我按讚的回覆 (反白用)
	public function get_article_liked_reply()
	{
		$this->db->select('reply_likes_replyid AS reply_id');

		$this->db->where('reply_likes_post', $this->input->post('aid'));
		$this->db->where('reply_likes_rndcode', $this->session->userdata('rndcode'));

		$query = $this->db->get('reply_likes');

		return $query->result_array();

	}

	// 取得文章是否「收藏」(archive)
	public function get_article_is_archive() {

		// 假如有結果 (已按喜歡) ，會傳回 is_like 這個欄位，而且值是 true
		$this->db->select('"TRUE" AS is_archive');

		$this->db->where('arc_post', $this->input->post('aid'));
		$this->db->where('arc_rndcode', $this->session->userdata('rndcode'));

		$query = $this->db->get('archive', 1);

		// 如果有查到記錄，傳回 true
		if ($query->num_rows() > 0)
		{
			return true;
		}
		else {
			return false;
		}

	}

	// 文章按讚
	public function like_article() {

		$rndcode	= $this->session->userdata('rndcode');
		$aid		= $this->input->post('aid');
		$type		= $this->input->post('type');
		$islike		= $this->input->post('islike');

		// 判斷傳進來的是屬於哪種行為  false=尚未按讚「要」按讚； true=已經按讚 要「取消」讚
		switch ( $islike ) {

			//  尚未按讚， 「要」按讚
			case "false":
				$this->db->query('INSERT INTO  likes (likes_rndcode, likes_post, time) '.
									'SELECT * FROM (SELECT  "'. $rndcode .'", '.
											' (SELECT id FROM article WHERE article.id = "'. $aid .'" AND article.type = "'.$type.'" AND article.art_del = 0 ) AS art_exist, CURRENT_TIMESTAMP) AS tmp '.
								'WHERE NOT EXISTS ('.
										'SELECT id FROM likes WHERE likes_rndcode = "'.$rndcode.'" AND likes_post = "'. $aid .'"'.
									') AND art_exist IS NOT NULL LIMIT 1');

				// 檢查有沒有按讚成功，如果有成功
				if ( $this->db->affected_rows() == 1 ) {

					// 在 article 的 like_count +1
					$this->db->set('like_count', 'like_count+1', FALSE);
					$this->db->where('article.id', $aid);
					$this->db->where('article.type', $type);
					$this->db->update('article');

					// 如果 +1 成功
					if ( $this->db->affected_rows() == 1 ) {
						return "liked";
					}
					else {
						return "likedFailed#1";
					}
				}
				else {
					return "likedFailed";
				}


			// 已經按讚， 要「取消」按讚
			case "true":
				$this->db->where('likes_rndcode', $rndcode);
				$this->db->where('likes_post', $aid);

				$query = $this->db->delete('likes');

				// 檢查有沒有取消讚成功，如果有成功
				if ( $this->db->affected_rows() == 1 ) {

					// 到 article 的 like_count -1
					$this->db->set('like_count', 'like_count-1', FALSE);
					$this->db->where('article.id', $aid);
					$this->db->where('article.type', $type);
					$this->db->update('article');

					// 如果 -1 成功
					if ( $this->db->affected_rows() == 1 ) {
						return "unliked";
					}
					else {
						return "unlikeFailed#1";
					}

				}
				else {
					return "unlikeFailed";
				}

			default:
				return "error";
		}

	}

	// 文章加入收藏
	public function archive_article() {

		$rndcode	= $this->session->userdata('rndcode');
		$aid		= $this->input->post('aid');
		$type		= $this->input->post('type');
		$isarchive	= $this->input->post('isarchive');

		// 判斷傳進來的是屬於哪種行為  false=尚未按收藏「要」加入收藏； true=已經收藏 要「取消」收藏
		switch ( $isarchive ) {

			//  尚未收藏， 「要」加入收藏
			case "false":
				$this->db->query('INSERT INTO  archive (arc_rndcode, arc_post, arc_time)  '.
									'SELECT * FROM (SELECT  "'. $rndcode .'", '.
											' (SELECT id FROM article WHERE article.id = "'. $aid .'" AND article.type = "'.$type.'" AND article.art_del = 0 ) AS art_exist, CURRENT_TIMESTAMP) AS tmp '.
								'WHERE NOT EXISTS ('.
										'SELECT arc_id FROM archive WHERE arc_rndcode = "'.$rndcode.'" AND arc_post = "'. $aid .'"'.
									') AND art_exist IS NOT NULL LIMIT 1');

				// 檢查有沒有加入收藏成功，如果有成功
				if ( $this->db->affected_rows() == 1 ) {
					return "archived";
				}
				else {
					return "archiveFailed";
				}


			// 已經收藏， 要「取消」收藏
			case "true":
				$this->db->where('arc_rndcode', $rndcode);
				$this->db->where('arc_post', $aid);

				$query = $this->db->delete('archive');

				// 檢查有沒有取消收藏成功，如果有成功
				if ( $this->db->affected_rows() == 1 ) {
					return "unarchived";
				}
				else {
					return "unarchiveFailed";
				}

			default:
				return "error";
		}

	}

	// 文章加入收藏
	public function like_reply() {

		$rndcode	= $this->session->userdata('rndcode');
		$aid		= $this->input->post('aid');
		$type		= $this->input->post('type');
		$replyid	= $this->input->post('replyid');
		$isrlike	= $this->input->post('isrlike');

		// 判斷傳進來的是屬於哪種行為  false=尚未按收藏「要」加入收藏； true=已經收藏 要「取消」收藏
		switch ( $isrlike ) {

			//  尚未收藏， 「要」加入收藏
			case "false":
				$this->db->query('INSERT INTO  reply_likes (reply_likes_rndcode, reply_likes_post, reply_likes_replyid, time) '.
										' SELECT * FROM ( '.
									        'SELECT "'. $rndcode .'", '.
											'(SELECT id FROM article WHERE article.id = "'. $aid .'" AND article.type = "'.$type.'" AND article.art_del = 0 ) AS art_exist, '.
											'(SELECT reply.id FROM reply WHERE reply.id = "'. $replyid .'" AND reply.reply_post = "'. $aid .'" AND reply.reply_del = 0 ) AS reply_exist, '.
											'CURRENT_TIMESTAMP) AS tmp '.
									'WHERE NOT EXISTS ('.
											'SELECT reply_likes.id FROM reply_likes WHERE reply_likes_rndcode = "'. $rndcode .'" AND reply_likes_replyid = "'. $replyid .'"'.
										') AND art_exist IS NOT NULL AND reply_exist IS NOT NULL LIMIT 1;');

				// 檢查有沒有按讚成功，如果有成功
				if ( $this->db->affected_rows() == 1 ) {

					// 到 article 的 like_count -1
					$this->db->set('reply_like_count', 'reply_like_count+1', FALSE);
					$this->db->where('reply.id', $replyid);
					$this->db->where('reply.reply_post', $aid);
					$this->db->update('reply');

					// 如果 +1 成功
					if ( $this->db->affected_rows() == 1 ) {
						return "rliked";
					}
					else {
						return "rlikedFailed#1";
					}
				}
				else {
					return "rlikedFailed";
				}


			// 已經按讚， 要「取消」按讚
			case "true":
				$this->db->where('reply_likes_rndcode', $rndcode);
				$this->db->where('reply_likes_post', $aid);
				$this->db->where('reply_likes_replyid', $replyid);

				$query = $this->db->delete('reply_likes');

				// 檢查有沒有取消讚成功，如果有成功
				if ( $this->db->affected_rows() == 1 ) {

					// 到 article 的 like_count -1
					$this->db->set('reply_like_count', 'reply_like_count-1', FALSE);
					$this->db->where('reply.id', $replyid);
					$this->db->where('reply.reply_post', $aid);
					$this->db->update('reply');

					// 如果 -1 成功
					if ( $this->db->affected_rows() == 1 ) {
						return "unrliked";
					}
					else {
						return "unrlikeFailed#1";
					}

				}
				else {
					return "unrlikeFailed";
				}

			default:
				return "error";
		}

	}

    public function newpost () {

        // 發文者個人資料
        $member = $this->account_model->get_member_profile();

        $data = array(
			'art_name' => $this->input->post('title'),
			'content' => $this->input->post('content'),
            'signature' => ( $this->input->post('anonymous') == 'true' ) ? NULL : $member['signature'],
            'author' => ( $this->input->post('anonymous') == 'true' ) ? '匿名' : $member['sc_name'].' '.$member['de_name'].'系',
            'gender' => $member['gender'],
            'author_rndcode' => $member['rndcode'],
            'type' => $this->input->post('type'),
            'public' => ( $this->input->post('public') == 'true' ) ? '0' : '1',
		);

        $this->db->insert('article', $data);

		return TRUE;

	}

    public function article_reply () {

        $member = $this->account_model->get_member_profile();
        $is_yuan_po = $this->article_model->is_yuan_po( $this->input->post('art_id') );

        if ($is_yuan_po) {

            $this->db->where('id', $this->input->post('art_id'));
            $yuan_po_info = $this->db->get('article');

            $info = $yuan_po_info->row_array();
            $yuanpo_author = $info['author'];

        }
        else {
            $yuanpo_author = ($this->input->post('anon') == 'true') ? $member['sc_name'] : $member['sc_name'].' '.$member['de_name'].'系';
        }

        $data = array(
            'reply_post' => $this->input->post('art_id'),
            'reply_rndcode' => $member['rndcode'],
            'reply_author' => $yuanpo_author,
            'reply_gender' => $member['gender'],
            'content' => $this->input->post('content'),
            'art_reply_type' => $this->input->post('art_type'),
            're_check' => '0',
            'reply_like_count' => '0',
            'reply_del' => '0',
            'reply_anon' => ( $this->input->post('anon') == 'true' ) ? '1' : '0',
            'reply_time' => date("Y-m-d H:i:s"),
        );
        $this->db->insert('reply', $data);

        return true;
    }

    // 判斷原po
    public function is_yuan_po ($reply_post) {

        $this->db->where('id', $reply_post);
        $this->db->where('author_rndcode', $this->session->userdata('rndcode') );
        $query = $this->db->get('article');

        return ($query->num_rows() > 0) ? true : false;

    }

}
