<?php
$STUDENT_NUMBER = $_POST['student'];
$MOBILE_NUMBER = $_POST['mobile'];
$COUNTER_NUMBER = $_POST['counter'];
$QUEUE_NUMBER = 0;
$studentnumberErr = "";
$mobilenumberErr = "";
$counternumberErr = "";


//if Student Name empty
$studentnumberErr = empty($_POST['student']) ? "student number is Required" : NULL;

//if contact empty
if (empty($_POST['mobile'])) {
    $mobilenumberErr = "Mobile Number is Required";
} else {
    $mobilenumberErr = (strlen($_POST['mobile']) != 11) ? "Mobile should be 10 digits" : $mobilenumberErr;
}

if (isset($_POST['submit'])) {
    if ($studentnumberErr == "" && $mobilenumberErr == "") {
        $serverName = "localhost";
        $username = "root";
        $password = "";
        $dbname = "oli";
        $conn = mysqli_connect($serverName, $username, $password, $dbname);
        if ($conn == false){
            die(print_r(sqlsrv_errors(), true));
        }

        $query = "INSERT INTO ayunta (STUDENT_NUMBER, MOBILE_NUMBER, COUNTER_NUMBER) VALUES('$STUDENT_NUMBER', '$MOBILE_NUMBER', '$COUNTER_NUMBER')";
        $results = mysqli_query($conn, $query);
        if ($results) {
            //header("Location: login.html");
            exit();
            //echo 'Registration Successful';
        } else {
            die(print_r(sqlsrv_errors(), true));
        }
    } else {
        echo "$studentnumberErr <br> $mobilenumberErr";
    
    }
}
?>