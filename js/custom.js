

function manageCart(pid,type) {
    if (type=='update') {
        var qty=jQuery("#"+pid+"qty").val();    
    }else{
        var qty=jQuery("#qty").val();
    }
    jQuery.ajax({
url:"manage_cart.php",
type:"post",
data:"pid="+pid+"&qty="+qty+"&type="+type,
success:function(result) {
     jQuery(".htc__qua").html(result);
     if (type=='delete' || type=='update'){
        window.location.href=window.location.href;
        
     }
    }

    });

}


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
                window.location.href= window.location.href;
                
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