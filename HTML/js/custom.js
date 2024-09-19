
    // bootstrap-tooltip
    $('[data-toggle="tooltip"]').tooltip()


    // sidebar-open-close
    $('.hamburg-menu').click(function (e) { 
        e.preventDefault();
        $(".page-wrapper").toggleClass('sidebar-collaps');
    });
    if ($(window).width() < 767) {
        $(".page-wrapper").addClass('sidebar-collaps');
    }

    // custom-scrollbar
    $(".custom-scrollbar").mCustomScrollbar();

    // datepicker
    $(".date-input").flatpickr();

    // text-editor
    $('#trumbowyg-demo').trumbowyg();