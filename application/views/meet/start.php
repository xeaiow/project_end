<div class="ui thirteen wide column" ng-init="loadLikes()">

    <div class="ui segment bg1">
        <div class="ui special cards centered">

            <div class="card">
                <div class="blurring dimmable image">
                    <div class="ui dimmer">
                        <div class="content">
                            <div class="center">
                                <div class="ui inverted button change-pic">更換大頭貼</div>
                            </div>
                        </div>
                    </div>
                    <img src="<?= ($profile['pic'] != NULL ? ( substr($profile['pic'], 0, 7) == 'userimg' ) ? 'https://selene.tw/'.$profile['pic'] : $profile['pic'] : ($profile['gender'] == '1' ? "//i.imgur.com/cvZYCXb.png" : "http://i.imgur.com/MFPRIEs.png") ) ?>">

                </div>

                <div class="content">
                    <span class="header center aligned"><?php echo $profile['firstname']; ?> <button class="ui icon button basic change-pic"><i class="photo icon"></i></button></span>
                </div>

            </div>

        </div>

    </div>

    <div class="ui small four icon buttons fluid">
        <button class="ui button nav-blue notinverted" id="lab"><i class="lab icon"></i> 分析</button>

        <?php
            if (is_null($profile['d_acc'])) {
                echo '<button class="ui button basic grey" id="profile-short"><i class="cut icon"></i> 建立短帳號</button>';
            }
            else{
                echo '<button class="ui button basic grey disabled">'.$profile['d_acc'].'</button>';
            }
        ?>
        <button class="ui button basic grey" id="profile-edit-password"><i class="lock icon"></i> 修改密碼</button>
        <button class="ui button basic grey" id="profile-hide"><i class="hide icon"></i> 隱藏姓名 <span>(<?php echo ($profile['nameIsHide'] == 1) ? "隱藏" : "顯示"; ?>)</span></button>
    </div>

    <?php
        // 停抽涅友狀態出現提示訊息
        if ($profile['stop'] == 1 || $profile['wrn'] == 1) {
            echo '
                <div class="ui attached warning message">
                    <i class="warning sign icon"></i>
                    <strong class="ui red">目前為停止配對涅友</strong> (增加自介及興趣專長，經審核後即可啟用配對涅友功能)
                </div>
            ';
        }
    ?>

    <div class="ui segment">
        <table class="ui very basic table">
            <tbody>
                <tr>
                    <td class="three wide table-th">校名</td>
                    <td><?php echo $profile['sc_name']; ?></td>
                </tr>

                <tr>
                    <td class="table-th">系所</td>
                    <td><?php echo $profile['de_name']; ?>系</td>
                </tr>

                <tr>
                    <td class="table-th">關鍵字</td>
                    <td>籃球、程式設計、川普、房地產、高爾夫球</td>
                </tr>

                <tr>
                    <td class="table-th">我喜歡的</td>
                    <td>
                        <div class="ui form">
                            <a href="//localhost/meet/meet/fans/{{likes.id}}" target="_self" class="ui basic label" title="{{likes.id}}" ng-repeat="likes in likesList">{{likes.name}}</a>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="table-th">喜歡的活動</td>
                    <td>
                        <div class="ui form" id="profile-edit-signature">
                            <div class="field">
                                <a target="_self" class="ui basic label" ng-repeat="events in eventsList">{{events.name}}</a>
                            </div>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td class="table-th">我的專業</td>
                    <td>
                        <div class="ui form" id="profile-edit-signature">
                            <div class="field">
                                喜歡的書籍
                            </div>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>

</div> <!-- end of container -->

<!-- Change Picture -->
<div class="ui basic modal" id="change-pic-modal">
<i class="close icon"></i>
<div class="header">
    更換大頭貼
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
        <div class="ui lightblack notinverted button" id="change-pic-no">
            <i class="remove icon"></i>
            等等再換
        </div>
        <div class="ui nav-blue notinverted button" id="change-pic-yes">
            <i class="checkmark icon"></i>
            我要更換
        </div>
    </div>
    <form id="change-pic-form" method="post" enctype="multipart/images">
        <input id="change-pic-choose-image" name="userImage" type="file" accept="image/*" style="display:none;">
    </form>
