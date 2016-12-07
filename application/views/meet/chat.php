<div class="ui grid stackable container">
    <div class="ui sixteen wide column">
        <div class="ui grid">

            <div class="four wide column">

                <div class="ui top attached tabular menu">
                    <a class="item active" data-tab="first"><i class="user icon"></i>資料</a>
                    <a class="item" data-tab="second"><i class="heart icon"></i>關注</a>
                </div>

                <div class="ui bottom attached tab segment active" data-tab="first" id="profile"></div>
                <div class="ui bottom attached tab segment" data-tab="second">
                    <div class="ui segment basic">
                        <div class="ui divided items scrollbar-black" style="max-height:475px;overflow-y:auto;" id="userKeywords"></div>
                    </div>
                </div>

            </div>

            <div class="eight wide column">

                <div id="messagesDiv" class="ui segment loading" style="min-height:522px;max-height:522px;overflow-y:auto;"></div>

                <div class="ui fluid icon input">
                    <input type="text" id="messageInput" placeholder="說些什麼...">
                    <i class="send icon"></i>
                </div>

            </div>

            <div class="four wide column">

                <h3 class="ui header centered">Meet</h3>
                <div class="ui segment basic center aligned scrollbar-black" id="matchKeywords" style="min-height:200px;max-height:200px;overflow-y:auto;"></div>
                <div class="ui raised segment basic" id="me"></div>

            </div>
        </div>
    </div>
</div>

<style media="screen">
    .node circle {
      cursor: pointer;
      stroke: #3182bd;
      stroke-width: 1.5px;
    }

    .node text {
      font: 10px sans-serif;
      pointer-events: none;
      text-anchor: middle;
    }

    line.link {
      fill: none;
      stroke: #9ecae1;
      stroke-width: 1.5px;
    }
</style>

