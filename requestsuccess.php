<?php
session_start();
define('TITLE','Success');
include('includes/header.php');
include('connect.php');















if (isset($_SESSION['myid'])) {

$sql = "SELECT * FROM submitrequest_tb WHERE request_id = 
{$_SESSION['myid']}";
$result = $conn->query($sql);


if (!$result) {
    die("Error: ".$conn->error);
}


if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    echo "<div class='ml-5 mt-5'>
        <table class='table'>
            <tbody>
                <tr>
                    <th>\n\n\nRequest Id</th>
                    <td>" . $row['request_id'] . "</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>" . $row['requester_name'] . "</td>
                </tr>
                <tr>
                    <th>Email Id</th>
                    <td>" . $row['requester_email'] . "</td>
                </tr>
                <tr>
                    <th>Request Info</th>
                    <td>" . $row['request_info'] . "</td>
                </tr>
                <tr>
                    <th>Request Description</th>
                    <td>" . $row['request_desc'] . "</td>
                </tr>
                <tr>
                    <td>
                        <form class='d-print-none'>
                            <input class='btn btn-danger' type='submit' value='Print' onClick='window.print()'>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>";
} else {
    echo "<div class='alert alert-danger col-sm-6 ml-5 mt-2'>No matching request found.</div>";
}
} else {
echo "<div class='alert alert-danger col-sm-6 ml-5 mt-2'>Session variable 'myid' not set.</div>";
}

?>

<?php
include('includes/footer.php');
?>

