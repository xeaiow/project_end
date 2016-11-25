<div class="thirteen wide stackable grid column" ng-controller="ArticleListCtrl" ng-init="article_id='<?php echo ($art_id !== NULL) ? "$art_id'; getArticle();" : ""?>">

	<h3 class="ui header">
		文章查詢
	</h3>


	<div class="ui form">
		<div class="field">
			<input type="text" placeholder="文章編號" autofocus ng-model="article_id" on-enter="getArticle()">
		</div>
	</div>


	<div class="ui segment" ng-if="article.status">

		<table class="ui very basic table">
			<tbody>
				<tr>
					<td>標題</td>
					<td>
						<div class="ui red horizontal label" ng-show="article.result.art_del == 1">已刪除</div>
						<div class="ui nav-blue notinverted horizontal label" ng-show="article.result.top == 1">置頂</div>
						<a ng-href="<?php echo base_url('a').'/'?>{{article.result.di_code}}/{{article_id}}">{{ article.result.art_name }}</a>
					</td>
					<td><a ng-href="<?php echo base_url('a').'/'?>{{ article.result.di_code }}">{{ article.result.di_name }}</a></td>
				</tr>
				<tr>
					<td class="two wide">作者</td>
					<td class="eight wide">{{ article.result.sc_name }} {{ article.result.de_name }}系</td>
					<td><a ng-href="<?php echo base_url('pineapple/member').'/'?>{{ article.result.author_rndcode }}">{{ article.result.author_rndcode }}</a></td>
				</tr>
				<tr>
					<td>時間</td>
					<td colspan="2">{{ article.result.time }}</td>
				</tr>
				<tr>
					<td class="top aligned">內容</td>
					<td colspan="2"><div ng-bind-html="article.result.content | formatter"></div></td>
				</tr>
			</tbody>
		</table>
		<div class="two ui buttons">
			<button class="ui button darkred notinverted" ng-show="article.result.art_del == 0" ng-click="removeArticle()">刪除</button>
			<button class="ui button darkred notinverted" ng-show="article.result.art_del == 1" ng-click="removeArticle()">復原</button>
			<button class="ui button admin-navbar notinverted" ng-show="article.result.top == 0" ng-click="topArticle()">置頂</button>
			<button class="ui button admin-navbar notinverted" ng-show="article.result.top == 1" ng-click="topArticle()">取消置頂</button>
		</div>

	</div>

</div>
