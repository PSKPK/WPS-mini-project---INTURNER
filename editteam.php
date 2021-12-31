<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit details</title>
    <style media="screen">
      body{
        background-color: #CCFAFF;
      }
      *{
        font-size: 25px;
      }
      td{
        word-wrap: break-word;
        max-width: 550px;
      }
    </style>
  </head>
  <body>
    <form action="" method="post">
      <center>
        <hr><hr>
        <br><br><br>
        <table style="text-align:right;" border='10' cellpadding='20,30' cellspacing=.5 >
          <tr>
            <th colspan=2 style="text-align:center">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Edit your details&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
          </tr>
          <?php
            session_start();
            $tid = $_SESSION['teamid'];
            $con = mysqli_connect("localhost","root","","teams");
            $dets = mysqli_fetch_array(mysqli_query($con,"select * from `profs` where tid=".$tid.";"));
            echo "<tr><td><b>Team name : </b></td><td><input type='text' name='nm' value='".$dets[1]."'></td></tr>";
            echo "<tr><td><b>Email : </b></td><td><input type='text' name='em' value='".$dets[2]."'></td></tr>";
            echo "<tr><td><b>Contact number : </b></td><td><input type='number' name='phno' value='".$dets[3]."'></td></tr>";

            echo "<tr><td><b>Established since : </b></td><td>";
            echo " <select name='exp' style='width:13em'>";
            echo "<option value='Undisclosed' ";  if($dets[4]=='Undisclosed') echo "selected>"; else echo ">"; echo "Undisclosed</option>";
            echo "<option value='Recent startup' "; if($dets[4]=='Recent startup') echo "selected>"; else echo ">"; echo "Recent startup</option>";
            echo "<option value='1-2 years' "; if($dets[4]=='1-2 years') echo "selected>"; else echo ">"; echo "1-2 years</option>";
            echo "<option value='3-5 years' "; if($dets[4]=='3-5 years') echo "selected>"; else echo ">"; echo "3-5 years</option>";
            echo "<option value='More than 5 years' "; if($dets[4]=='More than 5 years') echo "selected>"; else echo ">"; echo "More than 5 years</option>";
            echo "</select> </td>";

            $skills = mysqli_query($con,"select skill from `skills` where tid=".$tid.";");
            $ts = array();
            for($i=0; $i<mysqli_num_rows($skills); $i++) array_push($ts,mysqli_fetch_array($skills)[0]);
            $conn = mysqli_connect("localhost","root","","inds");
            $skills = mysqli_query($conn,"select skill from `allskills`");
            $skill = array();
            for($i=0; $i<mysqli_num_rows($skills); $i++) array_push($skill,mysqli_fetch_array($skills)[0]);
            echo "<tr><td><b>Skills looking for : </b></td><td>";
            for($i=0; $i<count($skill); $i++)
            {
              if(in_array($skill[$i],$ts))
              echo "<div style='display: inline-block'><input type='checkbox' name='sk[]' checked=true style='height:20px; width:20px' value='".$skill[$i]."'>".$skill[$i]."&emsp;</div>";
              else
              echo "<div style='display: inline-block'><input type='checkbox' name='sk[]' style='height:20px; width:20px' value='".$skill[$i]."'>".$skill[$i]."&emsp;</div>";
              }

            $keyws = mysqli_query($con,"select keyws from `keyws` where tid=".$tid.";");
            $tkeys = array();
            for($i=0; $i<mysqli_num_rows($keyws); $i++) array_push($tkeys,mysqli_fetch_array($keyws)[0]);
            $keywords = mysqli_query($conn,"select keyw from `allkeywords`");
            $keyword = array();
            for($i=0; $i<mysqli_num_rows($keywords); $i++) array_push($keyword,mysqli_fetch_array($keywords)[0]);
            echo "<tr><td><b>Keywords-Interests : </b></td><td>";
            for($i=0; $i<count($keyword); $i++)
            {
              if(in_array($keyword[$i],$tkeys))
              echo "<div style='display: inline-block'><input type='checkbox' name='kw[]' checked=true style='height:20px; width:20px' value='".$keyword[$i]."'>".$keyword[$i]."&emsp;</div>";
              else
              echo "<div style='display: inline-block'><input type='checkbox' name='kw[]' style='height:20px; width:20px' value='".$keyword[$i]."'>".$keyword[$i]."&emsp;</div>";
            }

            echo "<tr><td><b>Achievements : </td><td>";
            $achievements = mysqli_query($con,"select achv from `achvs` where tid=".$tid.";");
            $achvs=array();
            for($i=0;$i<mysqli_num_rows($achievements);$i++) array_push($achvs,mysqli_fetch_array($achievements)[0]);
            for($i=0; $i<count($achvs); $i++)
              echo "<div style='display: inline-block'><input type='checkbox' name='achvs[]' checked=true style='height:20px; width:20px' value='".$achvs[$i]."'>".$achvs[$i]."&emsp;</div>";
            echo "<input type='text' name='achievement'>";
            echo "<button name='addachv'>Add new achievement</button></tr>";


            echo "<tr><td><b>Profiles liked : </b></td>";
            $pids = mysqli_query($con,"select pid from `likes` where tid=".$tid.";");
            $pnames = array();
            for($i=0; $i<mysqli_num_rows($pids); $i++){
              $pid = mysqli_fetch_array($pids)[0];
              $pnames[$pid]=mysqli_fetch_array(mysqli_query($conn,"select name from `profs` where pid=".$pid.";"))[0];
            }
            echo "<td>";
            for($i=0; $i<count($pnames); $i++){
              echo "<div style='display: inline-block'><input type='checkbox' name='profs[]' checked=true style='height:20px; width:20px' value='".$pnames[$i]."'>".$pnames[$i]."&emsp;</div>";
            }
            echo "</td></tr>";

            echo "<tr><td><b>Bio : </b></td>";
            $bio = mysqli_query($con,"select bio from `about` where tid=".$tid.";");
            if(mysqli_num_rows($bio)!=1) $bio='';
            else $bio = mysqli_fetch_array($bio)[0];
            echo "<td><textarea name='bio' rows='6' cols='35' maxlength='400'>".$bio."</textarea></td></tr>";
            ?>
          </table>

          <br><br>
          <a href="http://localhost/INTurner/editteam.php" target='_blank'><input type='submit' name='save' value='Save changes'></a>
          <br><br><br>
        </center>
    </form>
  </body>
