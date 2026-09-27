<?php


$province = $_GET['province'] ?? 'Naga';


// ========================================
// PSGC LOCATION LIST
// ========================================

// Put your PSGC JSON file here.
// Example:
// data/psgc.json
$psgcFile = __DIR__ . '/data/psgc.json';

$psgc = [];

if (file_exists($psgcFile)) {
    $psgc = json_decode(
        file_get_contents($psgcFile),
        true
    );
}


// ========================================
// OPEN-METEO GEOCODING
// ========================================

$url = "https://geocoding-api.open-meteo.com/v1/search?" .
       http_build_query([
           "name" => $province,
           "count" => 10,
           "language" => "en",
           "format" => "json"
       ]);

$response = @file_get_contents($url);

$data = $response
    ? json_decode($response, true)
    : [];

$latitude = null;
$longitude = null;
$locationName = $province;


// Find Philippine result
if (!empty($data["results"])) {

    foreach ($data["results"] as $result) {

        if (($result["country_code"] ?? '') === "PH") {

            $latitude = $result["latitude"];
            $longitude = $result["longitude"];
            $locationName = $result["name"];

            break;
        }
    }
}


// ========================================
// OPEN-METEO WEATHER (CURRENT CONDITIONS)
// ========================================

$weather = null;

// WMO weather codes -> human-readable label + emoji
$weatherCodes = [
    0  => ['label' => 'Clear sky',              'icon' => '☀️'],
    1  => ['label' => 'Mainly clear',            'icon' => '🌤️'],
    2  => ['label' => 'Partly cloudy',           'icon' => '⛅'],
    3  => ['label' => 'Overcast',                'icon' => '☁️'],
    45 => ['label' => 'Fog',                     'icon' => '🌫️'],
    48 => ['label' => 'Depositing rime fog',     'icon' => '🌫️'],
    51 => ['label' => 'Light drizzle',           'icon' => '🌦️'],
    53 => ['label' => 'Moderate drizzle',        'icon' => '🌦️'],
    55 => ['label' => 'Dense drizzle',           'icon' => '🌦️'],
    56 => ['label' => 'Light freezing drizzle',  'icon' => '🌦️'],
    57 => ['label' => 'Dense freezing drizzle',  'icon' => '🌦️'],
    61 => ['label' => 'Slight rain',             'icon' => '🌧️'],
    63 => ['label' => 'Moderate rain',           'icon' => '🌧️'],
    65 => ['label' => 'Heavy rain',              'icon' => '🌧️'],
    66 => ['label' => 'Light freezing rain',     'icon' => '🌧️'],
    67 => ['label' => 'Heavy freezing rain',     'icon' => '🌧️'],
    71 => ['label' => 'Slight snow fall',        'icon' => '🌨️'],
    73 => ['label' => 'Moderate snow fall',      'icon' => '🌨️'],
    75 => ['label' => 'Heavy snow fall',         'icon' => '🌨️'],
    77 => ['label' => 'Snow grains',             'icon' => '🌨️'],
    80 => ['label' => 'Slight rain showers',     'icon' => '🌦️'],
    81 => ['label' => 'Moderate rain showers',   'icon' => '🌦️'],
    82 => ['label' => 'Violent rain showers',    'icon' => '⛈️'],
    85 => ['label' => 'Slight snow showers',     'icon' => '🌨️'],
    86 => ['label' => 'Heavy snow showers',      'icon' => '🌨️'],
    95 => ['label' => 'Thunderstorm',            'icon' => '⛈️'],
    96 => ['label' => 'Thunderstorm, slight hail', 'icon' => '⛈️'],
    99 => ['label' => 'Thunderstorm, heavy hail',  'icon' => '⛈️'],
];

if ($latitude !== null && $longitude !== null) {

    $weatherUrl = "https://api.open-meteo.com/v1/forecast?" .
        http_build_query([
            "latitude"        => $latitude,
            "longitude"       => $longitude,
            "current_weather" => "true",
            "timezone"        => "Asia/Manila",
        ]);

    $weatherResponse = @file_get_contents($weatherUrl);

    $weatherData = $weatherResponse
        ? json_decode($weatherResponse, true)
        : null;

    if (!empty($weatherData["current_weather"])) {
        $weather = $weatherData["current_weather"];
    }

}

$weatherInfo = null;

