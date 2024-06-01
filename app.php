<?php include "process.php";

if(isset($_POST['submit'])){
    $city = $_POST['cityname'];
    $hidden_value = $_POST['hidden_field'];
    global $hidden_value;
    $img['src'] = '';
    getWeather($hidden_value);
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
        <input type="hidden" name="hidden_field" value="<?php echo $hidden_value  ?>">
        <button type="submit" name="submit">Search</button>
    </form>
    <div>
            <a id="history" href="history.php?userId=<?php echo $hidden_value ?>">History</a>
        </div>
        </div>
    </div>

    <div id="forcast">
        <div id="sunny">
            <h1 id="temperature"></h1>            
            <?php if (isset($GlobalWeather)) { ?>
                    <div style="font-size: 40px;" ><?php echo $GlobalWeather['temperature']; ?></div>
                    <img id="img" src="http://openweathermap.org/img/w/<?php echo $GlobalWeather['icon']; ?>.png" alt="Weather Icon">
                    <div>
                        <div style="font-size: 25px;">Max Temperature today <?php echo $GlobalWeather['max_tmp']; ?></div>
                        <div style="font-size: 25px;">Min Temperature today <?php echo $GlobalWeather['min_tmp']; ?></div>
                        <div style="font-size: 25px;">Humidity <?php echo $GlobalWeather['humidity']; ?></div>
                        <div style="font-size: 25px;">Wind Speed <?php echo $GlobalWeather['speed']; ?></div>
                    
                    </div>
                    
                <?php }

            ?>
        </div>
    </div>
</body>
</html>