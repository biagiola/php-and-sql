<?php

    // isset() check weather is a certain variable has been set
    // in this case the global variable $_GET
    // the email, title and the ingredients, and the submit button of the form will be store in the $_GET array
    /* if( isset($_GET['submit']) ) {  // the submit is from the ,,name'' of the input tag not the ,,value''  
        echo $_GET['email'];
        echo $_GET['title'];
        echo $_GET['ingredients'];
    } */

    // POST (it is more secure)
    // htmlspecialchars($_POST['email']) is for prevented xss attacks
    if( isset($_POST['submit']) ) {  
        // check if the user enter all the fields (we could do it in the frontend usind requiered property of html5)
        if ( empty( $_POST['email'] ) ) {
            echo 'An email is required <br/>';
        } else {
            $email = $_POST['email'];
            if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {  // if it's not a validate email the condition will be false, but with ! operator it'll become true
                echo 'email must be a valid email address';
            } else {

            }
        }

        // check title
        if ( empty( $_POST['title'] ) ) {
            echo 'An title is required <br/>';
        } else {
            $title =  $_POST['title']; 
            if ( !preg_match( '/^[a-zA-Z\s]+$/', $title ) ) {// all the alphabet, wall spaces and a least one character long
                echo 'Title must be letters and spaces only';
            }
        }

        // check ingredients
        if ( empty( $_POST['ingredients'] ) ) {
            echo 'At leats one ingredient is required <br/>';
        } else {
            $ingredients =  $_POST['ingredients']; 
            if ( !preg_match( '/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients ) ) {
                echo 'ingredients must be a comma separeted space';
            }
        }
        // end of the POST check
    }

?>
<!DOCTYPE html>
<html>

  <?php include('templates/header.php') ?>

  <section class="container grey-text">
    <h4 class="center">Add a Pizza</h4>
    <form class="white" action="add.php" method="POST" >
        <label>Your Email:</label>
        <input type="text" name="email">
        <label>Pizza title:</label>
        <input type="text" name="title">
        <label>Ingredients (comma separedted):</label>
        <input type="text" name="ingredients">
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
  </section>

  <?php include('templates/footer.php') ?>

</html>