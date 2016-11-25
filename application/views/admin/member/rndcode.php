<div class="thirteen wide stackable grid column" ng-controller="MemberQueryCtrl" ng-init="memberId='<?php echo $rndcode?>'; getMemberInfo();getMemberArticle();">

	<!-- 主要資料顯示 -->
	<div class="ui segment bg2 center aligned">
		<div class="ui card centered">
			<div class="content center aligned">
				<i class="ui circular notinverted {{ member.gender | gender }} icon"></i> {{ member.firstname }}
			</div>
			<div class="image">

			<div class="image-square image radius-4" style="background-image: url({{( member.pic.startsWith('userimg') ? 'https://selene.tw/'+member.pic : member.pic  )}})"></div>

			</div>
			<div class="content">
				{{ member.sc_name }} {{ member.de_name }}系
			</div>
			<div class="content articleListItem" id="member-email" ngclipboard data-clipboard-target="#member-email">
				{{ member.email }}
			</div>
			<div class="content articleListItem" id="member-rndcode" ngclipboard data-clipboard-target="#member-rndcode">
				{{ member.rndcode }}
			</div>
			<div class="ui grey horizontal label" ng-show="{{ member.stop == '1' }}">停抽</div>
			<div class="ui red horizontal label" ng-show="{{ member.online == '1' }}">封鎖</div>
			<div class="ui green horizontal label" ng-show="{{ member.inspect == '0' }}">待審</div>
			<div class="ui yellow horizontal label" ng-show="{{ member.wrn == '1' }}">警告</div>
		</div>
	</div>
	<!-- 主要資料顯示 END -->

	<!-- 自介專長 -->
	<div class="ui segment top attached">
		<table class="ui very basic table">
			<tbody>
		        <tr>
		            <td class="three wide table-th">自介</td>
		            <td>{{ member.introduction }}</td>
		        </tr>
				<tr>
		            <td class="three wide table-th">興趣專長</td>
		            <td>{{ member.specialty }}</td>
		        </tr>
				<tr>
		            <td class="three wide table-th">簽名檔</td>
		            <td>{{ member.signature }}</td>
		        </tr>
				<tr>
		            <td class="three wide table-th">註冊時間</td>
		            <td>{{ member.reg_date }}</td>
		        </tr>
				<tr>
		            <td class="three wide table-th">最後抽涅友日</td>
		            <td>{{ member.last_seen }}</td>
		        </tr>
				<tr>
		            <td class="three wide table-th">Coin</td>
		            <td>{{ member.coin }}</td>
		        </tr>
			</tbody>
		</table>
	</div>
	<div class="ui bottom attached nav-blue notinverted button" ng-click="inspectMember()" ng-init="member.rndcode" ng-show="{{ member.inspect == '0' }}">審核</div>
	<!-- 自介專長 END -->

	<!-- 違規紀錄 -->
	<div class="ui segment">
		<h2 class="ui header">
			<i class="warning sign icon"></i>
			<div class="content">
				違規紀錄
			</div>
		</h2>

		<table class="ui very basic table">
			<thead>
				<tr>
					<th>項目</th>
					<th>解除方式</th>
					<th>發送狀態</th>
					<th>改善狀態</th>
					<th>發送時間</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
	<!-- 違規紀錄 END -->

	<!-- 文章列表 -->
	<div class="ui segment">

		<h2 class="ui header">
			<i class="bookmark icon"></i>
			<div class="content">
				文章列表
			</div>
		</h2>

		<table class="ui very basic table">
			<thead>
				<tr>
					<th>標題</th>
					<th>討論板</th>
					<th>時間</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="article in articleList">
					<td>
						<a href="<?php echo base_url('pineapple/article')?>/{{ article.id }}">{{ article.art_name }}</a>
					</td>
					<td>
						<a href="<?php echo base_url('a')?>/{{ article.di_code }}">{{ article.di_name }}</a>
					</td>
					<td>
						{{ article.time }}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- 文章列表 END -->

</div>
