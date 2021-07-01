<?php
header("X-XSS-Protection: 1; mode=block");
error_reporting(0);
$uname = $_POST['uname'];
$msg= "";
$total="";
$db_connection = mysqli_connect("localhost", "root", "", "sbs");
if(isset($uname)){
if($uname>0 && $uname<=7){
    $query = "SELECT Remaining FROM seatsstatus"; 
    $result = mysqli_query($db_connection,$query);
    $row = mysqli_fetch_array($result);
    if($row['Remaining']>=0){
        $row['Remaining']=$row['Remaining']-$uname;
        $total=$row['Remaining'];
        $msg= "Total seats booked are ".$uname.", Total remaining seats are ".$row['Remaining'].".";
        $sql = "UPDATE seatsstatus SET Remaining='$total'";
        $result = mysqli_query($db_connection,$sql);
    }
    else{
        $msg= "Seats Finished.";

    }    
}
echo "<meta http-equiv='refresh' content='2'>";
}
else{
    $msg="Enter the Seats in Range of 1 to 7 only";
}

?>