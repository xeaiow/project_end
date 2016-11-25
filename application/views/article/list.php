	<div class="thirteen wide stackable grid column" ng-init="<?php if (!$this->session->userdata('ts') ) echo 'notLoginHolder();'; ?> typeCode='<?php echo $type['di_code']?>'; typeName='<?php echo $type['di_name'] ?>'; typeNumb='<?php echo $type['di_numb']?>'; isSex(); loadMore(); ">
		<div class="ui main text">
			<h1 class="ui header segment basic center aligned icon">
				<i id="topic-icon" class="right quote icon"></i>
				<span id="discuss-topic" ng-bind="discuss_topic" ng-init="discuss_topic='<?php echo $type['di_name']; ?>'"></span>
			</h1>

			<div class="ui basic segment">
				<div class="ui small icon buttons fluid" id="article-bar">

			<?php if ( $this->session->userdata('ts') ) { ?>

				<?php if ( ! in_array( $type['di_code'], array('all', 'ann') ) ) { ?>
					<a class="ui button notinverted lightblack" href="<?php echo base_url(). 'a/' .$type['di_code'] . '/';?>newpost"><i class="edit icon"></i> 發表文章</a>
				<?php } else { ?>
					<a class="ui button notinverted lightblack" id="newpost-ask-button" onclick="$('#newpost-ask-modal').modal('show');"><i class="edit icon"></i> 發表文章</a>

					<div class="ui small modal" id="newpost-ask-modal">
						<i class="close icon"></i>
						<div class="header">
							塞拉涅任意門
						</div>
						<div class="content">
							<div class="ui form">
								<div class="field">
									<label>想在什麼板發文？</label>
									<select class="ui fluid search dropdown" ng-model="postType">
										<option value="">搜尋看板</option>
										<option value="{{ type.di_code }}" ng-repeat="type in typeList | filter: {di_sch: 0 }">{{ type.di_name }}</option>
										<option value="{{ type.di_code }}" ng-repeat="type in typeList | filter: {di_sch: 1 }">{{ type.di_name }}</option>
									</select>
								</div>
							</div>
						</div>

						<div class="actions">
							<a class="ui darkred notinverted button" ng-href="https://selene.tw/a/{{ postType }}/newpost" ng-show=" postType.length > 0 ">確定</a>
						</div>

					</div>

				<?php } ?>
					<a class="ui button notinverted gentleman-red" ng-click="hot()" id="article-bar-hot"><i class="comments outline icon"></i> 熱門文章</a>

			<?php } else { ?>

					<a class="ui button notinverted gentleman-red" ng-click="hot()" id="article-bar-hot"><i class="comments outline icon"></i> 熱門文章</a>

			<?php } ?>

				</div>
			</div>


			<!-- 文章列表 -->
			<div class="ui basic segment">

				<!-- Announcement 公告 -->
				<div ng-cloak class="ui grey raised fluid card articleListItem" ng-click="loadArticle( <?php echo $ann['type'] ?> , <?php echo $ann['id'] ?>)">
					<div class="content">
						<div class="ui header"><?php echo $ann['art_name'] ?>
							<div class="sub header art-interval">
								<i class="ui circular mini {{ <?php echo $ann['gender'] ?> | gender }} icon"></i> <span class="category"><?php echo $ann['author'] ?></span>
							</div>
						</div>

					</div>
					<div class="extra">
						<div class="meta">
							<div class="left floated">
								<a class="like art-info-color"><i class="large like icon"></i> <?php echo $ann['like_count'] ?></a>
								<a class="like art-info-color"><i class="large comment icon"></i> <?php echo $ann['reply_count'] ?></a>
							</div>
							<!-- <span class="right floated time" ng-bind="article.time | relativeTime"></span> -->
						</div>
					</div>
				</div>

				<div ng-cloak class="ui raised fluid card {{ (article.like_count -- article.reply_count) | hotLayer }} articleListItem" ng-repeat="article in articleList" ng-click="loadArticle( article.type , article.id)">
					<div class="content">
						<div class="ui header">{{ article.art_name }}
							<div class="sub header art-interval">
								<i class="ui circular mini {{ article.gender | gender }} icon"></i> <span class="category" ng-bind="article.author"></span>
							</div>
						</div>

					</div>
					<div class="extra">
						<div class="meta">
							<div class="left floated">
								<a class="like art-info-color"><i class="large like icon"></i><span ng-bind="article.like_count"></span></a>
								<a class="like art-info-color"><i class="large comment icon"></i><span ng-bind="article.reply_count"></span></a>
							</div>
							<span class="right floated time" ng-bind="article.time | relativeTime"></span>
						</div>

					</div>
				</div>

				<div class="ui active inline loader centered" ng-if="!noMoreArticle"></div>

				<div class="ui warning message" ng-if="noMoreArticle">
					<p>沒有更多文章了</p>
				</div>
			</div>

			<div infinite-scroll="loadMore()" infinite-scroll-distance="0" infinite-scroll-disabled="noMoreArticle || !scroll_switch"></div>

		</div>

		<div class="ui large modal" id="article_modal">
			<i class="close icon"></i>
			<div class="header">{{ article.result.art_name }}</div>
			<div class="image content" ng-if="article">
				<div class="ui medium image">
					<div class="ui feed">
					    <div class="event">
					        <div class="label article_author" id="article_gender">
								<i class="ui circular {{ article.result.gender | gender }} icon"></i>
							</div>
					        <div class="content">
					            <div class="summary">
					                <a class="user" id="article_author" >{{ article.result.author }}</a>
					            </div>
					            <div class="meta">
					                <a class="like" id="article_time">{{ article.result.time }}</a>
					            </div>
					        </div>
					    </div>
					</div>

					<div id="article_type">
						<a class="ui nav-blue notinverted big horizontal label" ng-href="<?=base_url('a')?>/{{ article.result.di_code }}" target="_self">
							 {{ article.result.di_name }}
						 </a>
					 </div>

				</div>
				<div class="description fluid" id="article_content_container">
					<div class="ui header" id="article_adv">
						<!-- advertisement -->
					</div>
					<div class="ui basic article-content" ng-bind-html="article.result.content | formatter"></div>
					<div class="ui grey fluid text-italic" id="article_signature" ng-if="article.result.signature">{{ article.result.signature }}</div>

				</div>
			</div>
			<div class="actions">
				<div class="ui segment basic center aligned">
					<div class="ui right pointing black label" id="article_likecount">{{ articleLikeCount }}</div>
					<div class="ui {{ ( articleIsLike ) ? 'islike-pink-bg' : 'basic' }}  button" id="article_like" ng-click="doLike()">
						喜歡
					</div>
					<div class="ui {{ ( articleIsArchive )? 'isarchive-green-bg' : 'basic'; }} button" id="article_archive" ng-click="doArchive()">
						{{ ( articleIsArchive ) ? '取消收藏' : '加入收藏'; }}
					</div>
				<?php if ( $this->session->userdata('ts') ) { ?>

					<div class="ui basic buttons">
						<div class="ui button" id="article_reply_button">回覆</div>
						<div class="ui floating dropdown icon button" ng-show="(article.result.ismypost == '1') ? true : false">
							<i class="dropdown icon"></i>
							<div class="menu">
								<a class="item" target="_self" ng-href="<?=base_url('a')?>/{{ article.result.di_code }}/{{ article.result.id }}/edit" ng-if="(article.result.ismypost == '1') ? true : false"><i class="edit icon"></i> 編輯文章</a>
								<a class="item" ng-click="removeArticle()" ng-if="(article.result.ismypost == '1') ? true : false"><i class="delete icon"></i> 刪除</a>
							</div>
						</div>
					</div>

				<?php } ?>

				</div>
			</div>
			<div class="content">

				<div class="description" id="article_reply">

					<div class="ui basic segment" id="article_adv_adgeek_2">
					</div>

				<?php if ( $this->session->userdata('ts') ) { ?>
					<!-- 回應輸入 -->
					<div class="ui segments" id="article-reply-input-container">
						<div class="ui basic secondary segment">
							<div class="ui small black header">
								<span><?php echo $this->session->userdata('school'); ?></span> <span ng-hide="anonymous"><?php echo $this->session->userdata('department'); ?>系</span>
							</div>
							<div class="ui lightblue top right attached label pointer">
								<div class="ui toggle checkbox">
			                        <input type="checkbox" id="anonymous" ng-model="anonymous">
			                        <label for="anonymous">&nbsp;</label>
			                    </div>
							</div>

							<div contenteditable="plaintext-only" class="div-textarea" placeholder="說點什麼吧..." id="reply-content" ng-model="replyContent"></div>

							<div class="ui two mini buttom attached buttons">
				                <button class="ui button darkgreen notinverted" id="reply-select-pic"><i class="file image outline icon"></i></button>
				                <button class="ui button nav-blue notinverted" ng-click="doReply()"><i class="send icon"></i></button>
				            </div>

						</div>

					</div>


					<!-- 剛剛的回覆 -->
					<div class="ui segments" ng-repeat="reply in recentReplyList" ng-if="recentReplyList">
						<div class="ui basic secondary segment">

							<h4 class="ui header">
								<i class="ui circular tiny {{ reply.reply_gender | gender }} icon"></i>
								<div class="content">{{ reply.reply_author }}
									<div class="sub header">

									</div>
								</div>
							</h4>

							<p class="reply-content" ng-bind-html="reply.content | formatter"></p>
						</div>

						<div class="ui secondary segment right aligned segmentfooter" ng-if="reply.reply_del == 0">
							{{ reply.reply_time | relativeTime }}
						</div>
					</div>
				<?php } ?>


					<!-- 熱門回覆 -->
					<div class="ui segments" id="rf-{{$index+1}}" ng-repeat="reply in replyList | filter:{ hot:1 }">
						<div class="ui hot-layer-2 segment" ng-if="reply.reply_del == 0">

							<h4 class="ui header">
								<i class="ui circular tiny {{ reply.reply_gender | gender }} icon"></i>
								<div class="content">{{ reply.reply_author }}
									<div class="sub header">
										<span class="ui horizontal replybtn">熱門回覆 <i class="ui bookmark brown icon" ng-if="article.yuanPO.indexOf(reply.id) != -1"></i>
									</div>
								</div>
							</h4>

							<div class="ui {{ (article.my_reply.indexOf(reply.id) != -1 ) ? 'my-reply' : 'lightblue' }} top right attached label reply_like_btn" isrlike="{{ (article.reply_liked.indexOf(reply.id) != -1 ) ? 'true' : 'false' }}" replyid="{{ reply.id }}">
								<i class="{{ (article.reply_liked.indexOf(reply.id) != -1 ) ? 'islike-pink' : 'empty' }} heart large icon"></i><span class="reply_likecount">{{ reply.reply_like_count }}</span>
							</div>
							<p class="reply-content" ng-bind-html="reply.content | formatter"></p>
						</div>

						<div class="ui hot-layer-2 segment right aligned segmentfooter" ng-if="reply.reply_del == 0">
							<a class="ui horizontal label" ng-if="(article.my_reply.indexOf(reply.id) != -1 )" ng-click="removeReply(reply.id)">刪除</a> {{ reply.reply_time | relativeTime }}</a>
						</div>
					</div>

					<div class="ui horizontal divider" ng-if="replyList.length">回覆</div>

					<!-- 回覆 -->
					<div class="ui segments" id="rf-{{$index+1}}" ng-repeat="reply in replyList |  filter:{ hot:0 }">
						<div class="ui {{ (article.my_reply.indexOf(reply.id) != -1 ) ? 'my-reply' : 'basic secondary' }} segment" ng-if="reply.reply_del == 0">

							<h4 class="ui header">
								<i class="ui circular tiny {{ reply.reply_gender | gender }} icon"></i>
								<div class="content">{{ reply.reply_author }}
									<div class="sub header">
										<span class="ui horizontal grey basic replybtn">{{ $index+1 }}F</span> <i class="ui bookmark brown icon" ng-if="article.yuanPO.indexOf(reply.id) != -1"></i>
									</div>
								</div>
							</h4>

							<div class="ui {{ (article.my_reply.indexOf(reply.id) != -1 ) ? 'my-reply' : 'lightblue' }} top right attached label reply_like_btn" isrlike="{{ (article.reply_liked.indexOf(reply.id) != -1 ) ? 'true' : 'false' }}" replyid="{{ reply.id }}">
								<i class="{{ (article.reply_liked.indexOf(reply.id) != -1 ) ? 'islike-pink' : 'empty' }} heart large icon"></i><span class="reply_likecount">{{ reply.reply_like_count }}</span>
							</div>
							<p class="reply-content" ng-bind-html="reply.content | formatter"></p>
						</div>


						<div class="ui basic secondary disabled segment" ng-if="reply.reply_del == 1">
							<div class="ui small black header">
								<a class="ui horizontal grey basic label replybtn" href="#rf-{{ $index+1 }}">{{ $index+1 }}F</a> <i>消失的無影無蹤</i>
							</div>
						</div>

						<div class="ui {{ (article.my_reply.indexOf(reply.id) != -1 ) ? 'my-reply' : 'secondary' }} segment right aligned segmentfooter" ng-if="reply.reply_del == 0">

							<div class="ui simple left dropdown">
								<div class="text">{{ reply.reply_time | relativeTime }}</div>
								<i class="dropdown icon"></i>
								<div class="menu">
									<a class="item" ng-if="(article.my_reply.indexOf(reply.id) != -1 )" ng-click="removeReply(reply.id)">刪除</a>
									<a class="item" ng-click="reportReply(reply.id)">檢舉</a>
								</div>
							</div>

						</div>
					</div>

					<div infinite-scroll="loadReply()" infinite-scroll-distance="0" infinite-scroll-disabled="noMoreReply || !scroll_switch_reply" infinite-scroll-container="'#article_modal'"></div>

					<div class="ui orange basic fluid button" ng-click="loadReply(); $(this).remove();" ng-hide="noMoreReply">
						<p>載入更多回應</p>
					</div>

				</div> <!-- end of description class -->

			</div> <!-- end of content class -->
		</div>

	<?php if ( $this->session->userdata('ts') ) { ?>
		<form id="reply-imgur" method="post" enctype="multipart/images" hidden>
			<input id="reply-choose-image" name="userImage" type="file" accept="image/*">
			<input type="submit" class="ui button blue" value="上傳" id="reply-upload">
		</form>

		<!-- 檢舉輸入框 -->
		<div class="ui small modal" id="article-report">
			<i class="close icon"></i>
			<div class="header">
				檢舉文章
			</div>
			<div class="content">
				<div class="ui form">
					<div class="field">
						<label>文章標題</label>
						<p>{{ article.result.art_name }}</p>
					</div>

					<div class="field">
						<textarea ng-model="articleReportDesc" maxlength="100" placeholder="ex. 辱罵、恐嚇其他人、性別歧視、洩露身分。賽拉涅提醒你，惡意檢舉別人或檢舉理由不明確，是會視情況暫時停止使用或刪除帳號的喔！"></textarea>
						<p>{{ articleReportError }}</p>
					</div>
				</div>
			</div>
			<div class="actions">
				<div class="ui cancel lightblack notinverted button">沒事</div>
				<div class="ui darkred notinverted button" ng-click="articleReport()">檢舉</div>
			</div>
		</div>

	<?php } ?>

	</div> <!-- end of column -->

