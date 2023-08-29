<?php 
session_start();

$servername = "localhost";
$database = $_SESSION["dbName"];
$tableName = $_SESSION["tableName"];
$username = "root";
$password = "";
$columns = array();
$columnNames = array();

$conn = mysqli_connect($servername, $username, $password, $database);
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

<!DOCTYPE html>
<html>
<head>
    <link rel = "stylesheet" type = "text/css" href = "../Main.css" ></link> 	    
</head>
<body>

    <div class = "splash-screen">
        Welcome <?php print_r($_SESSION["userName"]);?>
    </div>
    <div class = 'background-image'>
        <div class = 'modal1'>

        <div class = "information2">
            <b>Connected to:</b> <?php print_r($database); ?> <br>
            
            <b>Using table:</b> <?php print_r($tableName)?> <br>
            
            <b>Column Names:</b> <br><?php
            for($i = 0; $i < sizeof($columnNames); $i++)
            {print_r($columnNames[$i] . " <br>");}
            ?> <br>

        </div>

            <div class = "editdb" id = "edit">
                <div class = "text-in">Edit Database and tables</div>
                <div class = "line"></div>
                <br>
                <button class = "button-home" type = "button" onclick = "window.location.href = 'table.php';">View Table Information<i class = "m" style = "background-image: url('../Media/view.png');"></i></button><br>
                <button class = "button5" type = "button">Add Table Information<i class = "m" style = "background-image: url('../Media/new.png');"></i></button><br>
                <button class = "button5" type = "button">Update Table Information<i class = "m" style = "background-image: url('../Media/update.png'); left: 220px;"></i></button><br>
                <button class = "button5" type = "button">Delete Table Information<i class = "m" style = "background-image: url('../Media/remove.png');"></i></button><br>
                <button class = "button5" type = "button">Empty Table Information<i class = "m" style = "background-image: url('../Media/remove.png');"></i></button><br>
                <button class = "button5" type = "button">Create a Report<i class = "m" style = "background-image: url('../Media/empty-box-32.png'); left: 220px;"></i></button><br>
                <button class = "button" style = "width: 300px; height: 45px;" onclick = "window.location.href = '../Landing-page.html';">Return to home<i class = "m" style = "background-image:url('../Media/home.png');"></i></button><br>
            </div>

            <!-- Add info to database -->
            <div class = "database-div" id = "info1">
                <span onclick = "document.getElementById('info1').style.display = 'none'" class = "close" title = "Close Modal" ></span>
                <br>
                <div class = "text-modal">Add Information</div><br><br>
                <form method = "post" action = "worker.php">

                <?php
                    /* enables the form to shift depending on the table information */
                    for($i = 0; $i < sizeof($columnNames); $i++)
                    {
                        echo"
                        <div class = 'text-modal'>$columnNames[$i]</div>
                        <input type = 'text' name = 'value$i' placeholder = 'Enter value' autocomplete = 'off' required>
                        <br><br>
                        ";
                    }
                ?>

                    <button class = "button" type = "submit" name = "addBtn">Confirm</button>
                </form>
            </div>

            <!-- Update database Info -->
            <div class = "database-div" id = "info2">
                <span onclick = "document.getElementById('info2').style.display = 'none'" class = "close" title = "Close Modal" ></span>
                <br>       
                <div class = "text-modal">Update Table Information</div><br>
                <form method = "post" action = "worker.php">
                    <div class = "text-modal">Enter Old value</div><br>
                    <input type = "text" name = "ID" placeholder = "Enter Product SKU" autocomplete = "off" required>
                    <br><br>
                    <div class = "text-modal">Enter field(Column) that will be changed</div><br>
                    <input type = "text" name = "changeID" placeholder = "Enter value" autocomplete = "off" required>
                    <br><br>
                    <div class = "text-modal">Enter new Value</div><br>
                    <input type = "text" name = "newID" placeholder = "Enter new value" autocomplete = "off" required>
                    <br><br>
                    
                    <button class = "button" type = "submit" name = "updateBtn">Confirm</button>
                </form>
            </div>

            <!-- Delete database info-->
            <div class = "database-div" id = "info3">
                <span onclick = "document.getElementById('info3').style.display = 'none'" class = "close" title = "Close Modal" ></span>
                <br>     
                <div class = "text-modal">Delete Table Information</div>
                <form method = "post" action = "worker.php">
                    <br>
                    <div class = "text-modal">Enter SKU</div>
                    <input type = "text" name = "delID" placeholder = "Enter SKU" autocomplete = "off" required>
                    <br><br>

                    <button class = "button" type = "submit" name = "delDbBtn">Confirm</button>
                </form>
            </div>
            
            <!-- Empty Table Information -->
            <div class = "database-div" id = "info4">
                <span onclick = "document.getElementById('info4').style.display = 'none'" class = "close" title = "Close Modal"></span>
                <br>
                <div class = "text-modal">Empty Table Data</div><br>
                <div class = "text-modal">This will remove all the information in the Table, please proceed with caution. Lost information cannot be returned again</div><br>
                <form method = "post" action = "worker.php">
                    <div class = "text-modal">Enter Table Name</div><br>
                    <input type = "text" name = "emptyTable" placeholder = "Enter table name" autocomplete = "off" required>
                    <br><br>

                    <button class = "button" type = "submit" name = "emptyTb">Confirm</button>
                </form>
            </div>

            <!-- Create report -->
            <div class = "database-div" id = "info5">
                <span onclick = "document.getElementById('info5').style.display = 'none'" class = "close" title = "Close Modal"></span>
                <br>
                <div class = "text-modal">Create a Report</div><br>
                <form method = "post" action = "worker.php">
                    <div class = "text-modal">Admin Credentials</div><br>
                    <input type = "text" name = "credentials" placeholder = "Enter your Admin Credentials" autocomplete = "off" required>
                    <br><br>

                    <div class = "text-modal">Enter Table Name to create Report from</div><br>
                    <input type = "text" name = "newTb" placeholder = "Enter table name" autocomplete = "off" required>
                    <br><br>

                    <button class = "button" type = "submit" name = "createReport">Confirm</button>
                </form>
            </div>
        </div>   
    
    </div>
</body>

<script src = "../Scripts/Scripts.js"></script>
<script src = "Scripts.js"></script>
</html>