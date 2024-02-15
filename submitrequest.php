<?php
session_start();
define('TITLE','submitrequest');
define('PAGE','submitrequest');
include('includes/header.php');
include('connect.php');



if(isset($_REQUEST['submitrequest'])){
    //checking for empty fields
    if(empty($_POST['requestinfo']) || empty($_POST['requestdesc']) || empty($_POST['requestername']) || empty($_POST['requesteradd1']) || empty($_POST['requesteradd2']) || empty($_POST['requestercity']) || empty($_POST['requesterstate']) || empty($_POST['requesterzip']) || empty($_POST['requesteremail']) || empty($_POST['requestermobile']) || empty($_POST['requesterdate'])) {
    
        $msg = "<div class='alert alert-warning col-sm-6 ml-5 mt-2'>Fill All fields</div>";
    }
    else{
        $rinfo=$_REQUEST['requestinfo'];
        $rdesc=$_REQUEST['requestdesc'];
        $rname=$_REQUEST['requestername'];
        $radd1=$_REQUEST['requesteradd1'];
        $radd2=$_REQUEST['requesteradd2'];
        $rcity=$_REQUEST['requestercity'];
        $rstate=$_REQUEST['requesterstate'];
        $rzip=$_REQUEST['requesterzip'];
        $remail=$_REQUEST['requesteremail'];
        $rmobile=$_REQUEST['requestermobile'];
        $rdate=$_REQUEST['requesterdate'];
        $sql= "INSERT INTO submitrequest_tb(request_info,request_desc,requester_name,requester_add1,requester_add2,requester_city,requester_state,requester_zip,requester_email,requester_mobile,request_date) VALUES('$rinfo','$rdesc' ,'$rname','$radd1' ,'$radd2' , '$rcity' ,'$rstate' , '$rzip' ,'$remail' , '$rmobile' , '$rdate')";
        if($conn->query($sql) == TRUE){
            $genid = mysqli_insert_id($conn);
            $msg="<div class='alert alert-success col-sm-6 ml-5 mt-2'>Request submitted succesfully!</div>";
            $_SESSION['myid'] = $genid;
            echo "<script> location.href='requestsuccess.php'</script>";
            //echo "Redirecting...";
        }
        else{
            "<div class='alert alert-danger col-sm-6 ml-5 mt-2'>Request not submitted.</div>";
        }

    }

}
?>

<div class="col-sm-9 col-md-10 mt-3"><!--start service request form-->
<?php if (isset($msg)){echo $msg;} ?>
<form class="mx-5" action="" method="POST">
    <div class="form-group">
        <label for="inputrequestinfo">Request Info</label>
        <input type="text" class="form-control" id="inputrequestinfo" placeholder="Request Info" name="requestinfo">
    </div>

    <div class="form-group">
        <label for="inputrequestdescription">Description</label></label>
        <input type="text" class="form-control" id="inputrequestdescription" placeholder="Write Description" name="requestdesc">
    </div>

    <div class="form-group">
        <label for="inputname">Name</label>
        <input type="text" class="form-control" id="inputname" placeholder="Write Name" name="requestername">
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="inputaddress">Adress Line 1</label>
        <input type="text" class="form-control" id="inputaddress" placeholder="Write address" name="requesteradd1">
    </div>

    <div class="form-group col-md-6">
        <label for="inputaddress2">Adress Line 2</label>
        <input type="text" class="form-control" id="inputaddress2" placeholder="Write address" name="requesteradd2">
    </div>
    </div>

    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputcity">City</label>
        <input type="text" class="form-control" id="inputcity" placeholder="city" name="requestercity">
    </div>
    <div class="form-group col-md-4">
        <label for="inputState">State</label>
        <input type="text" class="form-control" id="inputstate" placeholder="state" name="requesterstate">
    </div>
    <div class="form-group col-md-2">
        <label for="inputzip">Zip</label>
        <input type="text" class="form-control" id="inputzip"  name="requesterzip" onkeypress="isInputNumber(event)">
    </div>
    </div>

    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputemail">Email Id</label>
        <input type="email" class="form-control" id="inputemail" name="requesteremail">
    </div>

    <div class="form-group col-md-2">
        <label for="inputmobile">Mobile No.</label>
        <input type="text" class="form-control" id="inputmobile"  name="requestermobile" onkeypress="isInputNumber(event)">
    </div>

    <div class="form-group col-md-2">
        <label for="inputdate">Date</label>
        <input type="date" class="form-control" id="inputdate"  name="requesterdate">
    </div>
    </div>

    <button type="submit" class="btn btn-primary" name="submitrequest">Submit</button>
    <button type="reset" class="btn  btn-secondary">Reset</button>
</form>



</div><!--end service request form-->

<!--only number for input fields-->
<script>
    function isInputNumber(evt){
        var ch=String.fromCharCode(evt.which);
        if(!(/[0-9]/.test(ch))){
            evt.preventDefault();
        }    }
</script>




<?php
include('includes/footer.php');
?>
