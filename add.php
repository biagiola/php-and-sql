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
    if( isset($_POST['submit']) ) {  
        // htmlspecialchars is for prevented xss attacks
        echo htmlspecialchars( $_POST['email'] );
        echo htmlspecialchars( $_POST['title'] );
        echo htmlspecialchars( $_POST['ingredients'] );
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