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
        <button type="submit" name="submit">Search</button>
    </form>
        </div>
    </div>

    <div id="forcast">
        <div id="sunny">
            <h1 id="temperature"></h1>

            <?php include "process.php";

            // API Key
            $Api = '040d1885618d5b4f42d9de24a810a32b';
            $city;
            $GlobalWeather;

            if(isset($_POST['submit'])){
                $city = $_POST['cityname'];
                $img['src'] = '';
                getWeather();
            }
            ?>
            
            <?php if (isset($GlobalWeather)) { ?>
                    <div style="font-size: 40px;" ><?php echo $GlobalWeather['temperature']; ?></div>
                    <img id="img" src="http://openweathermap.org/img/w/<?php echo $GlobalWeather['icon']; ?>.png" alt="Weather Icon">
                <?php }

            ?>
        </div>
    </div>
</body>
</html>