</div>  <!-- end of ui grid (container) -->

<!-- 功能選單 -->
<div ng-cloak class="ui five attached black buttons" id="reply-bar">
	<?php if ( $this->session->userdata('ts') ) { ?>
	<div class="ui button modal-cancel"><i class="remove circle icon"></i></div>
	<div class="ui button" id="reply"><i class="comment icon"></i></div>
	<div class="ui button" id="report"><i class="thumbs down icon"></i></div>
	<?php } ?>
	<!-- <div class="ui button scroll-to-bottom-onmodal"><i class="arrow circle down icon"></i></div>
	<div class="ui button scroll-to-top-onmodal"><i class="arrow circle up icon"></i></div> -->
</div>

<div class="ui basic modal legal-age-modal">
	<div class="ui icon header"><i class="ban icon"></i> 年齡確認 </div>
	<div class="content">
		<p align="center">您即將進入年齡分級看板，請確認您符合年齡限制，未滿 18 歲者，請立即離開。</p>
	</div>
	<div class="actions">
		<div class="ui darkred notinverted cancel button"><i class="remove icon"></i> 我未滿18歲 </div>
		<div class="ui green ok button"><i class="checkmark icon"></i> 是的，我已年滿18歲 </div>
	</div>
</div>

<script type="text/javascript">
// Mobile hide modal
if ( window.DeviceMotionEvent == undefined ) {
	void(0);
}
else {

	window.ondeviceorientation = function(event) {
		alpha = Math.round(event.alpha);
		beta = Math.round(event.beta);
		gamma = Math.round(event.gamma);
	}

	setInterval(function() {
		if ( beta <= Number(-20)  ) {
			$('#article_modal').modal('hide');
		}
	}, 500);

}
// Mobile Fix
$.fn.mobileFix = function (options) {

    $(document)
    .on('focus', options.inputElements, function(e) { })
    .on('blur', options.inputElements, function(e) {

        setTimeout(function() {
            $(document).scrollTop($(document).scrollTop())
        }, 100);

    });

    return this;
};

</script>
