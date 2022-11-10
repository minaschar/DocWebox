<?php

    require "../../src/db/connect.php";

    // Define variables and initialize with empty values
    $firstname = $lastname = $username = $email = $phone = $vat = $specialization = $password = $confirmPassword =  "";
    $firstnameErr = $lastnameErr = $usernameErr = $emailErr = $phoneErr = $vatErr = $specializationErr = $passwordErr = $confirmPasswordErr =  "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $phone = $_POST["phone"];
        $vat = $_POST["vat"];
        $specialization = $_POST["specialization"];

        // Validate username
        if (empty(trim($_POST["firstname"]))){
            $firstnameErr = "Please enter a Firstname.";
        } 

        if (empty(trim($_POST["lastname"]))){
            $lastnameErr = "Please enter a Lastname.";
        }

        if (empty(trim($_POST["username"]))){
            $usernameErr = "Please enter a username.";
        } else if (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
            $usernameErr = "Username can only contain letters, numbers, and underscores.";
        } 
        
        if (empty(trim($_POST["email"]))) {
            $emailErr = "Please enter a email.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email address format!";
        }  
        
        if (empty(trim($_POST["phone"]))) {
            $phoneErr = "Please enter a phone.";
        }

        if (empty(trim($_POST["vat"]))) {
          $vat = "Please enter your VAT Number.";
        }

        if (empty($_POST["specialization"])) {
          $specialization = "Please enter your Specialization.";
        }
        
        if (empty($firstnameErr) && empty($lastnameErr) && empty($usernameErr) && empty($emailErr) && empty($phoneErr) && empty($vatErr) && empty($specializationErr)) {
          // Prepare a select statement
          $sql = "SELECT id FROM doctor WHERE username = ?";
          
          if($stmt_username = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt_username->bind_param("s", $username);
                                          
            // Attempt to execute the prepared statement
            if($stmt_username->execute()){
              // store result
              $stmt_username->store_result();
                              
              if($stmt_username->num_rows == 1) {
                $usernameErr = "Username not available!";
              } else {

                // Prepare a select statement
                $sql = "SELECT id FROM doctor WHERE email = ?";

                if ($stmt_email = $mysqli->prepare($sql)) {
                  // Bind variables to the prepared statement as parameters
                  $stmt_email->bind_param("s", $email);

                  // Attempt to execute the prepared statement
                  if($stmt_email->execute()){
                    // store result
                    $stmt_email->store_result();
                                    
                    if($stmt_email->num_rows == 1) {
                      $emailErr = "Email not available!";
                    } else {

                      // Validate password
                      if(empty(trim($_POST["password"]))){
                          $passwordErr = "Please enter a password.";     
                      } else if(strlen(trim($_POST["password"])) < 8){
                          $passwordErr = "Password must have at least 8 characters.";
                      } else {
                          $password = trim($_POST["password"]);
                      }

                      // Validate confirm password
                      if(empty(trim($_POST["confirm-password"]))){
                          $confirmPasswordErr = "Please confirm password.";     
                      } else {
                        $confirmPassword = trim($_POST["confirm-password"]);
                        if(empty($passwordErr) && ($password != $confirmPassword)){
                            $confirmPasswordErr = "Password did not match.";
                        }
                      }

                      if(empty($passwordErr) && empty($confirmPasswordErr)){

                        // Prepare an insert statement
                        $sql = "INSERT INTO doctor (firstname, lastname, username, email, password, phone, specialization, vat) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                        if($stmt = $mysqli->prepare($sql)){
                          // Bind variables to the prepared statement as parameters
                          $stmt->bind_param("ssssssss", $firstname, $lastname, $username, $email, $param_password, $phone, $specialization, $vat);
                          
                          $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                          
                          // Attempt to execute the prepared statement
                          if($stmt->execute()){
                              // Redirect to login page
                              header("location: login-doctor.php");
                          } else {
                              echo "Oops! Something went wrong. Please try again later.";
                          }

                          // Close statement
                          $stmt->close();
                        }
                      }

                      // Close connection
                      $mysqli->close();
                    }
                  } else {
                    echo "Oops! Something went wrong. Please try again later.";
                  }
                  // Close statement
                  $stmt_email->close();
                } 
              }
            }
          } else {
              echo "Oops! Something went wrong. Please try again later.";
          }
          // Close statement
          $stmt_username->close();
       }
    }
?>

