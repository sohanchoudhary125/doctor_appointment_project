<?php
session_start();
if (isset($_POST['submit'])) {

  $conn = mysqli_connect('remotemysql.com', '2v6B9Eu4Wc', '926XBu3pHs', '2v6B9Eu4Wc');
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $user = stripcslashes($user);
  $pass = stripcslashes($pass);
  $_SESSION['user'] = $_POST['user'];
  $_SESSION['pass'] = $_POST['pass'];
  $query = "SELECT pass from patient where username = '$user' and pass = '$pass' ";
  $query_run = mysqli_query($conn, $query);
  if (mysqli_num_rows($query_run) == 1) {
    header('Location:nextpage.php');
  }

  mysqli_close($conn);
}
if (isset($_POST['submitnow'])) {
  $conn = mysqli_connect('remotemysql.com', '2v6B9Eu4Wc', '926XBu3pHs', '2v6B9Eu4Wc');
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $fname = stripcslashes($fname);
  $lname = stripcslashes($lname);
  $email = stripcslashes($email);
  $mobile = stripcslashes($mobile);
  $age = stripcslashes($age);
  $gender = stripcslashes($gender);
  $user = stripcslashes($user);
  $pass = stripcslashes($pass);
  $query = "INSERT INTO patient (fname,lname,email,mobile,age,gender,username,pass) values ('$fname','$lname','$email','$mobile','$age','$gender','$user','$pass')";
  $query_run = mysqli_query($conn, $query);
  echo "<script>
  alert('Registration was successful');
</script>";
  mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <link rel="stylesheet" href="css/style.css">

</head>

<body>
  <div class="div1">
    <div class="company">
      <img src="g10.svg" class="logo">
      <h1 class="dr">Dr&nbsp;<span class="care">&nbsp;Care</span></h1>
    </div>
    <div class="desc">
      <p>Not feeling well?</p>
      <p>Book your Appointment now</p>
    </div>
    <div class="content">
      <h1 class="heading">Welcome</h1>
      <div class="but">
        <button class="loginbtn">Login</button>
        <button class="signupbtn">Signup</button>
      </div>
    </div>
  </div>
  <div class="div2">
    <img src="image.svg">
  </div>
  <div class="wrapper" id="wrapper">
    <div class="title">
      Welcome Back
      <a href="#" class="close"><i class="fa fa-times"></i></a>

    </div>
    <form action="#" method="POST">
      <div class="field">
        <input type="text" required name="user">
        <label>Username</label>
      </div>
      <div class="field">
        <input type="password" required name="pass">
        <label>Password</label>
      </div>
      <div class="field">
        <input type="submit" value="Login" class='button' name="submit">
      </div>
      <div class="signup-link">
        Not a member? <a href="#" class="signupnow">Signup now</a></div>
    </form>
  </div>
  <div class="container">
    <div class="text">
      Fill the Details Below
    </div><a href="#" class="closes"><i class="fa fa-times"></i></a>
    <form action="#" method="POST">
      <div class="form-row">
        <div class="input-data">
          <input type="text" required name="fname">
          <div class="underline">
          </div>
          <label for="">First Name</label>
        </div>
        <div class="input-data">
          <input type="text" required name="lname">
          <div class="underline">
          </div>
          <label for="">Last Name</label>
        </div>
      </div>
      <div class="form-row">
        <div class="input-data">
          <input type="email" required name="email">
          <div class="underline">
          </div>
          <label for="">Email Address</label>
        </div>
        <div class="input-data">
          <input type="text" required pattern="^\d{10}$" name="mobile">
          <div class="underline">
          </div>
          <label for="">Mobile no.</label>
        </div>
      </div>
      <div class="form-row">
        <div class="input-data">
          <input type="text" required pattern="[0-9]+" name="age">
          <div class="underline">
          </div>
          <label for="">Age</label>
        </div>
        <div class="input-data">
          <input type="text" required name="gender">
          <div class="underline">
          </div>
          <label for="">Gender</label>
        </div>
      </div>
      <div class="form-row">
        <div class="input-data">
          <input type="text" required name="user">
          <div class="underline">
          </div>
          <label for="">Username</label>
        </div>
        <div class="input-data">
          <input type="password" required name="pass">
          <div class="underline">
          </div>
          <label for="">Password</label>
        </div>
      </div>
      <div class="signup-link">
        Already a member? <a href="#" class="loginnow">Login now</a></div>
      <div class="form-row submit-btn">
        <div class="input-data">
          <div class="inner"></div>
          <input type="submit" value="submit" name="submitnow" id="submit">
        </div>
      </div>
    </form>
  </div>
  <span id="circle"></span>
  <script>
    document.querySelector('.loginbtn').addEventListener('click', function() {
      document.querySelector('.div1').style = "opacity:0.5";
      document.querySelector('.div2').style = "opacity:0.5";
      document.querySelector('.wrapper').style = "display:block;opacity:1";

    });
    document.querySelector('.loginnow').addEventListener('click', function() {
      document.querySelector('.div1').style = "opacity:0.5";
      document.querySelector('.div2').style = "opacity:0.5";
      document.querySelector('.wrapper').style = "display:block;opacity:1";
      document.querySelector('.container').style = "display:none";
    });
    document.querySelector('.signupbtn').addEventListener('click', function() {
      document.querySelector('.div1').style = "opacity:0.5";
      document.querySelector('.div2').style = "opacity:0.5";
      document.querySelector('.container').style = "display:block;opacity:1";
    });
    document.querySelector('.signupnow').addEventListener('click', function() {
      document.querySelector('.div1').style = "opacity:0.5";
      document.querySelector('.div2').style = "opacity:0.5";
      document.querySelector('.container').style = "display:block;opacity:1";
      document.querySelector('.wrapper').style = "display:none";
    });
    document.querySelector('.close').addEventListener('click', function() {
      document.querySelector('.wrapper').style = "display:none";
      document.querySelector('.div1').style = "opacity:1";
      document.querySelector('.div2').style = "opacity:1";
    });
    document.querySelector('.closes').addEventListener('click', function() {
      document.querySelector('.container').style = "display:none";
      document.querySelector('.div1').style = "opacity:1";
      document.querySelector('.div2').style = "opacity:1";
    });
  </script>
</body>

</html>