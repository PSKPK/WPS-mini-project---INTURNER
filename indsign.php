<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>InTurner Signup form</title>
    <style media="screen">
      .uppad{
        color : white;
        background-color: blue;
        padding-bottom: 20px;
        padding-bottom: 20px;
        font-size: 140px;
        font-family: sans-serif;
      }
    </style>
  </head>
  <body style="background-color: #CCFAFF;">
    <center>
    <div class="uppad">
      <b><i>InTurner</i></b>
    </div>
    <br><br>
    <div style="font-size:40px; color: blue"><b><i>Sign up here as individual</i></b></div>
    <br>
    <center>
    <form action="signdone.php" method="post">
      <table style="text-align:right; font-size:2em;">
        <tr>
          <td><label for="nm">Full Name : </label></td>
          <td>&emsp;<input type="text" name="nm" required style="width:300px;"></td>
        </tr>
        <tr>
          <td><label for="em">Gmail : </label></td>
          <td>&emsp;<input type="email" name="em" required style="width:300px;"></td>
        </tr>
        <tr>
          <td><label for="phno">Contact number : </label></td>
          <td>&emsp;<input type="number" name="phno" required style="width:300px;"></td>
        </tr>
        <tr>
          <td><label for="occ">Occupation (present) : </label></td>
          <td> <select name="occ" required style="width:310px;">
            <option value=""></option>
            <option value="Student">Student</option>
            <option value="Graduate">Graduate</option>
            <option value="Employee">Employee</option>
            <option value="Freelancer">Freelancer</option>
            <option value="Other">Other</option>
          </select> </td>
        </tr>
        <tr>
          <td><label for="exp">Experience (in work if any) : </label></td>
          <td> <select name="exp" required style="width:310px;">
            <option value=""></option>
            <option value="Undisclosed">Undisclosed</option>
            <option value="0">0</option>
            <option value="1-2 years">1-2 years</option>
            <option value="3-5 years">3-5 years</option>
            <option value="More than 5 years">More than 5 years</option>
          </select> </td>
        </tr>
        <tr>
          <td><label for="usn">Username : </label></td>
          <td>&emsp;<input type="text" name="usn" style="width:300px;"></td>
        </tr>
        <tr>
          <td><label for="psw">Password : </label></td>
          <td>&emsp;<input type="password" name="psw" style="width:300px;"></td>
        </tr>
        <tr>
          <td><input type=submit name="sub" value="Create"></td>
        </tr>
      </table>
    </form>
    <a href="http://localhost/INTurner/teamsign.php" target="_blank" onclick="go()"> Or click here to register as a team</a>
    <script type="text/javascript">
      function go(){
        window.close();
      }
    </script>
  </body>
</html>
