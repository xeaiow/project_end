<div class="ui thirteen wide column" ng-init="fansId='<?=$id?>';loadFansInfo()">

    <h2 class="ui center aligned icon header">
        <i class="circular anchor icon"></i>
        <span>{{fansPageInfo[0].name}}</span>
    </h2>

    <img class="ui centered big rounded bordered image" src="{{fansPageInfoAll[0].cover.source}}" alt="">

    <div class="ui segment">
        <table class="ui very basic table">
            <tbody ng-repeat="info in fansPageInfo">
                <tr>
                    <td class="three wide table-th">建立時間</td>
                    <td>此項目從 <div class="ui nav-blue notinverted horizontal label">{{info.createTime | relativeTime}}</div> 建立的</td>
                </tr>
                <tr>
                    <td class="table-th">抓取時間</td>
                    <td>由 <div class="ui nav-blue notinverted horizontal label">{{info.fetchDay}}</div> 抓取</td>
                </tr>
                <tr>
                    <td class="table-th">描述</td>
                    <td>{{fansPageInfoAll[0].about}}</td>
                </tr>
                <tr>
                    <td class="table-th">關鍵字</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

</div> <!-- end of container -->
</div>
