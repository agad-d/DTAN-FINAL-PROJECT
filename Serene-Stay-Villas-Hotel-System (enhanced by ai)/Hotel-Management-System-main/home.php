<?php

include 'config.php';
session_start();

// page redirect
$usermail="";
$usermail=$_SESSION['usermail'];
if($usermail == true){

}else{
  header("location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin/css/roombook.css">
    <title>Serene Stay Villas</title>
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./css/home.css">
    <style>
      #guestdetailpanel{
        display: none;
      }
      #guestdetailpanel .middle{
        min-height: 450px;
      }
    </style>
</head>

<body>
  <nav>
    <div class="logo">
      <img class="bluebirdlogo" src="./image/bluebirdlogo.png" alt="Serene Stay Villas logo">
      <p>SERENE STAY VILLAS</p>
    </div>
    <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
    <ul id="navList">
      <li><a href="#firstsection" class="nav-link">Home</a></li>
      <li><a href="#aboutsection" class="nav-link">About</a></li>
      <li><a href="#secondsection" class="nav-link">Rooms</a></li>
      <li><a href="#thirdsection" class="nav-link">Facilities</a></li>
      <li><a href="#gallerysection" class="nav-link">Gallery</a></li>
      <li><a href="#contactsection" class="nav-link">Contact</a></li>
      <li><a href="./logout.php"><button class="btn btn-danger navbtn">Logout</button></a></li>
    </ul>
  </nav>

  <section id="firstsection" class="carousel slide carousel_section" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="carousel-image" src="./image/hotel1.jpg">
        </div>
        <div class="carousel-item">
            <img class="carousel-image" src="./image/hotel2.jpg">
        </div>
        <div class="carousel-item">
            <img class="carousel-image" src="./image/hotel3.jpg">
        </div>
        <div class="carousel-item">
            <img class="carousel-image" src="./image/hotel4.jpg">
        </div>

        <div class="welcomeline">
          <span class="hero-eyebrow">Serene Stay Villas &middot; Boutique Hospitality</span>
          <h1 class="welcometag">Welcome to heaven on earth</h1>
          <p class="hero-subtext">A quiet, elegant retreat where every detail is considered &mdash; from sunrise views to warm, personal service.</p>
          <div class="hero-cta-row">
            <button type="button" class="btn-primary-brand" onclick="openbookbox()">Book Now</button>
            <a href="#secondsection" class="btn-secondary-brand">Explore Rooms</a>
          </div>
        </div>

      <!-- bookbox -->
      <div id="guestdetailpanel">
        <form action="" method="POST" class="guestdetailpanelform">
            <div class="head">
                <h3>RESERVATION</h3>
                <i class="fa-solid fa-circle-xmark" onclick="closebox()"></i>
            </div>
            <div class="middle">
                <div class="guestinfo">
                    <h4>Guest information</h4>
                    <label class="field-label" for="res_name">Full name</label>
                    <input id="res_name" type="text" name="Name" placeholder="Enter Full name">
                    <label class="field-label" for="res_email">Email</label>
                    <input id="res_email" type="email" name="Email" placeholder="Enter Email">

                    <?php
                    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                    ?>

                    <label class="field-label" for="res_country">Country</label>
                    <select id="res_country" name="Country" class="selectinput">
						<option value selected >Select your country</option>
                        <?php
							foreach($countries as $key => $value):
							echo '<option value="'.$value.'">'.$value.'</option>';
                            //close your tags!!
							endforeach;
						?>
                    </select>
                    <label class="field-label" for="res_phone">Phone number</label>
                    <input id="res_phone" type="text" name="Phone" placeholder="Enter Phoneno">
                </div>

                <div class="line"></div>

                <div class="reservationinfo">
                    <h4>Reservation information</h4>
                    <label class="field-label" for="res_roomtype">Room type</label>
                    <select id="res_roomtype" name="RoomType" class="selectinput">
						<option value selected >Type Of Room</option>
                        <option value="Superior Room">SUPERIOR ROOM</option>
                        <option value="Deluxe Room">DELUXE ROOM</option>
						<option value="Guest House">GUEST HOUSE</option>
						<option value="Single Room">SINGLE ROOM</option>
                    </select>
                    <label class="field-label" for="res_bed">Bedding type</label>
                    <select id="res_bed" name="Bed" class="selectinput">
						<option value selected >Bedding Type</option>
                        <option value="Single">Single</option>
                        <option value="Double">Double</option>
						<option value="Triple">Triple</option>
                        <option value="Quad">Quad</option>
						<option value="None">None</option>
                    </select>
                    <label class="field-label" for="res_noofroom">No. of rooms</label>
                    <select id="res_noofroom" name="NoofRoom" class="selectinput">
						<option value selected >No of Room</option>
                        <option value="1">1</option>
                        <!-- <option value="1">2</option>
                        <option value="1">3</option> -->
                    </select>
                    <label class="field-label" for="res_meal">Meal plan</label>
                    <select id="res_meal" name="Meal" class="selectinput">
						<option value selected >Meal</option>
                        <option value="Room only">Room only</option>
                        <option value="Breakfast">Breakfast</option>
						<option value="Half Board">Half Board</option>
						<option value="Full Board">Full Board</option>
					</select>
                    <div class="datesection">
                        <span>
                            <label for="cin"> Check-In</label>
                            <input id="cin" name="cin" type ="date">
                        </span>
                        <span>
                            <label for="cout"> Check-Out</label>
                            <input id="cout" name="cout" type ="date">
                        </span>
                    </div>
                </div>
            </div>
            <div class="footer">
                <button class="btn btn-success" name="guestdetailsubmit">Submit</button>
            </div>
        </form>

        <!-- ==== room book php ====-->
        <?php       
            if (isset($_POST['guestdetailsubmit'])) {
                $Name = $_POST['Name'];
                $Email = $_POST['Email'];
                $Country = $_POST['Country'];
                $Phone = $_POST['Phone'];
                $RoomType = $_POST['RoomType'];
                $Bed = $_POST['Bed'];
                $NoofRoom = $_POST['NoofRoom'];
                $Meal = $_POST['Meal'];
                $cin = $_POST['cin'];
                $cout = $_POST['cout'];

                if($Name == "" || $Email == "" || $Country == ""){
                    echo "<script>swal({
                        title: 'Fill the proper details',
                        icon: 'error',
                    });
                    </script>";
                }
                else{
                    $sta = "NotConfirm";
                    $sql = "INSERT INTO roombook(Name,Email,Country,Phone,RoomType,Bed,NoofRoom,Meal,cin,cout,stat,nodays) VALUES ('$Name','$Email','$Country','$Phone','$RoomType','$Bed','$NoofRoom','$Meal','$cin','$cout','$sta',datediff('$cout','$cin'))";
                    $result = mysqli_query($conn, $sql);

                    
                        if ($result) {
                            echo "<script>swal({
                                title: 'Reservation successful',
                                icon: 'success',
                            });
                        </script>";
                        } else {
                            echo "<script>swal({
                                    title: 'Something went wrong',
                                    icon: 'error',
                                });
                        </script>";
                        }
                }
            }
            ?>
          </div>

    </div>
  </section>

  <section id="aboutsection" class="reveal">
    <div class="about-wrap">
      <div class="about-media">
        <img class="about-img-tall" src="./image/hotel3.jpg" alt="Serene Stay Villas courtyard at dusk">
        <img class="about-img-small" src="./image/hotel4.jpg" alt="Serene Stay Villas interior lobby">
      </div>
      <div class="about-content">
        <span class="eyebrow-label">Our story</span>
        <h2>A boutique retreat, run with genuine care</h2>
        <p>Serene Stay Villas began as a single guesthouse with one promise: every guest leaves feeling looked after. That promise still shapes how we run things today &mdash; from the way rooms are prepared to how quickly we answer the phone.</p>
        <p>Set across quiet gardens and courtyards, our villas blend traditional architecture with modern comfort, so you can slow down without giving anything up.</p>
        <div class="about-stats">
          <div class="stat">
            <h3>12+</h3>
            <span>Years hosting guests</span>
          </div>
          <div class="stat">
            <h3>17</h3>
            <span>Rooms &amp; villas</span>
          </div>
          <div class="stat">
            <h3>4.9</h3>
            <span>Average guest rating</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="secondsection" class="reveal">
    <div class="ourroom">
      <h1 class="head">≼ Our room ≽</h1>
      <div class="roomselect">
        <div class="roombox">
          <div class="hotelphoto h1"></div>
          <div class="roomdata">
            <h2>Superior Room</h2>
            <span class="room-tag">Spacious layout &middot; city view</span>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
              <i class="fa-solid fa-spa"></i>
              <i class="fa-solid fa-dumbbell"></i>
              <i class="fa-solid fa-person-swimming"></i>
            </div>
            <div class="room-price"><span>$189</span> / night</div>
            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h2"></div>
          <div class="roomdata">
            <h2>Delux Room</h2>
            <span class="room-tag">Panoramic garden view</span>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
              <i class="fa-solid fa-spa"></i>
              <i class="fa-solid fa-dumbbell"></i>
            </div>
            <div class="room-price"><span>$149</span> / night</div>
            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h3"></div>
          <div class="roomdata">
            <h2>Guest Room</h2>
            <span class="room-tag">Comfortable &amp; bright</span>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
              <i class="fa-solid fa-spa"></i>
            </div>
            <div class="room-price"><span>$119</span> / night</div>
            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h4"></div>
          <div class="roomdata">
            <h2>Single Room</h2>
            <span class="room-tag">Cozy &middot; ideal for solo stays</span>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
            </div>
            <div class="room-price"><span>$79</span> / night</div>
            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="thirdsection" class="reveal">
    <h1 class="head">≼ Facilities ≽</h1>
    <div class="facility">
      <div class="box">
        <h2>Swimming pool</h2>
      </div>
      <div class="box">
        <h2>Spa</h2>
      </div>
      <div class="box">
        <h2>24*7 Restaurants</h2>
      </div>
      <div class="box">
        <h2>24*7 Gym</h2>
      </div>
      <div class="box">
        <h2>Heli service</h2>
      </div>
    </div>
  </section>

  <section id="gallerysection" class="reveal">
    <h1 class="head">≼ Gallery ≽</h1>
    <div class="gallery-grid">
      <figure class="g-wide g-tall">
        <img src="./image/swimingpool.jpg" alt="Infinity pool at sunset">
        <figcaption>Infinity pool</figcaption>
      </figure>
      <figure>
        <img src="./image/spa.jpg" alt="Spa relaxation lounge">
        <figcaption>Spa &amp; wellness</figcaption>
      </figure>
      <figure>
        <img src="./image/food.jpg" alt="Signature dish plated">
        <figcaption>In-house dining</figcaption>
      </figure>
      <figure class="g-tall">
        <img src="./image/gym.jpg" alt="24 hour fitness studio">
        <figcaption>Fitness studio</figcaption>
      </figure>
      <figure>
        <img src="./image/heli.jpg" alt="Private helicopter service">
        <figcaption>Heli service</figcaption>
      </figure>
      <figure class="g-wide">
        <img src="./image/hotel1photo.webp" alt="Superior Room interior">
        <figcaption>Superior Room</figcaption>
      </figure>
      <figure>
        <img src="./image/hotel2photo.jpg" alt="Delux Room interior">
        <figcaption>Delux Room</figcaption>
      </figure>
      <figure>
        <img src="./image/hotel3photo.avif" alt="Guest Room interior">
        <figcaption>Guest Room</figcaption>
      </figure>
    </div>
  </section>

  <section id="contactsection" class="reveal">
    <h1 class="head">≼ Contact us ≽</h1>
    <p class="section-intro">Questions about a stay, a group booking, or just want to say hello? Send a message and we'll get back to you personally &mdash; usually within a day.</p>
    <div class="contact-wrap">
      <div class="contact-cards">
        <a class="contact-card" href="mailto:saiqabaloch79@gmail.com">
          <i class="fa-solid fa-envelope"></i>
          <div>
            <h4>Email</h4>
            <p>saiqabaloch79@gmail.com</p>
          </div>
        </a>
        <a class="contact-card" href="https://www.instagram.com/noont_ed/" target="_blank" rel="noopener">
          <i class="fa-brands fa-instagram"></i>
          <div>
            <h4>Instagram</h4>
            <p>@noont_ed</p>
          </div>
        </a>
        <a class="contact-card" href="https://web.facebook.com/profile.php?id=61578553178817" target="_blank" rel="noopener">
          <i class="fa-brands fa-facebook"></i>
          <div>
            <h4>Facebook</h4>
            <p>Serene Stay Villas</p>
          </div>
        </a>
      </div>

      <form class="contact-form-panel" id="contactForm">
        <div class="contact-form-row">
          <div class="contact-field">
            <label for="c_name">Full name</label>
            <input id="c_name" type="text" placeholder="Your name" required>
          </div>
          <div class="contact-field">
            <label for="c_email">Email</label>
            <input id="c_email" type="email" placeholder="you@email.com" required>
          </div>
        </div>
        <div class="contact-field">
          <label for="c_subject">Subject</label>
          <input id="c_subject" type="text" placeholder="How can we help?">
        </div>
        <div class="contact-field">
          <label for="c_message">Message</label>
          <textarea id="c_message" rows="5" placeholder="Write your message here..." required></textarea>
        </div>
        <button type="submit" class="btn-primary-brand contact-submit">Send message</button>
      </form>
    </div>
  </section>

  <footer id="sitefooter">
    <div class="footer-inner">
      <div class="footer-col footer-brand">
        <div class="footer-logo">
          <img src="./image/bluebirdlogo.png" alt="Serene Stay Villas logo">
          <p>SERENE STAY VILLAS</p>
        </div>
        <p class="footer-tagline">A quiet stay, thoughtfully hosted. Reach out any time &mdash; we reply personally.</p>
      </div>

      <div class="footer-col footer-links">
        <h4>Explore</h4>
        <ul>
          <li><a href="#firstsection">Home</a></li>
          <li><a href="#secondsection">Rooms</a></li>
          <li><a href="#thirdsection">Facilities</a></li>
          <li><a href="#contactsection">Contact</a></li>
        </ul>
      </div>

      <div class="footer-col footer-contact">
        <h4>Contact us</h4>
        <a class="contact-line" href="mailto:saiqabaloch79@gmail.com">
          <i class="fa-solid fa-envelope"></i> saiqabaloch79@gmail.com
        </a>
        <div class="social">
          <a href="https://www.instagram.com/noont_ed/" target="_blank" rel="noopener" aria-label="Instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a href="https://web.facebook.com/profile.php?id=61578553178817" target="_blank" rel="noopener" aria-label="Facebook">
            <i class="fa-brands fa-facebook"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?php echo date("Y"); ?> Serene Stay Villas. All rights reserved.</p>
      <p class="createdby">Created by @iqra</p>
    </div>
  </footer>
