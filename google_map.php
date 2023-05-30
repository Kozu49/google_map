<!DOCTYPE html>
<html>
<head>
  <title>Google Maps PHP Tutorial</title>
        <style>
            #map {
            height: 400px;
            width: 100%;
            }
        </style>
</head>

<body>
<div id="map"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4jkN3kZ2QpYB5J7SGd_zU39cjhueXHl0&callback=initMap" async defer></script>
    <?php

    require __DIR__ . '/vendor/autoload.php';

    use Google\Client;
    use Google\Service\Sheets;

    // Set up the Google API client
    $client = new Client();
    $client->setApplicationName('googlemap');
    $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
    $client->setAuthConfig('credentials.json');

    // Create a Sheets API service object
    $service = new Sheets($client);

    // ID of the Google Sheets spreadsheet
    $spreadsheetId = '1pDrwPKrcwPshmV-EOGZlzQFAz4D5jWkGrunuNMYPVAU'; // Replace with the actual spreadsheet ID

    // Range of the data you want to fetch
    $range = 'Form Responses 1!A2:G3'; // Replace with the actual sheet name and range

    // Fetch the data from the spreadsheet
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();

    
    // Initialize the markers array
    $markers = [];
     $markerJS = '';

    // Iterate through the rows and extract marker addresses
    foreach ($values as $row) {
        $title = $row['4']; 
        $lat = $row['5']; 
        $lng = $row['6']; 
        $markerJS .= "new google.maps.Marker({ position: {lat: $lat, lng: $lng}, map: map, title: '$title' });\n";
        // Add the address to the markers array
        // $markers[] = $address;
    }


        // code for multiple marker's address from markers.josn file
                //  Read the JSON file
                // $markersJSON = file_get_contents('markers.json');
                // $markerData = json_decode($markersJSON, true);

                // $markerJS = '';

                // // Generate JavaScript code for markers
                // foreach ($markerData['markers'] as $marker) {
                // $lat = $marker['lat'];
                // $lng = $marker['lng'];
                // $title = $marker['title'];

                // $markerJS .= "new google.maps.Marker({ position: {lat: $lat, lng: $lng}, map: map, title: '$title' });\n";
                // }
        // code for multiple marker's address from markers.josn file ends

        // code for accessing coordinates with name
                //         $places = array(
                //             'Tokyo, Japan',
                //             'Osaka, Japan',
                //             'Kyoto, Japan'
                //         );
                        
                //         // Format the addresses for the Geocoding API request
                //         $encodedAddresses = array_map('urlencode', $places);
                //         $joinedAddresses = implode('|', $encodedAddresses);
                        
                //         // Geocoding API request URL
                //         $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$joinedAddresses}&key=AIzaSyA4jkN3kZ2QpYB5J7SGd_zU39cjhueXHl0";
                        
                // // Make the API request
                // $response = file_get_contents($url);
                // var_dump($response);

        // code for accessing coordinates with name ends

        
    ?>

    <script>
        function initMap() {
        var japanLatLng = {lat: 35.6895, lng: 139.6917}; // Coordinates for Japan
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: japanLatLng,
        });

        <?php echo $markerJS; ?>
         // Restrict the map view to Japan
         var strictBounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(20.356504, 122.934570),
                new google.maps.LatLng(45.551483, 153.986476)
            );
            map.addListener('center_changed', function() {
                if (strictBounds.contains(map.getCenter())) return;
                map.setCenter({ lat: 36.2048, lng: 138.2529 });
            });
            map.addListener('zoom_changed', function() {
                if (map.getZoom() < 6) map.setZoom(6);
            });
        }
    </script>




</body>

</html>
