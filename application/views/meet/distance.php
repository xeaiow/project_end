<div class="ui sixteen wide column fluid">

    <!-- 距離列表 -->
    <div ng-cloak class="ui basic segment stackable four column doubling grid" id="friends-list"></div>

</div>

</div> <!-- end of container -->

<script>

    var userKeywords = new Array(); // 對方所有關鍵字
    var matchUser = new Array();
    var counts;

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
                        userKeywords[i] = response.result[i].keywords;
                    }
                }
                findMatch();
        	}
        });

        function findMatch () {
            $.ajax({
                type: 'post',
                url: '//localhost/selene_ci/meet/userMatchKeywordsCount/query',
                dataType: 'json',
                data: {
                    keywords : userKeywords,
                },
                error: function (xhr) {
                    errorMsg();
                },
                success: function (response) {
                    var response = $.parseJSON(JSON.stringify(response));

                    if (response.status == true) {

                        // 跑出跟我關鍵字重複的 username，存入 matchUser 待運算重複數
                        $.each(response.result, function(i) {
                            matchUser[i] = response.result[i].username;
                        });

                        // 計算使用者重複數
                        matchUser.forEach(function(x) { counts[x] = (counts[x] || 0)+1; });
                        loadMatchUserThree();
                    }
                }
            });
        }

        function loadMatchUserThree () {

            for (var i = 0; i < Object.keys(counts).length; i++) {
                $.ajax({
                    type: 'post',
                    url: '//localhost/selene_ci/meet/matchKeywordsThree/query',
                    dataType: 'json',
                    data: {
                        matchUsername : Object.keys(counts)[i],
                    },
                    error: function (xhr) {
                        errorMsg();
                    },
                    success: function (response) {
                        var response = $.parseJSON(JSON.stringify(response));

                        if (response.status == true) {

                            $("#friends-list").append(
                                '<div class="column">' +
                                    '<div class="ui card fluid">' +
                                        '<a class="ui" target="_self">' +
                                            '<div class="image-square image radius-4" style="background-image: url()"></div>' +
                                        '</a>' +
                                        '<div class="content">' +
                                            '<a class="header center aligned">' +
                                                response.result[0].sc_name + ' ' + response.result[0].de_name + '系' +
                                            '</a>' +
                                            '<div class="meta aligned">' + response.result[0].sc_name + '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>'
                            );
                            console.log(response.result);
                        }
                    }
                });
            }
        }
</script>
