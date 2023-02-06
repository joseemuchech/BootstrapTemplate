<?php

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];

if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password))
{
    $server = "localhost";
    $dbusername = "root";
    $dbpassword ="";
    $dbname = "snippest";

    $conn = new mysqli($server,$dbusername,$dbpassword,$dbname);
    if(mysqli_connect_error())
    {
      die('Connection Error('.mysqli_connect_errno().')'. mysqli_connect_error());    
    }
    else{
        $select = "SELECT email From register WHERE email = '$email' LIMIT 1";
        $result = $conn->query($select);
        if(mysqli_num_rows($result)>0)
        {
            echo '<script>alert("Email already registered!") </script>';
                include 'login.html';
            
        }else{
            $insert = "INSERT INTO register(firstname,lastname,email,password)
             values('$firstname','$lastname','$email','$password')";
             $result = $conn->query($insert);
             if($result>0)
             {
                echo '<script>alert("Successfully registered!") </script>';
                include 'login.html';
              
             }else{
             echo "Something went wrong!";
             }

        }

    }
}
else
{
    echo "All the fields are required";
}

?>