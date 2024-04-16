<?php

// Include the database connection script
include('database.php');
include("signup.html");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve and sanitize form inputs
    $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
    $middlename = filter_input(INPUT_POST, "middlename", FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
    $indexnumber = filter_input(INPUT_POST, "indexnumber", FILTER_SANITIZE_SPECIAL_CHARS);
    $birthday = filter_input(INPUT_POST, "birthday");
    $password = $_POST["password"];
    $confirmPassword = $_POST["ConfirmPassword"];
    $telephone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    

    // Validate form inputs
    if (empty($firstname) || empty($lastname) || empty($indexnumber) || empty($birthday) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "Please fill in all required fields!";
    } else {
        $pattern = '/[!@#$%^&*()_+{}\[\]:;<>,.?\/\\|~`\-]/';



        if (preg_match($pattern, $firstname)) {
            echo "First name should not contain special characters!";
        }
         elseif (!empty($middlename) && preg_match($pattern, $middlename)) {
            echo "Middle name should not contain special characters!";
        } 
        elseif (preg_match($pattern, $lastname)) {
            echo "Last name should not contain special characters!";
        } 
        elseif ($password != $confirmPassword) {
            echo "Passwords do not match!";
        }
        else {


            if ($password == $confirmPassword){
                $passwordPattern = '/[!@#$%^&*()_1234567890+{}\[\]:;<>,.?\/\\|~`\-]/';


                if (preg_match($passwordPattern,$password)){
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    $query = "INSERT INTO students (firstname, middlename, lastname, indexnumber, birthday, password, phone, email) 
                    VALUES ('$firstname', '$middlename', '$lastname', '$indexnumber', '$birthday', '$hashedPassword', '$telephone', '$email')";

                    try{
                        $result = pg_query($conn, $query);
                    if ($result) {
                        echo "Account created successfully!";
                        // Optionally redirect the user after successful registration
                        header("Location: homepage.html");
                        // exit();
                    }
                    
                    } 
                    catch(error){
                        echo "Credentials already exit !!! " ;
                           
                }
                
               
            }
        }
    }
}
}
// Close the database connection
pg_close($conn);
?>
