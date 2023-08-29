<?php 
session_start();

/* ensures that names are the same FROM DIFFERENT PAGES */
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

<head>
<link rel = "stylesheet" type = "text/css" href = "../Main.css" ></link>   
</head>
<body>
    <div class = "background-image">
        <div class = "modal1"></div>
    </div>

    <button class = "button" style = "z-index: 2; left: 50%; transform: translate(-50%, 0%); top: 3%;"
        type = "button" onclick = "window.location.href = 'Admin.php';">Edit</button>

    <div class = "table-info">
        <?php 
        $mysqli = new mysqli($servername, $username, $password, $dbname); 
        $query = "SELECT * FROM $tableName";
        
        echo '<table border = "0" cellspacing = "2" cellpadding = "2" color = "white">';
        
        for($i = 0; $i < sizeof($columnNames) - 1; $i++)
        {
            echo"
            
                <td><font face = 'Arial' 
                style = 'font-weight: bold; font-size: 20px;'>$columnNames[$i]</font> </td>
            ";
        }
        
        /*Make this flexable */
        if ($result = $mysqli->query($query)) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                for($i = 0; $i < sizeof($columnNames) - 1; $i++)
                {
                    ${'field' . $i . 'name'} = $row["$columnNames[$i]"];
                }
                
                echo" <tr>";
                for($i = 0; $i < sizeof($columnNames); $i++)
                {
                    
                    echo"
                    
                    <td> ${'field' . $i . 'name'} </td>
                        ";

                }
                echo" </tr>";     
            }
            $result->free();
        } 
        ?>  
    </div>
</body>