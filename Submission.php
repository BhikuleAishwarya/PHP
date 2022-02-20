<html>
<body>
Animal Name <?php echo $_POST["a_name"]; ?><br>

Category <?PHP echo $_POST["category"]; ?><br>

Life expectancy <?php echo $_POST['life']; ?> <br>

Description: <?php echo $_POST["d_name"]; ?><br>

<?php
if(isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['Tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.',$fileName);

    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png');
    if (in_array($fileActualExt, $allowed)) {
       if ($fileError === 0) {
           if ($fileSize < 4000) {
              $fileNameNew = uniqid('', true).".".$fileActualExt;
              $fileDestination =  'uploads/'.$fileNameNew;

              move_uploaded_file($fileTmpName, $fileDestination);
              header("Location: demo.php?upload Success");

           } else {
               echo"Your file is big!";
           }
       }else{
        echo"There was an error uploading your file! ";

    }
    }else{
        echo"You cannot upload files of this type!";

    }


}

?>
<?php

error_reporting(0);

?>

<?php
    
// Checking valid form is submitted or not
if (isset($_POST['submit_btn'])) {
      
    // Storing name in $name variable
    $name = $_POST['name'];
    
    // Storing google recaptcha response
    // in $recaptcha variable
    $recaptcha = $_POST['g-recaptcha-response'];
  
    // Put secret key here, which we get
    // from google console
    $secret_key = '6LdX5Y0eAAAAAGQaelBEFm1AqwYHauZ0YOazGUOv';
  
    // Hitting request to the URL, Google will
    // respond with success or error scenario
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
          . $secret_key . '&response=' . $recaptcha;
  
    // Making request to verify captcha
    $response = file_get_contents($url);
  
    // Response return by google is in
    // JSON format, so we have to parse
    // that json
    $response = json_decode($response);
  
    // Checking, if response is true or not
    if ($response->success = true) {
        echo '<script>alert("Google reCAPTACHA verified")</script>';
    } else {
        echo '<script>alert("Error in Google reCAPTACHA")</script>';
    }
}
  
?>


</body>
</html>