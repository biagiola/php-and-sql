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

    include('./config/db_connect.php');

    // we initialize empty and show thus the first time.
    $title = $email = $ingredients = ''; 
    $erros = array('email' => '', 'title' => '', 'ingredients' => '');

    if( isset($_POST['submit']) ) {  
        // check if the user enter all the fields (we could do it in the frontend usind requiered property of html5)
        
        // check if it's empty
        if ( empty( $_POST['email'] ) ) {
            $erros['email'] =  'An email is required <br/>';
        } else {
            // check if it's wrong
            $email = $_POST['email'];
            if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {  // if it's not a validate email the condition will be false, but with ! operator it'll become true
                $erros['email'] =  'email must be a valid email address';
            } 
        }

        // check title
        if ( empty( $_POST['title'] ) ) {
            // check if it's empty
            $erros['title'] = 'An title is required <br/>';
        } else {
            // check if it's wrong
            $title =  $_POST['title']; 
            if ( !preg_match( '/^[a-zA-Z\s]+$/', $title ) ) {// all the alphabet, wall spaces and a least one character long
                $erros['title'] = 'A title must be letters and spaces only';
            }
        }

        // check ingredients
        if ( empty( $_POST['ingredients'] ) ) {
            // check if it's empty
            $erros['ingredients'] = 'At leats one ingredient is required <br/>';
        } else {
            // check if it's wrong
            $ingredients =  $_POST['ingredients']; 
            if ( !preg_match( '/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients ) ) {
                $erros['ingredients'] = 'ingredients must be a comma separeted space';
            }
        }

        // array_filter interates each element of the array with a callback function 
        // in this case we dont define the callback. If all array's elements are empty
        // array_filter will value it as false 
        if ( array_filter( $erros ) ) { 
            // echo 'erros in the form';
        } else {
            
            // evoid sql injections
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

            // create sql
            $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES ('$title', '$email', '$ingredients') ";

            // save to db and check
            if( mysqli_query($conn, $sql) ) {
                // success
                header('Location: index.php'); // we redirect to the index page
            } else {
                // error
                echo 'query error: ' . mysqli_error($conn);
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

    <form class="white" action="add.php" method="POST" ><!-- when we click the submit button or press enter que execute the php code above -->

        <label>Your Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>"> <!--at the beginning $email, $title and $ingredients are empty. That is just when the user enter a wrong value and then he can changed it modifing the olds values insted to write it all again.-->
        <div class="red-text"><?php echo $erros['email'] ?></div><!-- errors array is also empty at the beginning -->
        
        <label>Pizza title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $erros['title'] ?></div>
    
        <label>Ingredients (comma separedted):</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
        <div class="red-text"><?php echo $erros['ingredients'] ?></div>
    
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    
    </form>

  </section>

  <?php include('templates/footer.php') ?>

</html>