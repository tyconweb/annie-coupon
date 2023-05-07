let initSortable = () => {
    $("#couponList").sortable({
        items: "li",
        cursor: 'move',
        opacity: 0.6,
        update: function() {
            var html = $(this).html();
            sendOrderToServer(html);
        }
    });
}
$(function() {
    $.when(
        $.getScript("https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"),
        $.Deferred(function(deferred) {
            $(deferred.resolve);
        })
    ).done(function() {
        initSortable();
    });
});

function sendOrderToServer(html) {
    var coupons = [];
    var token = $('meta[name="csrf-token"]').attr('content');
    var x = 0;
    $(html).each(function(index, element) {
        if ($(this).attr('data-id') != undefined) {
            x++;
            coupons.push({
                id: $(this).attr('data-id'),
                position: x
            });
        }
    });
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "?ajax=coupons-ordering.php",
        data: {
            coupons: coupons,
            _token: token,
        },
        beforeSend: function() {
            // Show the loader before the request is sent
        },
        success: function(response) {
            if (response.success) {
                initSortable();
            } else {
                console.log(response)
            }
        },
        complete: function() {
            // Hide the loader when the response is received
        }
    });
}