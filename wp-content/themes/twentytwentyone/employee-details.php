<?php
    get_header();
    /** Template Name: Employees Details */
?>
    <div class="employee" style="max-width: 300px; margin: 0px auto;">
        <div class="container">
            
            <form action="" method="post" id="employee-details" class="employee-details">
                <span>ID</span>
                <br>
                <input type="text" name="employee_id" class="employee_id" id="employee_id" placeholder="ID">
                <span class="error-id"></span>
                <br>
                <span>Name</span>
                <input type="text" name="employee_name" class="employee_name" id="employee_name" placeholder="Name">
                <span class="error-name"></span>
                <br>
                <span>Enroll No</span>
                <input type="text" name="employee_enrollno" class="employee_enrollno" id="employee_enrollno" placeholder="Enroll No">
                <span class="error-enroll"></span>
                <br>
                <span>Mobile No</span>
                <input type="text" name="employee_mobileno" class="employee_mobileno" id="employee_mobileno" placeholder="Mobile No">
                <span class="error-mobile"></span>
                <br>
                <span>Email</span>
                <input type="email" name="employee_email" id="employee_email" class="employee_email" placeholder="Email">
                <span class="error-email"></span>
                <br>
                <span>Resume Upload</span>
                <input type="file" name="employee_file" id="employee_file" class="employee_file">
                <span class="error-file"></span>
                <br>
                <br>
                <span class="error-general"></span>
                <input type="submit" value="Submit" name="submit" id="submit" class="submit">
            </form>
        
        </div>
    </div>
<?php
    get_footer();
?>