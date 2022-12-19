<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbConnection.php');

//function that logs in user
function doLogin($username, $password){
  $conn = dbConnection();
  $query = "select password from users where username = '$username';";
  $response = $conn->query($query);
  $Array = $response -> fetch_assoc();
  $hashpass = $Array["password"];
  if ($response->num_rows == 1){
    if(password_verify($password, $hashpass))
    {
      echo "\n Password correct";
      return true;
    }
    else
    {
      echo "\n Password incorrect";
      return false;
    }
  echo "/n Login Successful";
  return true;
  }
  else
  {
    echo "/n Login information incorrect";
    return false;
  }
}

//Function that registers new users
function doRegister($username, $password, $firstname, $lastname, $email)
{
  $conn = dbConnection();
  $conn2 = dbConnection2();
  $password = password_hash($password, PASSWORD_DEFAULT);

  $query = "SELECT * FROM `users` WHERE username='$username'";
  $result = $conn->query($query);
  if ($result->num_rows == 1) 
  {
    echo "\n***Username already in use***";
    return false;
  }
   	
  $insert = "INSERT INTO `users` (username, password, firstname, lastname, email) 
  			  VALUES('$username', '$password', '$firstname', '$lastname', '$email')";
    
  if ($conn->query($insert)) 
  {
    echo "\n***New record created successfully***";
  } 
  else 
  {
    echo "\n Error for main: " . $insert . "<br>" . $conn->error;
	  return false; 
  }

  if ($conn2->query($insert)) 
  {
    echo "\n***New backup created successfully***";
  } 
  else 
  {
    echo "\n Error for backup: " . $insert . "<br>" . $conn2->error;
    return false; 
  }
  initializeHealthInfo($username);
  echo "Successfully initialized health info";
  return true;
}

//function that calculates BMI
function BMIcalculator($height, $weight)
{
  $BMI = $weight / pow($height, 2) * 703;

  echo "\n BMI calculated successfully";
  return $BMI;
}

//function that calculates BMR
function BMRcalculator($age, $height, $weight, $gender)
{
  $kg = $weight * 0.45359237;
  $cm = $height * 2.54;
  $BMR = null;
  
  
    if ($gender = "male")
    {
      $BMR = 10 * $kg + 6.25 * $cm - 5 * $age + 5;  
    }
    else if ($gender == "female")
    {
      $BMR = 10 * $kg + 6.25 * $cm - 5 * $age - 161;
    }
    echo "\n BMR calculated successfully";
    return $BMR;
  
}
function initializeHealthInfo($username)
{
  $age = NULL;
  $heightInch = NULL;
  $weightPounds = NULL;
  $goal = NULL;
  $activity = NULL;
  $gender = NULL;
  $BMI = NULL;
  $BMR = NULL;
  
  $conn = dbConnection();
  $insert = "INSERT INTO `health` (username, age, heightInch, weightPounds, goal, activity, gender, BMI, BMR)
  VALUES ('$username', '$age', '$heightInch', '$weightPounds', '$goal', '$activity', '$gender', '$BMI', '$BMR')";
  if ($conn->query($insert)) 
  {
    echo "\n***New record created successfully***";
  } 
  else 
  {
    echo "\n Error for main: " . $insert . "<br>" . $conn->error;
    return false; 
  }
  return true;
}

//function to add Health information into database
function updateHealthInfo($username, $age, $heightInch, $weightPounds, $goal, $activity, $gender)
{
  $BMI = BMIcalculator($heightInch, $weightPounds);
  $BMR = BMRcalculator($age, $heightInch, $weightPounds, $gender);
  
  $conn = dbConnection();
  $conn2 = dbConnection2();
  $insert = "UPDATE `health` SET username = '$username', age = '$age', heightInch = '$heightInch', weightPounds = '$weightPounds',
  goal = '$goal', activity = '$activity', gender = '$gender', BMI = $BMI, BMR = $BMR WHERE username = '$username'";

  if ($conn->query($insert)) 
  {
    echo "\n***User health updated successfully***";
  } 
  else 
  {
    echo "\n Error for main: " . $insert . "<br>" . $conn->error;
    return false; 
  }

  if ($conn2->query($insert)) 
  {
    echo "\n***New backup health updated successfully***";
  } 
  else 
  {
    echo "\n Error for backup: " . $insert . "<br>" . $conn2->error;
    return false; 
  }

  
  return true;
}

