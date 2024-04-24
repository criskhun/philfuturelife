<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- Include Vanta.js scripts -->
<script src="https://cdn.jsdelivr.net/npm/three@0.134.0/build/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@0.5.22/dist/vanta.clouds.min.js"></script>

<script>
// Initialize Vanta.js clouds effect
VANTA.CLOUDS({
  el: "#background-image", // Make sure this selector matches your div's ID
  mouseControls: true,
  touchControls: true,
  gyroControls: false,
  minHeight: 200.00,
  minWidth: 200.00
});
</script>