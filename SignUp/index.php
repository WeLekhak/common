<?php

// INITIALIZE THE SESSION
session_start();


//TURN ON ERRORS IF IS UNDER DEBUGGING
$__showerrors = 1;


//INLCLUDE NECESSARY FILES
require_once("../private/config/db__config.php");
require_once("../private/config/errors__config.php");
require_once("../private/classes/debugManager/class__debugManager.php");
require_once("../private/classes/sessionManager/class__sessionManager.php");
require_once("../private/classes/Validator.php");

// DEFINE VARIABLES AND INITIALIZE WITH EMPTY VALUES
$input__firstname = '';
$input__lastname = '';
$input__mobile = '';
$input__email = '';
$input__password = '';
$input__passwordconfirmation = '';
$input__marketingaccept = '';
if (isset($_POST["input_marketingaccept"])) {
  if ($_POST["input_marketingaccept"] === "on") {
    $input_valid_marketingaccept = 1;
  }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (
    isset($_POST["input_firstname"]) &&
    isset($_POST["input_lastname"]) &&
    isset($_POST["input_mobile"]) &&
    isset($_POST["input_email"]) &&
    isset($_POST["input_password"]) &&
    isset($_POST["input_passwordconfirmation"])
    //isset($_POST["input_marketingaccept"])
  ) {

    //STORE THE INPUT IN VARIABLES
    $input__firstname = $_POST["input_firstname"];
    $input__lastname = $_POST["input_lastname"];
    $input__mobile = $_POST["input_mobile"];
    $input__email = $_POST["input_email"];
    $input__password = $_POST["input_password"];
    $input__passwordconfirmation = $_POST["input_passwordconfirmation"];
    $input__marketingaccept = $_POST["input_marketingaccept"];

    //VALIDATE INPUTS
    $input_valid_firstname = Validator::validateFirstName($input__firstname);
    $input_valid_lasttname = Validator::validateLastName($input__lastname);
    $input_valid_mobile = Validator::validateMobile($input__mobile);
    $input_valid_email = Validator::validateEmail($input__email);
    $input_valid_password = Validator::validatePassword($input__password);
    $input_valid_passwordconfirmation = Validator::validatePassword($input__passwordconfirmation);
    echo 'okok';
    if (
      $input_valid_firstname['success'] &&
      $input_valid_lasttname['success'] &&
      $input_valid_mobile['success'] &&
      $input_valid_email['success'] &&
      $input_valid_password['success'] &&
      $input_valid_passwordconfirmation['success']
    ) {
      echo("All Ok");
    } else {

      $remark_invalid_input_firstname = $input_valid_firstname['message'];
      $remark_invalid_input_lastname = $input_valid_lasttname['message'];
      $remark_invalid_input_mobile = $input_valid_mobile['message'];
      $remark_invalid_input_email = $input_valid_email['message'];
      $remark_invalid_input_password = $input_valid_password['message'];
      $remark_invalid_input_passwordconfirmation = $input_valid_passwordconfirmation['message'];


      if (isset($remark_invalid_input_firstname)) {
        $remark_invalid_input_firstname =
        '
        <span class="text-xs italic text-red-600">'.
        $remark_invalid_input_firstname.
        '</span>
        ';
      }else {
        $remark_invalid_input_firstname = '';
      }
      
      if (isset($remark_invalid_input_lastname)) {
        $remark_invalid_input_lastname =
        '
        <span class="text-xs italic text-red-600">'.
        $remark_invalid_input_lastname.
        '</span>
        ';
      }else {
        $remark_invalid_input_lastname = '';
      }
      
      if (isset($remark_invalid_input_mobile)) {
        $remark_invalid_input_mobile =
        '
        <span class="text-xs italic text-red-600">'.
        $remark_invalid_input_mobile.
        '</span>
        ';
      }else {
        $remark_invalid_input_mobile = '';
      }
      
      if (isset($remark_invalid_input_email)) {
        $remark_invalid_input_email =
        '
        <span class="text-xs italic text-red-600">'.
        $remark_invalid_input_email.
        '</span>
        ';
      }else {
        $remark_invalid_input_email = '';
      }
      
      if (isset($remark_invalid_input_password)) {
        $remark_invalid_input_password =
        '
        <span class="text-xs italic text-red-600">'.
        $remark_invalid_input_password.
        '</span>
        ';
      }else {
        $remark_invalid_input_password = '';
      }
      
      if (isset($remark_invalid_input_passwordconfirmation)) {
        $remark_invalid_input_passwordconfirmation =
        '
        <span class="text-xs italic text-red-600">'.
        $remark_invalid_input_passwordconfirmation.
        '</span>
        ';
      }else {
        $remark_invalid_input_passwordconfirmation = '';
      }
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Lekhak.in • Sign Up • Create Accoun</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">


  <style type="text/css" media="all">
    * {
      font-family: "Crimson Text", serif;
      font-weight: 400;
      font-style: normal;
    }
    .form-inputs {
      @apply h-10 mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm
    }
  </style>
</head>
<body>
  <!--
                          Heads up! 👋

                          Plugins:
                            - @tailwindcss/forms
                      -->

  <section class="bg-white">
    <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
      <aside class="relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6">
        <img
        alt=""
        src="https://images.unsplash.com/photo-1605106702734-205df224ecce?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
        class="absolute inset-0 h-full w-full object-cover"
        />
      </aside>

      <main
        class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6"
        >
        <div class="max-w-xl lg:max-w-3xl">
          <!--
                                                                                                    <a class="block text-blue-600" href="#">
                                                                                                      <span class="sr-only">Home</span>
                                                                                                      <svg
                                                                                                        class="h-8 sm:h-10"
                                                                                                        viewBox="0 0 28 24"
                                                                                                        fill="none"
                                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                                        >
                                                                                                        <path
                                                                                                          d="M0.41 10.3847C1.14777 7.4194 2.85643 4.7861 5.2639 2.90424C7.6714 1.02234 10.6393 0 13.695 0C16.7507 0 19.7186 1.02234 22.1261 2.90424C24.5336 4.7861 26.2422 7.4194 26.98 10.3847H25.78C23.7557 10.3549 21.7729 10.9599 20.11 12.1147C20.014 12.1842 19.9138 12.2477 19.81 12.3047H19.67C19.5662 12.2477 19.466 12.1842 19.37 12.1147C17.6924 10.9866 15.7166 10.3841 13.695 10.3841C11.6734 10.3841 9.6976 10.9866 8.02 12.1147C7.924 12.1842 7.8238 12.2477 7.72 12.3047H7.58C7.4762 12.2477 7.376 12.1842 7.28 12.1147C5.6171 10.9599 3.6343 10.3549 1.61 10.3847H0.41ZM23.62 16.6547C24.236 16.175 24.9995 15.924 25.78 15.9447H27.39V12.7347H25.78C24.4052 12.7181 23.0619 13.146 21.95 13.9547C21.3243 14.416 20.5674 14.6649 19.79 14.6649C19.0126 14.6649 18.2557 14.416 17.63 13.9547C16.4899 13.1611 15.1341 12.7356 13.745 12.7356C12.3559 12.7356 11.0001 13.1611 9.86 13.9547C9.2343 14.416 8.4774 14.6649 7.7 14.6649C6.9226 14.6649 6.1657 14.416 5.54 13.9547C4.4144 13.1356 3.0518 12.7072 1.66 12.7347H0V15.9447H1.61C2.39051 15.924 3.154 16.175 3.77 16.6547C4.908 17.4489 6.2623 17.8747 7.65 17.8747C9.0377 17.8747 10.392 17.4489 11.53 16.6547C12.1468 16.1765 12.9097 15.9257 13.69 15.9447C14.4708 15.9223 15.2348 16.1735 15.85 16.6547C16.9901 17.4484 18.3459 17.8738 19.735 17.8738C21.1241 17.8738 22.4799 17.4484 23.62 16.6547ZM23.62 22.3947C24.236 21.915 24.9995 21.664 25.78 21.6847H27.39V18.4747H25.78C24.4052 18.4581 23.0619 18.886 21.95 19.6947C21.3243 20.156 20.5674 20.4049 19.79 20.4049C19.0126 20.4049 18.2557 20.156 17.63 19.6947C16.4899 18.9011 15.1341 18.4757 13.745 18.4757C12.3559 18.4757 11.0001 18.9011 9.86 19.6947C9.2343 20.156 8.4774 20.4049 7.7 20.4049C6.9226 20.4049 6.1657 20.156 5.54 19.6947C4.4144 18.8757 3.0518 18.4472 1.66 18.4747H0V21.6847H1.61C2.39051 21.664 3.154 21.915 3.77 22.3947C4.908 23.1889 6.2623 23.6147 7.65 23.6147C9.0377 23.6147 10.392 23.1889 11.53 22.3947C12.1468 21.9165 12.9097 21.6657 13.69 21.6847C14.4708 21.6623 15.2348 21.9135 15.85 22.3947C16.9901 23.1884 18.3459 23.6138 19.735 23.6138C21.1241 23.6138 22.4799 23.1884 23.62 22.3947Z"
                                                                                                          fill="currentColor"
                                                                                                          />
                                                                                                      </svg>
                                                                                                    </a>
                                                                                          -->
          <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">

            <br />

            लेखक.इन मध्ये आपले स्वागत  !!
          </h1>

          <p class="mt-4 leading-relaxed text-gray-500">
            Lekhak.in हे मराठी साहित्यासाठी तुमचे जाण्याचे व्यासपीठ आहे, जिथे लेखक आणि वाचक कथा, कविता आणि बरेच काही यांच्याद्वारे एकमेकांशी जोडले जातात. मराठी लेखनाचा समृद्ध वारसा जाणून घेण्यासाठी आणि शेअर करण्यासाठी आमच्यात सामील व्हा.
          </p>

          <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" class="mt-8 grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
              <label for="FirstName" class="block text-sm font-medium text-gray-700">
                First Name
              </label>

              <input
              required
              type="text"
              id="FirstName"
              name="input_firstname"
              class="px-4 h-10 border-2 mt-1 w-full border-gray-200 bg-white text-sm text-gray-700 shadow-sm
              focus:border-gray-500 outline-none"
              />
              <?php
              echo $remark_invalid_input_firstname;
              ?>


            </div>


            <div class="col-span-6 sm:col-span-3">
              <label for="LastName" class="block text-sm font-medium text-gray-700">
                Last Name
              </label>

              <input
              required
              type="text"
              id="LastName"
              name="input_lastname"
              class="px-4 h-10 border-2 mt-1 w-full border-gray-200 bg-white text-sm text-gray-700 shadow-sm
              focus:border-gray-500 outline-none"
              />
                            <?php
              echo $remark_invalid_input_lastname;
              ?>
            </div>

            <div class="col-span-6">
              <label for="Mobile" class="block text-sm font-medium text-gray-700"> Mobile </label>

              <input
              required
              type="tel"
              autocomplete="tel"
              min="10"
              max="10"
              id="Mobile"
              name="input_mobile"
              placeholder="+91 0000000000"
              class="px-4 h-10 border-2 mt-1 w-full border-gray-200 bg-white text-sm text-gray-700 shadow-sm
              focus:border-gray-500 outline-none"
              />
                            <?php
              echo $remark_invalid_input_mobile;
              ?>
            </div>

            <div class="col-span-6">
              <label for="Email" class="block text-sm font-medium text-gray-700"> Email </label>

              <input
              required
              autocomplete="email"
              type="email"
              id="Email"
              name="input_email"
              class="px-4 h-10 border-2 mt-1 w-full border-gray-200 bg-white text-sm text-gray-700 shadow-sm
              focus:border-gray-500 outline-none"
              />
                            <?php
              echo $remark_invalid_input_email;
              ?>
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label for="Password" class="block text-sm font-medium text-gray-700"> Password </label>

              <input
              required
              type="password"
              id="Password"
              name="input_password"
              class="px-4 h-10 border-2 mt-1 w-full border-gray-200 bg-white text-sm text-gray-700 shadow-sm
              focus:border-gray-500 outline-none"
              />
                            <?php
              echo $remark_invalid_input_password;
              ?>
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label for="PasswordConfirmation" class="block text-sm font-medium text-gray-700">
                Password Confirmation
              </label>

              <input
              required
              type="password"
              id="PasswordConfirmation"
              name="input_passwordconfirmation"
              class="px-4 h-10 border-2 mt-1 w-full border-gray-200 bg-white text-sm text-gray-700 shadow-sm
              focus:border-gray-500 outline-none"
              />
                            <?php
              echo $remark_invalid_input_passwordconfirmation;
              ?>
            </div>

            <div class="col-span-6">
              <label for="MarketingAccept" class="flex gap-4">
                <input
                checked
                type="checkbox"
                id="MarketingAccept"
                name="input_marketingaccept"
                class="size-5 border-gray-200 bg-white shadow-sm"
                />

                <span class="text-sm text-gray-700">
                  I want to receive emails about events, product updates and company announcements.
                </span>
              </label>
            </div>

            <div class="col-span-6">
              <p class="text-sm text-gray-500">
                By creating an account, you agree to our
                <a href="#" class="text-gray-700 underline"> terms and conditions </a>
                and
                <a href="#" class="text-gray-700 underline">privacy policy</a>.
              </p>
            </div>

            <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
              <input

              type="submit"
              value="Create an account"
              class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
              >



              <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                Already have an account?
                <a href="../Login" class="text-gray-700 underline">Log in</a>.
              </p>
            </div>
          </form>
        </div>
      </main>
    </div>
  </section>
</body>
</html>