<?php
session_start();
include './connection.php';

if (!isset($_SESSION['id'])) {
    echo "<script>alert('Login Required');window.location='login.php'</script>";
}
if($_POST)
{
    $opass = $_POST['opass'];
    $npass = $_POST['npass'];
    $cpass = $_POST['cpass'];
    $uid = $_SESSION['id'];

    $oq = mysqli_query($connection,"select * from tbl_emp where emp_id='{$uid}'");
    $odata = mysqli_fetch_array($oq);
    if($odata['emp_password'] == $opass){
        if($npass == $cpass)
        {
            if($opass == $npass)
            {
                echo "<script>alert('New Password Can not be same as Old password');</script>";
            }else{
                $uq = mysqli_query($connection,"update tbl_emp set emp_password ='{$npass}' where emp_id='{$uid}'");
                echo "<script>alert('Password Updated');</script>";
            }
        }else{
            echo "<script>alert('New Password and Confirm Password Need to be Same');</script>";
        }
    }else{
        echo "<script>alert('Old Password Not Match');</script>";
    }
}
?>
<html>
    <body>
        <form method="POST">
            Old Password : <input type="password" name="opass" required /><br/>
            New Password : <input type="password" name="npass" required /><br/>
            Confirm Password : <input type="password" name="cpass" required /><br/>
            <input type="submit" />
        </form>
    </body>
</html>