<script>

function loadServiceItemsByUser(user_id) {

    $(document).ready( function () {

        // LIMPAR TUDO ANTES DE CRIAR NOVA DATATABLE
        // $('#ajax-datatable-service-item').DataTable().clear().destroy();

        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        });

        $.ajax({

            // Passar Status = 1 (mobilizado)

            url: '/pco/get-service-item-by-user/'+user_id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                values = JSON.stringify(response);

                const serviceItemData = JSON.parse(values);
                // console.log(serviceItemData);

                lenObj = serviceItemData['data'].length;

                contentServicesItem  = '';
                var grandTotal = 0;

                for(var i=0; i<lenObj; i++) {

                    var id                  = serviceItemData['data'][i]['id'];
                    var level               = serviceItemData['data'][i]['level'];
                    var item_description    = serviceItemData['data'][i]['item_description'];
                    var item_cost           = serviceItemData['data'][i]['item_cost'];

                    if(item_cost == null) {
                        var item_cost = '';
                    } else {

                        grandTotal = parseFloat(grandTotal) + parseFloat(item_cost);

                        if(document.getElementById("locale").value == 'pt_BR') {
                            var item_cost = serviceItemData['data'][i]['item_cost_br'];
                        } else {
                            var item_cost = serviceItemData['data'][i]['item_cost_en'];
                        }
                    }
                    // identação
                    var identification_level = serviceItemData['data'][i]['identification_level'];

                    if(identification_level == 1) {
                        ident = '';
                        bold = 'bold';
                    } else if(identification_level == 2) {
                        ident = '&nbsp;&nbsp;';
                        bold = 'normal';
                    } else {
                        ident = '&nbsp;&nbsp;&nbsp;&nbsp;';
                        bold = 'normal';
                    }

                    contentServicesItem += '<tr>';
                        contentServicesItem += '<td id="colSI-A-'+i+'" class="sorting_1" style="width: 4%; font-weight: '+bold+';">'+ident+level+'</td>';
                        contentServicesItem += '<td id="colSI-B-'+i+'" class="sorting_1" style="width: 86%; font-weight: '+bold+';">'+item_description+'</td>';
                        contentServicesItem += '<td id="colSI-C-'+i+'" class="sorting_1" style="width: 6%; font-weight: '+bold+'; text-align: right;">'+item_cost+'</td>';
                        contentServicesItem += '<td id="colSI-D-'+i+'" class="sorting_1" style="width: 2%; font-weight: '+bold+';"><a href="javascript:fcGetServiceItemRow('+id+','+i+')" data-toggle="tooltip" class="edit"><span class="fas fa-pencil-alt"></a></td>';
                        contentServicesItem += '<td id="colSI-D-'+i+'" class="sorting_1" style="width: 2%; font-weight: '+bold+';"><a href="javascript:deleteServiceItem('+id+')" data-toggle="tooltip" class="delete"><span class="fas fa-trash"></span></a></td>';

                        if(identification_level == 2) {
                            contentServicesItem += '<td id="colSI-D-'+i+'" class="sorting_1" style="width: 2%; font-weight: '+bold+';"><a href="javascript:openModalLaborAppropriation('+id+','+i+')" data-toggle="tooltip" class="edit"><span class="fas fa-hard-hat"></span></a></td>';
                        } else {
                            contentServicesItem += '<td id="colSI-D-'+i+'" class="sorting_1" style="width: 2%;">&nbsp;</td>';
                        }


                        // <td><span class="pull-right badge bg-green" style="font-size: 12px;">Completed</span></td>
                    contentServicesItem += '</tr>';

                }
                contentServicesItem += '<tr>';
                    contentServicesItem += '<td class="sorting_1" style="background-color: #d0d0d0; text-align: right;" colspan="2">Grand Total</td>';
                    contentServicesItem += '<td class="sorting_1" style="background-color: #d0d0d0; text-align: right;"><b>'+grandTotal+'</b></td>';
                    contentServicesItem += '<td class="sorting_1" style="background-color: #d0d0d0;" colspan="3"><b>&nbsp;</b></td>';
                contentServicesItem += '</tr>';


                document.getElementById("divBodyIS").innerHTML = contentServicesItem;

                // document.getElementById("divBodyIS").innerHTML = JSON.stringify(response);

            },
            error: function(xhr, status, error) {

                console.error(error);
            }
        });


    });

}

</script>
