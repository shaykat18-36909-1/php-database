<html>
  <head>
   
   
    <style>
      body {
        box-sizing: border-box;
      }

      input {
        margin-bottom: 2px;
        width: 270px;
      }
      input[type='radio'] {
        width: 12px;
      }

      input[type='date'] {
        width: 210px;
      }

      label {
        display: inline-block;
        width: 150px;
      }

      .required {
        color: orange;
      }

      .error {
        padding-left: 10px;
        color: red;
      }

    </style>
    <title>Registration Form</title>
  </head>
  <body>

    <?php
      require "mainwork.php";
      $fname = "";
      $lname = "";
      $gender = "";
      $dob = "";
      $ageErr = "";
      $religion = "";
      $present = "";
      $permanent = "";
      $tel = "";
      $email = "";
      $emailErr = "";
      $weblink = "";
      $username = "";
      $password = "";
      
      $regErr = "";
      $flag = false;


      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if(!empty($_POST['fname'])) {
          $fname = input($_POST['fname']);
        }

        else {
          $flag = true;
        }

        if(!empty($_POST['lname'])) {
          $lname = input($_POST['lname']);
        }

        else {
          $flag = true;
        }

        if(!empty($_POST['gender'])) {
          $gender = input($_POST['gender']);
        }

        else {
          $flag = true;
        }

        if(!empty($_POST['dob'])) {
          $dob = input($_POST['dob']);
          // $a = strtotime($dob);
          // $b = strtotime('now') - 86400*365*10;
          // echo "<h1>" . $a - $b . "</h1>";
          if (strtotime($dob) >= (strtotime('now') - 96400*365*10)) {
            $ageErr = "you must be at least 10 years old";
          }

          else {
            $ageErr = "";
          }
        }

        else {
          $flag = true;
        }
        if(!empty($_POST['religion'])) {
          $religion = input($_POST['religion']);
        }

        else {
          $flag = true;
        }
        if(!empty($_POST['present'])) {
          $present = input($_POST['present']);
        }

        if(!empty($_POST['permanent'])) {
          $permanent = input($_POST['permanent']);
        }

        if(!empty($_POST['tel'])) {
          $tel = input($_POST['tel']);
        }

        if(!empty($_POST['email'])) {
          $email = input($_POST['email']);
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "invalid email format";
          }
        }

        else {
          $flag = true;
        }

        if(!empty($_POST['weblink'])) {
          $weblink = input($_POST['weblink']);
        }
        else {
          $flag = true;
        }

        if(!empty($_POST['username'])) {
          $username = input($_POST['username']);
        }

        else {
          $flag = true;
        }
        if(!empty($_POST['password'])) {
          $password = input($_POST['password']);
        }

        

        if (!$flag) {
          $existing_data = read();

          if(empty($existing_data)) {
            $objArr[] = array("firstname" => $fname, "lastname" => $lname, "gender" => uswords($gender), "date of birth" => $dob, "religion" => ucwords($religion), "present address" => $present, "permanent address" => $permanent, "telephone" => $tel, "email" => $email, "weblink" => $weblink, "username" => $username, "password" => $password);
            $result = write(json_encode($objArr));
          }

          else {
            $existing_data_decode = json_decode($existing_data);

            array_push($existing_data_decode, array("firstname" => $fname, "lastname" => $lname, "gender" => $gender, "date of birth" => $dob, "religion" => $religion, "present address" => $present, "permanent address" => $permanent, "telephone" => $tel, "email" => $email, "weblink" => $weblink, "username" => $username, "password" => $password));
            write("");
            $result = write(json_encode($existing_data_decode));
          }

          setcookie("username", $username, time() + 96400);
      		setcookie("password", $password, time() + 96400);

      		header("Location: login-form.php");
        }

        else {
          $regErr = "<p class='error'>* fields is empty</p>";
      	}
      }
    ?>


    <h1 style="text-align: center;">Registration Form</h1>
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" autocomplete="off" method="POST">
      <fieldset>
        <legend>Basic information</legend>
        <label for="fname">Enter your first name<span class="required">*</span>: </label>
        <input type="text" name="fname" value="<?php echo $fname; ?>" />
        <br />
        <label for="lname">Enter your last name<span class="required">*</span>: </label>
        <input type="text" name="lname" value="<?php echo $lname; ?>" />
        <br />
        <label for="gender">Gender<span class="required">*</span>: </label>
        <input type="radio" name="gender" value="male" <?php if($gender === "male") echo "checked"; ?> />
        <label for="male">Male</label>
        <input type="radio" name="gender" value="female" <?php if($gender === "female") echo "checked"; ?> />
        <label for="female">Female</label>
        <br />
        <label for="dob">Date of Birth<span class="required">*</span>: </label>
        <input type="date" name="dob" value="<?php echo $dob; ?>" />
        <span class="error"><?php echo $ageErr; ?></span>
        <br />
        <label for="religion">Enter your Religion<span class="required">*</span>: </label>
        <select name="religion">
          <option value="">-</option>
          <option value="islam" <?php if($religion === "islam") echo "selected"; ?>>Islam</option>
          <option value="chritian" <?php if($religion === "christian") echo "selected"; ?>>Christianity</option>
          <option value="buddha" <?php if($religion === "buddha") echo "selected"; ?>>Buddhism</option>
          <option value="hisdu" <?php if($religion === "hindu") echo "selected"; ?>>Hinduism</option>
        </select>
      </fieldset>
      <br />

      <fieldset>
        <legend>Contact Information</legend>
        <label for="present">Present Address: </label>
        <textarea name="present" rows="2" cols="30" placeholder="<?php echo $present; ?>"></textarea>
        <br />
        <label for="permanent">Permanent Address: </label>
        <textarea name="permanent" rows="2" cols="30" value="<?php echo $permanent; ?>"></textarea>
        <br />
        <label for="tel">Telephone: </label>
        <input type="tel" name="tel" value="<?php echo $tel; ?>" />
        <br />
        <label for="email">Email<span class="required">*</span>: </label>
        <input type="email" name="email" value="<?php echo $email; ?>" />
        <span class="error"><?php echo $emailErr; ?></span>
        <br />

        <label for="weblink">Personal Website Link: </label>
        <input type="url" name="weblink" value="<?php echo $weblink; ?>" />
      </fieldset>
      <br />

      <fieldset>
        <legend>Account Information</legend>
        <label for="username">Username<span class="required">*</span>: </label>
        <input type="text" name="username" value="<?php echo $username; ?>" />
        <br>
        <label for="password">Password<span class="required">*</span>: </label>
        <input type="password" name="password" value="<?php echo $password; ?>" />
         
      </fieldset>
      <br />
      <button type="submit">Submit</button>
    </form>

    <?php echo $regErr; ?>
  </body>
</html>