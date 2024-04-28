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
        <form method="post" action="main.php">
            <label for="user-name">User Name</label>
            <input type="text" id="userName" name="userName" required>

            <label for="password"></label>
            <input type="password" id="passwrod" name="password" required>
            <button type="submit" name="submit">Search</button>
        </form>
        </div>

    </div>

    <div id="forcast">
        <div id="sunny">
            <h1 id="temperature"></h1>
        </div>
    </div>
</body>
</html>