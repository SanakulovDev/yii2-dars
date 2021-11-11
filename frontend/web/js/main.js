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

$('#worker-regionid').change(function(){
    let id = $(this).val();

    $.ajax({
        method: "get",
        url: "/ajax/city",
        data: { id: id},
        success: function(data) {
            $('#worker-cityid').html(data);
            // location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
});
$('#vacancy-region_id').change(function(){
    let id = $(this).val();
    $(this).select2();
    $.ajax({
        method: "get",
        url: "/ajax/city",
        data: { id: id},
        success: function(data) {
            $('#vacancy-city_id').html(data);
            // location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
});


$('#vacancy-profession_id').select2();
$('#vacancy-city_id').select2();
