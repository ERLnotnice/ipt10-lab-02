<?php

require "helpers/helper-functions.php";

session_start();


$email = $_POST['email'];
$password = $_POST['password'];
$hashedPassword = sha1($password);
$agree = $_POST['agree'];


$_SESSION['email'] = $email;
$_SESSION['password'] = $hashedPassword;
$_SESSION['agree'] = $agree;

$form_data = $_SESSION;


$csvFile = 'registration.csv';


$stream = fopen($csvFile, 'a');

if ($stream !== false) {
    if (fputcsv($stream, $form_data)) {
        echo "Registration data saved successfully!";
    } else {
        echo "Error writing to the CSV file.";
    }
    fclose($stream);
} else {
    echo "Error opening the CSV file.";
}


// dump_session();

session_destroy();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>
    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />   
</head>
<body>

<section class="p-section--hero">
  <div class="row--50-50-on-large">
    <div class="col">
      <div class="p-section--shallow">
        <h1>
          Thank You Page
        </h1>
      </div>
      <div class="p-section--shallow">
      
        <table aria-label="Session Data">
            <thead>
                <tr>
                    <th></th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($form_data as $key => $val):
            ?>
                <tr>
                    <th><?php echo $key; ?></th>
                    <td>
                      <?php echo $val; ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
            
        </table>
    
      </div>
    </div>
  </div>
</section>

</body>
</html>