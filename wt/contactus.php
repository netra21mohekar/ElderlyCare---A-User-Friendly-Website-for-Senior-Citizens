<?php
include 'connection.php'; // Include the database connection

$insert = false;  // Flag

if (isset($_POST['name'])) {
    // Collect post variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $subject = $_POST['subj'];
    $message = $_POST['message'];

    $sql = "INSERT INTO `s13p`.`contacts` (`name`, `email`, `phone_num`, `city`, `subject`, `msg`, `date`) 
            VALUES ('$name', '$email', '$phone', '$city', '$subject', '$message', current_timestamp())";

    // Execute the query
    if ($conn->query($sql) === true) {
        // Flag for successful insertion
        $insert = true;
    } else {
        echo "ERROR: $sql <br> $conn->error";
    }
}
if ($insert == true) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        <p class="m-2 text-center" id="bolder"><?php echo "<p class='text-center' style='font-weight:500'>Thanks for contacting us " . "$name" . " .We will be glad to help you out.</p>"; ?></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="hideAlert()">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    $insert = false;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="stylesheet" href="footer.css" />
    <style>
        /* Apply styles to everything except navbar and footer */
        body {
      font-family: 'Poppins', sans-serif;
    }

    .container {
      padding: 20px;
    }

    #bolder {
      font-weight: bold;
    }

    .form-section {
      margin-top: 20px;
    }

    .form-section .col-md-6 {
      margin-bottom: 20px;
    }

    .form-section textarea {
      resize: vertical;
    }

    /* Apply styles to the header section */
    .header1 {
      background: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 999;
    }

    /* Apply styles to the form */
    #contact-name, #contact-email, #contact-phone {
      width: 100%;
      padding: 10px;
      margin: 5px 0;
      box-sizing: border-box;
    }

    #contact-message {
      width: 100%;
      padding: 10px;
      margin: 5px 0;
      box-sizing: border-box;
      height: 100px;
    }

    .btn-success {
      background-color: #28a745;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
    }

    .btn-success:hover {
      background-color: #218838;
    }

    /* Apply styles to the alert box */
    .alert-success {
      background-color: #d4edda;
      border-color: #c3e6cb;
      color: #155724;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid transparent;
      border-radius: 4px;
    }

    .alert-success .close {
      font-size: 20px;
      font-weight: 700;
      line-height: 1;
      color: #000;
      opacity: .5;
    }

        </style>
    <body>
    <div class="header1">
      <nav class="sticky">
        <a href="" id="logo"><h2>JoyfulAging</h2></a>
        <div class="nav-links" id="navLinks">
          <i class="fas fa-window-close" onclick="hideMenu()"></i>
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="">Population Status Of Older Adults</a></li>
            <li class="dropdown">
              <a href="#" class="dropbtn">Health ▼</a>
              <div class="dropdown-content">
                <a href="diet.html">Diet</a>
                <a href="exercise.html">Exercise</a>
                <a href="mentalhealth.html">Mental Health</a>
              </div>
            </li>

            <li><a href="">Law And Senior Citizen</a></li>
            <li class="dropdown">
              <a href="#" class="dropbtn">Schemes ▼</a>
              <div class="dropdown-content">
                <a href="nationlpolicy.html">National Policy of Elder Person</a>
                <a href="nationalassistance.html">National Social Assistant Programme</a>
                <a href="">Rebates</a>
                <a href="">NGO's and Voluntury Organizations</a>
              </div>
            <li><a href="">Healthy Ageing</a></li>
            <li><a href="oldAgeVideos.html">Old Age Videos</a></li>
            <div id="button">
              <li><a href="loginPage.php">Login</a></li>
            </div>
          </ul>
        </div>
        <i class="fas fa-bars" onclick="showMenu()"></i>
      </nav>
   
  <!--END : BREADCRUMBS SECTION--->

  <section>
    <div class="container mt-2 p-2">
      <div class="row">
        <div class="col-12" id="bolder">
          <p>We are always here to help you. If you have any queries about our services 
            fill up the contact form below we'll do our best to contact you back within 24 hours.
          </p>
        <?php
        if($insert == true){ ?>
        <div class="alert alert-success alert-dismissable" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label ="close">
            <span aria-hidden="true">&times;</span>
          </button>
          <p class="m-2 text-center" id="bolder"><?php echo "<p class='text-center' style='font-weight:500'>Thanks for contacting us "."$name"." .We will be glad to help you out.</p>";?></p>
        </div>
        <?php
        $insert = false;
        }
        ?>
        <hr>
        </div>
      </div>
    </div>
  </section>


  <section class="form-section ">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
        
        <!--START :  FORM  -->
         <form method="post" action="contactus.php">
           <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" id="contact-name" class="form-control" placeholder="Full Name*" name="name" onkeyup='validateName()'>
                <span class='error-message' id='name-error'></span>
              </div>
              <div class="form-group col-md-6">
                <input type="email" id="contact-email" class="form-control" placeholder="Email Address*" name="email" onkeyup='validateEmail()'>  
                <span class='error-message' id='email-error'></span>
              </div>
           </div>

           <div class="form-row">
              <div class="form-group col-md-6">
                <input type="number" id="contact-phone" class="form-control" placeholder="Contact Number*" name="phone"  onkeyup='validatePhone()'> 
                <span class='error-message' id='phone-error'></span>  
              </div>
              <div class="form-group col-md-6">
                <select  class="form-control" name="city" id="" required>
                 <option selected value="Null">City</option>
                 <option value="Pune">Pune</option>
                 <option value="Mumbai">Mumbai</option>
                 <option value="Nashik">Nashik</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <input type="text" class="form-control" name="subj" placeholder="Subject*" required>  
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <textarea class="form-control" id="contact-message" name="message" rows="3" onkeyup='validateMessage()'></textarea>
                <span class='error-message' id='message-error'></span>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12 text-center">
                <button onclick="return validateForm()" class="btn btn-success"><i class="fas fa-paper-plane"></i>  Submit</button>
                <span class='error-message' id='submit-error'></span>
              </div>
            </div>            
          </form>
          <!--END :  FORM  -->
        

        </div>
        <div class="col-md-6 paragraph">
          <h5>Call Us / Whatsapp</h5>
          <p><a href="tel: +919011001190"> <i class="fas fa-phone"></i> +(91) 9011001190</a></p>
         
          <h5>Email / Website</h5>
          <p>
            <a href="mailto:inq.joyfulaging.com"> <i class="fas fa-envelope"></i>joufulaging112@gmail.com</a><br>
            <a href="https://joyfullAging.com"> <i class="fas fa-globe"></i> www.joyfulAging.in </a>
          </p> 

                
        </div>
      </div>
    </div>
  </section>

  <footer>
        <div class="footer-container">
          <div class="footer-column">
            <h3 class="heading">Main Menu</h3>
            <ul class="footer-nav">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="">Population Status Of Older Adults</a></li>
                <li><a href="">Health</a></li>
                <li><a href="lawsandsenior.html">Law And Senior Citizen</a></li>
                <li><a href="">Schemes</a></li>
                <li><a href="">Healthy Ageing</a></li>
              <!-- Add more main menu links as needed -->
            </ul>
          </div>
          <div class="footer-column">
            <h3 class="heading">Quick Links</h3>
            <ul class="footer-nav">
              <li><a href="#">Contact Us</a></li>
              <li><a href="#">FAQ</a></li>
              <li><a href="#">Support</a></li>
              <!-- Add more quick links as needed -->
            </ul>
          </div>
          <div class="footer-column">
            <h3 class="heading">Useful Links</h3>
            <ul class="footer-nav">
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Terms of Service</a></li>
              <li><a href="#">Accessibility</a></li>
              <!-- Add more useful links as needed -->
            </ul>
          </div>
        </div>
      </footer>
    <!--Bottom Footer -->
    <div class="container-fluid bottom-footer pt-2">
      <div class="row">
        <div class="col-12 text-center">
          <p>Copyrigts © 2023 -All Rights Reserved</p>
        </div>
      </div>
    </div>
  </footer>
    <!-- Optional JavaScript -->
    <script src="bootstrap-4.5.2-dist/js/form_valids.js" ></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap-4.5.2-dist\js\jquery-3.5.1.slim.min.js" ></script>
    <script src="bootstrap-4.5.2-dist\js\popper.min.js" ></script>
    <script src="bootstrap-4.5.2-dist\js\bootstrap.min.js" ></script>
    <script>
  function hideAlert() {
    var alertDiv = document.getElementById("success-alert");
    alertDiv.style.display = "none";
  }
</script>
  </body>
</html> 
