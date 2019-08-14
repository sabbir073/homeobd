<?php 

//dashboard functions
include("db.php");
$name = $_SESSION['name'];
$query = "SELECT * FROM users WHERE username = '".$name."' LIMIT 1";
$result = mysqli_query($con,$query);
$data = mysqli_fetch_assoc($result);
$rows = mysqli_num_rows($result);
if ($rows == 1){
    $credit = $data['credit'];
    $email = $data['email'];
    $role = $data['role'];
    $pending = $data['pending'];
}
else {
    echo mysqli_error($con);
}

//getting all users
$query2 = "SELECT * FROM users";
$result2 = mysqli_query($con,$query2);
$data2 = mysqli_fetch_assoc($result2);
$total_users = mysqli_num_rows($result2);


//geting all patient
$query3 = "SELECT * FROM patient";
$result3 = mysqli_query($con,$query3);
$data3 = mysqli_fetch_assoc($result3);
$total_patients = mysqli_num_rows($result3);

//geting all symptoms
$query4 = "SELECT * FROM symptoms";
$result4 = mysqli_query($con,$query4);
$data4 = mysqli_fetch_assoc($result4);
$total_symptoms = mysqli_num_rows($result4);

//geting all medicines
$query5 = "SELECT * FROM medicines";
$result5 = mysqli_query($con,$query5);
$data5 = mysqli_fetch_assoc($result5);
$total_medicines = mysqli_num_rows($result5);