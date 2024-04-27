
<?php
#include "connect_db.php";


function insertData($city, $temp) {
    $server = "mysql:host=localhost;dbname=project";
    $username = "root";
    $password = "";
            
try{
    $conn = new PDO($server, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO weather_forecast (city, temperature) VALUES ('$city', '$temp')";
    $conn->exec($sql);
}
catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

function getData() {
    $server = "mysql:host=localhost;dbname=project";
    $username = "root";
    $password = "";
    
    try{
            $conn = new PDO($server, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM weather_forecast";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    return null;
                }
}

// Usage example:
// $conn = connectToDatabase();
// if ($conn) {
//     insertData($conn, "New York", 25);
//     getData($conn);
//     // Close connection
//     $conn = null;
// } else {
//     echo "Failed to connect to the database.";
// }

// API Key
$Api = '040d1885618d5b4f42d9de24a810a32b';
$city;
$GlobalWeather;



    function ConvertToDegree($value, $t) {
        return floor($value - 273.15) . ' C ' . strtoupper($t) . ' ';
    }
    
    function getWeather() {
        global $Api, $city, $GlobalWeather;
    
        // Fetch weather data from API
        $url = 'http://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=' . $Api;
        $response = file_get_contents($url);
        $data = json_decode($response, true);
    
        if ($data['cod'] == 200) {
            $temperature = $data['main']['temp'];
            $description = $data['weather'][0]['description'];
            $icon = $data['weather'][0]['icon'];
            $GlobalWeather = array(
                'temperature' => ConvertToDegree($temperature, $city),
                'description' => $description,
                'icon' => $icon
            );

            insertData(strtoupper($city),  floor($temperature - 273.15) . ' C ');
        } else {    
            $GlobalWeather = array(
                'temperature' => 'Error: ' . $data['message'],
                'description' => '',
                'icon' => ''
            );
        }
    }
    
    
    function Climate() {
        global $GlobalWeather;
        $img = new stdClass();
        $bodyStyle = new stdClass();
    
        echo " Global = " . $GlobalWeather;

        switch ($GlobalWeather) {
            case 'Clouds':
                $img->src = 'images/clouds.png';
                $sunny = document.getElementById('sunny');
                $sunny->appendChild($img);
                $bodyStyle->style->backgroundColor = "#808080";
                break;
    
            case 'Rain':
                $img->src = 'images/rain--v2.png';
                $sunny = document.getElementById('sunny');
                $sunny->appendChild($img);
                $bodyStyle->style->backgroundColor = "#4682B4";
                break;
    
            case 'Haze':
                $img->src = 'data:image/png;base64,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';
                $sunny = document.getElementById('sunny');
                $sunny->appendChild($img);
                $bodyStyle->style->backgroundColor = "#E0E0E0";
                break;
    
            case 'Mist':
                $img->src = 'images/external-mist-natural-disaster-photo3ideastudio-flat-photo3ideastudio.png';
                $sunny = document.getElementById('sunny');
                $sunny->appendChild($img);
                $bodyStyle->style->backgroundColor = "#B0C4DE";
                break;
    
            case 'Clear':
                $img->src = 'images/sun-emoji.png';
                $sunny = document.getElementById('sunny');
                $sunny->appendChild($img);
                $bodyStyle->style->backgroundColor = "#87CEEB";
                break;
    
            case 'Smoke':
                $img->src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAF/klEQVRoge2Za2wc1RXHf3d2du21s3bWCY43GCc4UUipIECSppUg0I9tUYVACSJNkFBbEEXQB0JRq0pFfKn6olIFbRMhUgm3VPRTP5AooioEByEoVYMbaOJEjh/Bj9jBr/Vj53FOP+zasXdnvWtnnewHnw87R3fu3PP/7Zlz594ZWLEVW7GFzJRysPHj1EcM94pwh1G2qFBvhGoUREniM6hKuxFO+co7sb0Mlir2VYNoK/GUw36jHFBhB4JBQQUQmOurZtrSviJ8qD4tnkdL/DFGrguIthJ3PA4ifA8lFiR8AYj0MdMHYUyVl33ll0sFWhKIc4JHUX6lPvX5hC8CYtZXYQDh2drH+fOyguhJYq7HIZRHdAHhS4SYvVbUanF9ebL+KZIlB9F/sM61OYpy13JCqJiZtn/bIf167EkulQwkA/Eu6ZnoWkDMtLXbjt4Te64wjFUQ4iQx1+bYdYBAhS2uZY5eeplVVw3ievwe5c7rADEzxvbQhPXKVYFkZqf91xEiM54+PPhzvrWQ1rw1oq3EXZ8zyzDFLhJi1h8Iubo1/nzwcyZvRhyPg2UEgQrrfMt6blEZ0VbijkMnSk2ZQMyMN2qjG4OyEpiRlMP+MoRAhVrHZ1+Q5kCQzAKw3CAyvjkQqDm7Yfw49WFDP8WvYq8ZRKa/+o7Wr/8NQwtmJGJxXxlDgGJMiPuydeeAiM+2MobI+NbtBUHMzFKkbCHAKLcUBFFhXTlDpH2tL5wRYVV5QwBKTbZuO7thpvOAaeSFmlf5NLwDIZTTrRhLpDr5Uc/T3D7WWkoI1M+NlVvsQhKBI9Efczq8a8kQAH0VG/lt0+9KC5E+jhUEQRhQhWmqlwww1yat6tJCCKianI1WbrEr7QjsS75IXIraZea1iKb4bvfPSgqBglHOZsfKqREjnFKBzX4bb/TfSpe1BY8wvtqcjN7P66t/mFf4l8eOsefSS1R4EyDK+ukOqtzxkkKogFH5uCCIH+KE8VEEExKXZu+T2aBbJz+iM7yV96u/lgOx2hvkpxceI+xPl74m5vuCciI7fs6tFXuQSwgf5guacDoDs7HG7b8WEKjywfrD89dZgSAA6tMSFHTISvBu7IFAkAvRW/m4+p7lhgDR14Liz65+61rO1VRORp7FWF8Ik7L3rf/n/a6pCEN6AIdKTld9haRVGwgCEFKP28beI+YNZ/6RtP70T9Yx42vAOdt32NH3Fru7/pb9IB1NWbph02FGs2PP1kjFVMUf1fAIKA4RTrnbuofiW5vyqg4w39icqr13MZfktRNNe4k4k+zqefNKltW8tOmw5kDA/Ftr19wTbUOJtbXeZSmJqiVae92OubfqgOvLr/P1vQKi/H3uCVGqkkMTHcumsoBZ6rPz4rHZehPRH9z8p/xv6q/sEJ9Xq6Gx+yGj5g41JgRgVCt2N5zf01Gz/cZSC93Vf5TG8fZ0Hc2pGRSi7gR3XTxO8+W2mSf56zcdkcC9ei5IHjv4xqGm9to7z1ysvCVaCgCAPede5MAnLxSYnWb9f4U9/WrDa0wsNGbBV6a/2PtE9+nPat5smL7glIQC+FLvsWIhztroNwpBQBEgG49cqEz6Vdv/07sm2TDZMXXVFMDZup3FQHwU9nR34khx3xnz3lqNr/Rs9kTvNhbfRrk73dukdq7tGe2LfzFnh7YYC/vTfPPcH2gebsOIzq8TgT4v/vahG5959XM7nponViyxMP/97PHG9qJAEod7HsLoXwnaeAEbYiPnY2uqmkciNxTM6GKsbrLfHxryunqnY80LdPONMY/2fuemv8xtDBZi9AnyQAB0ja/e/Gl3OFU3eKY76k9ovn7FWix1Wet6z3Sd7q10CkAAhFR5KrsxWKzSUWg+EzHRtuFEkzXqTjWv6uiNV0tiYFVzlZjikhQSlxvGOieHk6G+/02tbUQTG4q6MC2wK7slECRkmZ94omFj2FZoSBHD+bE1MMZIhTWS2hTpl7UVE3E7pHGxw1E3FI0YEWxv0jGeN+X6oeGhVNVIh9dgd2l9Jr4u5pP0WSP29xfRf8VWbMWA/wPd/fpcGSu9+wAAAABJRU5ErkJggg==';
                document.getElementById('sunny')->appendChild($img);
                $bodyStyle->style->backgroundColor = "#696969";
                break;
    
            default:
                $img->src = 'images/sun-emoji.png';
                document.getElementById('sunny')->appendChild($img);
                $bodyStyle->style->backgroundColor = 'orange';
                break;
        }
    
    }


?>