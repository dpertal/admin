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
                <input type="text" class="store-query" name="store_query" value="<?php echo $query; ?>">
                <a href="javascript:;" class="btn blue" onclick="searchLocator();">Search</a>
            </form>

        </div>
        <div class="clear"></div>
        <div class="message"><p>This is success message</p></div>




        <div class="store-search-results">
            <h3>Nearest Stores to Postcode</h3>
            <?php if (isset($stores) && !empty($stores)) : ?>
                <div class="store-result-left">
                <?php foreach ($stores as $key => $store) : ?>
                    <div class="store-row">
                        <a class="btn-locate" href="javascript:;" onclick="locateMap('<?php echo $store['lat']?>', '<?php echo $store['lng']?>', '<?php echo $store['name']; ?>', '<?php echo $store['address']; ?> <?php echo $store['postcode']; ?> | <?php echo $store['phone']; ?>');" title="Locate this">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/skin/luckybuys/images/store-pin.png" border="0" />
                        </a>
                        <h4 class="store-name"><?php echo $store['name']; ?></h4>
                        <p class="sub-address"><?php echo $store['address'] . ' ' . $store['postcode']; ?></p>
                        <a class="btn-store-detail" href="javascript:;" onclick="popupStore(<?php echo $store['id']; ?>);">view store detail</a>
                    </div>
                <?php endforeach; ?>
            </div>
                <div class="store-result-right">
                <div class="gmap store-gmap" id="gmap-markers"></div>
            </div>
            <?php endif; ?>
            <div class="clear"></div>
            <div class="popup-store">
                <div class="bg"></div>
                <div class="popup-detail">
                    <h3 class="popup-name">International place</h3>
                    <div class="popup-store-left">
                        <h4>Address</h4>
                        <p class="popup-address">Fountain Gate Shopping Centre - 352 Princes Highway Narre Warren VIC 3805</p>
                        <h4>Phone Number</h4>
                        <p class="popup-phone">(03) 8765 6328</p>
                    </div>
                    <div class="popup-store-right">
                        <div class="popup-map" id="popup-map"></div>
                        <div class="popup-timming">
                            <h4>Openning hour</h4>
                            <p></p>
                        </div>
                    </div>
                    <div class="close-popup"><a href="javascript:;" onclick="$('.popup-store').hide();">x</a></div>
                </div>
            </div>
        </div>
        <div class="clear" style="padding-top: 10px;"></div>
        <?php if (isset($stores) && !empty($query)) : ?>
            <a href="javascript:;" class="btn blue btn-search-more" onclick="searchMoreLocator();">More results</a>
        <?php endif; ?>
        <?php if (isset($stores) && $position) : ?>
            <a href="javascript:;" class="btn blue btn-search-more" onclick="searchMoreLocatorPosition();">More results</a>
        <?php endif; ?>
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
                        var html_element = '<div class="store-row">' +
                            '<a class="btn-locate" href="javascript:;" onclick="locateMap(\'' + data[i].lat + '\', \'' + data[i].lng + '\', \'' + data[i].name + '\', \'' + content + '\');" title="Locate this">' +
                            '<img src="<?php echo Yii::app()->request->baseUrl; ?>/skin/luckybuys/images/store-pin.png" border="0" />' +
                            '</a>' +
                            '<h4 class="store-name">' + data[i].name + '</h4>' +
                            '<a class="btn-store-detail" href="javascript:;" onclick="popupStore(' + data[i].id + ');">view store detail</a>' +
                            '</div>';
                        stores[data[i].id] = {id: data[i].id,
                            name: data[i].name,
                            address: data[i].address + ' ' + data[i].postcode,
                            phone: data[i].phone,
                            timmings: data[i].timmings,
                            lat: data[i].lat,
                            lng: data[i].lng
                        };
                        $(".store-result-left").append(html_element);
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
                        var html_element = '<div class="store-row">' +
                            '<a class="btn-locate" href="javascript:;" onclick="locateMap(\'' + data[i].lat + '\', \'' + data[i].lng + '\', \'' + data[i].name + '\', \'' + content + '\');" title="Locate this">' +
                            '<img src="<?php echo Yii::app()->request->baseUrl; ?>/skin/luckybuys/images/store-pin.png" border="0" />' +
                            '</a>' +
                            '<h4 class="store-name">' + data[i].name + '</h4>' +
                            '<a class="btn-store-detail" href="javascript:;" onclick="popupStore(' + data[i].id + ');">view store detail</a>' +
                            '</div>';
                        stores[data[i].id] = {id: data[i].id,
                            name: data[i].name,
                            address: data[i].address + ' ' + data[i].postcode,
                            phone: data[i].phone,
                            timmings: data[i].timmings,
                            lat: data[i].lat,
                            lng: data[i].lng
                        };
                        $(".store-result-left").append(html_element);
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
    var stores = [];
    <?php foreach ($stores as $key => $store) : ?>
    stores[<?php echo $store['id']; ?>] = {id: <?php echo $store['id']; ?>,
        name: '<?php echo $store['name']; ?>',
        address: '<?php echo $store['address'] . ' ' . $store['postcode']; ?>',
        phone: '<?php echo $store['phone']; ?>',
        timmings: '<?php echo $store['timmings']; ?>',
        lat: <?php echo $store['lat']; ?>,
        lng: <?php echo $store['lng']; ?>
    };
    <?php endforeach; ?>

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

    function popupStore(storeId){
        var store = stores[storeId];
        $(".popup-name").html(store.name);
        $(".popup-address").html(store.address);
        $(".popup-phone").html(store.phone);
        $(".popup-timming p").html(store.timmings);
        $(".popup-store").show();
        $("#popup-map").empty();
        var map_markers = new GMaps({
            div: '#popup-map',
            lat: store.lat,
            lng: store.lng
        });
        map_markers.addMarker({
            lat: store.lat,
            lng: store.lng,
            title: store.name,
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