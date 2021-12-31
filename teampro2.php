<?php
  session_start();
  $con = mysqli_connect("localhost","root","","teams");
  $pid = $_SESSION['visitindiid'];
  $dets = mysqli_fetch_array(mysqli_query($con,"select * from `profs` where pid=".$pid.";"));
  $nm = $dets[1];
  $em = $dets[2];
  $occ = $dets[4];
  $exp = $dets[5];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Profile</title>
    <link rel="stylesheet" href="indpro.css">
  </head>
  <body style="background-color: #CCFAFF;">
    <div class="bio">
    <img src="https://st2.depositphotos.com/1104517/11965/v/600/depositphotos_119659092-stock-illustration-male-avatar-profile-picture-vector.jpg" alt="" style="width:400px;position:absolute;left:30px;top:40px;border-radius:50%;height:auto;">
    <br>
    <div style="font-size:70px;"><b><?php echo $nm;?></b></div><br>
    <div style="font-size:40px;"><b><?php echo $occ; ?></b></div>
    <div style="font-size:30px;"><b>Experience : <?php echo $exp; ?></b> <span style="position: absolute; right : 20px"><a href="mailto:<?php echo $em; ?>?subject=InTurn_Invite&Message=Hello"><u>Mail me here</u></a>&emsp;</span></div>
    <hr>
      <?php
        $bio = mysqli_query($con,"select bio from `about` where pid=".$pid.";");
        if(mysqli_num_rows($bio)==0){
          echo "<p>Describe yourself as an introduction so people will know about you<p><br>";
        }else{
          echo "<p>".mysqli_fetch_array($bio)[0]."</p><br>";
        }
      ?>
    </div>
    <hr>
    <br>
    <div class="projs">
      <div style="font-size:50px;"><u>Projects</u></div>
      <?php
        $projs = mysqli_query($con,"select projs from `projs` where pid=".$pid.";");
        if(mysqli_num_rows($projs)==0){
          echo "No projects yet";
        }else{
          echo "<ul>";
          for($i=0; $i<mysqli_num_rows($projs); $i++){
            echo "<li>".mysqli_fetch_array($projs)[0]."</li>";
          }
          echo "</li>";
        }
      ?>
    </div>
    <hr>
    <br>
    <div class="projs">
      <div style="font-size:50px;"><u>Skills</u></div>
      <?php
        $skills = mysqli_query($con,"select skill from `skills` where pid=".$pid.";");
        if(mysqli_num_rows($skills)==0){
          echo "No skills added yet";
        }else{
          echo "<ul>";
          for($i=0; $i<mysqli_num_rows($skills); $i++){
            echo "<li>".mysqli_fetch_array($skills)[0]."</li>";
          }
          echo "</li>";
        }
      ?>
    </div>
    <hr>
    <br>
    <div class="projs">
      <div style="font-size:50px;"><u>Achievements</u></div>
      <?php
        $achvs = mysqli_query($con,"select achv from `achvs` where pid=".$pid.";");
        if(mysqli_num_rows($achvs)==0){
          echo "No achievements added yet";
        }else{
          echo "<ul>";
          for($i=0; $i<mysqli_num_rows($achvs); $i++){
            echo "<li>".mysqli_fetch_array($achvs)[0]."</li>";
          }
          echo "</li>";
        }
      ?>
    </div>
    <hr>
    <br>
    <div class="projs" >
      <div style="font-size:50px;"><u>Interests - Keywords</u></div>
      <br>
      <?php
        $keyws = mysqli_query($con,"select keyws from `keyws` where pid=".$pid.";");
        if(mysqli_num_rows($keyws)==0){
          echo "No keywords added &emsp;(KEYWORDS HELP TEAMS TO SEARCH YOU)";
        }else{
          for($i=0; $i<mysqli_num_rows($keyws); $i++){
            echo "<span><button type='button' name='key".$i."'>".mysqli_fetch_array($keyws)[0]."</button></span>&emsp;";
          }
        }
      ?>
      <br>
      <br>
    </div>
    <hr>
    <br>
    <div class="projs">
      <div style="font-size:50px;"><u>Teams liked</u></div>
      <?php
        $tids = mysqli_query($con,"select tid from `likes` where pid=".$pid.";");
        if(mysqli_num_rows($tids)==0){
          echo "No profiles liked yet";
        }else{
          $conn = mysqli_connect("localhost","root","","teams");
          echo "<ul>";
          $url = 'http://localhost/INTurner/gototeam.php';
          for($i=0; $i<mysqli_num_rows($tids); $i++){
            $tid = mysqli_fetch_array($tids)[0];
            echo "<li><a href='".$url."?tid=".$tid."' target='_blank'>";
            echo mysqli_fetch_array(mysqli_query($con,"select name from `profs` where pid=".$tid.";"))[0];
            echo "</a></li>";
          }
          echo "</ul>";
        }
      ?>
    </div>
    <br><br>
    <?php
      if($_SESSION['is']=='indi'){
        echo "<a href='http://localhost/INTurner/likeindi.php?likeindiid=".$_SESSION['visitindiid']."' target='_blank'>Like</a>";
      }
    ?>
    <br><br><br><br>
  </body>
</html>