<script src="//localhost/selene_ci/assets/chat-d3.js"></script>
<script>

    var userKeywords = new Array(); // 對方所有關鍵字
    var userFirstname;

    // 判斷是否為好友
    $.ajax({
        type: 'post',
        url: '//localhost/selene_ci/meet/isfriend/query',
        dataType: 'json',
        data: {
            other : "<?=$id?>",
        },
        error: function (xhr) {
            errorMsg();
        },
        success: function (response) {
            var response = $.parseJSON(JSON.stringify(response));

            if (response.status == false) {
                window.location.href = '//localhost/selene_ci/distance';
            }
        }
    });


    var matchKeywordArr = new Array();
    // 取得對方與我相同關鍵字
    $.ajax({
        type: 'post',
        url: '//localhost/selene_ci/meet/MatchKeywords/query',
        dataType: 'json',
        data: {
            username : "<?=$id?>",
        },
        error: function (xhr) {
            errorMsg();
        },
        success: function (response) {

            var response = $.parseJSON(JSON.stringify(response));

            $.each(response.result, function(i) {
                $("#matchKeywords").append('<a class="ui basic label explan" coll="' + response.result[i].collections + '" field="' + response.result[i].field + '" itemId="' + response.result[i].itemid + '">' + response.result[i].name + '</a>');
                matchKeywordArr[i] = response.result[i].name;
            });
        }
    });

    // 顯示關鍵字說明
    var click_coll, content;
    $(document).on('click', '.explan', function(){

        click_coll = $(this).attr('coll');

        $(this).attr('coll');
        $.ajax({
            type: 'post',
            url: '//localhost/selene_ci/meet/keywordsExplan/query',
            dataType: 'json',
            data: {
                coll   : $(this).attr('coll'),
                field  : $(this).attr('field'),
                itemid : $(this).attr('itemid'),
            },
            error: function (xhr) {
                errorMsg();
            },
            success: function (response) {

                var response = $.parseJSON(JSON.stringify(response));

                switch (click_coll) {
                    case "accounts":
                        content = '專頁名稱：' + response.result[0].name + '<br />分類：' + response.result[0].category + '<br />關於：' + response.result[0].about;
                        break;
                    case "events":
                        content = '活動名稱：' + response.result[0].name + '<br />活動連結：' + response.result[0].eventId + '<br />活動簡介：' + response.result[0].description;
                        break;
                    case "groups":
                        content = userFirstname + '已參加的社團名稱：' + response.result[0].name;
                        break;
                    case "videos":
                        content = '貼文網址：' + response.result[0].postId + '<br />貼文內容：' + response.result[0].description;
                        break;
                    case "videos_comments":
                        content = '貼文網址：' + response.result[0].postId + '<br />回覆總內容：' + response.result[0].comments.replace('，', '<br />');
                        break;
                    case "posts":
                        content = '貼文網址：' + response.result[0].postId + '<br />貼文內容：' + response.result[0].message;
                        break;
                    case "fanspage":
                        content = '專頁名稱：' + response.result[0].name + '<br />粉絲人數：' + response.result[0].fan_count
                        + (response.result[0].website == '' ? '' : '<br />官方網站：' + response.result[0].website) + '<br/ >專頁簡介：' + response.result[0].about.replace('，', 'a');
                        break;
                    default:

                }
                Messenger().post({
                    message: content,
                    type: "info",
                    showCloseButton: true,
                    hideAfter: 0,
                });

            }
        });
	});

    // 搜尋陣列
    function arrSearch(arr, obj) {
        for(var i = 0; i < arr.length; i++) {
            if (arr[i] == obj) return true;
        }
    }


    // 取得對方所有關注的關鍵字
        $.ajax({
        	type: 'post',
        	url: '//localhost/selene_ci/meet/userKeywords/query',
        	dataType: 'json',
            data:{
                id : "<?=$id?>",
            },
        	error: function (xhr) {
        		errorMsg();
        	},
        	success: function (response) {
        		var response = $.parseJSON(JSON.stringify(response));

        		if (response.status == true) {

                    $.each(response.result, function(i) {

                        // 將共同關鍵字底色設為藍
                        if (arrSearch(matchKeywordArr, response.result[i].keywords)) {
                            $("#userKeywords").append('<a class="ui lightyellow-keywords basic label">' + response.result[i].keywords + '</a>');
                        }
                        else{
                            $("#userKeywords").append('<a class="ui basic label">' + response.result[i].keywords + '</a>');
                        }
                        userKeywords[i] = response.result[i].keywords;
                    });
                }
        	}
        });



    // 取得對方個資
    $.ajax({
        type: 'post',
        url: '//localhost/selene_ci/meet/chatProfile/query',
        dataType: 'json',
        data: {
            username : "<?=$id?>",
        },
        error: function (xhr) {
            errorMsg();
        },
        success: function (response) {

            var response = $.parseJSON(JSON.stringify(response));
            userFirstname = response.result[0].name;

            $("#profile").append(
                '<div class="column">' +
                    '<div class="ui card fluid">' +
                        '<a class="ui">' +
                            '<div class="image-square image radius-4" style="background-image: url(' + response.result[0].pic + ')"></div>' +
                        '</a>' +
                    '</div>' +
                '</div>' +
                '<table class="ui very basic table">' +
                    '<tbody>' +
                    '<tr>' +
                        '<td class="three wide table-th">姓名</td>' +
                        '<td>' + response.result[0].name + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td class="three wide table-th">生日</td>' +
                        '<td>' + response.result[0].birthday + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td class="three wide table-th">學歷</td>' +
                        '<td>' + response.result[0].education + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td class="three wide table-th">性別</td>' +
                        '<td>' + response.result[0].gender + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td class="three wide table-th">居住地</td>' +
                        '<td>' + response.result[0].location + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td class="three wide table-th">網站</td>' +
                        '<td>' + response.result[0].website + '</td>' +
                    '</tr>' +
                    '</tbody>' +
                '</table>'
            );

            // call ajax query 對方興趣
            $.ajax({
                type: 'post',
                url: '//localhost/selene_ci/meet/MatchKeywords/d3/query',
                dataType: 'json',
                data: {
                    username : "<?=$id?>",
                },
                error: function (xhr) {
                    errorMsg();
                },
                success: function (response) {
                    var response = $.parseJSON(JSON.stringify(response));
                    root = response;
                    root['name'] = userFirstname; // 額外注入姓名
                    update(); // 產生d3
                }
            });

        }
    });


    // 即時聊天
    (function (document, $) {

        loadJS('https://cdn.firebase.com/js/client/1.1.1/firebase.js', function () {

            var myDataRef = new Firebase('https://selene.firebaseio.com/');

            $('#messageInput').keypress(function (e) {
                if (e.keyCode == 13 && $('#messageInput').val() != '') {
                    var text = $('#messageInput').val();
                    myDataRef.push({
                        name: "<?=$rndcode?>", // 傳送者
                        receiver: "<?=$id?>", // 接收者
                        text: text
                    });
                    $('#messageInput').val('');
                    $('#messagesDiv').scrollTop($('#messagesDiv')[0].scrollHeight);
                }
            });

          myDataRef.on('child_added', function (snapshot) {
            var message = snapshot.val();
            displayChatMessage(message.name, message.receiver, message.text);
          });

          function displayChatMessage(name, receiver, text) {

              $("#messagesDiv").removeClass('loading'); // loading
              if (( name == "<?=$rndcode?>" && receiver == "<?=$id?>" ) || ( name == "<?=$id?>" && receiver == "<?=$rndcode?>" )) {
                  if (name == "<?=$rndcode?>") {
                      $("#messagesDiv").append(
                        '<div class="content" style="margin-bottom:20px;">'+
                            '<a class="ui label" style="background-color:#FFD972;">' +
                                text +
                            '</a>' +
                        '</div>'
                      );
                  }
                  else if (name == "<?=$id?>"){

                      $("#messagesDiv").append(
                        '<div class="content" style="margin-bottom:20px;">'+
                            '<a class="ui label">' +
                            '<i class="user icon"></i>'+
                                text +
                            '</a>' +
                        '</div>'
                      );
                  }
              }

          };
        });


        function loadJS(src, callback) {
            var head = document.getElementsByTagName("head")[0],
            script = document.createElement('script');
            script.src = src;
            script.onload = callback;
            script.onerror = function (e) {
                alert("failed: " + JSON.stringify(e));
            };
            head.appendChild(script);
            head.removeChild(script);
        }}(document, jQuery));

    $('.menu .item').tab();

</script>
