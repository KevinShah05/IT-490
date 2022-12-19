<?php session_start(); 
include('RabbitMQClient.php'); 
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.72.0">
  <title>yFoods User Dashboard</title>

  <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/dashboard/">

  <!--CSS Links-->
  <link rel="stylesheet" href="styleLanding.css">
  <!--JavaScript-->
  <script type="text/javascript" src="scripts.js"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
    integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
    crossorigin="anonymous"></script>

</head>
<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><?php echo $_SESSION['firstname']?></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
      data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 id="navWelcome" class="form-control form-control-dark w-100 bg-dark">yFoods User Dashboard</h1>
    <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Yfoods User Dashboard" aria-label="Search">-->
    <ul class="nav-item dropdown col-md-3 col-lg-2 mr-0 px-3">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php echo $_SESSION['username'];?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="logout.php?logout=true">Logout</a>
        </div>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md- col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="modal" data-target="#bmiForm">
                  BMI & Calorie Calculator
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="modal" data-target="#food-prefs">
                Food Prefrences
              </a>
            </li>
            <!--<li class="nav-item">
              <a class="nav-link" href="#">
                Log Foods
              </a>
            </li>-->
            <li class="nav-item">
              <a class="nav-link" href="#fridgeForm">
                Whats in your Fridge?
              </a>
            </li>
          </ul>
        </div>
</div>
  </div>
      </nav>

      <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="row">
          <div class="col-sm-3 d-flex align-items-stretch">
            <div class="flip-card text-white bg-danger mb-3" id="bmiCard">
              <div class="flip-card-inner">
                <div class="flip-card-front text-white bg-danger mb-3">
                <h5 class="card-title">Making Progress</h5>
                  <p class="card-text"> 
                    <!--<span style="font-size: large; font-weight:bold;">Making Progress</span>--><br>
                    <span style="font-size: medium; font-weight:bold;">Update your Health Info</span>
                  </p>
                </div>
                <div class="flip-card-back bg-danger">
                  <img class="card-img" src="Images/progress.jpg" alt="progessImg">
                  <div class="card-img-overlay">
                    <h5 style="color: black;">Made Some Progress?</h5> <br><br>
                    <p class="card-text">
                    <!--<form id="form1" name="updateBMR" method="POST">-->
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#bmiForm">Veiw Your Stats!"</button>
                    <!--</form>-->
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="col-sm-9 d-flex align-items-stretch">
          <div class="flip-card text-white bg-danger mb-3 w-100" id="foodP">
            <div class="flip-card-inner">
            <div class="flip-card-front text-white bg-danger mb-3">
              <h5 class="card-title">Food Preferences</h5>
                <p class="card-text">
                  Favorite Cuisines:<span class="dietDis"><?php echo $_SESSION['foodpref'];?></span><br>
                  Dietary Restrictions/Allergies:<span class="dietDis"><?php echo $_SESSION['diet-type'];?></span><br>
                  Diet Type:<span class="dietDis"><?php echo $_SESSION['restrictions'];?></span><br>
                </p>
            </div>
            <div class="flip-card-back bg-danger">
                  <div class="card-body">
                    <h5 style="color: black;">Want to try something new?</h5> <br><br>
                    <p class="card-text">
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#food-prefs">Update Your Preferences!</button>
                    </p>
                  </div>
                </div>
          </div>
        </div>
      </div>
      
        <!--<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="col-md-3">
              <div id="bmiCard" class="card text-white bg-danger mb-3" style="width: 18rem">
              <div class="card-header">
                BMI & Daily Calories
              </div>
                <div class="card-body text-center">
                   <p class="card-text">
                    BMI: <br>
                    Daily Calories: <br>
                  </p>
                </div>
              </div>
            </div>
          </div>-->

          <form id="searchFood" method="POST" action="landing.php">
            <input class="form-control form-control-dark w-100" type="text" name="searchRecipe" placeholder="Search Foods Here"/>
            <input id="searchFood" name="searchFood" type="submit" class="btn btn-info right" value="Search Recipes!"/>
          </form>
        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
          
        <h2>Whats in your Fridge?</h2>
        <div id=fridgeForm>
        <div class="col-sm-12 d-flex align-items-stretch">
          <form class="col-sm-12 d-flex flex-column" id="fridge" name="fridge" method="post" action="landing.php">
            <label>
              Ingredients<br>
              <textarea id="ingredientArea" name="ingredient" placeholder="Enter first ingredient"></textarea>
              <textarea id="ingredientArea" name="ingredient1" placeholder="Enter second ingredient"></textarea>
              <textarea id="ingredientArea" name="ingredient2" placeholder="Enter third ingredient"></textarea>
              <textarea id="ingredientArea" name="ingredient3" placeholder="Enter four ingredient"></textarea>
              <textarea id="ingredientArea" name="ingredient4" placeholder="Enter fifth ingredient"></textarea>
            </label><br>
            <input id="fridgeBTN" name="fridgesearch" class="btn btn-info right" type="submit" value="Search Recipes"/>
            <!--<div id="frigeOutput"></div>
            <a href="" id="sourceLink"></a>-->
          </form>
        </div>
      </div>
    </main>
    
   
  

  <!--BMI Modal Form-->
