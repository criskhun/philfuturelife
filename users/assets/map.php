<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Maps</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .mapArea {
            height: calc(100vh - 56px);
            width: 100%;
        }

        #map {
            height: 100%;
            width: 100%;
        }
        .controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            width: 50%;
            outline: none;
            -webkit-box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        .card-list .card {
        width: 100%;

        }
        .card-sched {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="row mt-2 d-flex align-items-stretch">
        <div class="col-sm-6">
            <div class="card h-100">
                <input class="form-control me-2 controls" id="pac-input" type="text" placeholder="Search Box" aria-label="Search">            
                <div class="mapArea">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card h-100">
                <?php
                    if (isset($_SESSION['error4'])) {
                        echo '<div class="container">
                        <div class="alert alert-danger alert-dismissible mt-2 mx-2">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Failed!</strong> '.$_SESSION['error4'].'
                        </div>
                        </div>';
                        unset($_SESSION['error4']);
                    }

                    if (isset($_SESSION['success4'])) {
                        echo '<div class="alert alert-success alert-dismissible mt-2 mx-2">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Success!</strong> '.$_SESSION['success4'].'
                        </div>';
                        unset($_SESSION['success4']);
                    }
                ?>
                <div class="card-body d-flex flex-column">
                    <!-- <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addtermination">
                            <i class="fa-solid fa-map-location-dot"></i>
                            New Branch
                        </button>                        
                    </div> -->
                    <div class="card-list mt-2">
                            <?php
                                include("../../dbconn.php");                

                                $query = "SELECT * FROM branch_location ORDER BY id DESC";                            

                                $result = mysqli_query($conn, $query);
                                if ($result->num_rows > 0) {
                                    while($row = mysqli_fetch_array($result)){
                                        $location = $row['name'];
                                        $locID = $row['id'];

                                        echo '
                                        <form action="../assets/delete_location.php" method="POST">
                                            <div class="card card-sched mt-2">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5>'.$location.'</h5>
                                                        </div>
                                                        <div class="col">
                                                            <h5><span class="badge rounded-pill bg-primary">'.$locID.'</span></h5>
                                                        </div>
                                                        <div class="col d-flex justify-content-end">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#locStatModal" data-id="'.$locID.'" data-locStat="'.$location.'"><i class="fa-solid fa-pen-to-square"></i></button>
                                                                <button type="submit" name="locStatDelete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="locStatID" value="'.$locID.'">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        ';
                                    }
                                }
                                $conn->close();
                            ?>  
                        </div> 
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for updating location title Location -->
<div class="modal fade" id="locStatModal" tabindex="-1" aria-labelledby="addLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLocationModalLabel">Update Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">                    
                </button>
            </div>
            <div class="modal-body">
                <form action="../assets/update_loc_name.php" method="POST" id="locationFormName">
                    <div class="mb-3">
                        <label for="modalLoc" class="form-label">Location Name</label>
                        <input type="text" name="locationName" class="form-control" id="modalLoc" required>
                    </div>
                    <input type="hidden" id="modalLocID" name="locId">
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Map Title Modal Call Value -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var locStatModal = document.getElementById('locStatModal');
        locStatModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget;
            // Extract info from data-* attributes
            var locId = button.getAttribute('data-id');
            var loc = button.getAttribute('data-locStat');
            
            // Update the modal's content
            var modalLoc = locStatModal.querySelector('#modalLoc');
            var modalLocId = locStatModal.querySelector('#modalLocID'); 
            
            modalLoc.value = loc;
            modalLocId.value = locId;
        });
    });
</script>
    
    <!-- Modal for Adding Location -->
