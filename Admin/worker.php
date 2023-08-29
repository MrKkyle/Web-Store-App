<?php 
session_start();

function addInfo()
{   
    $servername = "localhost";
    $database = $_SESSION["dbName"];
    $username = "root";
    $password = "";
    $column = "";
    $values = "";
    
    $conn = mysqli_connect($servername, $username, $password, $database);
    if($conn->connect_error)
    {
        die("Connection Failed " . $conn->connect_error);
    }    
    
    if(isset($_POST["tableName"]) == false)
    {
        $tableName = $_SESSION["tableName"];
    }
    else
    {
        $tableName = $_POST["tableName"];
        $_SESSION["tableName"] = $_POST["tableName"];
    }
            /* Column Names */
    $query = "SHOW COLUMNS FROM $tableName";
    $db = mysqli_query($conn, $query);
    while($set = mysqli_fetch_row($db))
    {
        $columnNames[] = $set[0];
    }
    
    /* Values of form data stored in variables */
    for($i = 0; $i < (sizeof($_POST) - 1); $i++)
    {
        ${'value' . $i} = $_POST["value$i"];          
    }
    /* Construct the query */
    for($v = 0; $v < (sizeof($_POST) - 1); $v++)
    {   

        $column .= $columnNames[$v] . ", ";
        $values .= "'" .${'value' . $v} . "'" . ", ";
    } 
    /* Remove last characters */
    $column = rtrim($column, ", ");
    $values = rtrim($values, ", ");

    $query = "INSERT INTO $tableName
    ($column) VALUES
    ($values)"; 
    
    if(mysqli_query($conn, $query))
    {
        echo "
            <div class = 'omega-container'>
            <div class = 'bg-img'>
            <div class = 'modal1'>
            <div class = 'modal-content'>
            <img src = '../Media/Simple1.gif' alt = 'Avatar' class = 'avatar'>
            <br><br><br><br><br><br><br><br>
            <div class = 'text'>Query successful!<br></div>  
            <button class = 'button' onclick = 'window.location.href = `Admin.php`;'>Proceed</button>
        ";
    } 
    else
    {
        echo "
        <div class = 'omega-container'>
        <div class = 'bg-img'>
        <div class = 'modal1'>
        <div class = 'modal-content'>
        <img src = '../Media/Simple1.gif' alt = 'Avatar' class = 'avatar'>
        <br><br><br><br><br><br><br><br>
        <div class = 'text'>Query unsuccessful!<br></div>  
        <button class = 'button' onclick = 'window.location.href = `Admin.php`;'>Proceed</button>
        ";
    }
       
}

function updateInfo()
{
    $servername = "localhost";
    $database = $_SESSION["dbName"];
    $username = "root";
    $password = "";
    $tableName = "";
    $ID = $_POST["ID"]; /* Identification */
    $changeID = $_POST["changeID"]; /* old value */
    $newID = $_POST["newID"];   /* new value */
    
    $conn = mysqli_connect($servername, $username, $password, $database);
    if($conn->connect_error)
    {
        die("Connection Failed " . $conn->connect_error);
    } 
        /* Table Name */
    if(isset($_POST["tableName"]) == false)
    {
        $tableName = $_SESSION["tableName"];
    }
    else
    {
        $tableName = $_POST["tableName"];
        $_SESSION["tableName"] = $_POST["tableName"];
    }
            /* Column Names */
    $query = "SHOW COLUMNS FROM $tableName";
    $db = mysqli_query($conn, $query);
    while($set = mysqli_fetch_row($db))
    {
        $columnNames[] = $set[0];
    }


    $query = "UPDATE $tableName SET $changeID = '$newID' WHERE sku = '$ID'";
    if(mysqli_query($conn, $query))
    {
        echo "
            <div class = 'omega-container'>
            <div class = 'bg-img'>
            <div class = 'modal1'>
            <div class = 'modal-content'>
            <img src = '../Media/Simple1.gif' alt = 'Avatar' class = 'avatar'>
            <br><br><br><br><br><br><br><br>
            <div class = 'text'>Query successful!<br></div>  
            <button class = 'button' onclick = 'window.location.href = `Admin.php`;'>Proceed</button>
        ";
    } 
    else
    {
        echo "
        <div class = 'omega-container'>
        <div class = 'bg-img'>
        <div class = 'modal1'>
        <div class = 'modal-content'>
        <img src = '../Media/Simple1.gif' alt = 'Avatar' class = 'avatar'>
        <br><br><br><br><br><br><br><br>
        <div class = 'text'>Query unsuccessful!<br></div>  
        <button class = 'button' onclick = 'window.location.href = `Admin.php`;'>Proceed</button>
        ";
    }
    
}

function deleteInformation()
{
    $servername = "localhost";
    $database = $_SESSION["dbName"];
    $tableName = $_SESSION["tableName"];
    $username = "root";
    $password = "";
    $delID = $_POST["delID"];
    
    $conn = mysqli_connect($servername, $username, $password, $database);
    if($conn->connect_error)
    {
        die("Connection Failed " . $conn->connect_error);
    }    

    $query1 = "DELETE FROM $tableName WHERE sku = '$delID'";
    
    if(mysqli_query($conn, $query1))
    {
        echo "
            <div class = 'omega-container'>
            <div class = 'bg-img'>
            <div class = 'modal1'>
            <div class = 'modal-content'>
            <img src = '../Media/Simple1.gif' alt = 'Avatar' class = 'avatar'>
            <br><br><br><br><br><br><br><br>
            <div class = 'text'>Query successful!<br></div>  
            <button class = 'button' onclick = 'window.location.href = `Admin.php`;'>Proceed</button>
        ";
    } 
    else
    {
        echo "
        <div class = 'omega-container'>
        <div class = 'bg-img'>
        <div class = 'modal1'>
        <div class = 'modal-content'>
        <img src = '../Media/Simple1.gif' alt = 'Avatar' class = 'avatar'>
        <br><br><br><br><br><br><br><br>
        <div class = 'text'>Query unsuccessful!<br></div>  
        <button class = 'button' onclick = 'window.location.href = `Admin.php`;'>Proceed</button>
        ";
    }

}

