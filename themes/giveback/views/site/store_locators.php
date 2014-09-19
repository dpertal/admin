<div class="main-content store-locators">
    <div class="section-header">Store locators</div>
    <div class="store-contents">
        <div class="store-current-location">
            <a href="javascript:;" class="btn blue btn-current-location" onclick="getLocation();">Use my current location</a>
            <form class="location_form" name="location_form" method="post" action="">
                <input type="hidden" name="latitude" value="" />
                <input type="hidden" name="longitude" value="" />
                <input type="hidden" name="location" value="1">
            </form>
        </div>
        <div class="store-search input">
            <label>Enter your ZipCode</label>
            <form name="store_query" action="" method="post">
                <input type="text" class="store-query" name="store_query">
                <a href="javascript:;" class="btn blue" onclick="searchLocator();">Search</a>
            </form>

        </div>
        <div class="clear"></div>
        <div class="message"><p>This is success message</p></div>
        <?php if (isset($stores) && !empty($stores)) : ?>
            <div class="gmap store-gmap" id="gmap-markers"></div>
        <?php endif; ?>

        <div class="store-search-results">
            <table class="store-locator">
                <thead>
                    <tr>
                        <th id="store-name" style="width: 20%;">Store</th>
                        <th id="store-distance">Photo</th>
                        <th id="store-address" class="hide-for-tiny">Address</th>
                        <th id="store-opening" class="hide-for-small">Opening Hours</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($stores) && !empty($stores)) :  ?>
                        <?php foreach ($stores as $key => $store) : ?>
                            <tr class="<?php echo ($key % 2 == 0) ? 'even' : 'odd'; ?>">
                                <td headers="store-name" class="storefinder-name">
                                    <a href="javascript:;" onclick="locateMap('<?php echo $store['lat']?>', '<?php echo $store['lng']?>', '<?php echo $store['name']; ?>', '<?php echo $store['address']; ?> <?php echo $store['postcode']; ?> | <?php echo $store['phone']; ?>');" title="Locate this">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/skin/luckybuys/images/store-pin.png" border="0" />
                                    </a>
                                    <a href=""><?php echo $store['name']; ?></a>
                                </td>
                                <td headers="store-distance" class="store-distance">
                                    <img src="<?php echo $store['logo_url'] ?>" width="80" height="80" />
                                </td>
                                <td headers="store-address" class="hide-for-tiny">
                                    <strong><?php echo $store['address']; ?></strong><br>
                                    <?php echo $store['phone']; ?> <?php echo $store['postcode']; ?></td>
                                <td headers="store-opening" class="hide-for-small">
                                    <?php echo $store['timmings']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="4">Specify your zipcode query above</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if (isset($stores) && !empty($query)) : ?>
                <a href="javascript:;" class="btn blue btn-search-more" onclick="searchMoreLocator();">More results</a>
            <?php endif; ?>
            <?php if (isset($stores) && $position) : ?>
                <a href="javascript:;" class="btn blue btn-search-more" onclick="searchMoreLocatorPosition();">More results</a>
            <?php endif; ?>
        </div>
    </div>
    <?php if($products != NULL):?>
        <div class="clear"></div>
        <div style="width: 940px;height: auto;">
        <?php
            $count = 0;
            //        var_dump($productCount);exit;
            foreach ($products['data']->item as $product):
                if($count >= intval($productCount))
                    break;

                ?>
                <div style="width: 200px;padding: 5px; height: 100px;margin: 10px;float:left;text-align: center;">
            <img src="<?php echo $product->imageurl[0]; ?>" width="100px" height="70px" style="margin-left: 15px;" />
            <div>
                <a href="<?php echo $product->linkurl; ?>" target="_blank"><?php echo $product->productname; ?></a>
            </div>
            <div>
                <?php echo $product->price; ?>
            </div>
        </div>
                <?php $count++; endforeach; ?>
    </div>
        <div class="clear"></div>
    <?php endif; ?>
