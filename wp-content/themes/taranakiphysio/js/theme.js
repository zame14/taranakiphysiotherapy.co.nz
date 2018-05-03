jQuery(function($) {
    var $ = jQuery;
    if($('.staff-inner-wrapper').length) {
        $('.staff-inner-wrapper').click(function() {
            $(".loader",this).show();
            $('.staff-inner-wrapper').removeClass('showMe');
            showStaffBio($(this).data('id'), $(this).data('colid'));
            $(this).addClass('showMe');
        });
    }
    gallerySlick = $(".gallery-wrapper").slick({
        dots:false,
        speed: 300,
        slidesToShow: 1,
        arrows: true,
        adaptiveHeight: true
    });
    partnersSlick = $(".partners-wrapper").slick({
        infinite: false,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true
    });
    $('.top').click(function(event){
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        return false;
    });
    var waypoint = new Waypoint({
        element: document.getElementById('header'),
        handler: function() {
            $(".top").toggleClass('show');
        },
        offset: -500
    });
});
var curStaffId = 0;
var curDisplayRow = 0;
function showStaffBio(id, colid) {
    var $ = jQuery;
    var staffid = id;
    var row = 1;
    var curRowTop = 0;
    var staffRow = 0;
    var lastRowStaff = null;
    // If current staff profile then reset everything.
    if (id == curStaffId) {
        closeStaffBio();
        return;
    }
    // Find out position of staff within the site responsively
    $(".staff").each(function () {
        var top = $(this).offset().top;
        if (!curRowTop) curRowTop = top;
        // If greater than we just started a new row
        if (top > curRowTop) {
            row++;
            curRowTop = top;
        }
        // Check to see if this is the staff profile we're looking for
        if ($(this).attr("id") == "staff-" + id) {
            staffRow = row;
        }
        // Record the last profile in the row so we know where to insert the section containing the content
        if (row == staffRow) {
            lastRowStaff = $(this);

        }
    });
    // Load bio from database
    $.ajax({
        url: "?ajax=show_staff_bio&staffid=" + staffid + "&colid=" + colid,
        success: function (response) {
            $(".loader").hide();
            // Check if the section row needs to appear.
            if (staffRow != curDisplayRow) {
                // Slide out the current row if still there
                if (curDisplayRow) {
                    $(".staff-bio-wrapper").css('height','0px').addClass("remove");
                    //setTimeout(function() {
                    $(".remove.staff-bio-wrapper").remove();
                    // }, 1000);
                }
                // Add the new bio and slide it in
                var html = '<article class="staff-bio-wrapper" style="width: 100%;clear:both;"><div class="staff-bio-inner-wrapper">' + response + '</div></article>';

                $(lastRowStaff).after(html);
                //var newheight = $('.strategy-content.col2').height();
                var newheight = '100%';
                $(".staff-bio-wrapper").not(".remove").css('height',newheight);
            } else {
                // Fade out existing bio and fade in the new one
                $(".staff-bio-wrapper .bio-content").css('opacity','0');
                $(".staff-bio-wrapper .bio-content").attr('id','');
                $(".staff-bio-wrapper").html('<div class="bio-content" style="opacity:0">' + response + '</div>');
                $(".staff-bio-wrapper .bio-content").css('opacity','1');

                var newheight = '100%';
                $(".staff-bio-wrapper").css('height',newheight);
            }
            //var minus = parseInt($('.fixed').height());
            setTimeout(function() {
                $("html, body").animate({scrollTop: (0, $('.staff-bio-wrapper').offset().top)}, 1000);
            },100);
            // Set currentStrategy to this id
            curDisplayRow = staffRow;
            curStaffId = staffid;
        }
    });
}

function closeStaffBio() {
    var $ = jQuery;
    $(".staff-bio-wrapper").css('height','0px').addClass("remove");
    //setTimeout(function() {
    $(".remove.staff-bio-wrapper").remove();
    //}, 1000);
    curStaffId = 0;
    curDisplayRow  = 0;
}