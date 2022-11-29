//Validate Login Form
function validateLogin(){
    var username = document.getElementById("username").value;
        if(username == ""){
            alert("Username is required");
            return false;
        }
    var password = document.getElementById("password").value;
        if(password == ""){
            alert("Password is required");
            return false;
        }
}

//Create New User Button
function createNewUsr(){
    document.getElementById("createNew").onclick;
    location.href = "registration.php";
}

//Validate Registration Form
function validateRegistration(){
    var firstname = document.getElementById("firstname").value;
        if(firstname == ""){
            alert("First-Name is required");
            return false;
        }
    var lastname = document.getElementById("lastname").value;
        if(lastname == ""){
            alert("Last-Name is required");
            return false;
        }
    var email = document.getElementById("email").value;
    var emailRegEx = new RegExp(/^[a-zA-Z0-9]*@[a-zA-Z]*.[a-zA-Z]{2,5}$/);
        if(email==""){
            alert("Email is required");
            return false;
        }
        else if(!emailRegEx.test(email)){
            alert("Your email must be in the format user@domainname.domain. (EX. user@aol.com)");
            return false;
        }
    var username = document.getElementById("username").value;
        if(username== ""){
            alert("Username is required");
            return false;
        }
    /*var birthday = document.getElementById("date").value;
        if(birthday == ""){
            alert("Your date of birth is required");
            return false;
        }*/
    var gender = document.getElementsByName("gender");
        if(!gender[0].checked && !gender[1].checked){
            alert("Gender Slection is required");
            return false;
        }
    var password = document.getElementById("password").value;
    var regEx = new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,10}$/);
        if(password==""){
            alert("Password is required");
            return false;
        }
        if(!regEx.test(password)){
            alert("Password must contain at least one upper-case, one number and one special character. (MAX of 10 characters)");
            return false;
        }
}

/*var minimumAge = 18;
function setAge(){
    birthdate = new Date(document.getElementById("date").value);
    var today = new Date();
    var differ = Math.abs(today.getTime() - date.getTime());
    var age = Math.ceil(differ / (1000*3600*24)) / 365;
    var differ = (givendate.getFullYear()-birthdate.getFullYear());
    return age;
}

function getAge(){
    var age = setAge();
    if(age<minimumAge){
        alert("You must be at least 18 years of age to create an account!");
        return false;
    }
}*/
