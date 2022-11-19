const hearts = document.querySelectorAll(".heart");
const addFavorite = document.querySelector(".add-favorite-park");
const closeModalDisconnected = document.querySelector(
  ".close-add-favorite-park-disconnected"
);
const addFavoriteParkDisconnected = document.querySelector(
  ".add-favorite-park-disconnected"
);

hearts.forEach((heart) => {
  heart.addEventListener("click", () => {
    addFavorite.style.transform = "translateX(0)";
    addFavorite.style.opacity = "1";

    if (addFavorite.style.opacity == 1) {
      setTimeout(() => {
        addFavorite.style.transform = "translateX(70%)";
        addFavorite.style.opacity = "0";
      }, 3000);
    }
  });

  heart.addEventListener("click", () => {
    addFavoriteParkDisconnected.style.display = "flex";
    document.body.classList.add("body-overflow");
  });
});

// Close modal addpark disconnected
closeModalDisconnected.addEventListener("click", () => {
  addFavoriteParkDisconnected.style.display = "none";
  document.body.classList.remove("body-overflow");
});

addFavoriteParkDisconnected.addEventListener("click", (e) => {
  if (e.target == addFavoriteParkDisconnected) {
    addFavoriteParkDisconnected.style.display = "none";
    document.body.classList.remove("body-overflow");
  }
});
