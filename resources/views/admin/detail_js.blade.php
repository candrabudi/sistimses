<script>
    $('#get-population').on('click', '.detail-population-data', function() {
        var id = $(this).data('id');
        $.get("/edit/" + id, function(data) {
            let id = data.population_data.id;

            $('#p_nik').html(data.population_data.nik);
            $('#p_name').html(data.population_data.name);
            $('#p_address').html(data.population_data.address);
            $('#p_phone_number').html(data.population_data.phone_number);
            $('#p_person_responsible').html(data.population_data.person_responsible);
            $('#p_information').html(data.population_data.information);
            $('#p_district').html(data.population_data.district);
            $('#p_sub_district').html(data.population_data.sub_district);
            $('#p_gender').html(data.population_data.gender);
            if(data.population_data.photo_id != ""){
                $("#p_photo_id").attr("src", "upload_images/"+data.population_data.photo_id);
            }else{
                if(data.population_data.gender == "Laki-laki"){
                    $("#p_photo_id").attr("src", "https://cdn-icons-png.flaticon.com/512/236/236832.png");
                }else{
                    $("#p_photo_id").attr("src", "https://cdn-icons-png.flaticon.com/512/6997/6997662.png");
                }
            }
            
        });

    });
</script>