</html>


<?php
  if(isset($_POST['addachv'])){
    if(!in_array($_POST['achievement'],$achvs)){
      $res = mysqli_query($con,"insert into `achvs` values(".$tid.",'".$_POST['achievement']."');");
      echo "<script>location.reload()</script>";
    }
  }
  if(isset($_POST['save'])){
    $nm = $_POST['nm'];
    $em = $_POST['em'];
    $phno = $_POST['phno'];
    $done = 0;

    $nmpt = '/^[A-Za-z]+[A-Za-z ]*$/';
    $empt = '/^[a-z0-9]{5,30}@gmail.com$/';
    $phnopt = '/^[7-9][0-9]{9}$/';
    if(preg_match($nmpt,$nm)==1){
      if(preg_match($empt,$em)==1){
        if(preg_match($phnopt,$phno)==1){
          $res = mysqli_query($con,"select tid from `profs` where mail='".$em."' and tid!=".$tid.";");
          if(mysqli_num_rows($res)==0){
            $res = mysqli_query($con,"select tid from `profs` where phno='".$phno."' and tid!=".$tid.";");
            if(mysqli_num_rows($res)==0){
              $exp = $_POST['exp'];
              $res = mysqli_query($con,"update `profs` set name='".$nm."',email='".$em."',phno='".$phno."',exp='".$exp."' where tid=".$tid.";");
              $res = mysqli_query($con,"delete from `skills` where tid=".$tid.";");
              if(in_array('sk',array_keys($_POST))){
              foreach($_POST['sk'] as $ski){
                mysqli_query($con,"insert into `skills` values(".$tid.",'".$ski."');");
              }}
              $res = mysqli_query($con,"delete from `keyws` where tid=".$tid.";");
              if(in_array('kw',array_keys($_POST))){
              foreach($_POST['kw'] as $kwd){
                mysqli_query($con,"insert into `keyws` values(".$tid.",'".$kwd."');");
              }}
              $res = mysqli_query($con,"delete from `about` where tid=".$tid.";");
              mysqli_query($con,"insert into `about` values(".$tid.",'".$_POST['bio']."');");
              $res = mysqli_query($con,"delete from `achvs` where tid=".$tid.";");
              if(in_array('achvs',array_keys($_POST))){
              foreach($_POST['achvs'] as $achvt){
                mysqli_query($con,"insert into `achvs` values(".$tid.",'".$achvt."');");
              }}
              echo "<script>window.close()</script>";
            }else{
              echo "<br><h1>The phone number is already registered..</h1><br>";
            }
          }else{
            echo "<br><h1>The gmail account is already in use..</h1><br>";
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
