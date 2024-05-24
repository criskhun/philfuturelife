

<script type="text/javascript" src="../assets/webcam.min.js"></script>
<script type="text/javascript">
    function configure(){
        var width = 480; // Default width
        var height = 360; // Default height

    // Check if the device is a mobile device
    if (window.matchMedia("(max-width: 767px)").matches) {
        width = 340; // Set smaller width for mobile devices
        height = 340; // Set smaller height for mobile devices
    }

        Webcam.set({
            width: width,
            height: height,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');
    }

    function saveSnap(){
    Webcam.snap(function(data_uri){
        document.getElementById('results').innerHTML = 
        '<img id="webcam" src="'+data_uri+'">';
    });

    Webcam.reset();

    var base64image = document.getElementById("webcam").src; // Corrected id here
    Webcam.upload(base64image,'../attendanceUpload.php',function(code,text){
        alert('Save Successfully');
        document.location.href = "dashboard.php"
    });
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://kit.fontawesome.com/ac1d57cf2f.js" crossorigin="anonymous"></script>
</body>
</html>
