    <div class="ui thirteen wide column">

        <div ng-cloak class="ui basic segment stackable four column doubling grid" id="friends-list"></div>

    </div>
</div>
<script>

    var userKeywords = new Array(); // 對方所有關鍵字
    var matchUser = new Array();
    var selfKeywords = new Array();
    var topThree = new Array();
    var user_loop = 0;
    var counts;
    var user_init = 0;

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
                            selfKeywords[i] = response.result[i].keywords;

                            $.ajax({
                                type: 'post',
                                url: '//localhost/selene_ci/meet/addMatchKeywords/save',
                                dataType: 'json',
                                data: {
                                    username : response.result[i].username,
                                    keywords : response.result[i].keywords,
                                },
                                error: function (xhr) {
                                    errorMsg();
                                },
                                success: function (response) {
                                }
                            });
                        });

                        // 計算使用者重複數
                        matchUser.forEach(function(x) { counts[x] = (counts[x] || 0)+1; });

                        loadMatchUserThree();
                    }
                }
            });
        }
        // TODO: 到聊天頁面再判斷是否有相同關鍵字，否則踢走
        var aa = 0;
        function loadMatchUserThree () {

            for (var i = 0; i < Object.keys(counts).length; i++) {

                if (Object.values(counts)[i] >= 3) {

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
                                            '<a class="ui" target="_self" href="' + '//localhost/selene_ci/chat/' + response.result[0].rndcode +'">' +
                                                '<div class="image-square image radius-4" style="background-image: url(' + response.result[0].pic + ')"></div>' +
                                            '</a>' +
                                            '<div class="content">' +
                                                '<a class="header center aligned">' +
                                                    response.result[0].name +
                                                '</a>' +
                                                '<div class="meta center aligned">' + response.result[0].gender + '</div>' +
                                            '</div>' +
                                            '<div class="extra content scrollbar-black keywords" style="max-height:50px;overflow-y:auto;">' +

                                            '</div>' +
                                        '</div>' +
                                    '</div>'
                                );

                                $.ajax({
                                    type: 'post',
                                    url: '//localhost/selene_ci/meet/MatchKeywords/query',
                                    dataType: 'json',
                                    data: {
                                        username : Object.keys(counts)[1],
                                    },
                                    error: function (xhr) {
                                        errorMsg();
                                    },
                                    success: function (response) {

                                        var response = $.parseJSON(JSON.stringify(response));

                                        $.each(response.result, function(i) {
                                            $('.keywords:eq('+user_init+')').append('<a class="ui basic label">' + response.result[i].keywords + '</a>');
                                        });

                                        user_init++;

                                    }
                                });
                                aa++;
                                user_loop++;

                                console.log(aa);
                            }
                        }
                    });

                }
                else{
                    aa++;
                    console.log(user_loop);
                }

            }

        }

</script>
