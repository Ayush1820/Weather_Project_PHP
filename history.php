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
            <?php
                include "process.php";
                $data = getData();
                #echo $data;
                if($data){
                    echo '<table class="styled-table">';
                    echo '<thead><tr><th>ID</th><th>City</th><th>Temperature</th></tr></thead>';
                    echo '<tbody>';
                    foreach ($data as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['city'] . '</td>';
                        echo '<td>' . $row['temperature'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody></table>';
                }
                ?>

        </div>
    </div>

    <div id="forcast">
        <div id="sunny">
            <h1 id="temperature"></h1>
        </div>
    </div>
</body>
</html>