<!doctype html>
<html>
    <head>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
      <link rel="stylesheet" href="../styles/login-register.css">
      <title>DocWebox - Find your Doctor!</title>
    </head>
    <body>
    <header>
      <nav>
        <a href="./sign-up.php"><img src="../resources/logos/logo-back-transparent.png" alt="DocWebox logo back" class="nav__logo" id="logo" /></a>
      </nav>
    </header>
       <section class="my-5 mx-5">
        <div class="container">
          <div class="row no-gutters">
            <div class="col-lg-6 section-img" id="doctor-c">
              <img src="../resources/logos/main-logo-transparent.png" class="mx-auto d-block">
              <!-- <h4 class="header">Welcome to DocWebox</h4>
              <a href="../../../DocWebox/index.php" id="back-home-doctor" class="d-flex justify-content-center align-self-end">Back to home page</a> -->
             </div>
            <div class="col-lg-6 section-form">
              <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h4 class="font-weigth-bold header">Glad to have you on board Doc!</h4>
                <div class="d-flex justify-content-center align-items-center">
                  <div class="col-lg-7">
                    <label class="form-label" for="firstname">Firstname*</label>
                    <input type="text" class="form-control my-2 p-2" placeholder="Firstname" name="firstname" autofocus autocomplete="on">
                  </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                  <div class="col-lg-7">
                    <label class="form-label" for="lastname">Lastname*</label>
                    <input type="text" class="form-control my-2 p-2" placeholder="Lastname" name="lastname" autocomplete="on">
                  </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                  <div class="col-lg-7">
                    <label class="form-label" for="username">Username*</label>
                    <input type="text" class="form-control my-2 p-2" placeholder="Username" name="username" autocomplete="on">
                  </div>
                </div>
                <div class="form-row d-flex justify-content-center align-items-center">
                   <div class="col-lg-7">
                    <label class="form-label" for="email">Email*</label>
                    <input type="email" class="form-control my-2 p-2" placeholder="Email" name="email" autocomplete="on">
                  </div>
                </div>
                <div class="form-row d-flex justify-content-center align-items-center">
                  <div class="col-lg-7">
                   <label class="form-label" for="phone">Phone number*</label>
                   <input type="tel" class="form-control my-2 p-2" placeholder="Phone" name="phone" autocomplete="on">
                 </div>
               </div>
               <div class="form-row d-flex justify-content-center align-items-center">
                <div class="col-lg-7">
                 <label class="form-label" for="vat">VAT number*</label>
                 <input type="text" class="form-control my-2 p-2" placeholder="Vat" name="vat">
                </div>
                </div>
                <div class="form-row d-flex justify-content-center align-items-center">
                  <div class="col-lg-7">
                    <label class="form-label" for="password">Password*</label>
                    <input type="password" class="form-control my-2 p-2" placeholder="Password" name="password">
                  </div>
                </div>
                <div class="form-row d-flex justify-content-center align-items-center">
                  <div class="col-lg-7">
                    <label class="form-label" for="confirm-password">Confirm Password*</label>
                    <input type="password" class="form-control my-2 p-2" placeholder="Password" name="confirm-password">
                  </div>
                </div>
                <div class="form-row d-flex justify-content-center align-items-center">
                    <div class="col-lg-7">
                      <select id="Doc-Specialities" name="specialization">
                        <option value="">Choose Doctor Specialization</option>
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
                    </div>
                </div>
                <div class="form-row d-flex justify-content-center align-items-center">
                  <div class="col-lg-7">
                      <button type="submit" class="btns my-2 p-2 first-btn mt-4" id="doctor-first-btn" >Register as a Doctor</button>
                  </div>
                </div>
                <div class="d-flex justify-content-around">
                    <div class="d-flex align-items-center">
                     <hr>
                    </div>
                    
                    <p >Already registered?</p>
                    <div class="d-flex align-items-center">
                      <hr>
                    </div>
                    
                  </div>
                <div class="form-row d-flex justify-content-center align-items-center">
                  <div class="col-lg-7">
                      <button type="button" class="btns my-2 p-1" id="doctor-second-btn">Login as a Doctor</button>
                  </div>
                      
                </div>
             </div>
       </section>
       <footer class="footer">
      <img src="../resources/logos/main-logo-transparent.png" alt="Logo" class="footer__logo" />
      <p class="footer__copyright">
        &copy; Project owned by 
        <a class="footer__link" target="_blank" href="https://github.com/ics20044/DocWebox">Us</a>.
      </p>
    </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>