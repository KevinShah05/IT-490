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

/*function bmiCalc(){
    //var feet = document.getElementById(heightft).value;
    var inch = document.getElementById('height').value;

    //var inches = feet/12 + inch;
    var cm = inch * 2.54;

    var weight = document.getElementById('weight').value;
    var kg = weight/2.2046;
    var BMI = (kg/cm/cm) * 10000;
    var display = document.getElementById("disBMI");
    var retBMR = BMI;
    display.innerHTML = '<div class="container"><h4 class="text-center form-control my-3 text-danger fs-4">Your BMI">'+Math.ceil(BMI)+'</span></h4></div>';
    document.getElementById('disBMI').innerText= retBMR;
    console.log(BMI);
    
    return BMI;
    
}


function BMRcalculator(){

  var age = document.getElementById("age").value;
  var age = document.getElementById("height").value;
  var age = document.getElementById("weight").value;
  var age = document.getElementById("gender").value;

  kg = weight * 0.45359237;
  cm = height * 2.54;
  BMR = null;


    if (gender = "male")
    {
      BMR = 10 * kg + 6.25 * cm - 5 * age + 5;
    }
    else if (gender == "female")
    {
      BMR = 10 * kg + 6.25 * cm - 5 * age - 161;
    }
    
    return BMR;

}*/

//Fridge Search
/*function getsource(id){
    $.ajax({
        url:"https://api.spoonacular.com/recipes/"+id+"/information?apiKey=22cd95b6f2msh56aa4218766ee17p1c066ejsn53b34fba64ac",
        success: function(res){
            document.getElementById("sourceLink").innerHTML=res.sourceUrl
            document.getElementById("sourceLink").href=res.sourceUrl
        }
    })
}

function getrecipe(q){
    $.ajax({
        url:"https://api.spoonacular.com/recipes/search?apiKey=22cd95b6f2msh56aa4218766ee17p1c066ejsn53b34fba64ac&number1&query="+q,
        success: function(res){
            document.getElementById("output").innerHTML="<h1>"+res.results[0].title+"</h1><br><img src='"+res.baseUri+res.results[0].image+"'width='400' /><br> ready in"+res.results[0].readyInMinutes+" minutes"
            getsource(res.results[0].id)
        }
    })
}*/