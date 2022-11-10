//Validate Login Form
function validateLogin(){

    var userName = document.getElementById("username").value;
    var passWord = document.getElementById("password").value;

    var userNamec = userName.trim();
    var passWordc = passWord.trim();

    if(userNamec != "" && passWordc != ""){
        sendLogCreds(userNamec, passWordc); 
    }
    else{
        if(userNamec == ""){
            turnFieldToRedColorBorder(userNamec);
        }
        if(passWordc == ""){
            turnFieldToRedColorBorder(passWordc);
        }
        if (userNamec == "" && passWordc == ""){
            turnFieldToRedColorBorder(userNamec);
            turnFieldToRedColorBorder(passWordc);
        }        
    }

}

//Create New User Button
function createNewUsr(){
    document.getElementById("createNew").onclick;
    location.href = "registration.php";
}

//Send Login Credentials
function sendLogCreds(username, password){
    
    var httpReq = createRequestObject();
    httpReq.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            document.getElementById("login").innerHTML = "Login";
            
            if(this.responseText == true){
                window.location = "../HTML-CSSJS/landing.html";
            }else{
                window.location = "login.html";
            }
            
        }else{
            document.getElementById("login").innerHTML = "Loading...";
        }
    }
    httpReq.open("GET", "../PHP/switchCase.php?type=Login&username=" + username + "&password=" + password);
    httpReq.send(null);
}

function ValidateRegistration(){
    
    //Form input
    var firstname = document.getElementById("firstname").value;
    var lastname = document.getElementById("lastname").value;
    var email = document.getElementById("email").value;
    var username = document.getElementById("username").value;
    var height = document.getElementById("height").value;
    var weight = document.getElementById("weight").value;
    var password = document.getElementById("password").value;
    
    //Cleaning input
    var firstnamec = firstname.trim();
    var lastnamec = lastname.trim();
    var emailc = email.trim();
    var usernamec = username.trim();
    var heightc = height.trim();
    var weightc = weight.trim();
    var passwordc = password.trim();
    
    
    if (firstname != "" && lastname != "" && username != "" && email != "" && password != "" && height != "" && weight != ""){
        sendRegCreds(firstname, lastname, email, username, height, weight, password);
    }else{
        alert("Missing Fields: Try Again");
    }

}

//Sends a AJAX request to register new user
function sendRegCreds(firstname, lastname, email, username, height, weight, password){
    
    var httpReq = createRequestObject();
    httpReq.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            document.getElementById("register").innerHTML = "Register";
            if(this.responseText == true){
                alert("User Registered");
            }else{
                alert("Error Occured: Try Again");
            }
        }else{
            document.getElementById("register").innerHTML = "Loading...";
        }
    }
    httpReq.open("GET", "../PHP/switchCase.php?type=RegisterUser&username=" + username + "&password=" + password + "&firstname=" + firstname + "&lastname=" + lastname + "&email=" + email + "$height" + height + "$weight" + weight);
    httpReq.send(null);
}

//Check for existing user
function ExistingUsername(){
    
    var username = document.getElementById("username").value;
    var usernamec = username.trim();
    
    var httpReq = createRequestObject();
    httpReq.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            if(this.responseText == false){
                alert("Username Already Exists");
            }else{
                alert("You can register");
            }
            
        }
    }
    httpReq.open("GET", "../PHP/switchCase.php?type=UsernameVerification&username=" + username);
    httpReq.send(null);
}

//Check for existing email
function ExistingEmail(){
    
    var email = document.getElementById("email").value;
    var emailc = email.trim();
    
    alert(email);
    
    var httpReq = createRequestObject();
    httpReq.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            if(this.responseText == false){
                alert("Email Already Exists");
            }else{
                alert("Email can be registered");
            }
            
        }
    }
    httpReq.open("GET", "../PHP/switchCase.php?type=EmailVerification&email=" + email);
    httpReq.send(null);
}



