
const menuToggle = document.getElementById("menuToggle");
const menuClose = document.getElementById("menuClose");
const navMenu = document.getElementById("navMenu");

if (menuToggle && menuClose && navMenu) {

    // Open menu
    menuToggle.addEventListener("click", () => {

        navMenu.classList.add("active");
        document.body.classList.add("menu-open");
    });

    // Close menu
    menuClose.addEventListener("click", () => {

        navMenu.classList.remove("active");
        document.body.classList.remove("menu-open");
    });

    // Close menu when a link is clicked
    const navLinks = navMenu.querySelectorAll("a");
    navLinks.forEach(link => {

        link.addEventListener("click", () => {

            navMenu.classList.remove("active");
            document.body.classList.remove("menu-open");

        });
    });
}