function emptyInformation()
{
    $servername = "localhost";
    $database = $_SESSION["_dbname"];
    $username = "root";
    $password = "";
    /* Get the table Name */
    $tableName = $_POST["emptyTable"];

    $conn = mysqli_connect($servername, $username, $password, $database);
    if($conn->connect_error)
    {
        die("Connection Failed " . $conn->connect_error);
    }    

            /* Column Names */
       
    $query = "SHOW COLUMNS FROM $tableName";
    $db = mysqli_query($conn, $query);
    if($db == FALSE)
    {
        header("location: Error-tbs.php");  
    }
    $query = "TRUNCATE $tableName";

    if(mysqli_query($conn, $query))
    {
        echo "
            <div class = 'omega-container'>
            <div class = 'bg-img'>
            <div class = 'modal1'>
            <div class = 'modal-content'>
            <img src = '../Media/Simple1.gif' alt = 'Avatar' class = 'avatar'>
            <br><br><br><br><br><br><br><br>
            <div class = 'text'>Query successful!<br></div>  
            <button class = 'button' onclick = 'window.location.href = `Admin.php`;'>Proceed</button>
        ";
    } 
    else
    {
        echo "
        <div class = 'omega-container'>
        <div class = 'bg-img'>
        <div class = 'modal1'>
        <div class = 'modal-content'>
        <img src = '../Media/Simple1.gif' alt = 'Avatar' class = 'avatar'>
        <br><br><br><br><br><br><br><br>
        <div class = 'text'>Query unsuccessful!<br></div>  
        <button class = 'button' onclick = 'window.location.href = `Admin.php`;'>Proceed</button>
        ";
    }
}

function createReport()
{
    $tableName = $_POST["newTb"];
    $columnNames = array();
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = $_SESSION["dbName"];

    $adminName = $_SESSION["userName"];
    $credentials = $_POST["credentials"];
    
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

    $mysqli = new mysqli($servername, $username, $password, $dbname); 
    $query = "SELECT * FROM $tableName";

    $line = "------------------------------------------------------------------------------------------\n\n";
    $myfile = fopen("newReport.txt", "w") or die("Unable to open file!");

    $heading = "THIS IS A REPORT CREATED BY $adminName on: " . date("Y/m/d") . " " . date("h:i:sa") . "\n";
    
    $body1 = "Find Below the description of the Products and their respecitive details: \n";
    $body2 = "";
    
    fwrite($myfile, $heading);
    fwrite($myfile, $line);
    fwrite($myfile, $body1);
    fwrite($myfile, $line);

    for($i = 0; $i < sizeof($columnNames) - 1; $i++)
    {
        $body2 = $body2 . $columnNames[$i] . " \t";
    }
    $body2 = $body2 . "\n";
    fwrite($myfile, $body2);

    $body3 = "";
    if ($result = $mysqli->query($query)) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            for($i = 0; $i < sizeof($columnNames) - 1; $i++)
            {
                ${'field' . $i . 'name'} = $row["$columnNames[$i]"];
            }
            for($i = 0; $i < sizeof($columnNames) - 1; $i++)
            {
                $body3 = $body3 . ${'field' . $i . 'name'} . "\t";
                if($i == 5)
                {
                    $body3 = $body3 . "\n";
                    fwrite($myfile, $body3);
                    $body3 = "";
                }
            }  
        }
        $result->free();
    }

    $ending = "\nAdmin: Signed By ##$credentials##" ;
    fwrite($myfile, $ending);
    fclose($myfile);
    
    echo "
        <div class = 'omega-container'>
        <div class = 'bg-img'>
        <div class = 'modal1'>
        <div class = 'modal-content'>
        <img src = '../Media/Simple1.gif' alt = 'Avatar' class = 'avatar'>
        <br><br><br><br><br><br><br><br>
        <div class = 'text'>Report Created Sucessfully!<br></div>  
        <button class = 'button' onclick = 'window.location.href = `Admin.php`;'>Proceed</button>
    ";
}

?>
<head>
<link rel = "stylesheet" type = "text/css" href = "../Main.css" ></link>   
</head>
<body>

<div class = "background-image">
    <div class = "modal1"></div>
</div>


<!-- success -->
<?php 
    if(isset($_POST['addBtn']))
    {
        addInfo();
    } 
    else if(isset($_POST['updateBtn']))
    {
        updateInfo();
    }
    else if(isset($_POST['delDbBtn']))
    {
        deleteInformation();
    }
    else if(isset($_POST['emptyTb']))
    {
        emptyInformation();
    }
    else if(isset($_POST['createReport']))
    {
        createReport();
    }    
    else
    {
        header("Location: ../System-messages/error.html");
    }
?>
</body>




