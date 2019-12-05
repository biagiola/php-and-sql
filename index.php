<?php

    // connect to database
    // mysqli_connect(server, user, password, table);
    $conn = mysqli_connect('localhost', 'david', 'holaquetal', 'ninja_pizza');

    // check connection
    if( !$conn ) {
        echo 'Connection error: ' . mysqli_connect_error();
    } else {

    }

    // write query for all pizzas
    $sql = 'SELECT title, ingredients, id FROM pizzas';

    // make query and get result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC); // MYSQLI_ASSOC means the way that we want the return (as an array)

    print_r($pizzas);


?>
<!DOCTYPE html>
<html>

  <?php include('templates/header.php') ?>
  <?php include('templates/footer.php') ?>
  
</html>
