document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed'); // Log

    var toggleTheme = document.getElementById('toggle-theme');

    if (toggleTheme) {
        console.log('Toggle theme button found'); // Log
        toggleTheme.checked = (localStorage.getItem('theme') === 'dark');

        toggleTheme.addEventListener('change', function() {
            console.log('Theme toggle changed'); // Log
            if (toggleTheme.checked) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        });

        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    } else {
        console.log('Toggle theme button not found'); // Log
    }
});