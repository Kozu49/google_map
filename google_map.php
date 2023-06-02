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

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4jkN3kZ2QpYB5J7SGd_zU39cjhueXHl0&callback=initMap&libraries=places" async defer></script>
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

            // Iterate over Sheet1 data
        foreach ($values as $sheet1Row) {
        // Get the address from column F (index 5)
        $addressSheet1 = $sheet1Row[5];
        // Iterate over Sheet2 data
        foreach ($secondvalues as $sheet2Row) {
            // Get the address from column A (index 0)
            $addressSheet2 = $sheet2Row[0];
                // Compare the addresses
            if ($addressSheet1 === $addressSheet2) {
                    $lat = $sheet2Row[1]; 
                    $lng = $sheet2Row[2]; 
                    $title = $sheet2Row[0];
                    $markerJS .= "new google.maps.Marker({ position: {lat: $lat, lng: $lng}, map: map, title: '$title' });\n";    
                }
            }
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

                // Add the SVG overlay of Japan
        // var japanOverlay = new google.maps.GroundOverlay(
        //     "123123.svg", // Replace with the path to your SVG image of Japan
        //     japanBounds,
        //     // { map: map }
        // );

                // Listen for the map to be idle and adjust the overlay bounds
        // google.maps.event.addListenerOnce(map, "idle", function() {
        //     var overlayBounds = japanOverlay.getBounds();
        //     var overlayAspect = overlayBounds.toSpan().lat() / overlayBounds.toSpan().lng();
        //     var mapBounds = map.getBounds();
        //     var mapAspect = mapBounds.toSpan().lat() / mapBounds.toSpan().lng();

        //     if (overlayAspect > mapAspect) {
        //     var lngSpan = overlayBounds.toSpan().lng();
        //     var newLngSpan = lngSpan * (overlayAspect / mapAspect);
        //     var lngOffset = (lngSpan - newLngSpan) / 2;
        //     overlayBounds = new google.maps.LatLngBounds(
        //         new google.maps.LatLng(overlayBounds.getSouthWest().lat(), overlayBounds.getSouthWest().lng() + lngOffset),
        //         new google.maps.LatLng(overlayBounds.getNorthEast().lat(), overlayBounds.getNorthEast().lng() - lngOffset)
        //     );
        //     } else {
        //     var latSpan = overlayBounds.toSpan().lat();
        //     var newLatSpan = latSpan * (mapAspect / overlayAspect);
        //     var latOffset = (latSpan - newLatSpan) / 2;
        //     overlayBounds = new google.maps.LatLngBounds(
        //         new google.maps.LatLng(overlayBounds.getSouthWest().lat() + latOffset, overlayBounds.getSouthWest().lng()),
        //         new google.maps.LatLng(overlayBounds.getNorthEast().lat() - latOffset, overlayBounds.getNorthEast().lng())
        //     );
        //     }
        //             japanOverlay.setMap(map);
        //     japanOverlay.setBounds(overlayBounds);
        // });
        

        <?php echo $markerJS; ?>
        }
    </script>
</body>

</html>
