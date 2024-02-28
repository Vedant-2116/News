document.addEventListener('DOMContentLoaded', function () {
    var userDropdown = document.getElementById('userDropdown');

    userDropdown.addEventListener('click', function () {
        var dropdownContent = document.querySelector('.dropdown-content');
        dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
    });

    // Close dropdown when clicking outside
    window.addEventListener('click', function (event) {
        if (!userDropdown.contains(event.target)) {
            var dropdownContent = document.querySelector('.dropdown-content');
            dropdownContent.style.display = 'none';
        }
    });
});
