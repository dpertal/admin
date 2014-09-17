/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 function showRetailerOverlay(url) {
		$.get(url, null, function(data) {
          
            //alert(data);
            
            $('#overlayRetailer #contentContainer').html(data.replace('.css', ''));
            showOverlay('overlayRetailer', 'retailerDetail');
            /*$('.overlay_bg').show();
            //$('#overlayRetailer iframe').attr('src', 'RetailerDetail/'+id);
            height = $('#overlayRetailer').height();
            wHeight = $(window).height() - 100;
            if(height > wHeight) {
               $('#overlayRetailer').height(wHeight);
               height = wHeight;
            }
            $('#retailerDetail').height(height);
            $('#overlayRetailer').css('margin-left', 0-$('#overlayRetailer').width()/2);
            $('#overlayRetailer').css('margin-top', 0-height/2);
            $('#overlayRetailer').css('top', '0');
            $('#overlayRetailer').animate( { 'top': '50%'}, 300);
            $('#overlayRetailer').show();*/
        }, null);
    }
    
    function showOverlay(div_id, content_id) {
        $('.overlay_bg').show();
            //$('#overlayRetailer iframe').attr('src', 'RetailerDetail/'+id);
            height = $('#'+div_id).height();
            wHeight = $(window).height() - 100;
            if(height > wHeight) {
               $('#'+div_id).height(wHeight);
               height = wHeight;
            }
            if(content_id) {
                $('#'+content_id).height(height);
            }
            $('#'+div_id).css('margin-left', 0-$('#'+div_id).width()/2);
            $('#'+div_id).css('margin-top', 0-height/2);
            $('#'+div_id).css('top', '0');
            $('#'+div_id).animate( { 'top': '50%'}, 300);
            $('#'+div_id).show();
    }
    
    function hideOverlay() {
        $('.overlay_fg').hide();
        $('.overlay_bg').hide();
        $('#overlayRetailer').height('auto');
    }