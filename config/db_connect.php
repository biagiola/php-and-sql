<?php 
    
    // connect to database -the variable $conn we can use in others files that we want just using include()
    // mysqli_connect(server, user, password, table);
    $conn = mysqli_connect('localhost', 'david', 'holaquetal', 'ninja_pizza');

    // check connection
    if( !$conn ) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

?>