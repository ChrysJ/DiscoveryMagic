// ----------------------------------------------------------------------------------------
// Swiper
const swiper = new Swiper(".swiper", {
  loop: true,

  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});
// ----------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------------
// SeeMoreDescriptionPark
const btnSeeMore = document.querySelector(".seemore");
const textDescripton = document.querySelector(".text-descriptionpark");

if (
  textDescripton.offsetHeight < textDescripton.scrollHeight ||
  textDescripton.offsetWidth < textDescripton.scrollWidth
) {
  btnSeeMore.style.display = "block";
  btnSeeMore.textContent = "voir plus";
}

btnSeeMore.addEventListener("click", () => {
  textDescripton.classList.toggle("truncate");
  if (btnSeeMore.textContent == "voir plus") {
    btnSeeMore.textContent = "voir moins";
  } else if (btnSeeMore.textContent == "voir moins") {
    btnSeeMore.textContent = "voir plus";
  }
});
// ----------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------------
// Systeme de notation
const stars = document.querySelectorAll(".star-rated");
const rate = document.querySelector("#rate");
const selectedStars = document.querySelector(".selected-stars");
const userSelectedRate = document.querySelector(".user-selected-rate");

stars.forEach((star) => {
  star.addEventListener("mouseover", function () {
    resetStars();
    this.style.color = "#F97B36";
    this.classList.add("las");
    this.classList.remove("lar");
    // L'élément précédent dans le DOM (de même niveau, balise soeur)
    let previousStar = this.previousElementSibling;

    while (previousStar) {
      // On passe l'étoile qui précède en rouge
      previousStar.style.color = "#F97B36";
      previousStar.classList.add("las");
      previousStar.classList.remove("lar");
      // On récupère l'étoile qui la précède
      previousStar = previousStar.previousElementSibling;
    }
  });

  // On écoute le clic
  star.addEventListener("click", function () {
    rate.value = this.dataset.value;
    selectedStars.style.display = "flex";
    userSelectedRate.textContent = `${rate.value} / 5`;
  });

  star.addEventListener("mouseout", function () {
    resetStars(rate.value);
  });
});

/**
 * Reset des étoiles en vérifiant la rate dans l'input caché
 * @param {number} rate
 */
function resetStars(rate = 0) {
  stars.forEach((star) => {
    if (star.dataset.value > rate) {
      star.style.color = "#ABA49C";
      star.classList.add("lar");
      star.classList.remove("las");
    } else {
      star.style.color = "#F97B36";
      star.classList.add("las");
      star.classList.remove("lar");
    }
  });
}
// ----------------------------------------------------------------------------------------
