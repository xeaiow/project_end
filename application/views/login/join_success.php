<div class="ui stackable grid container">

	<div class="row">

		<div class="eight wide column centered">

			<div class="ui basic segment">
				<h2 class="ui header center aligned">
					恭喜你準備成為 Selene 的一份子！
					<div class="sub header">
						現在，請你進入學校信箱收取認證信
					</div>
				</h2>
			</div>

			<div class="ui segment">
				<a href="<?php echo $school['sc_url']; ?>" target="_blank" class="fluid ui teal button">點我去收啟用信 (<?php echo $school['sc_name']; ?>)</a>
                <div class="ui relaxed divided list">
                    <div class="item">
                        <i class="large comment middle aligned icon"></i>
                        <div class="content">
                            <a class="header">我收不到信</a>
                            <div class="description">請先檢查垃圾信件、系統不同收到的時間也有所差異。</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large comment middle aligned icon"></i>
                        <div class="content">
                            <a class="header">找不到我的系所</a>
                            <div class="description">請點選 feedback ，我們立即為您修正。</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large comment middle aligned icon"></i>
                        <div class="content">
                            <a class="header">我的帳號是什麼？</a>
                            <div class="description">帳號為申請時所填寫的校園信箱。</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large comment middle aligned icon"></i>
                        <div class="content">
                            <a class="header">我忘記密碼了</a>
                            <div class="description">請點選 "忘記密碼" 並填寫申請時的校園信箱，再去校園信箱收確認信即可。</div>
                        </div>
                    </div>
                </div>
			</div> <!-- END OF SEGMENT-->

		</div> <!-- END OF EIGHT WIDE COLUMN -->

	</div> <!-- END OF ROW -->

</div> <!-- END OF CONTAINER -->

<style type="text/css"> body { background: url('<?=base_url()?>assets/img/boy.png') no-repeat bottom 10px left 50px fixed; } </style>
