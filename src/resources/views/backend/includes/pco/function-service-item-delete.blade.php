<script>

// Delete Service Item
function deleteServiceItem(id) {

    Swal.fire({
        title: "{{ __('messages.Confirm record deletion') }}",
        text: "{{ __('messages.You wont be able to reverse this') }}!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "{{ __('messages.Yes delete') }}!"
        }).then((result) => {
        if (result.isConfirmed) {

            document.form_delete_service_item.id.value = id;

            var data = $('#form_delete_service_item').serialize();

            $.ajax({
                type: 'post',
                url: "{{ '/pco/delete-service-item' }}",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

            });

            Swal.fire({
                title: "{{ __('messages.Deleted') }}!",
                text: "{{ __('messages.Successfully deleted record') }}!",
                icon: "success"
            });

            // REFRESH DATATABLE
            setTimeout(function() {
                loadServiceItemsByUser({{ Auth::user()->id }});
            }, 200);

        }
    });

}

</script>
