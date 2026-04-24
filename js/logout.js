// Show confirmation dialog before logging out
var logoutLink = document.getElementById("logout-link");
if (logoutLink) {
  logoutLink.addEventListener("click", function (event) {
    var confirmLogout = confirm("Do you want to exist?");
    if (!confirmLogout) {
      event.preventDefault();
    }
  });
}
