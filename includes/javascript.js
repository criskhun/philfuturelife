document.addEventListener("DOMContentLoaded", function() {
    // Sidebar toggle functionality
    const sidebarToggle = document.querySelector("#sidebar-toggle");
    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function() {
            const sidebar = document.querySelector("#sidebar");
            if (sidebar) {
                sidebar.classList.toggle("collapsed");
            }
        });
    }

    // Theme toggle functionality
    const themeToggler = document.querySelector(".theme-toggler");
    if (themeToggler) {
        themeToggler.addEventListener("click", function() {
            toggleRootClass();
        });
    }

    function toggleRootClass() {
        const currentTheme = document.documentElement.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-bs-theme', newTheme);
        toggleLocalStorage(newTheme);
    }

    function toggleLocalStorage(theme) {
        localStorage.setItem("theme", theme);
    }

    function applyInitialTheme() {
        const storedTheme = localStorage.getItem("theme");
        if (storedTheme) {
            document.documentElement.setAttribute('data-bs-theme', storedTheme);
        }
    }

    applyInitialTheme();

    // Initialize Bootstrap collapse for sidebar items
    const collapseElements = document.querySelectorAll('.collapse');
    collapseElements.forEach(collapseEl => {
        new bootstrap.Collapse(collapseEl, {
            toggle: false // prevent automatic collapsing
        });
    });

    // Manually show the collapsible elements in the sidebar
    ['pages', 'posts', 'reports', 'multi', 'level-1'].forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            new bootstrap.Collapse(element, {
                toggle: true // force to show
            });
        }
    });
});
