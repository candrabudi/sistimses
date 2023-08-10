<script>
    $(document).ready(function() {
        $("#district").change(function() {

            var stateID = $(this).val();
            console.log("stateID");
            if (stateID) {
                $.ajax({
                    url: "/sub-district",
                    dataType: 'Json',
                    data: {
                        'district_city_id': stateID
                    },
                    success: function(data) {
                        $('select[name="sub_district"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="sub_district"]').append('<option value="' + value.id + '">' + value.subdistrict_name + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#e_district").change(function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    url: "/sub-district",
                    dataType: 'Json',
                    data: {
                        'district_city_id': stateID
                    },
                    success: function(data) {
                        $('select[name="e_sub_district"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="e_sub_district"]').append('<option value="' + value.id + '">' + value.subdistrict_name + '</option>');
                        });
                    }
                });
            }else{
                $('select[name="e_sub_district"]').empty();
            }
        });
    });
</script>