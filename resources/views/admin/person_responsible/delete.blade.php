<script>
    $(function() {
        $('#get-person-responsible').on('click', '.delete-person-responsible', function() {
            var id = $(this).data('id');

            Swal.fire({
                text: 'Apakah kamu yakin mau menghapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm: () => {
                    return $.ajax({
                        url: '/person-responsible/delete/' + id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            return response;
                        },
                        error: function(xhr, response) {
                            if (xhr.responseJSON.code == 400) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Maaf Data Tidak Bisa Dihapus!',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                });
                            }
                            if (xhr.responseJSON.code == 404) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Maaf data tidak ditermukan!',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                });
                            }
                        }
                    });
                },
            }).then(function(result) {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Dihapus!',
                        text: 'Data kamu berhasil di hapus. kamu akan segera dialihkan',
                        timer: 1000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        },
                        customClass: {
                            confirmButton: 'btn btn-success d-none'
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location = '/person-responsible'
                        }
                    });
                }
            });
        });
    });
</script>