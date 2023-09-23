<?php
    get_header();
    /** Template Name: Employees */
?>
    
    <?php
        $employee = new WP_Query(array(
            'post_type' => 'employees',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        ));
        
        ?>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>EnRoll Number</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($employee->have_posts()) {
                        $employee->the_post();
                        $post_id = get_the_ID();

                        $enroll_no = get_field('enroll_no',$post_id);
                        $name = get_field('name',$post_id);
                        $email = get_field('email',$post_id);

                        ?>
                            <tr id="<?php echo $post_id; ?>">
                                <td class="enroll_no"><?php echo $enroll_no; ?></td>
                                <td class="name"><?php echo $name; ?></td>
                                <td class="email"><?php echo $email; ?></td>
                                <td><a href="javascript:void(0)" class="edit">Edit</a></td>
                                <td><a href="javascript:void(0)" class="delete">Delete</a></td>
                            </tr>
                        <?php
                    }
                ?>
            <tbody>
    
        </table>

        <form action="" method="post" name="update-emplyoyee" id="update-emplyoyee">
            <input type="text" id="id" class="id" hidden>
            <span>Name</span>
            <input type="text" name="update_employee_name" class="update_employee_name" id="update_employee_name" placeholder="Name">
            <span class="update-error-name"></span>
            <br>
            <span>Enroll No</span>
            <input type="text" name="update_employee_enrollno" class="update_employee_enrollno" id="update_employee_enrollno" placeholder="Enroll No">
            <span class="update-error-enroll"></span>
            <br>
            <span>Email</span>
            <input type="email" name="update_employee_email" id="update_employee_email" class="update_employee_email" placeholder="Email">
            <span class="update-error-email"></span>
            <br>
            <br>
            <span class="update-error-general"></span>
            <input type="submit" value="Submit" name="submit" id="submit" class="submit">
        </form>
        <?php
        
        
        wp_reset_query();
    ?>
<?php
    get_footer();
?>