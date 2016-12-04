<div class="ui grid stackable container">
    <div class="ui sixteen wide column">
        <div class="ui grid">

            <div class="four wide column">

                <div class="ui top attached tabular menu">
                    <a class="item active" data-tab="first">資料</a>
                    <a class="item" data-tab="second">關注</a>
                    <a class="item" data-tab="third">D3.js</a>
                </div>

                <div class="ui bottom attached tab segment active" data-tab="first" id="profile"></div>
                <div class="ui bottom attached tab segment" data-tab="second">
                    <div class="ui segment basic">
                        <div class="ui divided items">
                            <p id="userKeywords"></p>
                        </div>
                    </div>
                </div>

                <div class="ui bottom attached tab segment" data-tab="third">
                    <div class="ui raised segment basic">
                        <p>
                            d3.js
                        </p>
                    </div>
                </div>

            </div>

            <div class="eight wide column">

                <div id="messagesDiv" class="ui segment" style="min-height:522px;max-height:522px;overflow-y:auto;"></div>

                <div class="ui icon input">
                    <input type="text" id="messageInput" placeholder="說些什麼...">
                    <i class=" circular send link icon"></i>
                </div>

            </div>

            <div class="four wide column">
                <h3 class="ui header centered">關鍵字</h3>
                <div class="ui segment basic center aligned" id="matchKeywords"></div>
            </div>
        </div>
    </div>
</div>

<script>

    var userKeywords = new Array(); // 對方所有關鍵字
    var userFirstname;

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
                        $("#userKeywords").append('<a class="ui nav-blue notinverted label">' + response.result[i].keywords + '</a>');
                        userKeywords[i] = response.result[i].keywords;
                    });
                }
        	}
        });


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
                $("#matchKeywords").append('<a class="ui nav-blue notinverted label">' + response.result[i].keywords + '</a>');
            });
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
        }
    });



    // 即時聊天
    (function (document, $) {

        loadJS('https://cdn.firebase.com/js/client/1.1.1/firebase.js', function () {

            var myDataRef = new Firebase('https://selene.firebaseio.com/');

            $('#messageInput').keypress(function (e) {
                if (e.keyCode == 13) {
                    var text = $('#messageInput').val();
                    myDataRef.push({
                        name: "<?=$rndcode?>", // 傳送者
                        receiver: "<?=$id?>", // 接收者
                        text: text
                    });
                    $('#messageInput').val('');
                }
            });

          myDataRef.on('child_added', function (snapshot) {
            var message = snapshot.val();
            displayChatMessage(message.name, message.receiver, message.text);
          });

          function displayChatMessage(name, receiver,text) {

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




            $('#messagesDiv')[0].scrollTop = $('#messagesDiv')[0].scrollHeight;
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
      }

    }(document, jQuery));

    $('.menu .item').tab();

</script>
