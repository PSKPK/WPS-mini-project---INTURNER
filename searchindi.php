<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    .card {
      float: left;
      padding: 20px;
      background-color: #fffc99;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      width: 20%;
    }

    .card:hover {
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    .container {
      padding: 2px 16px;
    }

    body{
      background-color: #CCFAFF;
      font-size: 20px;
    }

    select{
      font-size: 20px;
      width: 300px;
    }

    .results{
      padding-left: 10%;
      display: inline-block;
      padding: 30;
    }
    </style>
  </head>
  <body>
    <h1>Select from the filters : </h1><br>
    <form action="" method="post">
      <table style="align-items:center" cellpadding=10 cellspacing=10>
        <tr>
          <td><strong><u>Occupation</u></strong></td>
          <td><strong><u>Experience</u></strong></td>
          <td><strong><u>Skill</u></strong></td>
          <td><strong><u>Interests</u></strong></td>
        </tr>
        <tr>
          <td>
          <select name="job">
            <option value=""></option>
            <option value="Student">Student</option>
            <option value="Graduate">Graduate</option>
            <option value="Employee">Employee</option>
            <option value="Freelancer">Freelancer</option>
            <option value="Any">Any</option>
          </select>
          </td>
          <td>
          <select name="exp">
            <option value=""></option>
            <option value="Undisclosed">Undisclosed</option>
            <option value="0">0</option>
            <option value="1-2 years">1-2 years</option>
            <option value="3-5 years">3-5 years</option>
            <option value="More than 5 years">More than 5 years</option>
            <option value="Any">Any</option>
          </select>
          </td>
          <td>
          <select name="skill">
            <option value=""></option>
            <?php
            $con = mysqli_connect("localhost","root","","inds");
            $sks = mysqli_query($con,"select skill from `allskills`;");
            for($i=0; $i<mysqli_num_rows($sks); $i++){
              $skl = mysqli_fetch_array($sks)[0];
              echo "<option value='".$skl."'>".$skl."</option>";
            }
            ?>
            <option value="Any">Any</option>
          </select>
          </td>
          <td>
          <select name="keyword">
            <option value=""></option>
            <?php
            $con = mysqli_connect("localhost","root","","inds");
            $kws = mysqli_query($con,"select keyw from `allkeywords`;");
            for($i=0; $i<mysqli_num_rows($kws); $i++){
              $kw = mysqli_fetch_array($kws)[0];
              echo "<option value='".$kw."'>".$kw."</option>";
            }
            ?>
            <option value="Any">Any</option>
          </select>
          </td>
      </table>
      <center><input type='submit' value='Fetch'></center>
    </form>
    <br><br><br><br>

    <div id="results">
      <?php
      if(in_array('pidarr',array_keys($_SESSION))){
        $pidarr = $_SESSION['pidarr'];
        if(count($pidarr)>0){
          echo $pidarr;
          for($i=0; $i<count($pidarr); $i++){
            $pid = $pidarr[$i];
            $con = mysqli_connect('localhost',"root","","inds");
            echo "<a href='http://localhost/INTurner/gotoindi.php?indiid=".$pid."' target='_blank'>";
            echo  "<div class='card'>
                    <img src='https://st2.depositphotos.com/1104517/11965/v/600/depositphotos_119659092-stock-illustration-male-avatar-profile-picture-vector.jpg' alt='Avatar' style='width:100%'>
                    <div class='container'>";
            echo    "<h4><b>".mysqli_fetch_array(mysqli_query($con,"select name from `profs` where pid=".$pid))[0]."</b></h4>";
            echo   "</div>
                  </div>";
            echo "</a>";
          }
        }
      }
      ?>
      <div class='card'>
        <img src='https://st2.depositphotos.com/1104517/11965/v/600/depositphotos_119659092-stock-illustration-male-avatar-profile-picture-vector.jpg' alt='Avatar' style='width:100%'>
        <div class='container'>
          <h4><b>P S K Pavan Kalyan</b></h4>
          <p>Freelancer</p>
          <p>Experience : Undisclosed</p>
        </div>
      </div>
      

    </div>
  </body>
</html>


<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    echo "<script>function do(){ document.getElementById('results')='';}</script>";
    $job = $_POST['job'];
    $exp = $_POST['exp'];
    $skill = $_POST['skill'];
    $keyword = $_POST['keyword'];
    $con = mysqli_connect("localhost","root","","inds");
    $queryfetch = 'select pid from `profs` where pid!=0';
    if($job!='Any'){
      $queryfetch = $queryfetch." and job='".$job."'";
    }
    if($exp!='Any'){
      $queryfetch = $queryfetch." and exp='".$exp."'";
    }
    $pids = mysqli_query($con,$queryfetch);
    $pidarr = array();
    for($i=0; $i<mysqli_num_rows($pids); $i++) array_push($pidarr,mysqli_fetch_array($pids)[0]);
    $pidarr2 = array();
    for($i=0; $i<count($pidarr); $i++){
      if(mysqli_num_rows(mysqli_query($con,"select pid from `skills` where pid=".$pidarr[$i]." and skill='".$skill."'"))!=0)
      array_push($pidarr2,$pidarr[i]);
    }
    $pidarr = array();
    for($i=0; $i<count($pidarr2); $i++){
      if(mysqli_num_rows(mysqli_query($con,"select pid from `keyws` where pid=".$pidarr2[$i]." and keyws='".$keyword."'"))!=0)
      array_push($pidarr,$pidarr2[i]);
    }
    $_SESSION['pidarr']=$pidarr;
  }
?>