</div>
</div>

<!-- Hide Name -->
<div class="ui basic modal" id="hide-name-modal">
<i class="close icon"></i>
<div class="header">
    隱藏姓名
</div>
<div class="image content">
    <div class="image">
        <i class="hide icon"></i>
    </div>
    <div class="description">
        <ul class="list">
            <li>此功能會將您的姓名隱藏</li>
            <li>隱藏姓名的功能，可控制您在對方的好友名單內、本日涅友，是否顯示本名</li>
            <li>如果開啟，僅會顯示「男孩」或「女孩」</li>
            <li>此功能僅有隱藏姓名，學校及系所仍會顯示</li>
        </ul>
    </div>
</div>
<div class="actions">
    <div class="two fluid ui inverted buttons">
        <div class="ui darkgreen notinverted button" id="hide-name-hide">
            <i class="remove icon"></i>
            隱藏
        </div>
        <div class="ui nav-blue notinverted button" id="hide-name-unhide">
            <i class="checkmark icon"></i>
            顯示
        </div>
    </div>
</div>
</div>

<!-- Profile Short -->
<div class="ui basic modal" id="profile-short-modal">
<i class="close icon"></i>
<div class="header">
    建立短帳號
</div>
<div class="image content">
    <div class="image">
        <i class="compress icon"></i>
    </div>
    <div class="description">
        <ul class="list">
            <li>自訂您常用的帳號</li>
            <li>設定短帳號後亦可使用校園信箱登入</li>
            <li>帳號長度介於4-16的英文及數字</li>
        </ul>
    </div>
</div>
<div class="actions">
    <div class="two fluid ui inverted buttons">
        <div class="ui lightblack notinverted button modal-cancel">
            <i class="remove icon"></i>
            稍等
        </div>
        <div class="ui green basic inverted button" id="profile-short-setup">
            <i class="checkmark icon"></i>
            繼續
        </div>
    </div>
</div>
</div>

<!-- Profile Short Second -->
<div class="ui small modal transition" id="profile-short-second-modal">
<i class="close icon"></i>
<div class="header">
    建立短帳號
</div>
<div class="content">
    <div class="ui form">
        <div class="ui grid">
            <div class="seven stackable column align centered">
                <div class="field">
                    <label>自訂的帳號</label>
                    <div class="ui input focus">
                        <input type="email" class="profile-short" id="profile-short-username" maxlength="16" placeholder="4-16 碼英文及數字">
                    </div>
                </div>
                <div class="field">
                    <label>密碼認證</label>
                    <div class="ui input focus">
                        <input type="password" class="profile-short" id="profile-short-password" placeholder="輸入密碼確保您是本人">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="actions">
    <div class="ui button modal-cancel">取消</div>
    <div class="ui green button" id="profile-shortened">縮短吧！</div>
</div>
</div>

<!-- Profile Edit Password -->
<div class="ui basic modal" id="profile-edit-password-modal">
<i class="close icon"></i>
<div class="header">
    修改密碼
</div>
<div class="image content">
    <div class="image">
        <i class="lock icon"></i>
    </div>
    <div class="description">
        <ul class="list">
            <li>定期更換新的密碼</li>
            <li>密碼長度介於 6-20 的英文及數字</li>
            <li>更改後請牢記新密碼</li>
        </ul>
    </div>
</div>
<div class="actions">
    <div class="two fluid ui inverted buttons">
        <div class="ui lightblack notinverted button modal-cancel">
            <i class="remove icon"></i>
            稍等
        </div>
        <div class="ui nav-blue notinverted button" id="profile-edit-password-setup">
            <i class="checkmark icon"></i>
            繼續
        </div>
    </div>
</div>
</div>

<!-- Profile Edit Password Second -->
<div class="ui small modal transition" id="profile-edit-password-second-modal">
<i class="close icon"></i>
<div class="header">
    修改密碼
