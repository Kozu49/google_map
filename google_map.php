<!DOCTYPE html>
<html>
<head>
  <title>Google Maps PHP Tutorial</title>
        <style>
            #map {
            height: 1000px;
            width: 100%;
            }
        </style>
</head>

<body>
<div id="map"></div>
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
        var japanLatLng = {lat: 35.6895, lng: 139.6917}; // Coordinates for Japan
        var map = new google.maps.Map(document.getElementById('map'), {
            center: japanLatLng, // Set the initial center of the map 
            zoom: 8, // Set the initial zoom level
            // mapTypeId: "transparent", // Custom map type for the transparent overlay

            restriction: {
                latLngBounds: japanBounds, // Apply the viewport restriction to Japan
                strictBounds: false // Allow zooming out beyond the viewport restriction
                }
        });

        <?php echo $markerJS; ?>
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4jkN3kZ2QpYB5J7SGd_zU39cjhueXHl0&callback=initMap&libraries=places" async defer></script>

</html>
