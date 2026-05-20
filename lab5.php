<!DOCTYPE html>
<html>
<body>
<?php
// Initialize variables
$name = $email = $gender = $course = $message = "";
$hobbies = [];
$errors = [];

if ($_SERVER["REQUESTMETHOD"] == "POST") {
    // Sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $gender = htmlspecialchars($_POST['gender'] ?? "");
    $course = htmlspecialchars($_POST['course']);
    $message = htmlspecialchars($_POST['message']);
    $hobbies = $_POST['hobbies'] ?? [];

    // Validation
    if (empty($name)) $errors[] = "Name is required";
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (empty($gender)) $errors[] = "Gender is required";
    if (empty($course)) $errors[] = "Course is required";
    if (empty($message)) $errors[] = "Message is required";

    // Output
    if (empty($errors)) {
        echo "<h3>Registration Successful!</h3>";
        echo "Name: $name <br>";
        echo "Email: $email <br>";
        echo "Gender: $gender <br>";
        echo "Course: $course <br>";
        echo "Hobbies: " . implode(", ", $hobbies) . "<br>";
        echo "Message: $message <br>";
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>

<h2>Student Registration Form</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHPSELF"]); ?>">
  Name: <input type="text" name="name" value="<?php echo $name; ?>" required><br><br>
  Email: <input type="text" name="email" value="<?php echo $email; ?>" required><br><br>

  Gender:
  <input type="radio" name="gender" value="Male" <?php if($gender=="Male") echo "checked"; ?>> Male
  <input type="radio" name="gender" value="Female" <?php if($gender=="Female") echo "checked"; ?>> Female
  <br><br>

  Course:
  <select name="course" required>
    <option value="">--Select--</option>
    <option value="BSIT" <?php if($course=="BSIT") echo "selected"; ?>>BSIT</option>
    <option value="BCSC" <?php if($course=="BCSC") echo "selected"; ?>>BCSC</option>
    <option value="BSIS" <?php if($course=="BSIS") echo "selected"; ?>>BSIS</option>
  </select>
  <br><br>

  Hobbies:<br>
  <input type="checkbox" name="hobbies[]" value="Reading" <?php if(in_array("Reading",$hobbies)) echo "checked"; ?>> Reading<br>
  <input type="checkbox" name="hobbies[]" value="Sports" <?php if(in_array("anime",$hobbies)) echo "checked"; ?>> anime<br>
  <input type="checkbox" name="hobbies[]" value="Music" <?php if(in_array("Music",$hobbies)) echo "checked"; ?>> Music<br><br>

  Message:<br>
  <textarea name="message" required><?php echo $message; ?></textarea><br><br>

  Password: <input type="password" name="password"><br><br>

  Age: <input type="number" name="age" min="1" max="120"><br><br>

  <input type="submit" value="Register">
  <input type="reset" value="Reset">
</form>
</body>
</html>