const btnsFilter = document.querySelectorAll(".btn-filter");
const btnDisplayValidated = document.querySelector(".allParks");
const btnDisplayNotValidated = document.querySelector(".notValidated");
const tableBody = document.querySelector(".tableBody");

// ---------------------------------------------------------------------------------------------------------------------------
let parks = [];

window.onload = () => {
  fetch("/getParksList")
    .then((response) => response.json())
    .then((datas) => {
      parks.push(datas);
      displayParksValidated();
      btnDisplayNotValidated.textContent += ` (${parks[0][1].length})`;
      btnDisplayValidated.textContent += ` (${parks[0][0].length})`;
    });
};

// -----------------------------------------------FILTER----------------------------------------------------------------------
// Display validated park
btnDisplayValidated.addEventListener("click", () => {
  tableBody.innerHTML = "";
  displayParksValidated();
});

const displayParksValidated = () => {
  parks[0][0].forEach((park) => {
    tableBody.innerHTML += `
          <tr>
            <td>${park.id}</td>
            <td>${park.name}</td>
            <td>${park.theme}</td>
            <td class="button-list">
              <a class="review" href="/dashboard/review/${park.id}?action=update"><i class="fa-solid fa-pencil"></i></a>
              <a class="delete" href="/dashboard/suppresion_parc/${park.id}?action=update"><i class="fa-solid fa-xmark"></i></a>
            </td>
          </tr>
          `;
  });
};

// ---------------------------------------------------------------------------------------------------------------------------

// Display not validated park
btnDisplayNotValidated.addEventListener("click", () => {
  tableBody.innerHTML = "";
  displayParksNotValidated();
});

const displayParksNotValidated = () => {
  parks[0][1].forEach((park) => {
    tableBody.innerHTML += `
            <tr>
              <td>${park.id}</td>
              <td>${park.name}</td>
              <td>${park.theme}</td>
              <td class="button-list">
                <a class="review" href="/dashboard/review/${park.id}?action=validate"><i class="fa-solid fa-pencil"></i></a>
                <a class="delete" href="/dashboard/suppresion_parc/${park.id}?action=validate"><i class="fa-solid fa-xmark"></i></a>
              </td>
            </tr>
            `;
  });
};

// ---------------------------------------------------------------------------------------------------------------------------

// Filter nav active
btnsFilter.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    removeClassbtnFilter();
    e.target.classList.add("active");
  });
});

const removeClassbtnFilter = () => {
  btnsFilter.forEach((btn) => {
    btn.classList.remove("active");
  });
};
