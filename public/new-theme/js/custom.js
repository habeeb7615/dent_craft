
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

function newPartJS() {
    $('.choose-parts-checkboxes .custom-checkbox input[type="checkbox"]').click(function (e) {
        var checkbox = $(this).parent('.custom-checkbox')
        var dropdown = checkbox.find('.add-parts-dropdown')
        if ($(this).prop('checked') === true) {
            dropdown.show();
            dropdown.find('.part_quantity').select()
        }else{
            checkbox.find('.parts-quantity-price p').css('color', 'grey');
            dropdown.hide();
            checkbox.find('.quantity').text(0)
            checkbox.find('.total_price').text(parseFloat('00').toFixed(2))
        }

        checkbox.siblings('.custom-checkbox').find('.add-parts-dropdown').hide();
        $(this).parents('.parts').siblings('.parts').find('.add-parts-dropdown').hide();
        // $(this).parent('.custom-checkbox').siblings('.custom-checkbox').find('.add-parts-dropdown').removeClass('hidden');
    });

    // $('.add-parts-dropdown .add-part-btn button').click(function (e) {
    //     e.preventDefault();
    //     $(this).parents('.add-parts-dropdown').addClass('hidden');
    // });

    // text-editor
    // $('#trumbowyg-demo').trumbowyg();

    // $('.part_quantity').on('change keyup', function() {
    //     var quantity = parseInt($(this).val())
    //     var checkbox = $(this).parents('.custom-checkbox')
    //     var unitPrice = checkbox.find('.unit_price').val()
    //     var number = !isNaN(quantity) ? quantity * parseFloat(unitPrice) : '0'
    //     $(this).parents('.add-parts-dropdown').find('.total_price').val(number)
    // })

    $('.add-part-btn button').click(function() {
        var checkbox = $(this).parents('.custom-checkbox')
        var dropdown = $(this).parents('.add-parts-dropdown')
        var quantity = dropdown.find('.part_quantity').val() == '' ? '0' : dropdown.find('.part_quantity').val()
        var number = dropdown.find('.total_price').val();
        // var unitPrice = dropdown.find('.unit_price').val()
        // var number = !isNaN(quantity) && quantity != '' ? (quantity * parseFloat(unitPrice)).toFixed(2) : parseFloat('00').toFixed(2)

        if (quantity <= 0) {
            checkbox.find('input[type="checkbox"]').attr('checked', false)
        }else {
            checkbox.find('.quantity').text(quantity)
            checkbox.find('.total_price').text(number)
            checkbox.find('.parts-quantity-price p').css('color', '#4BFF00');
        }
        dropdown.hide()
    })
}

newPartJS()
