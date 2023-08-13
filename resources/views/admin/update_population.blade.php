<script>
    $('#get-population').on('click', '.edit-population-data', function() {
        var id = $(this).data('id');
        $.get("/edit/" + id, function(data) {
            let id = data.population_data.id;

            $('#e_nik').val(data.population_data.nik);
            $('#e_name').val(data.population_data.name);
            $('#e_address').val(data.population_data.address);
            $('#e_phone_number').val(data.population_data.phone_number);
            $('#e_person_responsible').val(data.population_data.person_responsible);
            $('#e_information').val(data.population_data.information);
            $('select[name="e_district"]').append('<option value="' + data.population_data.data_district.district_id +  ',' + data.population_data.data_district.city_id +  '" selected>' + data.population_data.district + '</option>');
            $('select[name="e_sub_district"]').append('<option value="' + data.population_data.data_sub_district.id + '" selected>' + data.population_data.sub_district + '</option>');
            $('select[name="e_gender"]').append('<option value="' + data.population_data.gender + '" selected>' + data.population_data.gender + '</option>');
            $('select[name="e_person_responsible"]').append('<option value="' + data.population_data.person_responsible_id + '" selected>' + data.population_data.person_responsible + '</option>');
            $('#edit-submit-data').click(function() {
                Swal.fire({
                    title: 'Yakin?',
                    text: "Kamu akan Melakukan Perubahan Data",
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
                        formData.append('e_nik', $('#e_nik').val());
                        formData.append('e_name', $('#e_name').val());
                        formData.append('e_phone_number', $('#e_phone_number').val());
                        formData.append('e_district', $('#e_district').val());
                        formData.append('e_sub_district', $('#e_sub_district').val());
                        formData.append('e_person_responsible', $('#e_person_responsible').val());
                        formData.append('e_information', $('#e_information').val());
                        formData.append('e_address', $('#e_address').val());
                        formData.append('e_photo_id', $('#e_photo_id')[0].files[0]);
                        $.ajax({
                            url: '/update/'+ id,
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                Swal.fire({
                                    title: 'Berhasl!',
                                    text: 'Data Berhasil Di Ubah!',
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
                                if (xhr.responseJSON.code == 400) {
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
                                if (xhr.responseJSON.code == 500) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Maaf Ada Kesalahan Internal!',
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
                            title: 'Perubahan Dibatalkan',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });
        })
    });
</script>