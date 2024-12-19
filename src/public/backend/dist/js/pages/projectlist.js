$(document).ready(function() {


    $('#but_fetchall').click(function() {
        fetchRecords(0);
    });

});

function fetchRecords(id) {
    $.ajax({
        url: "projects/"+id,
        type: "get",
        dataType: "json",
        success: function (response) {

            var len = 0;

            $('projectTable tbody').empty();

            if(response.data != null) {
                len = response['data'].length;
            }

            if(len > 0) {

                for(var i=0; i<len; i++) {

                    var id          = response['data'][i].id;
                    var name        = response['data'][i].name;
                    var short_name  = response['data'][i].short_name;

                    var tr_str = "<tr>" +
                        "<td>" + (i + 1) + "</td>" +
                        "<td>" + name + "</td>" +
                        "<td>" + short_name + "</td>" +
                    "</tr>";

                    $("#projectTable tbody").append(tr_str);

                }

            } else {

                var tr_str = "<tr>" +
                        "<td colspan='4'>Nenhum registro localizado</td>" +
                    "</tr>";
                $("#projectTable tbody").append(tr_str);

            }


        }
    });
}
