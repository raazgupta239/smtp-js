<?php
include('connect.php');
if($_SERVER["REQUEST_METHOD"]=='POST'){
    $error="";
$email=$_POST['email'];
$pas=md5($_POST['password']);

$loginq="SELECT * FROM Signup where email='$email' and password='$pas'";
$result=mysqli_query($connections,$loginq);
$logincount=mysqli_num_rows($result);
if($logincount!=1){
    $error="incorrect credentials";
}

}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <h2>Login</h2>
        <form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <p><?php echo $error ; ?> </p>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php
if($error==""){
if(isset($_POST['submit'])){
    $insertq="INSERT INTO Login (email,password) values ('$email','$pas')";
    $result1=mysqli_query($connections,$insertq);
    if($result1){
        header('location:home.php');
    }
    
}
}

?>

