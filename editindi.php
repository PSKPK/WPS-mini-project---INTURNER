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
            $pid = $_SESSION['indid'];
            $con = mysqli_connect("localhost","root","","inds");
            $dets = mysqli_fetch_array(mysqli_query($con,"select * from `profs` where pid=".$pid.";"));
            echo "<tr><td><b>Name : </b></td><td><input type='text' name='nm' value='".$dets[1]."'></td></tr>";
            echo "<tr><td><b>Email : </b></td><td><input type='text' name='em' value='".$dets[2]."'></td></tr>";
            echo "<tr><td><b>Contact number : </b></td><td><input type='number' name='phno' value='".$dets[3]."'></td></tr>";

            echo "<tr><td><b>Occupation : </b></td><td>";
            echo " <select name='occ' style='width:13em'>";
            echo "<option value='Student' "; if($dets[4]=='Student') echo "selected>"; else echo ">"; echo "Student</option>";
            echo "<option value='Graduate' "; if($dets[4]=='Graduate') echo "selected>"; else echo ">"; echo "Graduate</option>";
            echo "<option value='Employee' "; if($dets[4]=='Employee') echo "selected>"; else echo ">"; echo "Employee</option>";
            echo "<option value='Freelancer' "; if($dets[4]=='Freelancer') echo "selected>"; else echo ">"; echo "Freelancer</option>";
            echo "<option value='Other' "; if($dets[4]=='Other') echo "selected>"; else echo ">"; echo ">Other</option>";
            echo "</select> </td>";

            echo "<tr><td><b>Experience : </b></td><td>";
            echo " <select name='exp' style='width:13em'>";
            echo "<option value='Undisclosed' ";  if($dets[5]=='Undisclosed') echo "selected>"; else echo ">"; echo "Undisclosed</option>";
            echo "<option value='0' "; if($dets[5]=='0') echo "selected>"; else echo ">"; echo "0</option>";
            echo "<option value='1-2 years' "; if($dets[5]=='1-2 years') echo "selected>"; else echo ">"; echo "1-2 years</option>";
            echo "<option value='3-5 years' "; if($dets[5]=='3-5 years') echo "selected>"; else echo ">"; echo "3-5 years</option>";
            echo "<option value='More than 5 years' "; if($dets[5]=='More than 5 years') echo "selected>"; else echo ">"; echo "More than 5 years</option>";
            echo "</select> </td>";


            $skills = mysqli_query($con,"select skill from `skills` where pid=".$pid.";");
            $ps = array();
            for($i=0; $i<mysqli_num_rows($skills); $i++) array_push($ps,mysqli_fetch_array($skills)[0]);
            $skills = mysqli_query($con,"select skill from `allskills`");
            $skill = array();
            for($i=0; $i<mysqli_num_rows($skills); $i++) array_push($skill,mysqli_fetch_array($skills)[0]);
            echo "<tr><td><b>Skills : </b></td><td>";
            for($i=0; $i<count($skill); $i++)
            {
              if(in_array($skill[$i],$ps))
              echo "<div style='display: inline-block'><input type='checkbox' name='sk[]' checked=true style='height:20px; width:20px' value='".$skill[$i]."'>".$skill[$i]."&emsp;</div>";
              else
              echo "<div style='display: inline-block'><input type='checkbox' name='sk[]' style='height:20px; width:20px' value='".$skill[$i]."'>".$skill[$i]."&emsp;</div>";
              }

            $keyws = mysqli_query($con,"select keyws from `keyws` where pid=".$pid.";");
            $pkeys = array();
            for($i=0; $i<mysqli_num_rows($keyws); $i++) array_push($pkeys,mysqli_fetch_array($keyws)[0]);
            $keywords = mysqli_query($con,"select keyw from `allkeywords`");
            $keyword = array();
            for($i=0; $i<mysqli_num_rows($keywords); $i++) array_push($keyword,mysqli_fetch_array($keywords)[0]);
            echo "<tr><td><b>Keywords-Interests : </b></td><td>";
            for($i=0; $i<count($keyword); $i++)
            {
              if(in_array($keyword[$i],$pkeys))
              echo "<div style='display: inline-block'><input type='checkbox' name='kw[]' checked=true style='height:20px; width:20px' value='".$keyword[$i]."'>".$keyword[$i]."&emsp;</div>";
              else
              echo "<div style='display: inline-block'><input type='checkbox' name='kw[]' style='height:20px; width:20px' value='".$keyword[$i]."'>".$keyword[$i]."&emsp;</div>";
            }

            echo "<tr><td><b>Projects : </td><td>";
            $projects = mysqli_query($con,"select projs from `projs` where pid=".$pid.";");
            $projs=array();
            for($i=0;$i<mysqli_num_rows($projects);$i++) array_push($projs,mysqli_fetch_array($projects)[0]);
            for($i=0; $i<count($projs); $i++)
              echo "<div style='display: inline-block'><input type='checkbox' name='projs[]' checked=true style='height:20px; width:20px' value='".$projs[$i]."'>".$projs[$i]."&emsp;</div>";
            echo "<input type='url' name='projlink'>";
            echo "<button name='addproj'>Add new project</button></tr>";

            echo "<tr><td><b>Achievements : </td><td>";
            $achievements = mysqli_query($con,"select achv from `achvs` where pid=".$pid.";");
            $achvs=array();
            for($i=0;$i<mysqli_num_rows($achievements);$i++) array_push($achvs,mysqli_fetch_array($achievements)[0]);
            for($i=0; $i<count($achvs); $i++)
              echo "<div style='display: inline-block'><input type='checkbox' name='achvs[]' checked=true style='height:20px; width:20px' value='".$achvs[$i]."'>".$achvs[$i]."&emsp;</div>";
            echo "<input type='text' name='achievement'>";
            echo "<button name='addachv'>Add new achievement</button></tr>";


            echo "<tr><td><b>Teams liked : </b></td>";
            $tids = mysqli_query($con,"select tid from `likes` where pid=".$pid.";");
            $conn = mysqli_connect("localhost","root","","teams");
            $tnames = array();
            for($i=0; $i<mysqli_num_rows($tids); $i++){
              $tid = mysqli_fetch_array($tids)[0];
              $tnames[$tid]=mysqli_fetch_array(mysqli_query($conn,"select name from `profs` where tid=".$tid.";"))[0];
            }
            echo "<td>";
            for($i=0; $i<count($tnames); $i++){
              echo "<div style='display: inline-block'><input type='checkbox' name='teams[]' checked=true style='height:20px; width:20px' value='".$tnames[$i]."'>".$tnames[$i]."&emsp;</div>";
            }
            echo "</td></tr>";

            echo "<tr><td><b>Bio : </b></td>";
            $bio = mysqli_query($con,"select bio from `about` where pid=".$pid.";");
            if(mysqli_num_rows($bio)!=1) $bio='';
            else $bio = mysqli_fetch_array($bio)[0];
            echo "<td><textarea name='bio' rows='6' cols='35' maxlength='400'>".$bio."</textarea></td></tr>";
            ?>
          </table>

          <br><br>
          <a href="http://localhost/INTurner/editindi.php" target='_blank'><input type='submit' name='save' value='Save changes'></a>
          <br><br><br>
        </center>
    </form>
  </body>
