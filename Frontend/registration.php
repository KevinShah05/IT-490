<?php include('RabbitMQClient.php'); ?>
<!doctype html>
<html lang="en">

<head>
  <title>Registration Page</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!--JS Scripts-->
   <script type="text/javascript" src="scripts.js"></script>
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
               <form onsubmit="return validateRegistration()" method="post" action="registration.php">
                <div class="form-group">
                    <label for="First Name"></label>
                    <input id="firstname" type="text" class="form-control" name="firstname" placeholder="First Name"/>
                </div>
                <div class="form-group">
                    <label for="Last Name"></label>
                    <input id="lastname" type="text" class="form-control" name="lastname" placeholder="Last Name"/>
                </div>
                <div class="form-group">
                  <label for="" class="form-label"></label>
                  <input id="email" type="email" class="form-control" name="email" id="" aria-describedby="emailHelpId" placeholder="user@mail.com"/>
                </div>
                <div class="form-group">
                  <label for="User Name"></label>
                  <input id="username" type="text" class="form-control" name="username" placeholder="UserName"/>
              </div>
              <!--<div class="form-group">
                  <label for="birthdate"></label>
                  <input id="date" type="date" class="form-control" name="birthdate" placeholder="Birthdate"/>
              </div>
              <h6 class="mb-2 pb-1">Gender: </h6>                             
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female"
                  value="female"/>
                <label class="form-check-label" for="femaleGender">Female</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="male"
                  value="male" />
                <label class="form-check-label" for="maleGender">Male</label>
              </div>-->
              <div class="form-group">
                  <label for="Password"></label>
                  <input id="password" type="password" class="form-control" name="password" placeholder="Password"/>
              </div>
              <div class="d-grid gap-4">
                <input type="submit" value="Register" id="register" name="register"/>
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

</body>
</html>
