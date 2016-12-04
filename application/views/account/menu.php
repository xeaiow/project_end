	<div class="ui grid stackable container" ng-controller="AccountCtrl">
	    <div class="three wide computer tablet only column">
	        <div class="ui vertical text menu">
				<div class="item">
					<div class="menu">
	                    <a id="menu-all" class="item" href="<?=base_url('distance')?>"><h5 class="ui header"><i class="street view icon"></i>距離</h5></a>
	                    <a id="menu-all" class="item" href="<?=base_url('place')?>"><h5 class="ui header"><i class="marker icon"></i>環遊</h5></a>
	                </div>
				</div>
	        </div>
	    </div>

		<div class="three wide mobile only column" id="menu-list-account">

			<div class="ui selection fluid dropdown">
				<input type="hidden" onchange="window.location.href = '<?php echo base_url(); ?>' + $(this).val()">
				<i class="dropdown icon"></i>
				<div class="default text"><i class="user icon"></i>我</div>
				<div class="menu">
					<a id="menu-all" class="item" href="<?=base_url('distance')?>"><h5 class="ui header"><i class="street view icon"></i>距離</h5></a>
					<a id="menu-all" class="item" href="<?=base_url('place')?>"><h5 class="ui header"><i class="marker icon"></i>環遊</h5></a>
				</div>
			</div>

		</div>
