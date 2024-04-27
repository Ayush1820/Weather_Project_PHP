<?php
$server = "mysql:host=localhost;dbname=project";
$username = "root";
$password = "";

try{
    $conn = new PDO($server, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
function insertData($city, $temp) {
    try {
        $sql = "INSERT INTO project (city, temperature) VALUES ('$city', '$temp')";
        $conn->exec($sql);
        echo "New record created successfully";
    } catch(PDOException $e) {
        // Handle insertion error
        echo "Error: " . $e->getMessage();
    }
}

function getData() {
    try {
        $sql = "SELECT * FROM project";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            foreach ($result as $row) {
                echo "City: " . $row["city"] . " - Temperature: " . $row["temperature"] . "<br>";
            }
        } else {
            echo "0 results";
        }
    } catch(PDOException $e) {
        // Handle retrieval error
        echo "Error: " . $e->getMessage();
    }
}

// Usage example:
$conn = connectToDatabase();
if ($conn) {
    insertData($conn, "New York", 25);
    getData($conn);
    // Close connection
    $conn = null;
} else {
    echo "Failed to connect to the database.";
}

?>