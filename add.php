<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Your page title here :)</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">

<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
  <script>
  tinymce.init({
    selector: '#PContent',
    theme: 'modern',
    height: 300,
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
 
  });
  </script>


  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">


</head>
<body onload="myUploadFunction()">
  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row">
      <div class="one-half column" style="margin-top: 2%">


      <?php

 require 'connect.php';

        // STEP 0. Are we getting form submission or should we show the form's field for filling?
         if(isset($_POST['add'])) {
           // STEP 1. Get the connection
           
            
            // STEP 2. Validate user's input
 $PTitle = $_POST['PTitle'];
           $PType = $_POST['PType'];
           $POrder = $_POST['POrder'];
           $PContent = $_POST['PContent'];
           $PDisplay = $_POST['PDisplay'];
         
            
            // STEP 3. Properly encode user input for SQL
            
            
            // STEP 4. Construct the SQL query


$sql = "INSERT INTO Pages ( PTitle,  PType,  POrder, PContent, PDisplay)
VALUES ('".$_POST["PTitle"]."','".$_POST["PType"]."','".$_POST["POrder"]."','".$_POST["PContent"]."','".$_POST["PDisplay"]."')";


            
            //$retval = mysql_query( $sql, $mysqli ); // procedural version
            $retval = $mysqli->query($sql);
            
            // STEP 5. Execute the SQL query
            if(! $retval ) {
                // STEP 5.1 Deal with insuccess
               die('Could not enter data: ' . $mysqli->error);
            }
            
            // STEP 5.2 Deal with success
            echo "Entered data successfully\n";
            
            // STEP 6. We're done, close the connection
            //mysqli_close($mysqli);
            $mysqli->close();
         }else {
            ?>
            

<form method = "post" action = "adm.php">
  <fieldset>
    <legend>Create A Page</legend>
    Title: <input type="text" name="PTitle">
    Page Type: <select name="PType">
  <option value="Home">Home</option>  
  <option value="Event">Event</option>
  <option value="Vehicle">Vehicle</option>
  <option value="Testimonial">Testimonial</option>
  <option value="Special">Special</option>
  <option value="About">About</option>
  <option value="Quote">Quote</option>
</select> Page Order: <input type="text" name="POrder"> 
  <textarea id="PContent">Please enter text and images only. Images will automatically be formatted based on the number of images included.

</textarea>  
<br>
    <select name="PDisplay">
  <option value="False">Hide</option>  
  <option value="True">Show</option>
</select><input type="submit" name="add" id="add" value="Save">
  </fieldset>
Upload New Image:
<input type="file" id="myFile" multiple size="50" onchange="myUploadFunction()">


<p id="demo"></p>
    
<script>
function myUploadFunction(){
    var x = document.getElementById("myFile");
    var txt = "";
    if ('files' in x) {
        if (x.files.length == 0) {
            txt = "Select one or more files.";
        } else {
            for (var i = 0; i < x.files.length; i++) {
                txt += "<br><strong>" + (i+1) + ". file</strong><br>";
                var file = x.files[i];
                if ('name' in file) {
                    txt += "name: " + file.name + "<br>";
                }
                if ('size' in file) {
                    txt += "size: " + file.size + " bytes <br>";
                }
            }
        }
    } 
    else {
        if (x.value == "") {
            txt += "Select one or more files.";
        } else {
            txt += "The files property is not supported by your browser!";
            txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead. 
        }
    }
    document.getElementById("demo").innerHTML = txt;
}
</script>

<p><strong>Tip:</strong> Use the Control or the Shift key to select multiple files.</p>

Set Page Image:
Image: <input type="text" name="ImageLink">

</form></div>



<div class="one-half column" style="margin-top: 2%">test

<?php


$sqli = "SELECT ID, PTitle, PType FROM Pages";
$resulti = $mysqli->query($sqli);

if ($resulti->num_rows > 0) {
    // output data of each row
    while($row = $resulti->fetch_assoc()) {
        echo "id: " . $row["ID"]. " - Name: " . $row["PTitle"]. " " . $row["PType"]. "<br>";
    }
} else {
    echo "0 results";
}



?>

</div>



     <?php
         }
      ?>
   
      


    </div>
  </div>
<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
