
<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $max = strlen($characters) - 1;
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[mt_rand(0, $max)];
    }
    
    return $randomString;
}

if(isset($_POST['submit'])){
    $un = $_POST['userName'];
    $pas = $_POST['password'];
    
    $server = "mysql:host=localhost;dbname=project";
    $username = "root";
    $password = "";
               
    try{
        $conn = new PDO($server, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "SELECT * FROM user WHERE username = '$un' AND password = '$pas';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        if($result){
            $randomString = $result[0]['userId'];
        }else{
            $randomString = generateRandomString(10);
            $sql = "INSERT INTO user (userName, password, userId) VALUES ('$un', '$pas', '$randomString')";
            $conn->exec($sql);
        }
        
        
    }
    catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                return null;
            }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Forcast</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="images/external-weather-app-weather-app-inipagistudio-mixed-inipagistudio.png"/>
        <h1>Weather Forcast</h1>
    </header>

    <div id="main">
        <div class="search">
        <form method="post" action="app.php">
            <label for="city-name">City Name:</label>
            <input type="text" id="cityname" name="cityname" required>
            <input type="hidden" name="hidden_field" value="<?php echo $randomString  ?>">
            <button type="submit" name="submit">Search</button>
        </form>
        <div>
        <a id="history" href="history.php?userId=<?php echo $randomString ?>">History</a>
        </div>
        </div>

    </div>

    <div id="forcast">
        <div id="sunny">
        </div>
    </div>
</body>
</html>