//function to display BMR
function displayBMR($username)
{

  $conn = dbConnection();
  

  $query = "SELECT * FROM `health` WHERE username = '$username'";

  $response = $conn->query($query);
  $data = [];
  while ($r = $response->fetch_assoc())
  {
    $BMR = $r["BMR"];
  };
  $data = array("BMR"=>$BMR);
  echo "\n BMR updated";
  return json_encode($data);
}

//function to addPreference
function addPreference($username, $cuisine, $diet, $restriction)
{
  $conn = dbConnection();
  $conn2 = dbConnection2();
  
  
  $insert = "INSERT INTO `perferences` (username, cuisine, diet, restriction) 
  VALUES('$username', '$cuisine', '$diet', '$restriction')";
  
  if ($conn->query($insert)) 
  {
    echo "\n***Preferences created successfully***";
  } 
  else 
  {
    echo "\n Error for main: " . $insert . "<br>" . $conn->error;
    return false; 
  }

  if ($conn2->query($insert)) 
  {
    echo "\n***Preferences backup created successfully***";
  } 
  else 
  {
    echo "\n Error for backup: " . $insert . "<br>" . $conn2->error;
    return false; 
  }

  return true;

}

//function search food based on recommendations
function doFood($username, $search)
{
  $conn = dbConnection();
  
  $query = "SELECT cuisine FROM `perferences` WHERE username = '$username'";
  $response = $conn->query($query);
  $a = $response->fetch_assoc();
  $cuisine = $a["cuisine"];

  $query = "SELECT diet FROM `perferences` WHERE username = '$username'";
  $response = $conn->query($query);
  $b = $response->fetch_assoc();
  $diet = $b["diet"];

  $query = "SELECT restriction FROM `perferences` WHERE username = '$username'";
  $response = $conn->query($query);
  $c = $response->fetch_assoc();
  $restriction = $c["restriction"];

  $query = "SELECT BMR FROM `health` WHERE username = '$username'";
  $response = $conn->query($query);
  $d = $response->fetch_assoc();
  $calories = $d["BMR"];


	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/complexSearch?query=$search&cuisine=$cuisine&diet=$diet&excludeIngredients=$restriction&minCalories=0&maxCalories=$calories&limitLicense=false&offset=0&number=10",
		CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
      "X-RapidAPI-Host: spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
      "X-RapidAPI-Key: 22cd95b6f2msh56aa4218766ee17p1c066ejsn53b34fba64ac"
    ],
  ]);

	echo "<pre>";
	echo curl_exec($curl);
	echo "</pre>";
                  
	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} 
	else {
  $json= json_decode($response); 
	
	echo "<br>";
  }

	$result = "";
  

	for($i=0;$i<10;$i++){
   

		$result .= "<br>Recipe: ";
		$result .= $json->results[$i]->title;	
    $result .= "<br>Nutrients: ";
		$result .= "<br>";
		$result .= "<br>";
	}
  
      echo "\n\n\t***Show Profile***\n\n";
      return json_encode($result);
}

//function to take user input of ingredients
function whatsinyourfridge($username, $ingredient1, $ingredient2, $ingredient3, $ingredient4, $ingredient5)
{
  $curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/findByIngredients?ingredients=$ingredient1%2C$ingredient2%2C$ingredient3%2C$ingredient4%2C$ingredient5&ranking=1&ignorePantry=false&number=10",
		CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
      "X-RapidAPI-Host: spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
      "X-RapidAPI-Key: 22cd95b6f2msh56aa4218766ee17p1c066ejsn53b34fba64ac"
    ],
  ]);

	echo "<pre>";
	echo curl_exec($curl);
	echo "</pre>";
                  
	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} 
	else {
  $json= json_decode($response); 
	echo "<br>";
  }

	$result = "";

	for($i=0;$i<10;$i++){
		$result .= "<br>Recipe: ";
		$result .= $json[$i]->title;
    $result .= "<br>Used Ingredients: ";
    $result .= $json[$i]->usedIngredientCount;
    $result .= "<br>Image: ";
    $result .= $json[$i]->image;
		$result .= "<br>";
		$result .= "<br>";
	}

      echo "\n\n\t***Show Profile***\n\n";
      return json_encode($result);

}

?>