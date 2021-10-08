$('#company-regionid').change(function(){
    let id = $(this).val();

    $.ajax({
        method: "get",
        url: "/ajax/city",
        data: { id: id},
        success: function(data) {
            $('#company-cityid').html(data);
            // location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
});