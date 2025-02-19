"use strict";

export default class AppointmentView {
  constructor() {
    this.parentElement = "#card-container";
  }

  template(appointmentObj) {
    return `
      <div class="card">
          <h3>Appointment with ${appointmentObj.doctorName}</h3>
          <button class="delete-btn" onclick="deleteAppointment(${appointmentObj.id})">Delete</button>
          <button class="edit-modal-trigger-appointment edit-btn" onclick="setSelectedAppointment(${appointmentObj.id})">
            Edit
          </button>
          <h4 id="appointment-date">${appointmentObj.date}</h4>
          <h4 id="appointment-time">${appointmentObj.time}.00</h4>
          <h4>${appointmentObj.location}</h4>
          <p>${appointmentObj.description}</p>
      </div>
      <br/>
    `;
  }

  templateEmpty() {
    return `<h3 class="h3-center">No Appointments yet</h3>`;
  }

  render(appointmentsData) {
    const that = this;
    const container = document.querySelector(this.parentElement);

    container.innerHTML = "";

    if (appointmentsData.length >= 1) {
      appointmentsData.forEach(function (appointmentObj) {
        container.insertAdjacentHTML("afterbegin", that.template(appointmentObj));

        const triggerA = document.querySelector(".edit-modal-trigger-appointment");
        const closeButtonA = document.querySelector(".edit-modal-close-button-appointment");

        triggerA.addEventListener("click", toggleModalAppointment);
        closeButtonA.addEventListener("click", toggleModalAppointment);
      });
    } else {
      container.insertAdjacentHTML("afterbegin", this.templateEmpty());
    }
  }
}
