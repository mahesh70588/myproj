<?php
define('TITLE','changepassword');
define('PAGE','changepassword');
include('includes/header.php');
include('connect.php');

session_start();

if(isset($_REQUEST['passupdate'])){
    if($_REQUEST['rpassword'] == ""){
        $passmsg= '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
    }
}



?>

<div class="col-sm-9 col-md-10"><!-- start change password column 2 -->
    <form class="mt-5 mx-5" action="" method="post">
    <?php if (isset($passmsg)) {echo $passmsg;} ?>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control col-md-6" id="inputEmail" readonly>
        </div>

        <div class="form-group">
            <label for="inputnewpassword">New password</label>
            <input type="password" id="inputnewpassword" name="rpassword" class="form-control col-md-6">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary mr-2 mt-4" name="passupdate">Update</button>
            <button type="reset" class="btn btn-secondary mt-4">Reset</button>

            
        </div>
    </form>
</div><!-- end change password column 2 -->

<?php
include('includes/footer.php');
?>
