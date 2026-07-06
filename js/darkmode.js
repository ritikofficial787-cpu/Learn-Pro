// Dark Mode Added — darkmode.js
// Handles toggle, localStorage persistence, and icon state

(function () {
    // Dark Mode Added: key used in localStorage
    var STORAGE_KEY = 'learnpro_darkmode';

    // Dark Mode Added: grab the toggle button
    var toggleBtn = document.getElementById('darkModeToggle');

    // Dark Mode Added: set icon to reflect current state
    function updateIcon(isDark) {
        if (toggleBtn) {
            toggleBtn.textContent = isDark ? '☀️' : '🌙';
            toggleBtn.setAttribute('title', isDark ? 'Switch to Light Mode' : 'Switch to Dark Mode');
            toggleBtn.setAttribute('aria-label', isDark ? 'Switch to Light Mode' : 'Switch to Dark Mode');
        }
    }

    // Dark Mode Added: apply or remove .dark-mode class on body
    function applyMode(isDark) {
        if (isDark) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
        updateIcon(isDark);
    }

    // Dark Mode Added: toggle and persist preference
    function toggleDarkMode() {
        var isDark = document.body.classList.contains('dark-mode');
        var newState = !isDark;
        localStorage.setItem(STORAGE_KEY, newState ? '1' : '0');
        applyMode(newState);
    }

    // Dark Mode Added: bind click on toggle button
    if (toggleBtn) {
        toggleBtn.addEventListener('click', toggleDarkMode);
    }

    // Dark Mode Added: restore saved preference on load
    // Note: the class is applied early (inline in <head>) to prevent flash;
    // this block just ensures the icon is correct after the DOM is ready.
    var saved = localStorage.getItem(STORAGE_KEY);
    updateIcon(saved === '1');

})();
