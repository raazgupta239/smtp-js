<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $otperr="";
    // $a=$_POST['otp'];
    if($_SESSION['otp']==$_POST['otp']){
        $otperr="";
    }
   else{
       $otperr="opt not matched";
    }
}

?>

</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Enter OTP</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="otp">Enter OTP</label>
                <input type="text" id="otp" name="otp" required>
                <p id="p"><?php echo $otperr ; ?></p>
                
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
    
</body>
</html>

<?php
include ('connect.php');
if(isset($_POST['submit'])){
    if($otperr==""){
            
            $name=$_SESSION['name'];
            $email=$_SESSION['email'];

            //hashing function using md5() function
            $password = md5($_SESSION['pass']);

            //inserting into login table
            $insertq="INSERT INTO Signup (name, email,password) VALUES('$name','$email','$password')";
        
            $result=mysqli_query($connections,$insertq);
            if($result){
            header('location:login.php');
            }
            else {
            echo "Error: " . mysqli_error($connections);
            }
        
        }
    }

?>