const menu = document.getElementById("menuMobile");
const optionsMobile = document.getElementById("optionsMobile");

function activateMenu() {
  menu.style.display = "none";
  optionsMobile.style.display = "block";
}

function disableMenu() {
  menu.style.display = "block";
  optionsMobile.style.display = "none";
}
