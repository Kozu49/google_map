<!DOCTYPE html>
<html>
<head>
  <title>Google Maps PHP Tutorial</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .container{
                height:80vh;
                width:80%;
                margin:0 auto;
            
            }
            #map {
            height: 100%;
            width: 100%;
            }

            .custom-info-window {
                width: auto; /* Set the desired width */
                height: 50px; /* Set the desired height */
                font-weight: bold;
                font-size:16px;
                display:flex;
                align-items:center;
                justify-content:center;
                }

                #header-left{
        /* display:none; */
        width:100%;
        height:100px;
        background:rgba(26, 126, 212, 0.4);
       }  

       .embname-text{
  font-size:22px;
  font-weight:bold;
}

.logo-title{
  font-size: 22px;
}

         #emb-name {
            width:100%;
            height:100%;
            
            background-image: url('https://www.np.emb-japan.go.jp/files/000061767.png');
            background-repeat: no-repeat;
            background-size: contain;
            background-position:center;
            display:flex;
            justify-content:center;
            align-items:center;
           
            
          }

          .title{
            font-size: 18px;
            font-weight:bold;
            text-align:center;
            padding:8px;
            margin:0;
            background:#F0F0F0 ;
          }

          @media (max-width: 576px) {
            .container{
                width:100%;
            }
          }

        </style>
</head>

<body>

<div class="container">

<div id="header-left">
        <div id="emb-name">
            <span>
                <strong class="embname-main logo-title" style="color:#000066; text-bold">Embassy of Japan in Nepal</strong> <br>
                <span class="embname-sub">
                    <span class="embname-logo"><img src="https://www.np.emb-japan.go.jp/files/100002131.png" alt="Japan national flag"></span>
                    <span class="embname-text" lang="ne" style="color:#000066;">जापानी राजदुतावास</span>
                </span>
        </span>
        </div>
    </div>
    <p class="title">Nepalese Population in Japan (Prefecture wise).</p>
<div id="map"></div>

</div>




    <?php
    require __DIR__ . '/vendor/autoload.php';
    
    use Google\Client;
    use Google\Service\Sheets;
    
    // Set up the Google API client
    $client = new Client();
    $client->setApplicationName('googlemap');
    // $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
    $client->setScopes([
        Google_Service_Sheets::SPREADSHEETS,
        Google_Service_Sheets::DRIVE,
    ]);
    
    $client->setAuthConfig('credentials.json');
    
    // Create a Sheets API service object
    $service = new Sheets($client);
    
    // ID of the Google Sheets spreadsheet
    $spreadsheetId = '1-Obge65AFLpmPvYlPmkg714jnrn1hMH110xJLTLBlPw'; // Replace with the actual spreadsheet ID
    
    // Range of the data you want to fetch
    $range = 'Form Responses 1!A2:Z'; // Replace with the actual sheet name and range
    $range2 = 'prefecture_coordinates!A2:Z'; // Replace with the actual sheet name and range
    
    // Fetch the data from the spreadsheet
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $response2 = $service->spreadsheets_values->get($spreadsheetId, $range2);
    $values = $response->getValues();
    $secondvalues = $response2->getValues();


    // Array to store marker data
    $markerData = array();
    $markerJS = '';
    $count = [];
    foreach ($values as $sheet1Row) {
        // Get the address from column F (index 5)
        $addressSheet1 = $sheet1Row[4];
        if(array_key_exists($addressSheet1,$count)){
            $count[$addressSheet1]++;
        }else{
            $count[$addressSheet1]=1;
        }
    }

    $markers= [];
            // Iterate over Sheet1 data
        foreach ($values as $sheet1Row) {
            // Get the address from column F (index 5)
            $addressSheet1 = $sheet1Row[4];
            // Iterate over Sheet2 data
            foreach ($secondvalues as $sheet2Row) {
                    // Get the address from column A (index 0)
                    $addressSheet2 = $sheet2Row[0];
                        // Compare the addresses
                    if ($addressSheet1 === $addressSheet2) {
                            $lat = $sheet2Row[1]; 
                            $lng = $sheet2Row[2]; 
                            $title = $sheet2Row[0];
                            $markerJS .= "new google.maps.Marker({ position: {lat: $lat, lng: $lng}, map: map, title: '$title($count[$addressSheet1])' });\n";    
                            array_push($markers, array('position' => array('lat' => (float)$lat, 'lng' => (float)$lng), 'title' => $title." - ". "(".$count[$addressSheet1].")"));

                        }                
            }
        }   
    ?>;
</body>
    <script>
        function initMap() {

            // Define the coordinates for the viewport restriction
            var japanBounds = {
                north: 45.551483,
                south: 24.396308,
                west: 122.934570,
                east: 153.986606
            };
        var japanLatLng = {lat: 37.90222, lng: 139.02361}; // Coordinates for Japan
        var map = new google.maps.Map(document.getElementById('map'), {
            center: japanLatLng, // Set the initial center of the map 
            zoom: 6, // Set the initial zoom level
            // mapTypeId: "transparent", // Custom map type for the transparent overlay

            restriction: {
                latLngBounds: japanBounds, // Apply the viewport restriction to Japan
                strictBounds: false // Allow zooming out beyond the viewport restriction
                }
        });

        var currentInfoWindow = null;
        let markers = <?php echo json_encode($markers); ?>;
        markers.forEach(function(location) {
            var marker = new google.maps.Marker({
                position: location.position,
                map: map,
                title:  location.title
            });

            var contentString = '<div class="custom-info-window">' +
                location.title
                '</div>';


            // Create a new info window
            var infoWindow = new google.maps.InfoWindow({
                content: contentString
            });

            // Add click event listener to open the info window when marker is clicked
            marker.addListener('click', function() {
                if (currentInfoWindow != null) {
                currentInfoWindow.close();
                }
                infoWindow.open(map, marker);
                currentInfoWindow = infoWindow;
            });
            });

        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAe8hUtoB2KcXBIbZHcOg5nNE_hBMEdrsQ&callback=initMap&libraries=places" async defer></script>

</html>
