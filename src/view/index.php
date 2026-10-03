<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>

</head>
<body>

    <?php

    include_once "components/header.php";

    ?>

    <div class="wrap">

        <nav class="site-nav">
            <span class="wordmark">MiniStation</span>
            <a href="?page=home" class="btn btn-ghost">Check the weather</a>
        </nav>


        <section class="features">

            <h2 style="font-size: 30px;">Built on real Philippine location data</h2>

            <div class="features-grid">

                <div class="feature">
                    <div class="feature-mark">PSGC</div>
                    <h3>Search anywhere in the country</h3>
                    <p>
                        Uses PSGC location data, so you can find your
                        own barangay or municipality, not just the
                        nearest big city.
                    </p>
                </div>

                <div class="feature">
                    <div class="feature-mark">NOW</div>
                    <h3>Live current conditions</h3>
                    <p>
                        Fresh temperature, sky condition, and wind
                        speed pulled for the exact coordinates of
                        your search.
                    </p>
                </div>

                <div class="feature">
                    <div class="feature-mark">MAP</div>
                    <h3>See where the reading comes from</h3>
                    <p>
                        Every result drops a pin, so you know exactly
                        where the conditions were measured.
                    </p>
                </div>

            </div>

        </section>


      

    </div>


    

     <section class="powered-by">
 
            <p>Powered by</p>
 
            <div class="stack">
 
                <div class="stack-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="9" r="4"></circle>
                        <path d="M9 1.5v2M9 14.5v2M1.5 9h2M14.5 9h2M4 4l1.4 1.4M12.6 12.6L14 14M14 4l-1.4 1.4M5.4 12.6L4 14"></path>
                        <path d="M13.5 17.5h5a3 3 0 0 0 0-6 5 5 0 0 0-9.6-1.6"></path>
                    </svg>
                    <span>Open-Meteo</span>
                </div>
 
                <div class="stack-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6.5l6-2 6 2 6-2v13l-6 2-6-2-6 2z"></path>
                        <path d="M9 4.5v13M15 6.5v13"></path>
                    </svg>
                    <span>OpenStreetMap</span>
                </div>
 
            </div>
 
        </section>

   

</body>
</html>