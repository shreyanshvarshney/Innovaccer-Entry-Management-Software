<?php
    session_start();
    function Message(){
        if(isset($_SESSION["ErrorMessage"])){
            $ErrorMessage = "<div class=\"alert alert-danger\">".htmlentities($_SESSION["ErrorMessage"])."</div>";
            $_SESSION["ErrorMessage"] = null;
            return $ErrorMessage;
        }
    }

    function SuccessMessage(){
        if(isset($_SESSION["SuccessMessage"])){
            $ErrorMessage = "<div class=\"alert alert-success\">".htmlentities($_SESSION["SuccessMessage"])."</div>";
            $_SESSION["SuccessMessage"] = null;
            return $ErrorMessage;
        }
    }
    if(isset($_POST['CheckOut'])){
        $Id = $_SESSION['id'];
        $Checkin_time = $_SESSION['checkin_time'];
        date_default_timezone_set("Asia/Kolkata");
        $CurrentTime = time();
        $DateTime = strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
    
        $query = "UPDATE visitors SET datetime = '$DateTime',checkin_time = '$Checkin_time' WHERE id= $Id";
    
                $execute_query = mysqli_query($connection,$query);
                
                if($execute_query){
                    $_SESSION["SuccessMessage"] = "Thank you for visiting! You successfully checked out.";
                    $query1 = "SELECT name FROM hosts ORDER BY time_added DESC";
		            $execute_query = mysqli_query($connection,$query1);
                    $row = mysqli_fetch_array($execute_query);

                    $query2 = "SELECT * FROM visitors ORDER BY checkin_time DESC";
		            $execute_query = mysqli_query($connection,$query2);
                    $row2 = mysqli_fetch_array($execute_query);

        $sub = "Innovaccer: Your visit Detials";
        $msg = "Your visit Detials: <br> Name:".$row2['name']."<br> Phone: ".$row2['phone']."<br> Checkin_time".$row2['checkin_time']."<br> Host Name: ".$row['name']."<br> Address visited: Innovaccer Noida, Sector-62, Uttar Pradesh, India";
		$rec = $row2['email'];
		mail($rec,$sub,$msg);

		
	// Authorisation details.
	$username = "shreyanshvarshney.sv@gmail.com";
	$hash = "028ed665c6322600d3a81102d127e3f11674b3a98074c059000e669a4eac04bd";

	// Config variables. Consult http://api.txtlocal.com/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "Innovaccer: Your visit Detials"; // This is who the message appears to be from.
	$numbers = $row2['phone']; // A single number or a comma-seperated list of numbers
	$message = "Your visit Detials: <br> Name:".$row2['name']."<br> Phone: ".$row2['phone']."<br> Checkin_time".$row2['checkin_time']."<br> Host Name: ".$row['name']."<br> Address visited: Innovaccer Noida, Sector-62, Uttar Pradesh, India";

	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.txtlocal.com/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	curl_close($ch);
                    

                    header("Location:index.php");
                    exit;
                }
                else{
                    $_SESSION["ErrorMessage"] = "Failed to check you out, Try again!";
                    header("Location:visitor.php");
                    exit;
                }
    
    }

?>