<div class="ui grid stackable container" ng-controller="AccountCtrl" ng-init="userId='<?=$id?>';loadKeyWords()">
    <div class="ui sixteen wide column">
        <div class="ui grid">

            <div class="four wide column">
                <h3 class="ui header centered">對方</h3>
                <div class="ui segment">
                    <div class="ui divided items">
                        <p id="keywords"></p>
                    </div>
                </div>
                <div class="ui raised segment">
                    <p>
                        d3.js
                    </p>
                </div>
            </div>

            <div class="eight wide column">

                <div class="ui segments">

                    <div class="ui segment scrollbar-black" id="talk-list">

            			<div class="ui very relaxed list">

            				<div class="item" ng-repeat="talk in talkList">
            					<!-- <i class="ui avatar {{ (talk.me == 1) ? 'chevron right' : '' }} icon"></i> -->
            					<div class="content">
            						<h4 class="ui {{ (talk.me == 1) ? 'blue' : 'brown' }} header" ng-bind=" (talk.me == 1) ? '我' : talk.name"></h4>
            						<div class="description">
            							<p ng-bind-html="talk.content | formatter"></p>
            						</div>
            					</div>

            				</div>

        					<div infinite-scroll="getTalk()" infinite-scroll-distance="0"  infinite-scroll-container="'#talk-list'" infinite-scroll-disabled="noMoreTalk || !scroll_switch_talk"></div>

            			</div>

        				<div ng-cloak class="ui warning message" ng-if="noTalk">
        					<p>迷 U 更多私訊了，快去聊天吧！</p>
        				</div>
        				<div ng-cloak class="ui negative message" ng-if="failLoading">
        					<p>載入失敗</p>
        				</div>

                    </div>

                    <div class="ui attached segment">

                        <div class="ui grid stackable">
                            <div class="ui sixteen wide column">
                                <div contenteditable="plaintext-only" class="ui segment talk-content" placeholder="跟對方聊個天..." id="friendMessage" ng-model="friendMessage"></div>
                            </div>
                        </div>
                    </div>

                    <div class="ui two buttom attached buttons">
                        <button class="ui button gentleman-red notinverted talk-select-pic"><i class="file image outline icon"></i></button>
                        <button class="ui button nav-blue notinverted talk-send" ng-click="sendTalk()"><i class="send icon"></i></button>
                    </div>

                </div>

            </div>

            <div class="four wide column">
                <h3 class="ui header centered">關鍵字</h3>
                <div class="ui segment">
                    <a class="ui basic label">Basic</a>
                    <a class="ui basic label">Basic</a>
                    <a class="ui basic label">Basic</a>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    loadkeywords("<?=$id?>");
</script>
