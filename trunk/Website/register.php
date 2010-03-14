<?php include('config/init.php'); ?>
<?php
  //Buffer larger content areas like the main page content
  ob_start();
  
  if (!is_null($_POST['txtStudentNumber'])){
    $personID = $_POST['txtStudentNumber'];
    $forename = $_POST['txtForename'];
    $surname = $_POST['txtSurname'];
    $password = $_POST['txtPassword'];
    $email = $_POST['txtEmail'];
    $student = Student::withParameters($personID, $forename, $surname, $password, $email);
    $student->register(true);
    ?>
    Your account has been registered, you can now proceed to <a href="my-account.php">your account</a>
    <?php
  }else{
    $rawError = "Registration failed, data was not complete";
    include('error.php');  
  }

  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  ob_end_clean();
  $page_title = "Register";
  //Apply the template
  include("master.php");
?>
