<?php
    session_start();

    $namae = $_POST["userName"];
    $passCode = $_POST["passCode"];

    $_SESSION["userName"] = $namae;
    $_SESSION["passCode"] = $passCode;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "api-database";
    $_SESSION["tableName"] = "products";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if($conn->connect_error)
    {
        die("Connection Failed: " . $conn->connect_error);
    }

    $query = "INSERT INTO `api-credentials` (username, passCode) VALUES ('$namae', '$passCode')";

    if(mysqli_query($conn, $query))
    {
        //If Success redirect to customer area

        $query = "INSERT INTO `customer` (c_Name, c_passCode, c_Money) VALUES ('$namae', '$passCode', 'R1000')";
        mysqli_query($conn, $query);

        header("Location: ../Customer/Customer.php");
    }
    else
    {
        //show failure message
        header("Location: ../System-messages/error.html");
    }

?>