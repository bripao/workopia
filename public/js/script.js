document.querySelector("#hamburger").addEventListener("click", function () {
    const menu = document.getElementById("mobile-menu");
    menu.classList.toggle("hidden");
});

// document.querySelectorAll('[id$="-alert"]').forEach(function (alert) {
//     // Get the duration from the data attribute
//     const duration = parseInt(alert.getAttribute('data-duration'), 10);

//     // Set a timeout to remove the alert after the specified duration
//     setTimeout(function () {
//       alert.style.opacity = 0;
//       setTimeout(function () {
//         alert.remove();
//       }, 600); // Match this duration with your CSS transition time
//     }, duration);
//   });
