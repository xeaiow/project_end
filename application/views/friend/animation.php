<div class="ui thirteen wide column center aligned">

    <div class="ui people shape choosecard" id="animation-card-1">
        <div class="sides">
            <div class="side">
                <div class="ui card">
                    <div class="image">
                        <img src="//i.imgur.com/p4vd7Tm.jpg">
                    </div>
                    <div class="content">
                        <div class="header center aligned">卡片</div>
                    </div>
                </div>
            </div>
            <div class="side active">
                <div class="ui card">
                    <div class="image">
                        <img src="//i.imgur.com/DZAx78g.jpg">
                    </div>
                    <div class="content">
                        <a class="header center aligned">卡片</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ui people shape choosecard" id="animation-card-2">
        <div class="sides">
            <div class="side">
                <div class="ui card">
                    <div class="image">
                        <img src="//i.imgur.com/p4vd7Tm.jpg">
                    </div>
                    <div class="content">
                        <div class="header center aligned">卡片</div>
                    </div>
                </div>
            </div>
            <div class="side active">
                <div class="ui card">
                    <div class="image">
                        <img src="//i.imgur.com/p4vd7Tm.jpg">
                    </div>
                    <div class="content">
                        <a class="header center aligned">卡片</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ui people shape choosecard" id="animation-card-3">
        <div class="sides">
            <div class="side">
                <div class="ui card">
                    <div class="image">
                        <img src="//i.imgur.com/p4vd7Tm.jpg">
                    </div>
                    <div class="content">
                        <div class="header center aligned">卡片</div>
                    </div>
                </div>
            </div>
            <div class="side active">
                <div class="ui card">
                    <div class="image">
                        <img src="//i.imgur.com/aGZdwD4.png">
                    </div>
                    <div class="content">
                        <a class="header center aligned">卡片</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> <!-- end of container -->

<script>
    $(".choosecard").click(function(){
        $(this).shape('flip over').addClass("hola");
        $('.choosecard').transition('fade down');
        setTimeout(function(){
            window.location.href = '<?=base_url('friend')?>';
        }, 800);
    });
</script>
