<script>
    $('#get-person-responsible').on('click', '.edit-person-responsible', function() {
        var id = $(this).data('id');
        $.get("/person-responsible/edit/" + id, function(data) {
            let id = data.population_data.id;
            $('#e_name').val(data.population_data.name);
            $('#e_address').val(data.population_data.address);
            $('#e_phone_number').val(data.population_data.phone_number);
            $('select[name="e_district"]').append('<option value="' + data.population_data.data_district.district_id +  ',' + data.population_data.data_district.city_id +  '" selected>' + data.population_data.district + '</option>');
            $('select[name="e_sub_district"]').append('<option value="' + data.population_data.data_sub_district.id + '" selected>' + data.population_data.sub_district + '</option>');
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
                        formData.append('e_name', $('#e_name').val());
                        formData.append('e_phone_number', $('#e_phone_number').val());
                        formData.append('e_district', $('#e_district').val());
                        formData.append('e_sub_district', $('#e_sub_district').val());
                        formData.append('e_address', $('#e_address').val());
                        $.ajax({
                            url: 'person-responsible/update/'+ id,
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
                                        window.location.href = '/person-responsible';
                                    }
                                });
                            },
                            error: function(xhr, response) {
                                if (xhr.responseJSON.code == 400) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Maaf Data tidak Valid!',
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