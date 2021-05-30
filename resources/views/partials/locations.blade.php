<script type="text/javascript">
    // Select Location
    $(document).on('change', '#country_id', function() {
        var country_id = $(this).val();
        if(country_id){
        $.ajax({
            url:"{{ url('get_cities') }}?country_id=" + country_id,
            type: "GET",
            success: function(res){        
                if(res){
                    $("#city_id").empty();
                    $("#city_id").append('<option>{{ trans('admin.all_cities') }}</option>');
                    $("#district_id").empty();
                    $("#district_id").append('<option>{{ trans('admin.all_districts') }}</option>');
                    $.each(res, function(key, value){
                        $("#city_id").append('<option value="'+ key +'">'+ value +'</option>');
                    });
                } else {
                    $("#city_id").empty();
                }
            }
        });
        } else {
            $("#city_id").empty();
            $("#district_id").empty();
        }   
    });
    $(document).on('change', '#city_id', function() {
        var city_id = $(this).val();
        if(city_id){
        $.ajax({
            url:"{{ url('get_districts') }}?city_id=" + city_id,
            type: "GET",
            success: function(res){        
                if(res){
                    $("#district_id").empty();
                    $("#district_id").append('<option>{{ trans('admin.all_districts') }}</option>');
                    $.each(res, function(key, value){
                        $("#district_id").append('<option value="'+ key +'">'+ value +'</option>');
                    });
                } else {
                    $("#district_id").empty();
                }
            }
        });
        } else {
            $("#district_id").empty();
        }   
    });
</script>