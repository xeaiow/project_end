<style type="text/css"> body { background: url('<?=base_url()?>assets/img/boy.png') no-repeat bottom 10px left 50px fixed; } </style>

<div class="ui stackable grid container">

	<div class="row">

		<div class="eight wide column center aligned centered">
			<div class="ui basic segment">
				<h2 class="ui header">
					<div class="content">
						加入 Selene
					</div>
				</h2>
			</div>

			<form class="ui large form" action="<?php echo base_url() ?>admin/login" method="post" accept-charset="utf-8">

				<div class="ui segment">

					<div class="field">
						<button type="button" class="ui button brown fluid basic select-pic"><i class="cloud upload icon"></i> 選擇頭貼</button>
					</div>

					<div class="field">
						<div class="ui right icon input">
							<i class="child grey icon"></i>
							<input type="text" placeholder="真實姓名" autofocus>
						</div>
					</div>

					<div class="field">
						<div class="ui right icon input">
							<i class="birthday grey icon"></i>
							<input type="text" placeholder="生日">
						</div>
					</div>

					<div class="field">
						<select class="ui dropdown">
							<option value="">性別</option>
							<option value="1">男孩</option>
							<option value="0">女孩</option>
						</select>
					</div>

					<input type="file" class="select-pic-file" style="display:none;" />

					<div class="field">
						<select class="ui dropdown">
							<option value="">我的學校</option>
							<option value="1">健行科大</option>
							<option value="2">龍華科大</option>
							<option value="3">中華科大</option>
							<option value="4">開南大學</option>
							<option value="5">弘光科大</option>
						</select>
					</div>

					<div class="field">
						<select class="ui dropdown">
							<option value="">我的系所</option>
							<option value="1">資訊管理系</option>
							<option value="2">資訊工程系</option>
							<option value="3">航空太空工程系</option>
							<option value="4">物理系</option>
							<option value="5">應用外語系</option>
						</select>
					</div>

					<div class="field">
						<div class="ui right icon input">
							<i class="mail grey icon"></i>
							<input type="text" name="email" placeholder="校園信箱">
						</div>
					</div>
					<div class="field">
						<div class="ui center icon input">
							<i class="lock grey icon"></i>
							<input type="password" name="password" placeholder="密碼">
						</div>
					</div>
					<div class="field">
						<div class="ui center icon input">
							<i class="lock grey icon"></i>
							<input type="password" name="password" placeholder="確認密碼">
						</div>
					</div>
					<div class="ui positive message">
						<div class="header">
							<a href="private.txt">會員條款</a>
						</div>
						<ul class="list">
							<li>點擊註冊表示您同意會員條款</li>
							<li>本站保有隨時調動條款之權利</li>
						</ul>
					</div>
					<div class="ui fluid large green submit button">加入！</div>

				</div> <!-- END OF SEGMENT-->

				<div class="ui message">
					<a href="<?php echo base_url(); ?>login">已有帳號，立即登入</a>
				</div>

			</form>

		</div> <!-- END OF EIGHT WIDE COLUMN -->

	</div> <!-- END OF ROW -->

</div> <!-- END OF CONTAINER -->


<!-- Select Picture -->
<div class="ui basic modal select-pic-modal">

	<i class="close icon"></i>

	<div class="header">
		選擇大頭貼
	</div>

	<div class="image content">
		<div class="image">
			<i class="child icon"></i>
		</div>
		<div class="description">
			<ul class="list">
				<li>清晰露出五官的正面生活照片</li>
				<li>沒有人想跟動漫人物/卡通人物/明星/花草/風景交朋友</li>
				<li>照片中只能有你自己，不可以是合照</li>
				<li>請遵守中華民國法律，不可以是違反善良風俗的照片</li>
				<li>檔案限制: 2MB</li>
			</ul>
		</div>
	</div>

	<div class="actions">
		<div class="two fluid ui inverted buttons">
			<div class="ui red basic inverted button select-pic-no">
				<i class="remove icon"></i>
				不能接受
			</div>
			<div class="ui green basic inverted button select-pic-yes">
				<i class="checkmark icon"></i>
				我會遵守
			</div>
		</div>
	</div>
</div> <!-- END OF SELECT PIC MODAL -->
