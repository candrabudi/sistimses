<script>
    $(document).ready(function() {
        $('#submit-data').click(function() {
            Swal.fire({
                title: 'Yakin?',
                text: "Kamu akan menambahkan data",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                customClass: {
                    confirmButton: 'btn btn-primary me-3',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    const formData = new FormData();
                    formData.append('nik', $('#nik').val());
                    formData.append('name', $('#name').val());
                    formData.append('phone_number', $('#phone_number').val());
                    formData.append('district', $('#district').val());
                    formData.append('sub_district', $('#sub_district').val());
                    formData.append('person_responsible', $('#person_responsible').val());
                    formData.append('information', $('#information').val());
                    formData.append('address', $('#address').val());
                    formData.append('gender', $('#gender').val());
                    formData.append('photo_id', $('#photo_id')[0].files[0]);
                    $.ajax({
                        url: '/store',
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data Berhasil Ditambahkan!',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                buttonsStyling: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/dashboard';
                                }
                            });
                        },
                        error: function(xhr, response) {
                            if (xhr.responseJSON.code === 1001) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Mohon check tipe foto yang diupload',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                });
                            }
                            if (xhr.responseJSON.code === 422) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Mohon Check Kembali Inputan Anda',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                });
                            }
                            if(xhr.responseJSON.code === 400) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                });
                            } 
                            if(xhr.responseJSON.code === 500){
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Ada Kesalahan Internal!',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                });
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Penambahan Dibatalkan',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });
    });
</script>