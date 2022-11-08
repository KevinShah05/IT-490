<?php 
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <title>Registration Page</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--CSS Links-->
  <link rel="stylesheet" href="styleReg.css">

  
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row col-md-12">
            <div class="regForm">
               <h1>Registration Form</h1>
               <form class="" onsubmit="return ValidateRegistration()" action="testRabbitMQRegister.php" method="post">
                <div class="form-group">
                    <label for="First Name"></label>
                    <input id="firstName" type="text" class="form-control" name="firstName" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="Last Name"></label>
                    <input id="lastName" type="text" class="form-control" name="lastName" placeholder="Last Name">
                </div>
                <div class="form-group">
                  <label for="" class="form-label"></label>
                  <input id="email" type="email" class="form-control" name="" id="" aria-describedby="emailHelpId" placeholder="user@mail.com">
                </div>
                <div class="form-group">
                  <label for="User Name"></label>
                  <input id="userName" type="text" class="form-control" name="userName" placeholder="UserName">
              </div>
              <div class="form-group">
                  <label for="height"></label>
                  <input id="height" type="text" class="form-control" name="height" placeholder="Height">
              </div>
              <div class="form-group">
                  <label for="weight"></label>
                  <input id="weight" type="text" class="form-control" name="weight" placeholder="Weight">
              </div>
      
              <!--<h6 class="mb-2 pb-1">Gender: </h6>                             

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender"
                  value="option1" checked />
                <label class="form-check-label" for="femaleGender">Female</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender"
                  value="option2" />
                <label class="form-check-label" for="maleGender">Male</label>
              </div>-->
              <div class="form-group">
                  <label for="Password"></label>
                  <input id="password" type="password" class="form-control" name="Password" placeholder="Password">
              </div>
              <div class="d-grid gap-4">
                <button type="button" value="submit" name="" id="register" class="btn btn-primary">Submit</button>
              </div>
            </div> 
                
               </form>
            </div>
        </div>
    </div>
  
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <!--JS Scripts-->
  <script type="text/javascript" src="scripts.js"></script>
</body>

</html>
