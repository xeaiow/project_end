<div class="ui grid stackable container">
    <div class="ui sixteen wide column">
        <div class="ui grid">

            <div class="sixteen wide column">
                <h3 class="ui header centered">距離</h3>
                <div class="ui segment">
                    <div class="ui divided items" id="distance"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    loadUserInfo();
    var userKeywords = new Array(); // 對方所有關鍵字


    function loadUserInfo () {
        $.ajax({
        	type: 'post',
        	url: '//localhost/selene_ci/meet/keywords/query',
        	dataType: 'json',
        	error: function (xhr) {
        		errorMsg();
        	},
        	success: function (response) {
        		var response = $.parseJSON(JSON.stringify(response));

        		if (response.status == true) {

                    for (var i = 0; i < response.result.length; i++) {
                        $.ajax({
                            type: 'post',
                            url: '//localhost/selene_ci/meet/userMatchKeywordsCount/query',
                            dataType: 'json',
                            data: {
                                keywords : response.result[i].keywords,
                            },
                            error: function (xhr) {
                                errorMsg();
                            },
                            success: function (response) {
                                var response_m = $.parseJSON(JSON.stringify(response));

                                if (response_m.status == true) {

                                    console.log((response_m.result[i].username != undefined ? response_m.result[i].username : ''));
                                }
                            }
                        });
                    }
                }
        	}
        });
    }


</script>
