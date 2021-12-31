<?php
  session_start();
  $_SESSION['visitteamid'] = intval($_GET['tid']);
  header('Location: http://localhost/INTurner/teampro2.php');
?>
