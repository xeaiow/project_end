    <div class="ui thirteen wide column" id="display_article" ng-init="archive()">

        <table ng-cloak class="ui selectable very basic table">
            <thead>
                <tr>
					<th class="one wide"><i class="heart red icon"></i></th>
					<th class="one wide"><i class="comments grey icon"></i></th>
					<th class="nine wide"><i class="bookmark icon"></i></th>
                    <th class="three wide"></th>
                    <th class="two wide">收藏時間</th>
                </tr>
            </thead>
            <tbody>
				<tr class="pointer" ng-repeat="archive in archiveList" ng-click="goto( archive.di_code + '/' + archive.arc_post )">
					<td>{{ archive.like_count }}</td>
					<td>{{ archive.reply_count }}</td>
					<td>{{ archive.art_name }}</td>
					<td>{{ archive.di_name }}</td>
					<td>{{ archive.arc_time | relativeTime }}</td>
				</tr>
			</tbody>
        </table>

		<div infinite-scroll="archive()" infinite-scroll-distance="0" infinite-scroll-disabled="noArchive || !scroll_switch_archive"></div>

		<div ng-cloak class="ui success message" ng-if="noArchive">
			<p>沒有更多收藏了</p>
		</div>
		<div ng-cloak class="ui negative message" ng-if="failLoading">
			<p>載入失敗</p>
		</div>

    </div>
