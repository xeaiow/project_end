<div class="thirteen wide stackable grid column" ng-controller="MemberQueryCtrl">

	<h3 class="ui header">
		會員查詢
	</h3>


	<div class="ui form">
		<div class="field">
			<input type="text" placeholder="隨機號、Email" autofocus ng-model="member_keyword" on-enter="getMember()">
		</div>
	</div>


	<div class="ui segment" ng-if="member.status">

		<table class="ui very basic table">
			<thead>
				<tr>
					<th>姓名</th>
					<th>信箱</th>
					<th>隨機號</th>
					<th>啟用</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="member in member.result">
					<td class="five wide">
						<h5 class="ui {{ (member.gender==1) ? 'blue' : 'red' }} header">
							{{ member.firstname }}
							<div class="ui sub header">
								{{ member.sc_name }} {{ member.de_name }}系
							</div>
						</h5>

					</td>
					<td class="three wide">{{ member.email }}</td>
					<td class="one wide">
						<a ng-href="<?php echo base_url(); ?>pineapple/member/{{ member.rndcode }}">{{ member.rndcode }}</a>
					</td>

					<td class="three wide">
						<!-- <div class="ui brown horizontal label" ng-show="member.status == 1">未啟</div> -->
						<div class="ui pink horizontal label" ng-show="member.stop == 1">停抽</div>
						<div class="ui red horizontal label" ng-show="member.online == 1">封鎖</div>
						<div class="ui yellow horizontal label" ng-show="member.inspect == 0">待審</div>
						<div class="ui yellow horizontal label" ng-show="member.orange == 1">警告</div>
					</td>
				</tr>
			</tbody>
		</table>

	</div>

</div>
