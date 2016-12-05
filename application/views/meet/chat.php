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
                    <div class="ui raised segment basic" id="me"></div>
                </div>

            </div>

            <div class="eight wide column">

                <div id="messagesDiv" class="ui segment loading" style="min-height:522px;max-height:522px;overflow-y:auto;"></div>

                <div class="ui fluid icon input">
                    <input type="text" id="messageInput" placeholder="說些什麼...">
                    <i class="search icon"></i>
                </div>

            </div>

            <div class="four wide column">

                <h3 class="ui header centered">關鍵字</h3>
                <div class="ui segment basic center aligned" id="matchKeywords"></div>

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

<script>
//D3
var width = 220,
    height = 300,
    root;

var force = d3.layout.force()
    .linkDistance(50)
    .charge(-120)
    .gravity(.05)
    .size([width, height])
    .on("tick", tick);

var svg = d3.select("#me").append("svg")
    .attr("width", width)
    .attr("height", height);

var link = svg.selectAll(".link"),
    node = svg.selectAll(".node");

d3.json("//localhost/selene_ci/assets/graph.json", function(error, json) {
  if (error) throw error;

  root = json;
  update();
});

function update() {
  var nodes = flatten(root),
      links = d3.layout.tree().links(nodes);

  // Restart the force layout.
  force
      .nodes(nodes)
      .links(links)
      .start();

  // Update links.
  link = link.data(links, function(d) { return d.target.id; });

  link.exit().remove();

  link.enter().insert("line", ".node")
      .attr("class", "link");

  // Update nodes.
  node = node.data(nodes, function(d) { return d.id; });

  node.exit().remove();

  var nodeEnter = node.enter().append("g")
      .attr("class", "node")
      .on("click", click)
      .call(force.drag);

  nodeEnter.append("circle")
      .attr("r", function(d) { return Math.sqrt(d.size) / 10 || 30.5; })
      .attr("class", "interest");

  nodeEnter.append("text")
      .attr("dy", ".35em")
      .text(function(d) { return d.name; });

  node.select("circle")
      .style("fill", color);
}

function tick() {
  link.attr("x1", function(d) { return d.source.x; })
      .attr("y1", function(d) { return d.source.y; })
      .attr("x2", function(d) { return d.target.x; })
      .attr("y2", function(d) { return d.target.y; });

  node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });
}

function color(d) {
  return d._children ? "#3182bd" // collapsed package
      : d.children ? "#c6dbef" // expanded package
      : "#F7F7F7"; // leaf node
}

// Toggle children on click.
function click(d) {
  if (d3.event.defaultPrevented) return; // ignore drag
  if (d.children) {
    d._children = d.children;
    d.children = null;
  } else {
    d.children = d._children;
    d._children = null;
  }
  update();
}

// Returns a list of all nodes under the root.
function flatten(root) {
  var nodes = [], i = 0;

  function recurse(node) {
    if (node.children) node.children.forEach(recurse);
    if (!node.id) node.id = ++i;
    nodes.push(node);
  }

  recurse(root);
  return nodes;
}
</script>

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
