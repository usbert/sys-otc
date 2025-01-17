<script>
    // ********* SAVING SERVICE ITEM **********
    function fcAddLabor() {

        // form-data-item-service
        document.formLaborAppropriation.employee_role_id.value = document.getElementById("employee_role_id").value;
        document.formLaborAppropriation.hours.value = document.getElementById("hours").value;
        document.formLaborAppropriation.rate.value = document.getElementById("rate").value;

        var data = $('#formLaborAppropriation').serialize();

        $.ajax({
            type: 'post',
            url: "{{ url('pco/store-labor-appropriation/') }}",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // beforeSend: function(){
            //     console.log('....Please wait');
            // },
            success: function(response){

                toastr.options = timeOut = 10000;
                toastr.options = {
                    "progressBar" : true,
                    "closeButton" : true,
                    "positionClass": "toast-bottom-full-width",
                    "onclick": true,
                    "fadeIn": 300,
                    "fadeOut": 1000,
                },
                toastr.success("<b>{{ __('messages.Successfully recorded') }}!</b>", "{{ __('messages.Success') }}!");

                // loadServiceItemsByUser(1);
                $('#formLaborAppropriation')[0].reset();

            },
            complete: function(response){
                console.log('Created New');
            },
            error: function(errors) {

                // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                console.log('TODOS', errors.responseJSON);
                // console.log('PARCIAL NIVEIS', errors.responseJSON.errors);

                if(errors.responseJSON.errors.employee_role_id) {
                    message_erro_aux = errors.responseJSON.errors.employee_role_id[0];
                    message_erro = message_erro_aux.replace("employee role id", " <b>{{__('messages.Function')}}</b>")

                } else if(errors.responseJSON.errors.hours) {
                    message_erro_aux = errors.responseJSON.errors.hours[0];
                    message_erro = message_erro_aux.replace("hours", "<b>{{ __('messages.Hours') }}</b>")

                } else if(errors.responseJSON.errors.rate) {
                    message_erro_aux = errors.responseJSON.errors.rate[0];
                    message_erro = message_erro_aux.replace("rate description", "<b>{{ __('messages.Rate') }}</b>")

                } else {
                    message_erro = errors.responseJSON.errors;
                }

                toastr.options = timeOut = 10000;
                toastr.options = {
                    "progressBar" : true,
                    "closeButton" : true,
                    "positionClass": "toast-bottom-full-width",
                    "onclick": true,
                    "fadeIn": 300,
                    "fadeOut": 1000,

                },
                toastr.error(message_erro, "<b>{{ __('messages.Attention') }}</b>!");


            }

        });

    }
</script>
