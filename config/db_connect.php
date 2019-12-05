<?php 
    
    // connect to database
    // mysqli_connect(server, user, password, table);
    $conn = mysqli_connect('localhost', 'david', 'holaquetal', 'ninja_pizza');

    // check connection
    if( !$conn ) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

?>