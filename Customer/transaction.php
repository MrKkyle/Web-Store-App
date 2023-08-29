<?php 
session_start();

$money = $_SESSION["c_Money"];
$productName = $_POST["productName"];
$c_Name = $_SESSION["c_name"];
$price;
$quantity;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = $_SESSION["dbName"];


$conn = mysqli_connect($servername, $username, $password, $dbname);
if($conn->connect_error)
{
    die("Connection Failed: " . $conn->connect_error);
}

$query1 = "SELECT productPrice, productQuantity, SKU FROM products WHERE productName = '$productName'";

$result = $conn->query($query1);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
       $price = $row["productPrice"]; 
       $quantity = $row["productQuantity"];
    }
}
$money = ltrim($money, 'R');
$amount = (intval($money) - intval($price));

$amount = (string)$amount;
$quantity = $quantity - 1;


$query2 = "UPDATE customer SET c_Money = '$amount' WHERE c_Name = '$c_Name'";
$query3 = "UPDATE products SET productQuantity = '$quantity' WHERE productName = '$productName'";

if(mysqli_query($conn, $query2) && mysqli_query($conn, $query3))
{
    echo "
    <div class = 'omega-container'>
    <div class = 'bg-img'>
    <div class = 'modal1'>
    <div class = 'modal-content'>
    <img src = '../Media/Simple1.gif' alt = 'Avatar' class = 'avatar'>
    <br><br><br><br><br><br><br><br>
    <div class = 'text-form'><b>Transaction Complete!</b></div>
    <div class = 'text-form'><b>Return to Customer Area</b></div>
    <button class = 'button' type = 'button' onclick = 'window.location.href = `Customer.php`;'>Return</button>
    ";
}
else
{
    echo "
    <div class = 'omega-container'>
    <div class = 'bg-img'>
    <div class = 'modal1'>
    <div class = 'modal-content'>
    <img src = '../Media/error.gif' alt = 'Avatar' class = 'avatar'>
    <br><br><br><br><br><br><br><br>
    <div class = 'text'>Error! <br></div>  
    <button class = 'button' type = 'button' onclick = 'window.location.href = `Customer.php`;'>Return</button>
    ";
}



?>
<html>
<head>
    <meta name = "viewport" content = "width = device-width, initial-scale = 1" charset="utf-8">
    <link rel = "stylesheet" type = "text/css" href = "../Main.css">
</head>
<body> 
</body>
</html>