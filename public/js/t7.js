/**
 * Created by ITC on 10/25/2016.
 */
$('document').ready(function(){

    $("#err").hide();
    $("#std").keyup   (function (event, ui) {
        var val=$("#std").val();


        if(val.length==7 || val.length==9){
            var status=0,state=1,count=0;
            while(count<=val.length-1){
                if(state==1 && val[count]>=0){
                    state=2
                }else if(state==2 && val[count]>=0){
                    state=3;
                }else if(state==3 && val[count]=='-'){
                    state=4;
                }else if ( ( (state>=4) &&(state<=9) ) && (val[count]>=0)){
                    state++;
                }else
                    status=1;

                count++;
            }
            if(status==0) {
                $.ajax({
                    type: "GET",
                    source: '/stud',
                    data: {'value': $('#std').val()}

                }).done(function (data) {

                    // $('#tab tr:last').after(data);
                    //  $('').html(data);
                    if (data == 1) {

                        $("#err").slideDown();
                    } else {
                        if(data==3){
                            $("#err").slideUp();
                            $("#er2").slideDown();
                            $('#lname').val('');
                            $('#fname').val('');
                            $('#mname').val('');
                            $('#col').val(3);
                            $("#lname").attr('readonly','readonly');
                            $("#fname").attr('readonly','readonly');
                            $("#mname").attr('readonly','readonly');
                            //$("#deg").attr('readonly','readonly');

                        }else{
                            var d=data.split('|');
                            //alert(d[0]);
                            $('#lname').val(d[2].trim());
                            $('#fname').val(d[0].trim());
                            $('#mname').val(d[1].trim());
                            $("#lname").removeAttr('readonly');
                            $("#fname").removeAttr('readonly');
                            $("#mname").removeAttr('readonly');
                            $('#col').val(d[4]);
                            $.ajax({
                                type:"GET",
                                url:"/stud1",
                                data:{'id': d[4]}

                            }).done(function (data) {

                                // $('#tab tr:last').after(data);
                                $('#de').html(data);
                                $('#deg').val(d[3].trim());
                                $('#deg1').val(d[3].trim());
                                console.log(data);
                            }).fail(function(data){
                                //alert("Error");
                                console.log(data);
                            });
                        }

                    }



                    console.log(data);
                }).fail(function (data) {
                    // alert("Error");
                    console.log(data);
                });
                $("#er").slideUp();
                $("#er1").slideUp();
            }else {

                $("#er").slideUp();
                $("#er1").slideDown();
            }
        }else{
            $("#err").slideUp();
            $("#er1").slideUp();
            $("#er2").slideUp();
            if(val.length==0){
                $("#er").slideUp();
            }else if(val.length==8 || val.length>9)
                $("#er").slideDown();
            else if(val.length==9)
                $("#er").slideUp();
            else
                $("#er").slideDown();
            $('#lname').val('');
            $('#fname').val('');
            $('#mname').val('');
            $('#col').val(3);
            $("#lname").attr('readonly','readonly');
            $("#fname").attr('readonly','readonly');
            $("#mname").attr('readonly','readonly');
            //$("#deg").attr('readonly','readonly');

        }



    });


});