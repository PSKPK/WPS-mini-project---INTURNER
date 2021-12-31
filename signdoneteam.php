<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Signin result</title>
    <style media="screen">
      body{
        text-align: center;
        font-size: 30px;
        background-color: #CCFAFF;
      }
    </style>
  </head>
  <body>
  </body>
</html>


<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $nm = ucwords(strtolower($_POST['nm']));
    $em = $_POST['em'];
    $phno = $_POST['phno'];
    $exp = $_POST['exp'];
    $usn = $_POST['usn'];
    $psw = $_POST['psw'];
    $con = mysqli_connect("localhost","root","","teams");
    echo $nm."<br>".$em."<br>".$phno."<br>".$exp."<br>";
    $nmpt = '/^[A-Za-z]+[A-Za-z ]*$/';
    $empt = '/^[a-z0-9]{6,30}@gmail.com$/';
    $phnopt = '/^[7-9][0-9]{9}$/';
    $usnpt = '/^[A-Za-z1-3]{5,30}$/';
    if(preg_match($nmpt,$nm)==1){
      if(preg_match($empt,$em)==1){
        if(preg_match($phnopt,$phno)==1){
          if(preg_match($usnpt,$usn)==1){
            $res = mysqli_query($con,"select tid from `login` where usn='".$usn."';");
            if(mysqli_num_rows($res)==0){
              $res = mysqli_query($con,"select tid from `profs` where name='".$nm."';");
              if(mysqli_num_rows($res)==0){
                $res = mysqli_query($con,"select tid from `profs` where mail='".$em."';");
                if(mysqli_num_rows($res)==0){
                  $res = mysqli_query($con,"select tid from `profs` where phno='".$phno."';");
                  if(mysqli_num_rows($res)==0){
                    if(rtrim($psw)!=''){
                      $res = mysqli_query($con,"insert into `profs` values(NULL,'".$nm."','".$em."','".$phno."','".$exp."');");
                      $tid = mysqli_fetch_array(mysqli_query($con,"select tid from `profs` where mail='".$em."';"))[0];
                      echo $tid;
                      $res = mysqli_query($con,"insert into `login` values(".$tid.",'".$usn."','".$psw."');");
                      if($res==false){
                        echo "error";
                      }
                      else{
                        echo "Successs!!!!";
                      }
                    }else{
                      echo "Invalid password";
                    }
                  }else{
                    echo "<br><h1>The phone number is already registered..</h1><br>";
                  }
                }else{
                  echo "<br><h1>The gmail account is already in use..</h1><br>";
                }
              }else{
                echo "<br><h1>Team name already used.. please choose another name</h1><br>";
              }
            }else{
              echo "<br><h1>The username already exists.. please use another username</h1><br>";
            }
          }else{
            echo "<br><h1>Invalid username format</h1><br>";
          }
        }else{
          echo "<br><h1>Please enter proper phone number</h1><br>";
        }
      }else{
        echo "<br><h1>Invalid gmail address</h1><br>";
      }
    }else{
      echo "<br><h1>Invalid name</h1><br>";
    }
  }
?>
