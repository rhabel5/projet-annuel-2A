document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed'); // Log

    var profileMenuButton = document.getElementById('profile-menu-button');
    var languageMenuButton = document.getElementById('language-menu-button');

    if (profileMenuButton) {
        console.log('Profile menu button found'); // Log
        profileMenuButton.addEventListener('click', function() {
            document.getElementById('profile-menu').classList.toggle('hidden');
        });
    } else {
        console.log('Profile menu button not found'); // Log
    }

    if (languageMenuButton) {
        console.log('Language menu button found'); // Log
        languageMenuButton.addEventListener('click', function() {
            document.getElementById('language-menu').classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            var isClickInsideLanguageMenu = languageMenuButton.contains(event.target) || document.getElementById('language-menu').contains(event.target);
            if (!isClickInsideLanguageMenu) {
                document.getElementById('language-menu').classList.add('hidden');
            }

            if (profileMenuButton) {
                var isClickInsideProfileMenu = profileMenuButton.contains(event.target) || document.getElementById('profile-menu').contains(event.target);
                if (!isClickInsideProfileMenu) {
                    document.getElementById('profile-menu').classList.add('hidden');
                }
            }
        });
    } else {
        console.log('Language menu button not found'); // Log
    }
});