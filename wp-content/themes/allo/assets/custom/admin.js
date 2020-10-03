(function ($) {
    "use strict"; // use strict to start
    var ajaxurl = allo.ajaxurl;
    $(function(){
        var windowLoc = window.location;
        var $parentMenuId = $('#toplevel_page_allo_welcome');
        var $submenuHref = $parentMenuId.find('.wp-submenu li a');
        $submenuHref.each(function() {
            if($(this).parent().hasClass("current")) {
                $(this).parent().removeClass("current");
            }
            if(windowLoc.search === $(this)[0].search) {
                $(this).parent().addClass("current");
            }
            $(this).on('click', function() {
                if($(this).parent().hasClass("current")) {
                    $(this).parent().removeClass("current");
                } else {
                    $(this).parent().addClass("current");
                }
            });
        });
    });

})(jQuery);