<div class="modal fade" id="addLocationModal" tabindex="-1" aria-labelledby="addLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLocationModalLabel">Add Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">                    
                </button>
            </div>
            <div class="modal-body">
                <form id="locationForm">
                    <div class="mb-3">
                        <label for="locationName" class="form-label">Location Name</label>
                        <input type="text" class="form-control" id="locationName" required>
                    </div>
                    <input type="hidden" id="locationLat">
                    <input type="hidden" id="locationLng">
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function loadScript(src, callback) {
        const script = document.createElement('script');
        script.src = src;
        script.async = true;
        script.defer = true;
        script.onload = callback;
        document.head.appendChild(script);
    }

    let map;
    let ArrayMarker = [];
    let AllMarker = [];

    function initMap() {
        // Create a map
        const latitude = 6.130111668953541;
        const longitude = 125.1887893641724;

        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: latitude, lng: longitude },
            zoom: 8,
            mapTypeId: "roadmap",
            mapId: "2c95966c1bb2f86",
            tilt: 52,
            disableDefaultUI: true,
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            }
        });

        // Create the search box and link it to the UI element
        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        // Bias the SearchBox results towards current map's viewport
        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });

        let markers = [];

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();

            if (places.length === 0) {
                return;
            }

            // Clear out the old markers
            markers.forEach((marker) => {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location
            const bounds = new google.maps.LatLngBounds();
            places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };

                // Create a marker for each place
                markers.push(
                    new google.maps.Marker({
                        map,
                        icon,
                        title: place.name,
                        position: place.geometry.location,
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

        // Handle map markers
        axios.get('../assets/get_location.php')
            .then(function(response) {
                // Handle success
                let data = response.data;
                ArrayMarker.push(data);

                for (let i = 0; i < ArrayMarker.length; i++) {
                    const eachData = ArrayMarker[i];

                    for (let j = 0; j < eachData.length; j++) {
                        const latitude = parseFloat(eachData[j]['lat']);
                        const longitude = parseFloat(eachData[j]['lng']);
                        const content = eachData[j]['name'];
                        const title = eachData[j]['id'];

                        AllMarker.push({
                            lat: latitude,
                            lng: longitude,
                            content: content,
                            title: title
                        });
                    }
                }

                // Create markers on map
                AllMarker.forEach((markerData) => {
                    let position = { lat: markerData.lat, lng: markerData.lng };
                    let content = markerData.content;
                    let title = markerData.title;

                    const infowindow = new google.maps.InfoWindow({
                        content: content,
                    });

                    const marker = new google.maps.Marker({
                        map,
                        title: title,
                        position: position,
                        draggable: true,
                        animation: google.maps.Animation.DROP
                    });

                    // Automatically open the InfoWindow
                    //infowindow.open(map, marker);

                    // Optionally, you can keep the InfoWindow open on marker click as well
                    marker.addListener('click', () => {
                        toggleBounce(marker);
                    });

                    marker.addListener('dragend', (event) => {
                        const newLat = event.latLng.lat();
                        const newLng = event.latLng.lng();
                        // You can use these newLat and newLng values to update the marker location
                        console.log('New position: ', newLat, newLng);
                        updateMarkerLocation(title, newLat, newLng);
                    });
                });
            })
            .catch(function(error) {
                // Handle error
                console.log(error);
            });

        // Add a click listener to the map to add a location
        map.addListener('click', (event) => {
            const lat = event.latLng.lat();
            const lng = event.latLng.lng();

            $('#locationLat').val(lat);
            $('#locationLng').val(lng);

            $('#addLocationModal').modal('show');
        });
    }

    function toggleBounce(marker) {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }

    function updateMarkerLocation(id, lat, lng) {
        $.ajax({
            url: '../assets/update_location.php',
            method: 'POST',
            data: {
                id: id,
                lat: lat,
                lng: lng
            },
            success: function (response) {
                console.log('Marker position updated:', response);
            },
            error: function (xhr, status, error) {
                console.error('Error updating marker position:', error);
            }
        });
    }

    $('#locationForm').on('submit', function (e) {
        e.preventDefault();

        const locationName = $('#locationName').val();
        const lat = $('#locationLat').val();
        const lng = $('#locationLng').val();

        $.ajax({
            url: '../assets/save_location.php',
            method: 'POST',
            data: {
                name: locationName,
                lat: lat,
                lng: lng
            },
            success: function (response) {
                console.log('Response from server:', response);

                try {
                    const jsonData = JSON.parse(response);

                    if (jsonData.status === 'success') {
                        console.log('Location saved successfully');
                        //alert('Location saved successfully');
                        $('#addLocationModal').modal('hide');
                        location.reload();
                    } else if (jsonData.status === 'error') {
                        console.error('Failed to save location');
                        alert('Failed to save location');
                    } else {
                        console.error('Unexpected response:', response);
                        $('#addLocationModal').modal('hide');
                        location.reload();
                        //alert('Failed to save location: Unexpected response');
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    $('#addLocationModal').modal('hide');
                    location.reload();
                    //alert('Failed to save location: Unexpected response');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error saving location:', error);
                alert('Failed to save location: ' + error);
            }

        });
    });

    function init() {
        loadScript('https://maps.googleapis.com/maps/api/js?key=AIzaSyA9NPUvP_DRt_oaIkHRHIlkLiAKtJMBm2Q&libraries=places', () => {
            console.log('Google Maps script loaded.');
            initMap();
        });
    }

    document.addEventListener('DOMContentLoaded', init);
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>