<script>

function loadLaborAppropriationByUser(service_item_id, user_id) {

    $(document).ready( function () {

        $('#ajax-datatable-labor-appropriation').DataTable().clear().destroy();

        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        });

        $('#ajax-datatable-labor-appropriation').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            paging: false,
            info: false,
            ajax: "{{ url('pco/get-labor-appropriation-by-user/') }}/"+service_item_id+'/'+user_id,
            columns: [
                { data: 'employee_role_name',   name: 'employee_role_name',     orderable: false, width: '60%' },
                { data: 'hours',                name: 'hours',                  orderable: false, width: '10%' },
                { data: 'rate',                 name: 'rate',                   orderable: false, width: '10%' },
                { data: 'subtotal',             name: 'subtotal',               orderable: false, width: '10%' },
                { data: 'action',               name: 'action',                 orderable: false, width: '10%', className: "text-right" },
            ],
            // dom: 'Bfrtip',
            order: [[1, 'asc']],
                columnDefs: [{
                width: '5%',
                targets: [0],
                visible: true
            },
        ],
        });

    });

}

</script>
