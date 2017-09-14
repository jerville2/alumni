/**
 * Created by ITC on 5/16/2017.
 */

// collegeMap
$(document).ready(function($){
    $('#collegeList').change(function(){
        $.get("/degreeList",
            { option: $(this).val()},
            function(data) {
                var degreeList = $('#degreeList');
                degreeList.empty();

                degreeList.append("<option value= null> -- Any Degree -- </option>");
                $.each(data, function(index, element) {
                    degreeList.append("<option value='"+ index +"'>" + element + "</option>");
                });
            });
    });
});

$(document).ready(function($){
    $('#degreeList').change(function(){
        $.get("/majorList",
            { option: $(this).val()},
            function(data) {
                var majorList = $('#majorList');
                majorList.empty();

                majorList.append("<option value=''> -------- </option>");
                $.each(data, function(index, element) {
                    majorList.append("<option value='"+ index +"'>" + element + "</option>");
                });
            });
    });
});

// Address map
$(document).ready(function($){
    $('#provList').change(function(){
        $.get("/city",
            { option: $(this).val()},
            function(data) {
                var cityList = $('#cityList');
                cityList.empty();

                cityList.append("<option value='0'> Please Select </option>");
                $.each(data, function(index, element) {
                    cityList.append("<option value='"+ index +"'>" + element + "</option>");
                });
            });
    });
});

$(document).ready(function($){
    $('#cityList').change(function(){
        $.get("/brgy",
            { option: $(this).val()},
            function(data) {
                var brgyList = $('#brgyList');
                brgyList.empty();

                provList.append("<option value='0'> Please Select </option>");
                $.each(data, function(index, element) {
                    brgyList.append("<option value='"+ index +"'>" + element + "</option>");
                });
            });
    });
});