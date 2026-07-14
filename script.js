// Restaurant Booking System
// Project By: Khushi kumari

// Welcome Message
window.onload = function () {
    console.log("Welcome to Royal Restaurant");
};

// Navbar Active Link
const links = document.querySelectorAll("nav ul li a");

links.forEach(link => {
    link.addEventListener("click", function () {
        links.forEach(item => item.classList.remove("active"));
        this.classList.add("active");
    });
});

// Smooth Button Animation
const buttons = document.querySelectorAll(".btn, button");

buttons.forEach(button => {
    button.addEventListener("mouseover", () => {
        button.style.transform = "scale(1.05)";
    });

    button.addEventListener("mouseout", () => {
        button.style.transform = "scale(1)";
    });
});

// Booking Form Validation
const form = document.querySelector("form");

if (form) {

    form.addEventListener("submit", function (e) {

        const name = document.querySelector('input[name="name"]');

        if (name && name.value.trim() === "") {

            alert("Please enter your name.");

            e.preventDefault();
        }

    });

}

// Back to Top
window.addEventListener("scroll", function () {

    if (window.scrollY > 200) {

        console.log("Scrolling...");
    }

});