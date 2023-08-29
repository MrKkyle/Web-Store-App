<?php
session_start();

$servername = "localhost";
$database = $_SESSION["dbName"];
$tableName = "customer";
$username = "root";
$password = "";
$columns = array();
$columnNames = array();

$conn = mysqli_connect($servername, $username, $password, $database);
if($conn->connect_error)
{
    die("Connection Failed: " . $conn->connect_error);
}

$name = $_SESSION["userName"];
$passCode = $_SESSION["passCode"];

//echo($name);
$query = "SELECT * FROM `api-credentials` WHERE userName = '$name' AND passCode = '$passCode'";
if((mysqli_query($conn, $query)) == false)
{
    echo "
    <div class = 'omega-container'>
    <div class = 'bg-img'>
    <div class = 'modal1'>
    <div class = 'modal-content'>
    <img src = '../Media/error.gif' alt = 'Avatar' class = 'avatar'>
    <br><br><br><br><br><br><br><br>
    <div class = 'text'>Error! Bad Login Attempt<br></div>  
    <button class = 'button' onclick = 'window.location.href = `Admin.php`;'>Proceed</button>
    "; 
}

$query1 = "SELECT c_Money, c_name FROM $tableName WHERE c_name = '$name'";
$result = $conn->query($query1);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $c_Money = $row["c_Money"]; 
        $c_Name = $row["c_name"];

        /* Set as session variables */
        $_SESSION["c_Money"] = $row["c_Money"];
        $_SESSION["c_name"] = $row["c_name"];
    }
}

?>
<html>
<head>
    <link rel = "stylesheet" type = "text/css" href = "../Main.css" ></link> 	    
</head>
<body>

    <div class = "splash-screen">
        Welcome <?php print_r($_SESSION["userName"]);?>
    </div>
    <div class = 'background-image'>
        <div class = "modal1">
            <div class = "welcome sign"></div>
            <div class = "dashboard">
                <div class = "blocks username">
                    <div class = "blocks-text">
                        Welcome back <?php print_r($c_Name);?> !
                    </div>
                </div>
                <div class = "blocks coupon">
                    <div class = "blocks-text">
                        Available Balance:<br><?php print_r($c_Money);?>
                    </div>
                </div>
                <div class = "blocks activity" onclick = "window.location.href = '../Login.html';">
                    <div class = "blocks-text">
                        Logout
                    </div>
                </div>
            </div>  
        

            <button class = "button" type = "button" 
            onclick = "window.location.href = 'Products.php';"
            style = "width: 30%; left: 50%; transform: translate(-50%, 0%); border-radius: 0px;"
            
            >View Products</button>
        </div>    
    </div>
</body>
<script src = "Scripts.js"></script>
</html>