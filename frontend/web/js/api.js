$.ajax({
    url: 'http://api1.smartdesign.uz/vacancies',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
        let text = '';
        let count = 0;
        // console.log(data);
        for (var value of data.items) {
            count;
            if (count === 2){
                break;
            }
            count++;
            text += "<li class=\"job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center\">";
            text += "<a href=" + value['link'] + "></a>";
            text += "<div class='job-listing-logo'>";
            if (value['image'])
                text += "<img class='img-fluid' src =" + value['image'] + ">";
            else
                text += "<img class='img-fluid' src='https://previews.123rf.com/images/arcady31/arcady311509/arcady31150900028/46164370-job-vacancy-rubber-stamp.jpg'>"
            text += "</div>";
            text += "<div class=\"job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4\">";
            text += "<div class=\"job-listing-position custom-width w-50 mb-3 mb-sm-0\">";
            text += "<h2>" + value['profession'] + "</h2>";
            text += "<strong>" + value['company'] + "</strong>";
            text += "</div>";
            text += "<div class=\"job-listing-location mb-3 mb-sm-0 custom-width w-25\">\n" +
                "<span class=\"icon-room\"></span> " + value['address'] + "</div>";
            text += "<div class=\"job-listing-meta\">\n" +
                "<span class=\"badge badge-danger\">" + value['jobtype'] + "</span>\n" +
                " </div>";
            text += "</div>";
            text += "</li>";
        }

        $('#vacancy-list').html(text);
    }
});