</div>
<div class="content">
    <div class="ui form">
        <div class="ui grid">
            <div class="seven stackable column align centered">
                <div class="field">
                    <label>新密碼</label>
                    <div class="ui input focus">
                        <input type="password" id="profile-edit-password-password" maxlength="20" placeholder="6-20 碼英文及數字">
                    </div>
                </div>
                <div class="field">
                    <label>新密碼確認</label>
                    <div class="ui input focus">
                        <input type="password" id="profile-edit-password-ck-password" maxlength="20">
                    </div>
                </div>
                <div class="field">
                    <label>目前密碼</label>
                    <div class="ui input focus">
                        <input type="password" id="profile-edit-password-old-password" maxlength="20" placeholder="輸入密碼確保您是本人">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="actions">
    <div class="ui cancel lightblack notinverted button">取消</div>
    <div class="ui nav-blue notinverted button" id="profile-edited">確定更改</div>
</div>
</div>

<script>

$('.form textarea').focus(function(){

    var _msg = $(this).parents().eq(2).find('.message');

    $(_msg).transition('fade down').transition('show');
    $(_msg).find('span').html($(this).val().length);

    $(this).on('change keyup paste', function() {

        $('#profile-save').removeClass('disabled');
        $(_msg).find('span').html($(this).val().length);

        if ( $(this).val().length > $(this).attr('wordslimit') || $(this).val().length == 0 ) {
            $(this).parent().addClass('error');
            $('#profile-save').addClass('disabled');
        }
        else {
            $(this).parent().removeClass('error');
            $('#profile-save').removeClass('disabled').removeClass('basic');
        }

    });

    $(this).focusout(function() {
        $(_msg).transition('fade down').transition('hide');
    });

});

$("#profile-edit-password").click(function(){
    $("#profile-edit-password-modal").modal('show');
});

$("#profile-edit-password-setup").click(function(){
    $("#profile-edit-password-second-modal").modal('show');
});

</script>

