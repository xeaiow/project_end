<div id="map"></div>
<script>

    function initMap() {

        var myplace = new Array();
        var myLatLng = {lat: 23.65468295580793, lng: 120.91557843288183};
        var customMapType = new google.maps.StyledMapType([{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"},{"weight":"0.20"},{"lightness":"28"},{"saturation":"23"},{"visibility":"off"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"color":"#494949"},{"lightness":13},{"visibility":"off"}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#144b53"},{"lightness":14},{"weight":1.4}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#08304b"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#0c4152"},{"lightness":5}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#0b434f"},{"lightness":25}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#0b3d51"},{"lightness":16}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"}]},{"featureType":"transit","elementType":"all","stylers":[{"color":"#146474"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#021019"}]}], {
            name: 'Custom Style'
        });
        var customMapTypeId = 'custom_style';


        var locations = [
            ['Bondi Beach', -33.890542, 151.274856, 4],
            ['Coogee Beach', -33.923036, 151.259052, 5],
            ['Cronulla Beach', -34.028249, 151.157507, 3],
            ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
            ['Maroubra Beach', -33.950198, 151.259302, 1]
        ];

        $.ajax({
            type: 'post',
            url: '//localhost/selene_ci/meet/slefPlace/query',
            dataType: 'json',
            error: function (xhr) {
                errorMsg();
            },
            success: function (response) {

                var response = $.parseJSON(JSON.stringify(response));

                var marker, i;

                for (i = 0; i < locations.length; i++) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(response.result[i].lat, response.result[i].lng),
                        map: map
                    });
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(response.result[i].name);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                }

            }
        });

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: myLatLng,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, customMapTypeId]
            }
        });

        map.mapTypes.set(customMapTypeId, customMapType);
        map.setMapTypeId(customMapTypeId);

        var infowindow = new google.maps.InfoWindow();


    }
</script>

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #000;
    }
    #map {
        position:absolute;
        height:auto;
        bottom:0;
        top:0;
        left:0;
        right:0;
        margin-top:50px;
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDaUU3JchpIC0s7sTTjbtE-wpcFZQF0kGg&signed_in=true&callback=initMap" async defer></script>
