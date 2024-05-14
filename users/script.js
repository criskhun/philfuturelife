document.addEventListener("DOMContentLoaded", function() {
    const hamburger = document.querySelector("#toggle-btn");

    hamburger.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("expand");
    });

    // Get the height of both columns
    var col1Height = document.querySelector('.profile-boxes1').offsetHeight;
    var col2Height = document.querySelector('.profile-boxes2').offsetHeight;

    // Set the height of both columns to the tallest one
    var maxHeight = Math.max(col1Height, col2Height);
    document.querySelector('.profile-boxes1').style.height = maxHeight + 'px';
    document.querySelector('.profile-boxes2').style.height = maxHeight + 'px';
});

$(function() {
    $('#datepicker').datepicker({
        format: 'mmmm-dd-yyyy',
        autoclose: true
    });
});