<script>

    is_Today();

    FB.init({
        appId: "1708325876106482",
        xfbml      : true,
        version    : 'v2.8',
        status     : true,
        cookie     : true,
        oauth      : true,
        frictionlessRequests: true
    });

    var access_token;

    // 取得登入狀態
    FB.getLoginStatus(function(response) {
        if (response.status === "connected") {
            var uid = response.authResponse.userID;
            access_token = response.authResponse.accessToken;
        }
        else if (response.status === "not_authorized") {

        }
        else {

        }
    });

    // 今天日否以分析過
    function is_Today() {

        $.ajax({
            type: 'post',
            url: '//localhost/meet/meet/today/query',
            dataType: 'json',
            error: function (xhr) {
                errorMsg();
            },
            success: function (response) {
                var response = $.parseJSON(JSON.stringify(response));
                if (response.status == true) {
                    $("#lab").prop("disabled", true); // 如果有抓到值表示我還無需分析
                }
            }
        });
    }

    // 分析
    $("#lab").click(function() {
        FB.login(function(response) {
            if (response.authResponse) {
                lab();
            }
        });
    });

    // 分析的 function
    function lab () {
        FB.api("/me/likes", function(details) {
            var response = $.parseJSON(JSON.stringify(details));
            $.each(response.data, function(i){
                $.ajax({
                    type: 'post',
                    url: '//localhost/meet/meet/likes/save',
                    dataType: 'json',
                    data: {
                        name : response.data[i].name,
                        id   : response.data[i].id,
                        time : response.data[i].created_time,
                    },
                    error: function (xhr) {
                        errorMsg();
                    },
                    success: function (response) {
                        var response = $.parseJSON(JSON.stringify(response));
                        (response.status == true ? success() : failed());
                    }
                });
                fanpageinfo(response.data[i].id);
            });
        });
        events();
        videos();
        accounts();
        groups();
        posts();
        place();

        // loadkeywords("<?=$profile['rndcode']?>");
    }


    // 儲存某粉專的相關資訊
    function fanpageinfo (id) {
        FB.api(id + "/?fields=id,name,about,cover,fan_count,location,website", function(details) {
            var response = $.parseJSON(JSON.stringify(details));

                $.ajax({
                    type: 'post',
                    url: '//localhost/meet/meet/fans/save',
                    dataType: 'json',
                    data: { // TODO: 抓經緯度
                        name        : response.name,
                        about       : ( response.about == null ? '' : cancelLn(response.about) ),
                        fan_count   : response.fan_count,
                        website     : ( response.website == undefined ? '' : response.website ),
                        location    : ( response.location == undefined ? '' : response.location.city + '/' + response.location.country),
                        cover       : ( response.cover == undefined ? '' : response.cover.source ),
                    },
                    error: function (xhr) {
                        errorMsg();
                    },
                    success: function (response) {
                        var response = $.parseJSON(JSON.stringify(response));
                        (response.status == true ? success() : failed());
                    }
                });

        });
    }

    // 感興趣的活動 function
    function events () {
        FB.api("me/events?fields=cover,description,id,feed.limit(500),name,posts.limit(500),timezone", function(details) {
            var response = $.parseJSON(JSON.stringify(details));
            $.each(response.data, function(i){
                $.ajax({
                    type: 'post',
                    url: '//localhost/meet/meet/events/save',
                    dataType: 'json',
                    data: {
                        name        : response.data[i].name,
                        id          : response.data[i].id,
                        timezone    : ( response.data[i].timezone == undefined ? '' : response.data[i].timezone ),
                        cover       : ( response.data[i].cover == undefined ? '' : response.data[i].cover.source ),
                        description : ( response.data[i].description == undefined ? '' : cancelLn(response.data[i].description) ),
                    },
                    error: function (xhr) {
                        errorMsg();
                    },
                    success: function (response) {
                        var response = $.parseJSON(JSON.stringify(response));
                        (response.status == true ? success() : failed());
                    }
                });
            });
        });
    }

    // 取得我喜歡我的影片 function
    function videos () {
        FB.api("me/videos?fields=description,place,permalink_url", function(details) {
            var response = $.parseJSON(JSON.stringify(details));
            $.each(response.data, function(i){
                if (response.data[i].description != null) {
                    $.ajax({
                        type: 'post',
                        url: '//localhost/meet/meet/videos/save',
                        dataType: 'json',
                        data: {
                            id              : response.data[i].id, // 編號
                            description     : cancelLn(response.data[i].description), // 影片貼文描述
                            permalink_url   : response.data[i].permalink_url, // 影片網址
                        },
                        error: function (xhr) {
                            errorMsg();
                        },
                        success: function (response) {
                            var response = $.parseJSON(JSON.stringify(response));
                            (response.status == true ? success() : failed());
                        }
                    });
                }
                videos_comments(response.data[i].id);
            });
        });
    }

    // 取得某影片的留言 function
    function videos_comments (id) {
        FB.api(id + "/?fields=comments{message}", function(details) {
            var response = $.parseJSON(JSON.stringify(details));
            var comments = "";

            for (var j = 0; j < response.comments.data.length; j++) {
                ( response.comments.data[j].message != undefined ? comments += response.comments.data[j].message += '，' : '' );
            }

            $.ajax({
                type: 'post',
                url: '//localhost/meet/meet/videos_comments/save',
                dataType: 'json',
                data: {
                    post_id : id,
                    comments : comments.slice(0, -1),
                },
                error: function (xhr) {
                    errorMsg();
                },
                success: function (response) {
                    var response = $.parseJSON(JSON.stringify(response));
                    (response.status == true ? success() : failed());
                }
            });
        });
    }

    // 取得我的貼文 function
    function posts () {
        FB.api("me/?fields=feed.limit(10000)", function(details) {
            var response = $.parseJSON(JSON.stringify(details));
            $.each(response.feed.data, function(i){
                if (response.feed.data[i].message != null) {
                    $.ajax({
                        type: 'post',
                        url: '//localhost/meet/meet/posts/save',
                        dataType: 'json',
                        data: {
                            id              : response.feed.data[i].id,
                            story           : ( response.feed.data[i].story == null ? '' : response.feed.data[i].story ),
                            message         : ( response.feed.data[i].message == null ? '' : response.feed.data[i].message.replace(/(?:\r\n|\r|\n)/g, '，') ),
                            createdtime     : response.feed.data[i].created_time,
                        },
                        error: function (xhr) {
                            errorMsg();
                        },
                        success: function (response) {
                            var response = $.parseJSON(JSON.stringify(response));
                            (response.status == true ? success() : failed());
                        }
                    });
                }
            });
        });
    }


    // 取得我管理的粉專
    function accounts () {
        FB.api("me/accounts?fields=cover,about,name,category&limit=1000", function(details) {
            var response = $.parseJSON(JSON.stringify(details));
            $.each(response.data, function(i){
                $.ajax({
                    type: 'post',
                    url: '//localhost/meet/meet/accounts/save',
                    dataType: 'json',
                    data: {
                        id       : response.data[i].id, // 編號
                        name     : response.data[i].name, // 名稱
                        about    : response.data[i].about,  // 介紹
                        category : response.data[i].category, // 分類(英文)
                        cover    : response.data[i].cover.source, // 封面
                    },
                    error: function (xhr) {
                        errorMsg();
                    },
                    success: function (response) {
                        var response = $.parseJSON(JSON.stringify(response));
                        (response.status == true ? success() : failed());
                    }
                });
            });
        });
    }

    // 取得我管理的社團
    function groups () {
        FB.api("me/groups?fields=name,id&limit=5000", function(details) {
            var response = $.parseJSON(JSON.stringify(details));
            $.each(response.data, function(i){
                $.ajax({
                    type: 'post',
                    url: '//localhost/meet/meet/groups/save',
                    dataType: 'json',
                    data: {
                        id       : response.data[i].id, // 編號
                        name     : response.data[i].name, // 名稱
                    },
                    error: function (xhr) {
                        errorMsg();
                    },
                    success: function (response) {
                        var response = $.parseJSON(JSON.stringify(response));
                        (response.status == true ? success() : failed());
                    }
                });
                groups_feed(response.data[i].id);
            });
        });
    }

    // 取得我管理的社團
    function groups_feed (id) {
        FB.api(id + "/feed?fields=message", function(details) {
            var response = $.parseJSON(JSON.stringify(details));
            $.each(response.data, function(i){
                $.ajax({
                    type: 'post',
                    url: '//localhost/meet/meet/groups_feed/save',
                    dataType: 'json',
                    data: {
                        group_id : id, // 社團編號
                        post_id  : response.data[i].id, // 貼文編號
                        message  : cancelSp(response.data[i].message), // 貼文內容
                    },
                    error: function (xhr) {
                        errorMsg();
                    },
                    success: function (response) {
                        var response = $.parseJSON(JSON.stringify(response));
                        (response.status == true ? success() : failed());
                    }
                });
            });
        });
    }

    // 取得我打卡過的地方
    function place () {
        FB.api("me/feed?fields=place&limit=5000", function(details) {
            var response = $.parseJSON(JSON.stringify(details));
            $.each(response.data, function(i){
                if (response.data[i].place != undefined) {
                    $.ajax({
                        type: 'post',
                        url: '//localhost/meet/meet/place/save',
                        dataType: 'json',
                        data: {
                            post_id  : response.data[i].id, // 貼文編號
                            locat_id : response.data[i].place.id, // 地標編號
                            name     : response.data[i].place.name, // 地標名稱
                            city     : response.data[i].place.location.city, // 城市
                            country  : response.data[i].place.location.country, // 縣
                            lat      : response.data[i].place.location.latitude, // 緯
                            lng      : response.data[i].place.location.longitude, // 經
                            street   : ( response.data[i].place.location.street == null ? '' : response.data[i].place.location.street ), // 地址
                        },
                        error: function (xhr) {
                            errorMsg();
                        },
                        success: function (response) {
                            var response = $.parseJSON(JSON.stringify(response));
                            (response.status == true ? success() : failed());
                        }
                    });
                }
            });
        });
    }

    function failed () {
        console.log('failed');
    }
    function success () {
        // Messenger().post({
        //     message: "成功",
        //     type: "info",
        //     showCloseButton: true,
        //     hideAfter: 1
        // });
        console.log('success');
    }

</script>
