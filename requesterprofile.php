<?php
define('TITLE','requesterprofile');
define('PAGE','requesterprofile');
include('includes/header.php');



?>



 <!--start profile area 2nd column-->
 <div class="col-sm-6 mt-5">
<form action="" method="POST" class="mx-5">
    <div class="form-group">
        <label for="rEmail">Email</label><input type="email"  class="form-control"
         name="rEmail" id="rEmail" readonly>
    </div>

    <div class="form-group">
        <label for="rName">Name</label><input type="text"  class="form-control" name="rName" id="rName">
    </div>

    <button type="submit" class="btn btn-primary" name="nameupdate">Update</button>
</form>
 

 </div><!--end profile area-->






 <?php
include('includes/footer.php');
?>
