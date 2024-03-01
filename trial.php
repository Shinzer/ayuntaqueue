<?php
$STUDENT_NUMBER = $_POST['student'];
$MOBILE_NUMBER = $_POST['mobile'];
$COUNTER_NUMBER = $_POST['counter'];
$DATE = DATE("d-m-y");
$studentnumberErr = "";
$mobilenumberErr = "";
$counternumberErr = "";

$studentnumberErr = empty($_POST['student']) ? "student number is Required" : NULL;

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

        if ($COUNTER_NUMBER == 1 || $COUNTER_NUMBER == 2 || $COUNTER_NUMBER == 3 || $COUNTER_NUMBER == 4){
            $counter_table = "counter_" . $COUNTER_NUMBER;
            $varquery = "SELECT QUEUE_NO FROM $counter_table ORDER BY QUEUE_NO DESC LIMIT 1";
            $varquery_results = mysqli_query($conn, $varquery);
            if (mysqli_num_rows($varquery_results) > 0) {
                $row = mysqli_fetch_assoc($varquery_results);
                $QUEUE_NUMBER = $row['QUEUE_NO'] + 1;
            } else {
                $QUEUE_NUMBER = 1;
            }
            
            $insertQuery = "INSERT INTO $counter_table (STUDENT_NUMBER, MOBILE_NUMBER, QUEUE_NO, TIME_CUR) VALUES ('$STUDENT_NUMBER', '$MOBILE_NUMBER', '$QUEUE_NUMBER', NOW())";
            $results = mysqli_query($conn, $insertQuery);
            if ($results) {
                header('Location: postindex.html');
            } else {
                die(print_r(sqlsrv_errors(), true));
            }
        }
        
        
        


        
    } else {
        echo "$studentnumberErr <br> $mobilenumberErr";
    
    }
}
?>