<script>

 function fcUpdateServiceItem() {

    document.formItemService.service_item_id.value = document.getElementById("service_item_id").value;
    document.formItemService.level_01.value = document.getElementById("level_01").value;
    document.formItemService.level_02.value = document.getElementById("level_02").value;
    document.formItemService.item_description.value = document.getElementById("item_description").value;
    document.formItemService.item_cost.value = document.getElementById("item_cost").value;

// $(".submit-form").click(function(e) {
    // e.preventDefault();

    var data = $('#formItemService').serialize();

    $.ajax({
        type: 'post',
        url: "{{ url('pco/update-service-item/') }}",
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        // beforeSend: function(){
        //     console.log('....Please wait');
        // },
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

            loadServiceItemsByUser({{ Auth::user()->id }});

            document.getElementById("level_01").value           = '';
            document.getElementById("level_02").value           = '';
            document.getElementById("item_description").value   = '';
            document.getElementById("item_cost").value          = '';

            $('#formItemService')[0].reset();

            document.getElementById("btnSaveSI").style.display = "";
            document.getElementById("btnUpdateSI").style.display = "none";
            document.getElementById("btnCancelSI").style.display = "none";

        },
        complete: function(response){
            console.log('Updated');
        },
        error: function(errors) {

            // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
            // console.log('TODOS', errors.responseJSON);
            // console.log('PARCIAL', errors.responseJSON.errors);

            if(errors.responseJSON.errors.level_01) {
                message_erro_aux = errors.responseJSON.errors.level_01[0];
                message_erro = message_erro_aux.replace("level 01", " <b>{{__('messages.Level 01')}}</b>")

            } else if(errors.responseJSON.errors.level_02) {
                message_erro_aux = errors.responseJSON.errors.level_02[0];
                message_erro = message_erro_aux.replace("level 02", "<b>{{ __('messages.Level 02') }}</b>")

            } else if(errors.responseJSON.errors.item_description) {
                message_erro_aux = errors.responseJSON.errors.item_description[0];
                message_erro = message_erro_aux.replace("item description", "<b>{{ __('messages.Description') }}</b>")

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

// });

}
</script>
