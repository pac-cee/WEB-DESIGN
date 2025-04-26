// Theme toggle logic for dashboard (light, dark, system)
(function() {
  const THEME_KEY = 'eventify_theme';
  const themeToggleBtn = document.getElementById('theme-toggle-btn');
  const themeMenu = document.getElementById('theme-menu');
  const themeOptions = document.querySelectorAll('.theme-option');

  // Detect system theme
  function getSystemTheme() {
    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  }

  // Set theme on <html>
  function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
  }

  // Persist theme
  function saveTheme(theme) {
    localStorage.setItem(THEME_KEY, theme);
  }

  // Get saved or system theme
  function getSavedTheme() {
    return localStorage.getItem(THEME_KEY) || 'system';
  }

  // Apply theme
  function applyTheme() {
    const theme = getSavedTheme();
    if (theme === 'system') {
      setTheme(getSystemTheme());
    } else {
      setTheme(theme);
    }
    // Highlight selected option
    themeOptions.forEach(opt => {
      opt.classList.toggle('active', opt.dataset.theme === theme);
    });
  }

  // Toggle menu
  themeToggleBtn.addEventListener('click', function(e) {
    themeMenu.classList.toggle('show');
    e.stopPropagation();
  });
  document.addEventListener('click', function() {
    themeMenu.classList.remove('show');
  });

  // Select theme
  themeOptions.forEach(opt => {
    opt.addEventListener('click', function(e) {
      const selected = this.dataset.theme;
      saveTheme(selected);
      applyTheme();
      themeMenu.classList.remove('show');
      e.stopPropagation();
    });
  });

  // Listen for system theme change
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function() {
    if (getSavedTheme() === 'system') applyTheme();
  });

  // Init
  applyTheme();
})();
