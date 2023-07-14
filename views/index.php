<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Form Wizard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="Artem Khlipitko">
<!--        <meta name="csrf-token" content="{{ csrf_token() }}">-->

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="public/fonts/material-design-iconic-font/css/material-design-iconic-font.css">

		<!-- DATE-PICKER -->
		<link rel="stylesheet" href="vendor/date-picker/css/datepicker.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="public/css/style.css">
<!--		<link rel="stylesheet" href="../public/css/style.css">-->

        <!-- Social Media Buttons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
        <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1651.880057711743!2d-118.34499784220355!3d34.101285264132784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bf20e4c82873%3A0x14015754d926dadb!2zNzA2MCBIb2xseXdvb2QgQmx2ZCwgTG9zIEFuZ2VsZXMsIENBIDkwMDI4LCDQodCo0JA!5e0!3m2!1sru!2sua!4v1688976910844!5m2!1sru!2sua" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>


		<div class="wrapper">
            
            <form method="post" action="mvc/input" id="wizard" enctype=multipart/form-data>
                <h2 class="title">To participate in the conference, please fill out the form</h2>
        		<!-- SECTION 1 -->
                <h4></h4>
                <section>
                    <div class="inner">
                        
                    	<!-- First  and last name -->
                    	<div class="form-row form-group">
                    		<div class="form-holder">
                    			<input type="text" class="form-control" name ="firstName"  placeholder="First Name" required>
                                <label id="fname-error" class="error-message" style="display: none;">First name is required</label>
                    		</div>
                    		<div class="form-holder">
                    			<input type="text" class="form-control" name ="lastName" placeholder="Last Name" required>
                                <label id="lname-error" class="error-message" style="display: none;">Last name is required</label>
                    		</div>
                    	</div>

                        <!-- birthday date -->
                        <div class="form-row">
                            <div class="form-holder">
                                <input type="text" class="form-control datepicker-here" name ="birthday" data-language='en' data-date-format="dd - mm - yyyy" id="dp1" placeholder="Date of Birth">
                                <label id="birthday-error" class="error-message" style="display: none;">Birthday date is required</label>
                            </div>
                        </div>

                        <!-- Report subject -->
                        <div class="form-row">
                            <div class="form-holder">
                                <input type="text" class="form-control" name ="report" placeholder="Report subject">
                                <label id="report-error" class="error-message" style="display: none;">Report subject is required</label>
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="form-row">
                            <div class="select">
                                <div class="form-holder">
                                    <select class="select-control" name="country" aria-label="Country">
                                        <option selected>Country</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="France">France</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                    </select>
                                </div>
                                <label id="country-error" class="error-message" style="display: none;">Country is required</label>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="form-row">
                    		<div class="form-holder">
                    			<input type="tel" class="form-control" id="phone" name ="phone" placeholder="Phone"  minlength="9" maxlength = "17">
                                <!-- pattern="\+1\([0-9]{3}\) [0-9]{3}-[0-9]{4}" -->
                    			<i class="zmdi zmdi-smartphone-android"></i>
                                <small>Format: +1 (555) 555 5555</small>
                                <label id="phone-error" class="error-message" style="display: none;">Phone is required</label>
                    		</div>
                    	</div>

                        <!-- Email -->
                        <div class="form-row">
                    		<div class="form-holder">
                    			<input type="text" class="form-control" name = "email" placeholder="Email">
                    			<i class="zmdi zmdi-email small"></i>
                                <label id="email-error" class="error-message" style="display: none;">Email is required</label>
                    		</div>
                    	</div>
                    	
                    </div>
                </section>
                
				<!-- SECTION 2 -->
                <h4></h4>
                <section class="section-2">
                	<div class="inner">
                        <!-- Company -->
                        <div class="form-row">
                    		<div class="form-holder">
                    			<input type="text" class="form-control" name = "сompany" placeholder="Company">
                    		</div>
                    	</div>
                                      
                        <!-- Position -->
                        <div class="form-row">
                            <div class="form-holder">
                                <input type="text" class="form-control" name = "position" placeholder="Position">
                            </div>
                        </div>

                        <!-- About me -->
                        <div class="form-row">
                            <div class="form-holder">
                                <textarea class="txtarea" placeholder="About me" name = "about" rows="4" cols="50" maxlength="170"></textarea>
                            </div>
                        </div>
                     
                        <!-- Avatar -->
                        <div class="form-row">
                    		<div class="form-holder">
                    			<input name="file" type="file" class="form-control" placeholder="Choose a profile picture">
                                <label id="file-error" class="error-message" style="display: none;">Text</label>
                                <div class="ajax-reply"></div>
                    		</div>
                    	</div>
                	</div>
                </section>

                <!-- SECTION 3 -->
                <h4></h4>
                <section class="section-3">
                    <div class="inner">
                        <div class="form-row form-group">
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer.php?u=http://127.0.0.1:5500/index.html&text=Check out this Meetup with SoCal AngularJS!" target="_blank" rel="noopener noreferrer" class="fa fa-facebook fa-3x"> </a>
                            <!-- Twitter -->
                            <a href="https://twitter.com/share?url=http://127.0.0.1:5500/index.html&text=Check out this Meetup with SoCal AngularJS!" target="_blank" rel="noopener noreferrer" class="fa fa-twitter fa-3x"></a>
                        
                        </div>
                        <!-- User counter  -->
                        <?php
                            $conn = mysqli_connect("localhost", "root", "root", "test");;

                            if (!$conn) {
                                die("Ошибка подключения: " . mysqli_connect_error());
                            }

                            $query = "SELECT COUNT(*) as total FROM users";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            $totalRows = $row['total'];
                            ?>
                        <a href="members" class="fa-3x" style="color:green;margin:0 auto;width:100%;text-shadow: 2px 2px #1c87c9" target = "_blank"> All members (<?php echo $totalRows; ?>)</a>

                    </div>
                </section>
            </form>
		</div>

		<script src="public/js/jquery-3.3.1.min.js"></script>
		<script src="https://malsup.github.io/jquery.form.js"></script> 
		<!-- JQUERY STEP -->
		<script src="public/js/jquery.steps.js"></script>

		<!-- DATE-PICKER -->
		<script src="vendor/date-picker/js/datepicker.js"></script>
		<script src="vendor/date-picker/js/datepicker.en.js"></script>

		<script src="public/js/main.js"></script>

</body>
</html>