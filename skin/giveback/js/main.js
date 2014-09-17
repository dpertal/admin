
//Responsive menu
$(function(){
    var mainWidth = parseInt($("body").width());
    $(".collapse-menu-icon a").click(function(){
        var responsiveMenu = $(".collapse-menu");
        if (responsiveMenu.hasClass('collapsed')){
            var bodyWidth = mainWidth + 200;
            $("body").css({'position':'fixed', 'width':bodyWidth + 'px'});
            $("body").animate({
                "left": "200px"
                }, 500);
            responsiveMenu.animate({
                'left': '0px'
                }, 500);
            responsiveMenu.removeClass('collapsed').addClass('expanded');
        }
        else{
            $("body").animate({
                "left": "0px"
                }, 500, function(){ $("body").css({'position':'inherit', 'width':mainWidth + 'px'}); });
            responsiveMenu.animate({
                'left': '-200px'
                }, 500);
            responsiveMenu.removeClass('expanded').addClass('collapsed');
        }
    });
});