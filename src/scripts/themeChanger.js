// Determines if the user has a set theme
const detectColorScheme = () => {
    let theme = "light"; // Default to light

    // Local storage is used to override OS theme settings
    if (localStorage.getItem("theme")) {
        if (localStorage.getItem("theme") === "dark") {
            theme = "dark";
        }
    } else if (!window.matchMedia) {
        // matchMedia method not supported
        return false;
    } else if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
        // OS theme setting detected as dark
        theme = "dark";
    }

    // Dark theme preferred, set document with a `data-theme` attribute
    if (theme === "dark") {
        document.documentElement.setAttribute("data-theme", "dark");
    }
}
detectColorScheme();

// Identify the theme button HTML element
const themeButton = document.querySelector('#theme-btn');

// Function that changes the theme, and sets a localStorage variable to track the theme between page loads
const switchTheme = () => {
    let currentTheme = document.documentElement.getAttribute('data-theme');
    if (currentTheme === 'dark') {
        localStorage.setItem('theme', 'light');
        document.documentElement.setAttribute('data-theme', 'light');
    } else {
        localStorage.setItem('theme', 'dark');
        document.documentElement.setAttribute('data-theme', 'dark');
    }    
}

// Listener for changing themes
themeButton.addEventListener('click', switchTheme, false);