</body>

<script>

    var bookbox = document.getElementById("guestdetailpanel");

    openbookbox = () =>{
      bookbox.style.display = "flex";
    }
    closebox = () =>{
      bookbox.style.display = "none";
    }

    // ---- mobile nav toggle ----
    const navToggle = document.getElementById('navToggle');
    const navList = document.getElementById('navList');
    if (navToggle && navList) {
      navToggle.addEventListener('click', () => {
        const isOpen = navList.classList.toggle('nav-open');
        navToggle.classList.toggle('open', isOpen);
        navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      });
      navList.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', () => {
          navList.classList.remove('nav-open');
          navToggle.classList.remove('open');
          navToggle.setAttribute('aria-expanded', 'false');
        });
      });
    }

    // ---- scroll reveal ----
    const revealEls = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && revealEls.length) {
      const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            revealObserver.unobserve(entry.target);
          }
        });
      }, { threshold: 0.12 });
      revealEls.forEach(el => revealObserver.observe(el));
    } else {
      revealEls.forEach(el => el.classList.add('is-visible'));
    }

    // ---- scrollspy active nav link ----
    const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
    const spySections = Array.from(navLinks)
      .map(link => document.querySelector(link.getAttribute('href')))
      .filter(Boolean);
    if ('IntersectionObserver' in window && spySections.length) {
      const spyObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const id = '#' + entry.target.id;
            navLinks.forEach(link => {
              link.classList.toggle('active-link', link.getAttribute('href') === id);
            });
          }
        });
      }, { rootMargin: '-45% 0px -50% 0px', threshold: 0 });
      spySections.forEach(sec => spyObserver.observe(sec));
    }

    // ---- contact form (no backend yet: opens the visitor's email client, pre-filled) ----
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
      contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = document.getElementById('c_name').value.trim();
        const email = document.getElementById('c_email').value.trim();
        const subject = document.getElementById('c_subject').value.trim() || 'Website enquiry';
        const message = document.getElementById('c_message').value.trim();

        if (!name || !email || !message) {
          if (window.swal) {
            swal({ title: 'Please fill in your name, email, and message.', icon: 'warning' });
          }
          return;
        }

        const body = `Name: ${name}\nEmail: ${email}\n\n${message}`;
        const mailto = `mailto:saiqabaloch79@gmail.com?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
        window.location.href = mailto;
      });
    }
</script>
</html>