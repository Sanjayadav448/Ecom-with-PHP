<?php

require('header.php');


?>
<style>

.popup-overlay {
  /*Hides pop-up when there is no "active" class*/
  visibility: hidden;
  position: absolute;
  background: #ffffff;
  border: 3px solid #666666;
  width: 50%;
  height: 50%;
  left: 25%;
}

.popup-overlay.active {
  /*displays pop-up when "active" class is present*/
  visibility: visible;
  text-align: center;
}

.popup-content {
  /*Hides pop-up content when there is no "active" class */
  visibility: hidden;
}

.popup-content.active {
  /*Shows pop-up content when "active" class is present */
  visibility: visible;
}

	</style>

<div class="popup-overlay">
  <!--Creates the popup content-->
  <div class="popup-content">
    <h2>Pop-Up</h2>
    <p> This is an example pop-up that you can make using jQuery.</p>
    <!--popup's close button-->
    <button class="close">Close</button> </div>
</div>

    <script src="js/main.js"></script>
       
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Login</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Login</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="contact-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="email" name="email" class="email" id="email_error" placeholder="Your Email*" style="width:100%">
											<!-- <span class="field_errror" id="email_error"> </span> -->
										</div>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="password" class="password" id="password_error" placeholder="Your Password*" style="width:100%">
											<!-- <span class="field_errror" id="password_error"> </span> -->
										</div>
									</div>
									
									<div class="contact-btn">
										<button type="submit" onclick="loginUser()" name="login" class="fv-btn">Login</button>
									</div>
                                    <span class="err_login"></span>

								</form>
								<span id="error_msg"></span>
							</div>
						</div> 
                
				</div>
				

					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Register</h2>
								</div>
                                <span class="success-msg"></span>
							</div>
							<div class="col-xs-12">
								<form class="contact-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
										</div>
                                        <span class="field_errror" id="name_error"> </span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="email" name="email" id="email" placeholder="Your Email*" style="width:100%">
                                           
                                        </div>
                                        <span class="field_errror email_err" id="email_error" ></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="tel" name="name" id="mobile" placeholder="Your Mobile*" style="width:100%">
										</div>
                                        <span class="field_errror" id="mobile_error"> </span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="name" id="password" placeholder="Your Password*" style="width:100%">
										</div>
                                        <span class="field_errror pass_err" id="password_error"> </span>
									</div>
									
									<div class="contact-btn">
										<button type="button" class="fv-btn" id="btn" onclick="userRegistration()">Register</button>
									</div>
								</form>
							</div>
						</div> 
                
				</div>
					
            </div>
        </section>

		<script>


function loginUser() {

	var email=jQuery(".email").val();
	var password=jQuery(".password").val();
	var is_error="";
	if(email==''){
		jQuery("#email_error").css("border", "#f70505 solid 3px");
    is_error='yes';	
}
if (password=="") {
	jQuery("#password_error").css("border", "#f70505 solid 3px");
    is_error='yes';	
	}
if (is_error=="") {
    jQuery.ajax({
        url:"login_user.php",
        method:"post",
        data:"email="+email+"&password="+password,
        success:function(result) {
            console.log(result);
            if (result=="wrong") {
                jQuery(".err_login").html("Please Enter Correct detail!").css("color", "#f70505");      
                
            }if (result=="correct") {
                window.location.href= "index.php";
                
            }
        }
    }
    );
}

}


function userRegistration() {
	
	
    jQuery(".field_errror").html('');
    var name=jQuery("#name").val();
    var email=jQuery("#email").val();
    var mobile=jQuery("#mobile").val();
    var password=jQuery("#password").val();
    var is_error="";
if (name=="") {
    jQuery("#name_error").html('Please Enter Name').css("color", "#f70505");
    is_error='yes';
    
}
if (email=="") {
    jQuery(".email_err").html("Please Enter Email").css("color", "#f70505");
    is_error='yes';
}
if (mobile=="") {
    $("#mobile_error").html('Please Enter Mobile').css("color", "#f70505");
    is_error='yes';
}
if(password==""){
    $(".pass_err").html("Please Enter Password").css("color", "#f70505");
    is_error='yes';}

if(is_error==""){   
jQuery.ajax({
url:"register_user.php",
type:"post",
data:"name="+name+"&email="+email+"&mobile="+mobile+"&password="+password,
success:function(result) {
    if (result=="present") {
     jQuery(".email_err").html("Email already registered!").css("color", "#f70505");
    }if (result=="wrong") {
	alert('Registered Successfully!!');
    jQuery("#mobile").val('');
    jQuery("#password").val('');
    jQuery("#name").val('');
    jQuery("#email").val('');}    
}



    });

}

}
		</script>
        <!-- End Contact Area -->
        <!-- End Banner Area -->
       <?php
       require("footer.php");       ?>