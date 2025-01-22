<script>

function fcUpdateLaborAppropriation() {

    // form-data-item-service
    service_item_id = document.formLaborAppropriation.service_item_id.value;
    document.formLaborAppropriation.employee_role_id.value = document.getElementById("employee_role_id").value;
    document.formLaborAppropriation.hours_aux.value = document.getElementById("hours").value;
    document.formLaborAppropriation.rate_aux.value = document.getElementById("rate").value;


    setTimeout(function() {

        var data = $('#formLaborAppropriation').serialize();
        console.log(data);

        $.ajax({
            type: 'post',
            url: "{{ url('pco/update-labor-appropriation/') }}",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(){
                console.log('Please wait...', data);
            },
            success: function(response){

                // TOASTR ALERT
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

                document.getElementById("employee_role_id").value = '';
                document.getElementById("hours").value = '';
                document.getElementById("rate").value = '';

            },
            complete: function(response){
                console.log('Updated');
            },
            error: function(errors) {

                // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                // console.log('TODOS', errors.responseJSON);
                console.log('PARCIAL APPROPRIATION', errors.responseJSON.errors);

                if(errors.responseJSON.errors.service_item_id) {
                    message_erro_aux = errors.responseJSON.errors.service_item_id[0];
                    message_erro = message_erro_aux.replace("service item id", " <b>{{__('messages.Service Item')}}</b>")

                } else if(errors.responseJSON.errors.employee_role_id) {
                    message_erro_aux = errors.responseJSON.errors.employee_role_id[0];
                    message_erro = message_erro_aux.replace("employee role id", " <b>{{__('messages.Function')}}</b>")

                } else if(errors.responseJSON.errors.hours) {
                    message_erro_aux = errors.responseJSON.errors.hours[0];
                    message_erro = message_erro_aux.replace("hours", "<b>{{ __('messages.Hours') }}</b>")

                } else if(errors.responseJSON.errors.rate) {
                    message_erro_aux = errors.responseJSON.errors.rate[0];
                    message_erro = message_erro_aux.replace("rate", "<b>{{ __('messages.Rate') }}</b>")

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


    }, 300);




}
</script>
