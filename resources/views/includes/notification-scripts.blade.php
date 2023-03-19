<script>

    function del() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            console.log(result.value)
            if (result.value === true) {
                $('#right-modal').modal('hide');
                Livewire.emit('delete')
            }
        })
    }
    function delPro() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            console.log(result.value)
            if (result.value === true) {
                $('#right-modal').modal('hide');
                Livewire.emit('del')
            }
        })
    }

    Livewire.on('mess', event => {
        $(event.modal).modal('hide');
        toastr.success(event.mess, 'Success')
    })
    Livewire.on('deleted', postId => {
        $('#exampleModal').modal('hide');
        toastr.error('Deleted')
    })
    Livewire.on('created', event => {
        $('#exampleModal').modal('hide');
        toastr.success('Item Created', 'Success')
    })
    Livewire.on('updated', event => {
        $('#exampleModal').modal('hide');
        toastr.success('Item Updated', 'Success')
    })
    Livewire.on('message', event => {
        $('#exampleModal').modal('hide');
        toastr.info(event, 'Alert')
    })
    Livewire.on('error', event => {
        $('#exampleModal').modal('hide');
        toastr.error(event, 'Alert')
    })

    Livewire.on('accepted', event => {
        $('#orderModal').modal('hide');
        toastr.success('Code is Valid and has been activated', 'Success')
    })
    Livewire.on('rejected', event => {
        $('#orderModal').modal('hide');
        toastr.error('Code has been used or is expired', 'Error')
    })
</script>
