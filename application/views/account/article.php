    <div class="ui thirteen wide column" id="display_article" ng-init="article()">

        <table ng-cloak class="ui selectable very basic table" ng-if="articleList">
            <thead>
                <tr>
					<th class="one wide"><i class="heart red icon"></i></th>
					<th class="one wide"><i class="comments grey icon"></i></th>
					<th class="nine wide"><i class="bookmark icon"></i></th>
                    <th class="three wide"></th>
                    <th class="two wide"></th>
                </tr>
            </thead>
            <tbody>
				<tr class="pointer" ng-repeat="article in articleList" ng-click="goto( article.di_code + '/' + article.id )">
					<td>{{ article.like_count }}</td>
					<td>{{ article.reply_count }}</td>
					<td>{{ article.art_name }}</td>
					<td>{{ article.di_name }}</td>
					<td>{{ article.time.substring(0, 10) }}</td>
				</tr>
			</tbody>
        </table>

		<div infinite-scroll="article()" infinite-scroll-distance="0" infinite-scroll-disabled="noArticle || !scroll_switch_article"></div>

		<div ng-cloak class="ui success message" ng-if="noArticle">
			<p>沒有更多文章了。快去與大家分享你的趣事吧！</p>
		</div>
		<div ng-cloak class="ui negative message" ng-if="failLoading">
			<p>載入失敗</p>
		</div>

    </div>

</script>
