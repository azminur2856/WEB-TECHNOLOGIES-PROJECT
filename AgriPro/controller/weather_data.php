<?php
    $data = json_decode($_POST['mydata'], true);
    $latitude = $data['latitude'] ?? null;
    $longitude = $data['longitude'] ?? null;

    $response = [
        'hourlyTimes' => [],
        'hourlyTemperatures' => [],
        'hourlyHumidity' => [],
        'hourlyWindSpeeds' => []
    ];

    if ($latitude && $longitude) {
        $apiUrl = "https://api.open-meteo.com/v1/forecast?latitude={$latitude}&longitude={$longitude}&past_days=10&forecast_days=10&hourly=temperature_2m,relative_humidity_2m,wind_speed_10m";
        $weatherData = @file_get_contents($apiUrl);

        if ($weatherData) {
            $weather = json_decode($weatherData, true);
            $response['hourlyTimes'] = $weather['hourly']['time'] ?? [];
            $response['hourlyTemperatures'] = $weather['hourly']['temperature_2m'] ?? [];
            $response['hourlyHumidity'] = $weather['hourly']['relative_humidity_2m'] ?? [];
            $response['hourlyWindSpeeds'] = $weather['hourly']['wind_speed_10m'] ?? [];
        }
    }

    echo json_encode($response);
?>