if ($weather !== null) {

    $code = $weather["weathercode"] ?? null;

    $weatherInfo = $weatherCodes[$code] ?? [
        'label' => 'Unknown conditions',
        'icon'  => '🌡️',
    ];

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Philippine Weather</title>


    <!-- ========================================
         LEAFLET
    ========================================= -->

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >


</head>


<body>


<h2>Philippine Weather</h2>


<div class='api-header'>

<div class="search-container">

    <input
        type="text"
        id="locationSearch"
        value="<?= htmlspecialchars($province) ?>"
        placeholder="Search Philippine location..."
        autocomplete="off"
    >

    <div id="results"></div>

</div>


<p>

    Selected location:

    <strong>
        <?= htmlspecialchars($locationName) ?>
    </strong>

</p>


<!-- ========================================
     WEATHER STATUS
========================================= -->

<?php if ($weather !== null && $weatherInfo !== null): ?>

    <div class="weather-card">

        <div class="weather-icon">
            <?= $weatherInfo['icon'] ?>
        </div>

        <div>

            <div class="weather-temp">
                <?= htmlspecialchars($weather['temperature']) ?>&deg;C
            </div>

            <div class="weather-label">
                <?= htmlspecialchars($weatherInfo['label']) ?>
            </div>

            <div class="weather-meta">
                Wind: <?= htmlspecialchars($weather['windspeed']) ?> km/h
                &nbsp;&middot;&nbsp;
                As of <?= htmlspecialchars($weather['time']) ?>
            </div>

        </div>

    </div>
</div>

<?php elseif ($latitude !== null && $longitude !== null): ?>

    <div class="weather-unavailable">
        Weather data is currently unavailable for this location.
    </div>

<?php endif; ?>


<?php if ($latitude !== null && $longitude !== null): ?>

    <p>

        Latitude:
        <?= htmlspecialchars($latitude) ?>

        <br>

        Longitude:
        <?= htmlspecialchars($longitude) ?>

    </p>


    <!-- ========================================
         MAP
    ========================================= -->

    <div id="map"></div>


    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    <script>

        const latitude =
            <?= json_encode($latitude) ?>;

        const longitude =
            <?= json_encode($longitude) ?>;

        const locationName =
            <?= json_encode($locationName) ?>;


        const map = L.map('map').setView(
            [latitude, longitude],
            10
        );


        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                attribution:
                    '&copy; OpenStreetMap contributors'
            }
        ).addTo(map);


        L.marker([latitude, longitude])
            .addTo(map)
            .bindPopup(
                '<b>' +
                locationName +
                '</b>'
            )
            .openPopup();

    </script>

<?php endif; ?>


<!-- ========================================
     PSGC SEARCH
========================================= -->

<script>

    const psgc =
        <?= json_encode($psgc) ?>;

    const searchInput =
        document.getElementById('locationSearch');

    const resultsContainer =
        document.getElementById('results');

    let currentMatches = [];


    /*
     * Renders a list of locations into
     * the dropdown.
     */
    function renderResults(locations) {

        resultsContainer.innerHTML = '';
        currentMatches = locations;

        locations.forEach(location => {

            const option =
                document.createElement('div');

            option.className = 'result';

            const name =
                location.name ?? 'Unknown';

            const province =
                location.province ?? '';

            option.innerHTML = `
                <div class="result-name">${name}</div>
                <div class="result-details">${province}</div>
            `;

            option.addEventListener('click', function () {
                goToLocation(location.name);
            });

            resultsContainer.appendChild(option);

        });

    }


    /*
     * Filters psgc by whatever's typed,
     * across every field.
     */
    function filterLocations(search) {

        if (search.length === 0) {
            // No text yet — show everything
            // (or cap it, see note below)
            return psgc;
        }

        return psgc.filter(location =>
            Object.values(location).some(value =>
                String(value ?? '')
                    .toLowerCase()
                    .includes(search)
            )
        );
    }


    /*
     * Show/filter on typing
     */
    searchInput.addEventListener('input', function () {

        const search = this.value.trim().toLowerCase();

        renderResults(
            filterLocations(search).slice(0, 10)
        );

    });


    /*
     * Show full list when the field is focused,
     * even before typing anything.
     */
    searchInput.addEventListener('focus', function () {

        const search = this.value.trim().toLowerCase();

        renderResults(
            filterLocations(search).slice(0, 10)
        );

    });


    /*
     * Hide dropdown when clicking elsewhere
     */
    document.addEventListener('click', function (event) {

        if (
            !searchInput.contains(event.target) &&
            !resultsContainer.contains(event.target)
        ) {
            resultsContainer.innerHTML = '';
        }

    });


    /*
     * Enter picks the top match
     */
    searchInput.addEventListener('keydown', function (event) {

        if (event.key !== 'Enter') return;

        event.preventDefault();

        if (currentMatches.length > 0) {
            goToLocation(currentMatches[0].name);
        } else {
            goToLocation(this.value.trim());
        }

    });


    function goToLocation(name) {

        if (!name) return;

        window.location.href =
            '?page=home&province=' + encodeURIComponent(name);

    }

</script>

</body>

</html>