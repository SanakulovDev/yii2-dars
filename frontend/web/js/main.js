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

//Vacancy show more ajax

$('#vacancysearch-region_id').click(function(){
    let id = $(this).val();
    $.ajax({
        method: "get",
        url: "/ajax/city",
        data: { id: id},
        success: function(data) {
            $('#vacancysearch-city_id').html(data);
            // location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
});



$.ajax({
    url: 'http://yii2dars.loc/api/regions',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
        console.lof(data);
        text = '';
        for(var value of data.items){
            text += "<li class='job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center'>";

        }
        $('#vacansies_isrofil').html(text);
    }
});








