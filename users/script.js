document.addEventListener("DOMContentLoaded", function() {
    const hamburger = document.querySelector("#toggle-btn");

    hamburger.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("expand");
    });

    // Get the height of both columns
    var col1Height = document.querySelector('.profile-boxes1')?.offsetHeight;
    var col2Height = document.querySelector('.profile-boxes2')?.offsetHeight;

    if (col1Height && col2Height) {
        // Set the height of both columns to the tallest one
        var maxHeight = Math.max(col1Height, col2Height);
        document.querySelector('.profile-boxes1').style.height = maxHeight + 'px';
        document.querySelector('.profile-boxes2').style.height = maxHeight + 'px';
    }

    // Adjust the height on page load if there is already content in the textareas
    document.querySelectorAll('textarea').forEach(textarea => {
        autoResize(textarea);
        textarea.addEventListener('input', () => autoResize(textarea));
    });

    // Schedule toggle functionality
    const breaktimeCheckbox = document.getElementById('breakime');
    const breakTimeFields = document.getElementById('breakTimeFields');
    const breakInInput = document.getElementById('BreakIn');
    const breakOutInput = document.getElementById('BreakOut');

    function toggleBreakTimeFields() {
        if (breaktimeCheckbox.checked) {
            breakTimeFields.classList.remove('hidden');
            breakInInput.required = true;
            breakOutInput.required = true;
        } else {
            breakTimeFields.classList.add('hidden');
            breakInInput.required = false;
            breakOutInput.required = false;
        }
    }

    breaktimeCheckbox.addEventListener('change', toggleBreakTimeFields);

    // Initial check on page load
    toggleBreakTimeFields();

});

function autoResize(textarea) {
    textarea.style.height = 'auto'; // Reset the height
    textarea.style.height = textarea.scrollHeight + 'px'; // Set the height to the scroll height
}

function navigateTo(inputId) {
    var url = document.getElementById(inputId).value;
    if (url) {
        window.open(url, '_blank');
    }
}