<div class="modal fade" id="bmiForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <form id="BMIForm" class="calculateBMI" method="post" action="landing.php">
        <div class="card bg-dark text-white mb-3">
          <h4 class="text-center text-danger card-header mb-4">BMI & Calorie Calculator</h4>
            <div class="card-body">
              <div class="row g-5">
                <div class="col-sm-3">
                  <div>
                      <h5>Age</h5>
                      <input class="form-control text-end" name="age" required="" type="number" placeholder="Age" />
                  </div>
                </div>
                <div class="col-sm-3">
                    <div>
                        <h5>Height</h5>
                        <div class="d-flex align-items-center">
                            <input class="form-control text-end" id="height" name="height" required="" type="number" placeholder="" />
                            <span class="btn ms-1 bg-warning text-nowrap">Inches</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div>
                        <h5>Weight</h5>
                        <div class="d-flex align-items-center">
                            <input class="form-control text-end" id="weightlb" name="weight" required="" type="number" placeholder="" />
                            <span class="btn ms-1 bg-warning text-nowrap">lbs</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div>
                        <h5>Gender</h5>
                        <div class="form-control">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <input checked="" id="gender_male" name="gender" required="" type="radio" value="0" />
                                    <label class="ms-2">Male</label>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <input id="gender_female" name="gender" required="" type="radio" value="1" />
                                    <label class="ms-2">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                    <div>
                        <h5>Goals</h5>
                        <select class="form-select" name="goals" required="">
                            <option selected="" value="1">Select your Goals!</option>
                            <option value="0">Lose Weight</option>
                            <option value="1">Maintain Weight</option>
                            <option value="2">Gain Weight</option>
                        </select>
                    </div>
                    <div>
                      <h5>Activity Level</h5>
                      <select class="form-select" name="activity" required="">
                          <option selected="" value="1">Basal Metabolic Rate (BMR)</option>
                          <option value="1.2">Sedentary: Little to no exercise/desk job</option>
                          <option value="1.375">Light: Exercise 1-3 times/week</option>
                          <option value="1.55">Moderate: Exercise 4-5 times/week</option>
                          <option value="1.725">Very Active: intense exercise 6-7 times/week</option>
                          <option value="1.9">Extra Active: very intense exercise daily, or physical job</option>
                      </select>
                    </div>                   
                </div>            
              </div>
              <div>
                <div class="modal-footer d-flex justify-content-center">
                  <input class="btn btn-success" name="bmiform" id="submit" type="submit" value="Calculate"/>
                </div>
              </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--END BMI Modal Form-->

<!--Food Prefrences Modal Form-->
<div class="modal fade" id="food-prefs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <form id="food-prefs" method="post" action="landing.php">
        <div class="card bg-dark text-white mb-3">
          <h4 class="text-center text-danger card-header mb-4">Set Your Food Prefrences</h4>
            <div id="cuisines" class="card-body">
            <h3>
              Favorite Cuisines <br>
              <small class="text-muted">(Choose at least one!)</small>
            </h3>
              <div class="mb-3">
                <select class="form-select form-select-lg" name="foodpref" id="">
                  <option selected>Select Your Favorite Cuisine</option>
                  <option value="american">American</option>
                  <option value="indian">Indian</option>
                  <option value="korean">Korean</option>
                  <option value="chinese">Chinese</option>
                  <option value="italian">Italian</option>
                  <option value="french">French</option>
                  <option value="japanese">Japanese</option>
                  <option value="thai">Thai</option>
                </select>
              </div>
          </div>
          <!------------------------------------------------------------------------------------------------------------------------>
          <br>
          <div id="diet-type" class="card-body">
            <h3>
              Diet Type <br>
              <small class="text-muted">(Choose only one!)</small>
            </h3>
            <div class="mb-3">
              <select class="form-select form-select-lg" name="diet-type" id="">
                <option selected>Set Your Diet Type</option>
                <option value="vegetarian">Vegetarian</option>
                <option value="vegan">Vegan</option>
                <option value="ketogenic">Keto</option>
                <option value="primal">Primal</option>
                <option value="paleo">Paleo</option>
              </select>
            </div>             
          </div>
          <!------------------------------------------------------------------------------------------------------------------------>
          <br>
          <div id="restrictions" class="card-body">
            <h3>
              Dietary Restrictions/Allergies <br>
              <small class="text-muted">Optional</small>
            </h3>
            <div class="mb-3">
              <select class="form-select form-select-lg" name="restrictions" id="">
                <option selected>Select Any Restrictions/Allergies</option>
                <option value="wheat">Wheat</option>
                <option value="dairy">Dairy</option>
                <option value="egg">Eggs</option>
                <option value="peanuts">Peanuts</option>
                <option value="tree nut">Tree Nuts</option>
                <option value="seafood">Seafood</option>
                <option value="shellfish">Shellfish</option>
                <option value="soy">Soy</option>
              </select>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <input class="btn btn-success" name="foodPrefs" id="submit" type="submit" value="Set Preferences"/>
              <!--<i class="fas fa-calculator me-3"></i>-->
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!--END Food Preferences Form-->


<!--SCRIPTS-->
  <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-DBjhmceckmzwrnMMrjI7BvG2FmRuxQVaTfFYHgfnrdfqMhxKt445b7j3KBQLolRl"
    crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js"
    integrity="sha384-EbSscX4STvYAC/DxHse8z5gEDaNiKAIGW+EpfzYTfQrgIlHywXXrM9SUIZ0BlyfF"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
    integrity="sha384-i+dHPTzZw7YVZOx9lbH5l6lP74sLRtMtwN2XjVqjf3uAGAREAF4LMIUDTWEVs4LI"
    crossorigin="anonymous"></script>
  <script src="dashboard.js"></script>
</body>

</html>