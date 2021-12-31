<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index.css">
    <title>InTurn Login page</title>
  </head>
  <body style="background-color: #CCFAFF;">
    <center>
    <div class="uppad">
      <b><i>InTurner</i></b>
    </div>
    <div class="loginbox">
      <form action="" method="post">
        <label for="usn">Username : </label>
        <input type="text" name="usn" />
        <br><br>
        <label for="psw">Password : </label>
        <input type="password" name="psw">
        <br><br>
        <label for="team">Team login</label>
        <input type="checkbox" name="team" style="height: 20px;width :20px;">
        <br><br>
        <button type="submit" name="subbut">Login</button>
      </form>
    </div>
  </center>
  <div class="newacc">
    Don't have an account ?<br>
    <a href="http://localhost/INTurner/indsign.php" target="_blank">Sign up as individual</a>
    <br>
    <a href="http://localhost/INTurner/teamsign.php" target="_blank">Sign up as team</a>
  </div>
  </body>
</html>

<?php
  session_start();
  if(in_array('indid',array_keys($_SESSION))){
    header("Location: http://localhost/INTurner/indpro.php");
  }elseif(in_array('teamid',array_keys($_SESSION))){
    header("Location: http://localhost/INTurner/teampro.php");
  }
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $SESSION = array();
    $usn = $_POST['usn'];
    $psw = $_POST['psw'];
    if(!isset($_POST['team'])){
      $con = mysqli_connect("localhost","root","","inds");
      $res = mysqli_query($con,"select pid from `login` where usn='".$usn."' and psw='".$psw."';");
      if(mysqli_num_rows($res)!=0){
        $_SESSION['indid']=mysqli_fetch_array($res)[0];
        $_SESSION['is']='indi';
        $_SESSION['visitteamid']=false;
        header("Location: http://localhost/INTurner/indpro.php");
      }else{
        echo "<center><h1>Login not found</h1></center>";
      }
    }else{
      $con = mysqli_connect("localhost","root","","teams");
      $res = mysqli_query($con,"select tid from `login` where usn='".$usn."' and psw='".$psw."';");
      if(mysqli_num_rows($res)!=0){
        $_SESSION['teamid']=mysqli_fetch_array($res)[0];
        $_SESSION['is']='team';
        $_SESSION['visitindiid']=false;
        header("Location: http://localhost/INTurner/teampro.php");
      }else{
        echo "<center><h1>Login not found</h1></center>";
      }
    }
  }
?>
