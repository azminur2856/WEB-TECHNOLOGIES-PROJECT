<?php include_once "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Widget</title>
    <link rel="stylesheet" href="../asset/css/weather.css">
    <script src="../asset/js/weather.js"></script>
</head>
<body>
    <h2 align="center">Weather Information (10 Days Before and After)</h2>
    <table id="weather" border="1" cellspacing="0" cellpadding="10" align="center">
        <thead>
            <tr>
                <th>Time</th>
                <th>Temperature (&deg;C)</th>
                <th>Humidity (%)</th>
                <th>Wind Speed (m/s)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" align="center">Initializing location request...</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
<?php include_once "footer.php"; ?>