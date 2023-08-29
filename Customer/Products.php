<?php 
session_start();

$tableName = $_SESSION["tableName"];
$columnNames = array();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = $_SESSION["dbName"];

$conn = mysqli_connect($servername, $username, $password, $dbname);
if($conn->connect_error)
{
    die("Connection Failed: " . $conn->connect_error);
}

$query = "SHOW COLUMNS FROM $tableName";
$result = $conn->query($query);
while($row = $result->fetch_assoc())
{
    $columns[] = $row['Field']; 
}

        /* Column Names */
$db = mysqli_query($conn, $query);
while($set = mysqli_fetch_row($db))
{
    $columnNames[] = $set[0];
}


?>
<html>
<head>
    <link rel = "stylesheet" type = "text/css" href = "../Main.css" ></link> 	    
</head>
<body>
    <div class = "card-container">
    <?php 
        $mysqli = new mysqli($servername, $username, $password, $dbname); 
        $query = "SELECT * FROM $tableName";
        
        $p_name = array();
        $p_price = array();
        $p_sku = array();

        /*Make this flexable */
        if ($result = $mysqli->query($query)) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                for($i = 0; $i < sizeof($columnNames); $i++)
                {
                    ${'field' . $i . 'name'} = $row["$columnNames[$i]"];
                }
                
                echo "
                        <div class = 'card'>
                            <img class = 'image' src = '${'field' . 6 . 'name'}' atl = 'Avatar'>
                            <div class = 'card-text'>
                                
                                <div class = 'heading'>${'field' . 1 . 'name'}</div>
                                <div class = 'price'>R${'field' . 2 . 'name'}</div>
                                <div class = 'description'>${'field' . 4 . 'name'}</div>
                                
                                <button class = 'button' style = 'width: 50%; border-radius: 0px;'>Purchase now!</button>
                            </div>
                        </div>
                    ";
            }
            $result->free();
        } 
    ?>
    </div> 

    <div class = 'omega-container' id = "transaction" style = "display: none;">
        <div class = 'modal1'>
            <form class = 'modal-content' action = "transaction.php" method = "post">
            <span onclick = "document.getElementById('transaction').style.display = 'none'" class = "close" title = "Close Modal"></span>
                <img src = '../Media/error.gif' style = "border-radius: 0%;" alt = 'Avatar' class = 'avatar'><br><br>
                <div class = 'text' style = "font-size: 15px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                    <hr style = 'width: 80%;'><br>
                    Customer Name: <?php print_r($_SESSION["c_name"]);?><br><br>
                    Customer Funds: <?php print_r($_SESSION["c_Money"]);?><br><br>

                    <div class = 'text-form'><b>Confirm you are Human</b></div>
                    <input type = 'text' placeholder = 'Correctly Enter Name of Product' name = 'productName' autocomplete = 'off' required>
                    <br>
                    
                    <div class = 'text-form'><b>Transaction Amount:</b></div>
                    <div class = "tr_amt" style = "text-align: center;"></div>

                    <button class = 'button5' style = "width: 50%;" type = "submit" >Complete Transaction</button>
                </div>  
                
        </div>    
    </div>
</body>
<script src = "transaction.js"></script>
</html>