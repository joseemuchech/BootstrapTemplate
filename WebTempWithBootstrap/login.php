<?php   
$email = $_POST['email'];
$password = $_POST['password'];

if(!empty($email) && !empty($password))
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
           $stmt = $conn->prepare("select*from register where email = ?");
           $stmt->bind_param("s",$email);
           $stmt->execute();
           $stmt_result = $stmt->get_result();
           if($stmt_result->num_rows > 0){
                  $data = $stmt_result->fetch_assoc();
                  if($data['password'] === $password){
                         include 'aboutus.html';
                  }else{
                    
                    echo '<script>alert("Invalid Email or Password!") </script>';
                include 'login.html';

                  }

           }else{
            echo "";
            echo '<script>alert("Invalid Email or Password!") </script>';
                include 'login.html';
           }

        }

    }

else
{
    echo "All the fields are required";
}



?>