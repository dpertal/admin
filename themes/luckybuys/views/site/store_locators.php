<div class="main-content store-locators">
    <div class="section-header">Store locators</div>
    <div class="store-contents">
        <div class="store-search input">
            <label>Enter your ZipCode</label>
            <form name="store_query" action="" method="post">
                <input type="text" class="store-query" name="store_query">
                <a href="javascript:;" class="btn blue" onclick="searchLocator();">Search</a>
            </form>
            <div class="message"><p>This is success message</p></div>
        </div>
        <div class="store-search-results">
            <table class="store-locator">
                <thead>
                    <tr>
                        <th id="store-name">Store</th>
                        <th id="store-distance">Photo</th>
                        <th id="store-address" class="hide-for-tiny">Address</th>
                        <th id="store-opening" class="hide-for-small">Opening Hours</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($stores)) :  ?>
                        <?php foreach ($stores as $key => $store) : ?>
                            <tr class="<?php echo ($key % 2 == 0) ? 'even' : 'odd'; ?>">
                                <td headers="store-name" class="storefinder-name">
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
            <?php if (isset($stores)) : ?>
                <a href="javascript:;" class="btn blue btn-search-more" onclick="searchMoreLocator();">More results</a>
            <?php endif; ?>
        </div>
    </div>
</div>
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
                        var html_element = '<tr class="' + class_e + '">' +
                                                '<td headers="store-name" class="storefinder-name">' +
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
</script>