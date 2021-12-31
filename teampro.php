<?php
  session_start();
  echo '<script>
  function preventBack() {
      window.history.forward();
  }

  setTimeout("preventBack()", 0);
  window.onunload = function() {
      null
  };
  </script>';

  if(!in_array("teamid",array_keys($_SESSION))){
    session_destroy();
    echo '<script>
    function preventBack() {
        window.history.forward();
    }

    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
  </script>';
    header("Location: http://localhost/INTurner");
  }
  $con = mysqli_connect("localhost","root","","teams");
  $tid = $_SESSION['teamid'];
  $dets = mysqli_fetch_array(mysqli_query($con,"select * from `profs` where tid=".$tid.";"));
  $nm = $dets[1];
  $em = $dets[2];
  $exp = $dets[4];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Team Profile</title>
    <link rel="stylesheet" href="indpro.css">
  </head>
  <body style="background-color: #CCFAFF;">
    <div class="bio">
    <img src="https://st2.depositphotos.com/1104517/11965/v/600/depositphotos_119659092-stock-illustration-male-avatar-profile-picture-vector.jpg" alt="" style="width:400px;position:absolute;left:30px;top:40px;border-radius:50%;height:auto;">
    <br>
    <div style="font-size:70px;"><b><?php echo $nm;?></b></div><br>
    <div style="font-size:30px;"><b>Since : <?php echo $exp; ?></b> <span style="position: absolute; right : 20px"><a href="mailto:<?php echo $em; ?>?subject=InTurn_Invite&Message=Hello"><u>Mail me here</u></a>&emsp;</span></div>
    <hr>
      <?php
        $bio = mysqli_query($con,"select bio from `about` where tid=".$tid.";");
        if(mysqli_num_rows($bio)==0){
          echo "<p>Describe your team and your goal so people will understand your motives better &emsp; (like team goal, organisational vision and mission,.. in or less than 100 words)<p><br>";
        }else{
          echo "<p>".mysqli_fetch_array($bio)[0]."</p><br>";
        }
      ?>
    </div>
    <hr>
    <br>
    <div class="projs">
      <div style="font-size:50px;"><u>Skills looking for</u></div>
      <?php
        $skills = mysqli_query($con,"select skill from `skills` where tid=".$tid.";");
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
        $achvs = mysqli_query($con,"select achv from `achvs` where tid=".$tid.";");
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
      <div style="font-size:50px;"><u>Interests of teams</u></div>
      <br>
      <?php
        $keyws = mysqli_query($con,"select keyws from `keyws` where tid=".$tid.";");
        if(mysqli_num_rows($keyws)==0){
          echo "No keywords added";
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
        $pids = mysqli_query($con,"select pid from `likes` where tid=".$tid.";");
        if(mysqli_num_rows($pids)==0){
          echo "No profiles liked yet";
        }else{
          $conn = mysqli_connect("localhost","root","","inds");
          echo "<ul>";
          $url = 'http://localhost/INTurner/gotoindi.php';
          for($i=0; $i<mysqli_num_rows($pids); $i++){
            $pid = mysqli_fetch_array($pids)[0];
            echo "<li><a href='".$url."?pid=".$pid."' target='_blank'>";
            echo mysqli_fetch_array(mysqli_query($conn,"select name from `profs` where pid=".$pid.";"))[0];
            echo "</a></li>";
          }
          echo "</ul>";
        }
      ?>
    </div>
    <br><br>
    <center><button><a href="http://localhost/INTurner/searchindi.php" target='_blank' style='text-decoration:none;color: black; font-size:30px;'>Search profiles </a></button></center>
    <center><button><a href="http://localhost/INTurner/editteam.php" target='_blank' style='text-decoration:none;color: black; font-size:30px;'>Edit profile </a></button></center>
    <center><button onclick="logout()"><a href="http://localhost/INTurner/logout.php" style='text-decoration:none;color: black; font-size:30px;'>Logout</a></button></center>
    <script type="text/javascript">
      function logout(){location.reload();}
    </script>
    <br><br><br><br>
  </body>
</html>
