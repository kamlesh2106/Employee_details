jQuery(function($){

    
    $('#myTable').DataTable( {
        dom: 'Qlfrtip',
        searchBuilder: {
            columns: [1,2]
        }
    });
    $('.employee_id, .employee_mobileno').keypress(function (e) {    
        var charCode = (e.which) ? e.which : event.keyCode    
        if (String.fromCharCode(charCode).match(/[^0-9]/g))    
            return false;                        
    }); 
     
    $(".delete").click(function(){
        
        var id = $(this).parent().parent().attr("id");
        $.ajax({
            type : "post",
            dataType : "json",
            url : custom.ajaxurl,
            data : {
                action: "delete_employee_post", 
                id: id
            },
            success: function(response) {
                location.reload(true);
            }
         });
    });

    $("form#update-emplyoyee").css('display','none');
    $(".edit").click(function(){

        var id = $(this).parent().parent().attr("id");
        var enroll_no = $(this).parent().parent().find(".enroll_no").text();
        var name = $(this).parent().parent().find(".name").text();
        var email = $(this).parent().parent().find(".email").text();

        $('#id').val(id);
        $('#update_employee_name').val(name);
        $('#update_employee_enrollno').val(enroll_no);
        $('#update_employee_email').val(email);
        $("form#update-emplyoyee").css('display','block');
      
    });

    $('.employee_email').on('change', function (e) { 
        var email = $("#employee_email").val();
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
            $(".error-email").text("Please Enter valid email");
            $(".error-email").css("color","red");
            return false;
        }else{
            $(".error-email").text("");
        }
    });
    

    $("form#employee-details").submit(function(event){
        event.preventDefault();

        var employee_id = $('#employee_id').val();
        var employee_name = $('#employee_name').val();
        var employee_enrollno = $('#employee_enrollno').val();
        var employee_mobileno = $('#employee_mobileno').val();
        var employee_email = $('#employee_email').val();
        var employee_file = $('#employee_file').val();

        console.log(console.log ($('#employee_file').prop('files')));
        if(
            employee_id == '' || 
            employee_name == '' || 
            employee_enrollno == '' || 
            employee_mobileno == '' ||
            employee_email == '' ||
            employee_file == ''
        ){
            $(".error-general").text("Please Enter all the details.");
            $(".error-general").css("color","red");
        }else{
            $(".error-general").text("");
        }

        if(employee_enrollno.length >10 || employee_enrollno.length <10){
            $(".error-enroll").text("Please enter only unique 10 digit.");
            $(".error-enroll").css("color","red");
            return false;
        }else{
            $(".error-enroll").text("");
            
        }
        
        if(employee_mobileno.length >10 || employee_mobileno.length <10){
            $(".error-mobile").text("Please enter only 10 digit number.");
            $(".error-mobile").css("color","red");
            return false;
        }else{
            $(".error-mobile").text("");
        
        }

        if(
            employee_id != '' || 
            employee_name != '' || 
            employee_enrollno != '' || 
            employee_mobileno != '' ||
            employee_email != '' ||
            employee_file != ''
        ){
            $.ajax({
                type : "post",
                dataType : "json",
                url : custom.ajaxurl,
                data : {
                    action: "store_employee_details_to_employee_post_type", 
                    employee_id : employee_id, 
                    employee_name: employee_name,
                    employee_enrollno: employee_enrollno,
                    employee_mobileno: employee_mobileno,
                    employee_email: employee_email,
                    employee_file: employee_file,
                },
                success: function(response) {
                   console.log(response);
                    // employee_id = $('#employee_id').val("");
                    // employee_name = $('#employee_name').val("");
                    // employee_enrollno = $('#employee_enrollno').val("");
                    // employee_mobileno = $('#employee_mobileno').val("");
                    // employee_email = $('#employee_email').val("");
                    // employee_file = $('#employee_file').val("");
                }
             });
        }


        
    });

    $("form#update-emplyoyee").submit(function(event){
        event.preventDefault();
        
        var id = $("#id").val();
        var employee_name = $('#update_employee_name').val();
        var employee_enrollno = $('#update_employee_enrollno').val();
        var employee_email = $('#update_employee_email').val();

        if(
            employee_name == '' || 
            employee_enrollno == '' || 
            employee_email == ''
        ){
            $(".update-error-general").text("Please Enter all the details.");
            $(".update-error-general").css("color","red");
        }else{
            $(".update-error-general").text("");
        }

        if(employee_enrollno.length >10 || employee_enrollno.length <10){
            $(".update-error-enroll").text("Please enter only unique 10 digit.");
            $(".update-error-enroll").css("color","red");
            return false;
        }else{
            $(".update-error-enroll").text("");
            
        }

        if(
            employee_name != '' || 
            employee_enrollno != '' || 
            employee_email != ''
        ){
            $.ajax({
                type : "post",
                dataType : "json",
                url : custom.ajaxurl,
                data : {
                    action: "update_employee_post",
                    id: id,
                    employee_name: employee_name,
                    employee_enrollno: employee_enrollno,
                    employee_email: employee_email,
                },
                success: function(response) {
                    location.reload(true);
               
                }
             });
        }


        
    });
    
});
