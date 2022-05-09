var isValidName = false;
var isValidEmail = false;
var isValidPassword = false;
var isValidConfirmPassword = false;

$("#first_name, #last_name, #designation, #organization").blur(function () {
    var name = this.value;
    var nameRule = /^[\w\s._-]+$/i; /*/^[A-Za-z]+[-\s, ]?[A-Za-z]+$/;   /^[\w\s.-]+$/i*/
    if (nameRule.test(name)){
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
        isValidName = true;
    }
    else{
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        isValidName = false;
    }
});

$("#email").blur(function () {
    var email = this.value;
    var eamilRule = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    if (eamilRule.test(email)){
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
        isValidEmail = true;
    }
    else{
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        isValidEmail = false;
    }
});

$("#password").blur(function () {
    var password = this.value;
    console.log(password);
    var passwordRule = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
    if(passwordRule.test(password)){
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
        isValidPassword = true;
    }
    else{
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        isValidPassword = false;
    }
});


$("#confirm_password").blur(function () {
    var confirm_password = this.value;
    var password = $("#password").val(); /* get password field value */
    if(confirm_password){
        if(confirm_password === password){
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
        else{
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        }
    }
});

function isSubmitFrom(){
    if(isValidName && isValidEmail && isValidPassword) {
        return true; // if all validation criteria successfully full filed
    }
    else{
        return false; // otherwise it will prevent from to be submitted
    }
}

// called when we will submit any from with id #registrationFrom,
$('#registrationFrom').submit(function (){
   var isSubmit = isSubmitFrom();
   //alert(isSubmit);
   return isSubmit;
});