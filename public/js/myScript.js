
    $(document).ready(function ($) {
    $('.table').DataTable();

    $("body").on("click", ".delete", function (e) {
        e.preventDefault();
        var url = $('.delete').data('url')
        del_id = $(this).attr("id");
        console.log(del_id);
        $.ajax({
            url: url,
            type: "DELETE",
            data: del_id,
            success: function (response) {
                console.log(response);
            },
            error: function () {
            },
        });
    });
});

