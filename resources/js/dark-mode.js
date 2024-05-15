// Fonction pour définir le thème en fonction du localStorage ou des préférences du système
function setTheme(theme) {
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
        document.getElementById('toggle-theme').checked = true;
    } else {
        document.documentElement.classList.remove('dark');
        document.getElementById('toggle-theme').checked = false;
    }
}

// Vérifier le localStorage pour le thème ou utiliser les préférences du système
if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    setTheme('dark');
} else {
    setTheme('light');
}

// Basculer le thème et enregistrer la préférence dans le localStorage
function toggleTheme() {
    if (document.documentElement.classList.contains('dark')) {
        setTheme('light');
        localStorage.setItem('theme', 'light');
    } else {
        setTheme('dark');
        localStorage.setItem('theme', 'dark');
    }
}

// Ajouter un écouteur d'événements à l'interrupteur de basculement
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('toggle-theme').addEventListener('change', toggleTheme);
});