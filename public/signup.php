<?php
include ('connect.php');
$name=$email=$pass=$cpass="";
$nameerr=$emailerr=$passerr=$cpasserr=$err="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST['name'])){
        $nameerr="Username cannot be empty!";
    }
    else{
        if(!preg_match('/^[a-zA-Z0-9_-]{3,16}$/',$_POST['name'])){
        $nameerr="Name format should be matched";
        }
        
    }
    if(empty($_POST['email'])){
        $emailerr="Email cannot be empty!";
    }
    else{
        if(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',$_POST['email'])){
        $emailerr="Email format should be matched";
        }
        
    }
    if(empty($_POST['pass'])){
        $passerr="Password cannot be empty!";
    }
    else{
        if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ,$_POST['pass'])){
        $passerr="Password format should be matched";
        }
        
    }   
        if($_POST['pass']!=$_POST['cpass']){
        $cpasserr="Password and confirm password doesnot match";
    }
    $email=$_POST['email'];
    $emailq= "SELECT * FROM Signup WHERE email='$email'";

    $result=mysqli_query($connections,$emailq);

    $emailcount=mysqli_num_rows($result);
    if($emailcount>0){
        $err="email already exists.. please login";
    }
    
}



?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
        <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
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
        <h2>Sign Up</h2>
        <form id="signup-form" action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="name" >
                <p><?php echo $nameerr?></p>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" >
                <p><?php echo $emailerr?></p>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="pass" >
                <p><?php echo $passerr?></p>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="cpass" >
                <p><?php echo $cpasserr ;?></p>
                <p><?php echo $err ;?></p>
            </div>
            <button type="submit"name="submit" >Sign Up</button>
        </form>
    </div>
   
</body>
</html>

<?php
   if($nameerr=="" && $emailerr=="" &&$passerr=="" && $cpasserr==""&& $err==""){
       if(isset($_POST['submit'])){
           session_start();
        $name=$_POST['name'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        
        $_SESSION['name']=$_POST['name'];
        $_SESSION['email']=$_POST['email'];
        $_SESSION['pass']=$_POST['pass'];
        
        

        $randomnum=rand(0000,9999); 
        $_SESSION['otp']= $randomnum;
        
        ?>

<script src="https://smtpjs.com/v3/smtp.js"></script>
<script defer >
  
   const randomnum= <?php echo json_encode($randomnum) ;?> ;

   const email ='<?php echo $email ;?>' ;
    
   const name ='<?php echo $name ;?>' ;
        
            Email.send({
                Host : "smtp.elasticemail.com",
                Username : "raazgupta958@gmail.com",
                Password: "CB7BBF9F2A65D14A9F2D15D1EF11A4237522",
                To: email,
                From: "raazgupta958@gmail.com",
                Subject: "Hey "+name+" !!!",
                Body: "Your otp is "+randomnum+" Don't share it with anyone"
            }).then(()=> {
                window.location.href="otp.php";
})
    
</script>
<?php
       }
    }
    ?>