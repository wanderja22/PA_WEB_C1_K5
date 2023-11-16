const header = document.querySelector("header");

window.addEventListener("scroll", function () {
  header.classList.toggle("sticky", window.scrollY > 0);
});

let menu = document.querySelector("#menu-icon");
let navlist = document.querySelector(".navlist");

document.addEventListener("DOMContentLoaded", function () {
  // Update the navbar based on the login status
  updateNavbar(username);
});

function updateNavbar(username) {
  var loginLink = document.getElementById("login-link");
  var welcomeLink = document.getElementById("welcome-link");
  var logoutLink = document.getElementById("logout-link");

  // Apply styles to the welcomeLink and logoutLink
  var commonStyles =
    "color: var(--text-color); font-weight: 600; padding: 0 15px; font-size: 1rem; transition: all 0.36s ease;";

  welcomeLink.style.cssText = commonStyles;
  logoutLink.style.cssText = commonStyles;

  if (username) {
    // User is logged in
    loginLink.style.display = "none";
    welcomeLink.style.display = "inline-block";
    welcomeLink.classList.add("welcome-logout");
    welcomeLink.innerText = "Welcome, " + username;

    // Show the logout link
    logoutLink.style.display = "inline-block";
    logoutLink.classList.add("welcome-logout");
  } else {
    // User is not logged in
    loginLink.style.display = "inline-block";
    welcomeLink.style.display = "none";

    // Hide the logout link
    logoutLink.style.display = "none";
  }
}
