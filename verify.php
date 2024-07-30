<?php
session_start();
$response="";
// Include database connection file
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
   // 1. Sanitize user input (code)
   $code = $_POST['code'];
   $email=$_SESSION['email'];

         // 5. Check if the user exists in the `users` table
         $sql = "SELECT id FROM users WHERE email = ?";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("s", $email);
         $stmt->execute();
         $user_result = $stmt->get_result();
            
                  if ($user_result->num_rows == 0) {
                    // 4. If the code is valid, update the user's status to verified
                    $sql = "insert into users(email,password) values(?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $email,$code);
                    $stmt->execute();
                    if($stmt==true)
                    {
                      $response=1;
                    }
                    else
                    {
                      $response=2;
                    }
                  } 
                  else {
                      $response=1;
                  }
                  echo $response;
            
                  $stmt->close();
                  $conn->close();                
              
            }
        

            ?>