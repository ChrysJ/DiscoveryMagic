// burgermenu
const burgerMenu = document.querySelector(".burger-menu");
const navMobile = document.querySelector(".box-nav-mobile");
// Menu user connected
const userConnected = document.querySelector(".user-connected");
const menuUserConnected = document.querySelector(".menu-user-connected");
// Active menu
const activeSearchPark = document.querySelectorAll(
  ".navigation-active-searchpark"
);
const activeFavoritePark = document.querySelectorAll(
  ".navigation-active-favoritepark"
);
const activeAddPark = document.querySelectorAll(".navigation-active-addpark");

// Active menu
if (location.pathname == "/controllers/searchparkController.php") {
  activeSearchPark.forEach((active) => {
    active.classList.add("active");
  });
}
if (location.pathname == "/controllers/favoritesparkController.php") {
  activeFavoritePark.forEach((active) => {
    active.classList.add("active");
  });
}

if (location.pathname == "/controllers/addparkController.php") {
  activeAddPark.forEach((active) => {
    active.classList.add("active");
  });
}

// Menu mobile
burgerMenu.addEventListener("click", () => {
  navMobile.classList.toggle("open-nav-mobile");
  document.body.classList.toggle("body-overflow");
  burger.classList.toggle("open");
});

// scroll navbar position
const topNav = document.querySelector(".header");
let lastScroll = 0;

window.addEventListener("scroll", () => {
  if (window.scrollY > 500) {
    if (window.scrollY < lastScroll) {
      topNav.style.top = 0;
    } else if (
      menuUserConnected.classList.contains("menu-user-connected-open")
    ) {
      topNav.style.top = 0;
    } else {
      topNav.style.top = "-200px";
    }
    lastScroll = window.scrollY;
  }
});

// Menu account
userConnected.addEventListener("click", () => {
  menuUserConnected.classList.toggle("menu-user-connected-open");
});

// --------------------------------------------------------------------------------------------------------
// Couleur theme
const colorThemes = document.querySelectorAll(".theme-park-title");

colorThemes.forEach((colorTheme) => {
  // Parc d'attractions et par a theme
  if (colorTheme.textContent == "parcs d'attractions et parcs à thème") {
    colorTheme.style.background = "#fa7f69";
  }
  // Parc aquatiques
  if (colorTheme.textContent == "parcs aquatiques") {
    colorTheme.style.background = "#5fcde0";
  }
  // Parc de loisirs
  if (colorTheme.textContent == "parcs de loisirs") {
    colorTheme.style.background = "#e971df";
  }
});
