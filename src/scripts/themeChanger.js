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


function changeMenuDisplay() {
    const display = window.getComputedStyle(menuContent).getPropertyValue('display');
    if (display === 'none') {
        menuContent.style.display = 'flex';
        menuContainer.style.transform = 'translateX(0)';
        return;
    }
    menuContainer.style.transform = 'translateX(calc(100% - var(--nav_height)))';
    setTimeout(() => {menuContent.style.display = 'none'; }, transitionDuration)
}


detectColorScheme();

const themeButton = document.getElementById('theme-btn');
const menuIcon = document.querySelector('.menu-icon');
const menuContent = document.querySelector('.menu-content');
const menuContainer = document.querySelector('.menu-container');
const root = document.documentElement;
let transitionDuration = getComputedStyle(root).getPropertyValue('--transition_duration');
transitionDuration = parseFloat(transitionDuration.slice(0, -1)) * 1000;


themeButton.addEventListener('click', switchTheme, false);
menuIcon.addEventListener('click', changeMenuDisplay);
