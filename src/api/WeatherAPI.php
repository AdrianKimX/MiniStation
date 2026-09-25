<?php

$province = "Cebu";

$url = "https://geocoding-api.open-meteo.com/v1/search?" .
       http_build_query([
           "name" => $province,
           "count" => 10,
           "language" => "en",
           "format" => "json"
       ]);

$response = file_get_contents($url);
$data = json_decode($response, true);

foreach ($data["results"] as $result) {

    if ($result["country_code"] === "PH") {

        $latitude = $result["latitude"];
        $longitude = $result["longitude"];

        echo "Province: " . $result["name"] . "<br>";
        echo "Latitude: " . $latitude . "<br>";
        echo "Longitude: " . $longitude . "<br>";

        break;
    }
}

?>