</html>


<?php
  if(isset($_POST['addproj'])){
    if(!in_array($_POST['projlink'],$projs)){
      $res = mysqli_query($con,"insert into `projs` values(".$pid.",'".$_POST['projlink']."');");
      echo "<script>location.reload()</script>";
    }
  }
  if(isset($_POST['addachv'])){
    if(!in_array($_POST['achievement'],$achvs)){
      $res = mysqli_query($con,"insert into `achvs` values(".$pid.",'".$_POST['achievement']."');");
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
          $res = mysqli_query($con,"select pid from `profs` where email='".$em."' and pid!=".$pid.";");
          if(mysqli_num_rows($res)==0){
            $res = mysqli_query($con,"select pid from `profs` where phno='".$phno."' and pid!=".$pid.";");
            if(mysqli_num_rows($res)==0){
              $occ = $_POST['occ'];
              $exp = $_POST['exp'];
              $res = mysqli_query($con,"update `profs` set name='".$nm."',email='".$em."',phno='".$phno."',job='".$occ."',exp='".$exp."' where pid=".$pid.";");
              $res = mysqli_query($con,"delete from `skills` where pid=".$pid.";");
              if(in_array('sk',array_keys($_POST))){
              foreach($_POST['sk'] as $ski){
                mysqli_query($con,"insert into `skills` values(".$pid.",'".$ski."');");
              }}
              $res = mysqli_query($con,"delete from `keyws` where pid=".$pid.";");
              if(in_array('kw',array_keys($_POST))){
              foreach($_POST['kw'] as $kwd){
                mysqli_query($con,"insert into `keyws` values(".$pid.",'".$kwd."');");
              }}
              $res = mysqli_query($con,"delete from `about` where pid=".$pid.";");
              mysqli_query($con,"insert into `about` values(".$pid.",'".$_POST['bio']."');");
              $res = mysqli_query($con,"delete from `projs` where pid=".$pid.";");
              if(in_array('projs',array_keys($_POST))){
              foreach($_POST['projs'] as $pjkt){
                mysqli_query($con,"insert into `projs` values(".$pid.",'".$pjkt."');");
              }}
              $res = mysqli_query($con,"delete from `achvs` where pid=".$pid.";");
              if(in_array('achvs',array_keys($_POST))){
              foreach($_POST['achvs'] as $achvt){
                mysqli_query($con,"insert into `achvs` values(".$pid.",'".$achvt."');");
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
