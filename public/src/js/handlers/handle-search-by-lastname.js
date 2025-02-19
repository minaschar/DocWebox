"use strict";

const searchContainer = document.querySelector(".card-container");
const searchButton = document.querySelector("#search-doctor");
const inputDoctor = document.querySelector("#input-search");

let previousInput = "";
let appointments = [];
let doctors = [];

const fetchData = async (url) => {
  return await fetch(url).then((res) => res.json());
};

const templateDoctor = (doctor) => {
  return `
               <div class="card">
                  <a href="http://localhost/DocWebox/public/views/patient-views/doctor-public-profile.php?id=${doctor.id}" class="doctor-profile-link">
                    <h3>Dr. ${doctor.firstname} ${doctor.lastname}</h3>
                    <p> tel: ${doctor.phone}<p/>
                    <p> Address: ${doctor.location}<p/>
                  </a>
               </div>
               `;
};

const templateEmpty = () => {
  return `<h3>No doctors with this lastname</h3>`;
};

const searchDoctor = async (api, searchInput) => {
  if (searchInput !== previousInput) {
    const searchDoctors = await fetchData(`${api}${searchInput}`);

    searchContainer.innerHTML = "";

    if (searchDoctors.length) {
      searchContainer.insertAdjacentHTML("beforeEnd", "<h3>Results that match your search:</h3>");
      searchDoctors.forEach((doctor) => searchContainer.insertAdjacentHTML("beforeEnd", templateDoctor(doctor)));
    } else {
      searchContainer.insertAdjacentHTML("beforeEnd", templateEmpty());
    }
  }

  previousInput = searchInput;
};

searchButton.addEventListener("click", (evt) => {
  evt.preventDefault();
  searchDoctor("http://localhost/DocWebox/src/scripts/APIs/doctor.php?lastname=", inputDoctor.value);
});

inputDoctor.addEventListener("keyup", (evt) => {
  if (evt.target.value !== "") {
    searchDoctor("http://localhost/DocWebox/src/scripts/APIs/doctor.php?startsWith=", evt.target.value);
  }
});
