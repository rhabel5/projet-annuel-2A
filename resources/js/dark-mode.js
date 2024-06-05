document.addEventListener('DOMContentLoaded', function() {
    var toggleTheme = document.getElementById('toggle-theme');

    if (toggleTheme) {
        toggleTheme.checked = (localStorage.getItem('theme') === 'dark');

        toggleTheme.addEventListener('change', function() {
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
    }
});