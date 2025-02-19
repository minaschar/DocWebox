<?php
    include "config.php";
    require_once "./src/scripts/configuration/init.php";
    include './public/views/includes/file-begin/file-begin.php';

    session_start();

    if (isset($_SESSION["redirecting-route"])) {
        unset($_SESSION["redirecting-route"]);
    }
     
?>
    <link rel="stylesheet" href="./public/styles/index-styling.css" />
<?php
    include './public/views/includes/headers/landing-header.php';
?>
    <div class="container">
        <h1>Welcome to DocWebox, the place where you find your doctor!</h1>
        <h3>Book an appointment with 4 clicks</h3>
        <form action="./public/views/patient-views/doctors.php" method="get" class="search-area">
            <select id="Doc-Specialities" name="specialization">
                <option value="None">All doctors</option>
                <option value="General doctor">General doctor</option>
                <option value="Pathologist">Pathologist</option>
                <option value="Pediatrician">Pediatrician</option>
                <option value="Urologist andrologist">Urologist andrologist</option>
                <option value="Gynecologist">Gynecologist</option>
                <option value="Ophthalmologist">Ophthalmologist</option>
                <option value="General surgeon">General surgeon</option>
                <option value="Dental Surgeon">Dental Surgeon</option>
                <option value="Dentist">Dentist</option>
                <option value="Cardiologist">Cardiologist</option>
                <option value="Endocrinologist">Endocrinologist</option>
                <option value="Dermatologist-Venereologist">Dermatologist-Venereologist</option>
                <option value="Anesthetist">Anesthetist</option>
                <option value="Allergist">Allergist</option>
                <option value="Dietitian-Nutritionist">Dietitian-Nutritionist</option>
                <option value="Oncologist">Oncologist</option>
                <option value="Orthopedist">Orthopedist</option>
                <option value="Pulmonologist">Pulmonologist</option>
                <option value="Physiotherapist">Physiotherapist</option>
                <option value="Psychiatrist">Psychiatrist</option>
                <option value="Otorhinolaryngologist">Otorhinolaryngologist</option>
            </select>
            <input type="text" placeholder="Location" name="location">
            <button type="submit"><img src="./public/resources/images/tools/search.png"></button>
        </form>
    </div>
    <section>
        <div class="row">
            <h1>Why use DocWebox?</h1>
        </div>
        <div class="row">
            <!-- Column One -->
            <div class="column">
                <div class="card">
                    <div class="icon">
                    <i class="fa-solid fa-stethoscope"></i>
                    </div>
                    <h3>Associate Doctors</h3>
                    <p>Hundreds of doctors have already joined DocWebox and are ready to assist you.</p>
                </div>
            </div>
            <!-- Column Two -->
            <div class="column">
                <div class="card">
                    <div class="icon">
                        <i class="fa-brands fa-searchengin"></i>
                    </div>
                    <h3>Results by the thousands</h3>
                    <p>Finding doctors near you has never been easier. Just select the doctor's specialization and your location and you are good to go!</p>
                </div>
            </div>
            <!-- Column Three -->
            <div class="column">
                <div class="card">
                    <div class="icon">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <h3>Shedule an appointment whithin a minute</h3>
                    <p>See the available times, fill in your contact details, the reason for your visit and you're ready!</p>
                </div>
            </div>
        </div>
    </section>
    <div class="container-us">
        <div id="info-icon">
            <i class="fa-solid fa-circle-info"></i>
        </div>
        <h2>DocWebox is an assignment for the lesson "Special Topics in Internet Programming" of Uom</h2>
        <h3>Meet <a class="us-link"href="./public/views/our-team.php">our team</a></h3><br>
    </div>  
<?php
  include './public/views/includes/footers/landing-footer.php';
?>