</div>
<script src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script src="<?= Yii::app()->request->baseUrl; ?>/skin/luckybuys/js/gmaps.js"></script>
<script src="//google-maps-utility-library-v3.googlecode.com/svn/trunk/geolocationmarker/src/geolocationmarker-compiled.js"></script>
<script type="text/javascript">
    var load_more_query = '<?php echo $query; ?>';
    var pager = <?php echo $pager; ?>;
    function searchLocator(){
        var query = $("input[name=store_query]").val();
        if (query == ''){
            toggleMessage("error", "please input your zipcode");
        }
        else document.store_query.submit();
    }
    function searchMoreLocator(){
        $(".btn-search-more").html('<i>Loading</i>').removeAttr('onclick');
        $.post("<?php echo $this->createAbsoluteUrl("site/store"); ?>",
            {store_query:load_more_query, pager:pager + 1, type:'json'},
            function(data){
                if (data.length > 0){
                    for (var i = 0;i < data.length;i++){
                        if (i % 2 == 0) var class_e = 'even';
                        else var class_e = 'odd';
                        var content = data[i].address + ' ' + data[i].postcode + ' | ' + data[i].phone;
                        var html_element = '<tr class="' + class_e + '">' +
                            '<td headers="store-name" class="storefinder-name">' +
                            '<a href="javascript:;" onclick="locateMap(\'' + data[i].lat + '\', \'' + data[i].lng + '\', \'' + data[i].name + '\', \'' + content + '\');" title="Locate this">' +
                            '<img src="<?php echo Yii::app()->request->baseUrl; ?>/skin/luckybuys/images/store-pin.png" border="0" />' +
                            '</a>'+
                            '<a href="">' + data[i].name + '</a>' +
                            '</td>' +
                            '<td headers="store-distance" class="store-distance">' +
                            '<img src="' + data[i].logo_url + '" width="80" height="80" />' +
                            '</td>' +
                            '<td headers="store-address" class="hide-for-tiny">' +
                            '<strong>' + data[i].address + '</strong><br>' +
                            data[i].phone + ' ' + data[i].postcode + '</td>' +
                            '<td headers="store-opening" class="hide-for-small">' +
                            data[i].timmings +
                            '</td>' +
                            '</tr>';
                        $(".store-locator tbody").append(html_element);
                    }
                    pager = pager + 1;
                    $(".btn-search-more").html('More Results').attr('onclick', 'searchMoreLocator();');
                }
                else {
                    $(".store-locator tbody").append("<tr><td colspan='4'>No more result.</td></tr>");
                    $(".btn-search-more").hide();
                }
            }
        )
    }

    function searchMoreLocatorPosition(){
        var lat = '<?php echo $position_detail['lat']; ?>';
        var lng = '<?php echo $position_detail['lng']; ?>';
        $(".btn-search-more").html('<i>Loading</i>').removeAttr('onclick');
        $.post("<?php echo $this->createAbsoluteUrl("site/store"); ?>",
            {latitude:lat, longitude: lng, pager:pager + 1, location: 1,type:'json'},
            function(data){
                if (data.length > 0){
                    for (var i = 0;i < data.length;i++){
                        if (i % 2 == 0) var class_e = 'even';
                        else var class_e = 'odd';
                        var content = data[i].address + ' ' + data[i].postcode + ' | ' + data[i].phone;
                        var html_element = '<tr class="' + class_e + '">' +
                            '<td headers="store-name" class="storefinder-name">' +
                            '<a href="javascript:;" onclick="locateMap(\'' + data[i].lat + '\', \'' + data[i].lng + '\', \'' + data[i].name + '\', \'' + content + '\');" title="Locate this">' +
                            '<img src="<?php echo Yii::app()->request->baseUrl; ?>/skin/luckybuys/images/store-pin.png" border="0" />' +
                            '</a>'+
                            '<a href="">' + data[i].name + '</a>' +
                            '</td>' +
                            '<td headers="store-distance" class="store-distance">' +
                            '<img src="' + data[i].logo_url + '" width="80" height="80" />' +
                            '</td>' +
                            '<td headers="store-address" class="hide-for-tiny">' +
                            '<strong>' + data[i].address + '</strong><br>' +
                            data[i].phone + ' ' + data[i].postcode + '</td>' +
                            '<td headers="store-opening" class="hide-for-small">' +
                            data[i].timmings +
                            '</td>' +
                            '</tr>';
                        $(".store-locator tbody").append(html_element);
                    }
                    pager = pager + 1;
                    $(".btn-search-more").html('More Results').attr('onclick', 'searchMoreLocatorPosition();');
                }
                else {
                    $(".store-locator tbody").append("<tr><td colspan='4'>No more result.</td></tr>");
                    $(".btn-search-more").hide();
                }
            }
        );
    }

    function toggleMessage(classMsg, Msg){
        $(".message").removeClass('success').removeClass('error')
            .find('p').html('');
        $(".message").addClass(classMsg)
            .find('p').html(Msg)
        $(".message").slideDown(500);
        setTimeout(function(){ $(".message").slideUp(500); }, 3000);
    }
    $(document).ready(function() {
        $("input[name=store_query]").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
    function getLocation() {
        $(".btn-current-location").html("<i>Loading</i>").removeAttr('onclick');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position){
                $(".location_form input[name=latitude]").val(position.coords.latitude);
                $(".location_form input[name=longitude]").val(position.coords.longitude);
                document.location_form.submit();
            }, function(error){
                toggleMessage('error', 'Unable to use your location');
                $(".btn-current-location").html("<i>unable to use your location</i>").css("opacity", "0.6");
            });

        } else {
            $(".btn-current-location").html("<i>unable to use your location</i>").css("opacity", "0.6");
            toggleMessage('error', "Geolocation is not supported by this browser.");
        }
    }
    <?php if (isset($stores) && !empty($store)) : ?>
    //For Gmap
    $(function(){
        <?php if (!empty($lat) && !empty($lng)) :  ?>
        var map_markers = new GMaps({
            div: '#gmap-markers',
            lat: <?php echo $lat; ?>,
            lng: <?php echo $lng; ?>
        });
        map_markers.addMarker({
            lat: <?php echo $lat; ?>,
            lng: <?php echo $lng; ?>,
            title: 'My location',
            details: {
                database_id: 42,
                author: 'HPNeo'
            },
            click: function(e){
            }
        });
        <?php else : ?>
        var map_markers = new GMaps({
            div: '#gmap-markers',
            lat: <?php echo $stores[0]['lat']; ?>,
            lng: <?php echo $stores[0]['lng']; ?>
        });
        map_markers.addMarker({
            lat: <?php echo $stores[0]['lat']; ?>,
            lng: <?php echo $stores[0]['lng']; ?>,
            title: '<?php echo $stores[0]['name']; ?>',
            details: {
                database_id: 42,
                author: 'HPNeo'
            },
            click: function(e){
            }
        });
        <?php endif; ?>
    });
    function locateMap(lat, lng, name, address){
        $("#gmap-markers").empty();
        var map_markers = new GMaps({
            div: '#gmap-markers',
            lat: lat,
            lng: lng
        });
        map_markers.addMarker({
            lat: lat,
            lng: lng,
            title: name,
            details: {
                database_id: 42,
                author: 'HPNeo'
            },
            click: function(e){
            }
        });
    }
    <?php endif; ?>
</script>