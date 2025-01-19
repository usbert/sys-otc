<script>

function loadLaborAppropriationByUser(user_id) {

    $(document).ready( function () {

        // LIMPAR TUDO ANTES DE CRIAR NOVA DATATABLE
        $('#ajax-datatable-labor-appropriation').DataTable().clear().destroy();

        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        });

        $('#ajax-datatable-labor-appropriation').DataTable({
            processing: false,
            serverSide: true,
            searching: true,
            ajax: "{{ url('pco/get-labor-appropriation-by-user/') }}"+user_id,
            columns: [
                { data: 'employee_role_name',   name: 'employee_role_name', orderable: true, width: "70%" },
                { data: 'hours',                name: 'hours', orderable: true, width: "10%" },
                { data: 'rate',                 name: 'rate', orderable: false, width: "10%" },
                { data: 'total',                 name: 'total', orderable: false, width: "10%" },
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pageLength',
                    className: 'btn btn-primary btn-sm'
                },
                {
                    extend:    'copyHtml5',
                    text:      '<i class="fas fa-copy" style="font-size: 24px;"></i>',
                    titleAttr: "{{ __('Copy') }}"
                },
                {
                    extend:    'excelHtml5',
                    text:      '<i class="fas fa-file-excel" style="font-size: 24px;"></i>',
                    titleAttr: 'Excel'
                },
                {
                    extend:    'csvHtml5',
                    text:      '<i class="fas fa-file-csv" style="font-size: 24px;"></i>',
                    titleAttr: 'CSV'
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<i class="fas fa-file-pdf" style="font-size: 24px;"></i>',
                    titleAttr: 'PDF'
                },
                {
                    "extend": "print",
                    'text':      '<i class="fas fa-print" style="font-size: 24px;"></i>',
                    titleAttr: "{{ __('Print') }}"
                }
            ],
            order: [[0, 'asc']],

            // DEFINIR SE COLUNA Descrição É VISIVEL (true ou false)
            columnDefs: [{
                targets: [0],
                visible: true
            }],
            // QUANTIDADE DE LINHAS NA PÁGINA
            lengthMenu: [
                [6, 8, 10, 25, 50, 100, -1],
                ['6', '8', 10, '25', '50', '100', 'Todos']
            ],
            pageLength: '10',

            // Traduzir Mostrar 10 registros (traduzir padrões de textos do datatable)
            // language: {
            //     url: "backend/{{ __('datatable-en') }}.json"

            // },
        });

        // hideLoading();

    });


}

</script>
