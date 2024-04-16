<?php
    include('database.php');
    include('login.html');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    
        // Retrieve username and password from the form
        $indexnumber = filter_input(INPUT_POST, "indexnumber", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = $_POST['password'];

    
      // if (empty($indexnumber) || empty($password)){
        //    echo "Indexnumber and password are required.";
       //}
       if(!(empty($indexnumber)) || !(empty($password))){

             // Query to fetch user from the database
        $query = "SELECT * FROM registration WHERE indexnumber = '$indexnumber' ";

        // Execute the query
        $result = pg_query($conn, $query);

        if (!$result) {
            echo "<p> Create Account !!! </p>"; 
            header("Location: login.php");
        }
        else{
             // Check if user exists
            if (pg_num_rows($result) == 1) {
                $row = pg_fetch_assoc($result);
                $hashedPasswordFromDatabase = $row['password'];
                if (password_verify($password, $hashedPasswordFromDatabase)) {
                    echo "Authentication successful!";
                    header("Location: homepage.html");
                    exit(); 
                } else {
                    echo "Invalid index number or password. Please try again.";
                }
                
            } 
            else {
                // Authentication failed
                echo "Invalid indexnumber or password. Please try again.";
                echo "<p> Create Account !!! </p>"; 
            }
    
           
            
        }

       }
       

       

        

       
        }
            

        // Close database connection
        pg_close($conn);


?>
