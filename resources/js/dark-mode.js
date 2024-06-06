document.addEventListener('DOMContentLoaded', function() {
    const toggleTheme = document.getElementById('toggle-theme');

    if (toggleTheme) {
        // Initial state
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
            toggleTheme.checked = true;
        }

        // Toggle event
        toggleTheme.addEventListener('change', function() {
            if (toggleTheme.checked) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        });
    }
});