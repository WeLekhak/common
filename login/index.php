<?php

// INITIALIZE THE SESSION
session_start();


//TURN ON ERRORS IF IS UNDER DEBUGGING
$__showerrors = 1;


//INLCLUDE NECESSARY FILES
require_once("../private/config/db__config.php");
require_once("../private/config/errors__config.php");
require_once("../private/classes/debugManager/class__debugManager.php");
require_once("handleLogin/handleLogin.php");


// CHECK IF THE USER IS ALREADY LOGGED IN, IF YES THEN REDIRECT HIM TO WELCOME PAGE
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: ../?ref=fromLogin&id=1001");
  exit;
}


// DEFINE VARIABLES AND INITIALIZE WITH EMPTY VALUES
$input__mobileno = '';
$input__password = '';


$sqlquery = '';
$__pdo = DatabaseConnection::getPdo();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $loginId = $_POST['mobile'] ?? '';
  $password = $_POST['password'] ?? '';

  $loginResult = UserLogin::login($loginId, $password);

  if (is_array($loginResult) && $loginResult['status'] === 'success') {
    echo "Login successful!";
    echo '<pre>';
    print_r($loginResult['data']);
    echo '</pre>';
  } else {
    echo $loginResult;
  }





  /**
  if (isset($_POST['mobile']) && isset($_POST['password'])) {
  $input__password = $_POST['password'];
  $input__mobileno = $_POST['mobile'];

  $sqlquery =
  'SELECT * FROM lekhak_users
  WHERE
  lekhak_mobile_number = :input_mobileno;';

  $params = [
  ':input_mobileno' => $input__mobileno
  ];

  // Get the number of results
  $result = DatabaseConnection::Query($sqlquery, $params);
  // echo $rowCount = DatabaseConnection::rowCount();
  // Fetch the results

  // Output the results (for demonstration)
  echo('<pre>');
  print_r($result);
  echo('</pre>');


  $hashed_password = $result[0]["lekhak_password"];
  if (password_verify($input__password, $hashed_password)) {
  echo "okok";

  echo($result[0]["lekhak_password"]);
  }

  echo($input__password);
  echo($input__mobileno);
  }
  **/
}


$remark__mobileno_neutral = <<<EOT
<span class="text-xs italic text-gray-400">
Enter Your Mobile No. Here.
</span>
EOT;
$remark__mobileno_notfound = <<<EOT
<span class="text-xs italic text-red-600">
No Lekhak is registered with this Mobile number.
</span>
EOT;



$remark__password_neutral = <<<EOT
<span class="text-xs italic text-gray-400">
Enter Your Password Here.
</span>
EOT;
$remark__password_wrong = <<<EOT
<span class="text-xs italic text-gray-400">
You have entered a wrong password.
</span>
EOT;

?>


<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title></title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://kit.fontawesome.com/1aabf1beac.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Yatra+One&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">

  <style>
    .crimson-text-regular {
      font-family: "Crimson Text", serif;
      font-weight: 400;
      font-style: normal;
    }

    .crimson-text-semibold {
      font-family: "Crimson Text", serif;
      font-weight: 600;
      font-style: normal;
    }

    .crimson-text-bold {
      font-family: "Crimson Text", serif;
      font-weight: 700;
      font-style: normal;
    }

    .crimson-text-regular-italic {
      font-family: "Crimson Text", serif;
      font-weight: 400;
      font-style: italic;
    }

    .crimson-text-semibold-italic {
      font-family: "Crimson Text", serif;
      font-weight: 600;
      font-style: italic;
    }

    .crimson-text-bold-italic {
      font-family: "Crimson Text", serif;
      font-weight: 700;
      font-style: italic;
    }

  </style>

  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="w-full crimson-text-regular">
  <div class="m-4 rounded-xl overflow-hidden border flex min-h-full flex-col justify-center lg:px-8">
    <div class="sm:mx-auto m-0 w-full bg-gray-100 border-b border-coolgray-200 py-12 pt-16 sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
      <h2 class="mt-10 text-center text-3xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
    </div>

    <div class="mt-6 px-6 py-12 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div>
          <label for="mobile" class="block text-m font-medium leading-6 text-gray-900">Mobile number</label>
          <div class="mt-2">
            <input placeholder="+91 0000000000" id="mobile" name="mobile" type="tel" autocomplete="tel" required class="px-3 py-2 outline-none block w-full border-0 py-1.5 text-gray-900 shadow-sm ring-2 ring-inset ring-gray-900 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            <?php
            echo($remark__mobileno_notfound);
            ?>
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-m font-medium leading-6 text-gray-900">Password</label>
            <div class="text-m">
              <a href="../forget-password" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
            </div>
          </div>
          <div class="mt-2">
            <input placeholder="" id="password" name="password" type="password" autocomplete="current-password" required class="px-3 py-2 outline-none block w-full border-0 py-1.5 text-gray-900 shadow-sm ring-2 ring-inset ring-gray-900 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            <?php
            echo($remark__password_neutral);
            ?>
          </div>
        </div>

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-m font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
        </div>
      </form>


      <div class="flex items-center pt-12">
        <div class="flex-1 border-t border-gray-200"></div>
        <span class="px-3 text-sm text-gray-500 bg-white">   Not a member yet   </span>
        <div class="flex-1 border-t border-gray-200"></div>
      </div>
      <div class="flex items-center">
        <a class="font-semibold w-full text-center text-indigo-600 hover:text-indigo-500" href="/SignUp"> Create account now</a>

      </div>
    </div>
    <div class=" w-full mb-16 flex items-center justify-center">

      <button>

      </button>
    </div>
  </div>


</body>
</html>