// displayRankingPark
const mapFrance = document.querySelector(".map-france-selected");
const regions = document.querySelectorAll(".region");
const selectRegion = document.getElementById("region-select");
const selectedRegionName = document.querySelector(".selected-region-name");
const listPark = document.querySelector(".list-park");

// Tableau datasRegions pour stocké les datas des regions
let dataParcs = [];

// Récupération des datas des parcs
window.onload = () => {
  fetch("/getDataPark")
    .then((response) => response.json())
    .then((datas) => {
      dataParcs.push(datas);
      displayParcs(datas);
    });
};

// --------------------------------------------------------
// Click des regions
// --------------------------------------------------------
regions.forEach((region) => {
  region.addEventListener("click", (e) => {
    switchcolor();
    switchRegion(e.target);

    selectRegion.value = e.target.dataset.region;
    selectedRegionName.innerHTML = `Les parcs de la région</br>${selectRegion.options[selectRegion.value].text
      }`;

    var regionsData = dataParcs[0].filter(function (dataParcs) {
      return (
        dataParcs.region == `${selectRegion.options[selectRegion.value].text}`
      );
    });
    displayParcs(regionsData);
  });

  // --------------------------------------------------------
  // Click du select
  // --------------------------------------------------------
  selectRegion.addEventListener("input", (e) => {
    if (e.target.value == region.dataset.region) {
      switchcolor();
      switchRegion(region);

      const selectRegionOptionsText =
        selectRegion.options[selectRegion.value].text;
      selectedRegionName.innerHTML = `Les parcs de la région</br>${selectRegionOptionsText}`;

      // ------------------------------------------------------------------------
      var regionsData = dataParcs[0].filter(function (dataParcs) {
        return (
          dataParcs.region == `${selectRegion.options[selectRegion.value].text}`
        );
      });
      displayParcs(regionsData);
    }
  });
});

// --------------------------------------------------------
// Parcs element
// --------------------------------------------------------
const displayParcs = (regionsData) => {
  if (regionsData.length === 0) {
    listPark.innerHTML = `
    <div>
    <h4>Aucun résultat n'a étais trouvé</h4>
    <p>Mais vous pouvez y remédier en ajoutant un nouveau parc<p>
    </div>
    `;
  } else {
    listPark.innerHTML = regionsData
      .map((region) => {
        return `
      <li class="park">
      <div class="container-img-park  transition-img">
      <img id="imgpark" src="/public/upload/imgparkValidated/${region.id}/1_${region.slug}.jpg" alt="${region.name}">
      </div>
      <div class="park-head">
      <a href="/review/${region.slug}">${region.name}</a>
      <i class="fa-regular fa-heart heart"></i>
      </div>
      <div class="container-rated">
          <i class="fa-solid fa-star stars"></i>
          <i class="fa-solid fa-star stars"></i>
          <i class="fa-solid fa-star stars"></i>
          <i class="fa-solid fa-star stars"></i>
          <i class="fa-solid fa-star empty-stars"></i>
          <span class="rated">4.1</span>
          <span class="separate-rate"></span>
          <span class="number-vote">2 notes</span>
          </div>
          <span class="theme-park-title">${region.theme}</span>
          <div class="short-info-text-park">
          <p class="truncate text-rankedpark">${region.description}</p>
          </div>
          </li>
          `;
      })
      .join("");
  }

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
};

// --------------------------------------------------------
// Style switch
// --------------------------------------------------------
const switchRegion = (region) => {
  region.style.fill = "#F97B36";
};

const switchcolor = () => {
  regions.forEach((region) => {
    region.style.fill = "#FFF8F3";
    region.style.cursor = "pointer";
  });
};

// --------------------------------------------------------
// Stepper
// --------------------------------------------------------
const steps = document.querySelectorAll(".step");
const imgStep = document.querySelector(".step-img");

steps.forEach((step) => {
  step.addEventListener("mouseover", (e) => {
    if (e.currentTarget == steps[0]) {
      imgStep.innerHTML = `<img src="/public/assets/img/other/search-park.svg" alt="Icône recherche de parc d'attraction">`;
    }
    if (e.currentTarget == steps[1]) {
      imgStep.innerHTML = `<img src="/public/assets/img/other/favorite-park.svg" alt="Icône ajouter les parcs d'attractions à vos favoris">`;
    }
    if (e.currentTarget == steps[2]) {
      imgStep.innerHTML = `<img src="/public/assets/img/other/add-park.svg" alt="Icône ajouter un parc d'attraction">`;
    }
  });
});
