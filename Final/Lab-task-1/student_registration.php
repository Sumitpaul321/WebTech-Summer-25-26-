<!DOCTYPE html>
<html>
<head>
    <title>Student Registration Form</title>
</head>
<body>

<h2>Student Registration Form</h2>

<?php
$studentName = $username = $email = $phone = $age = $studentID = $website = $dob = "";
$password = $confirmPassword = "";

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["fullname"])) {
        $errors["fullname"] = "Full Name is required";
    } else {
        $studentName = trim($_POST["fullname"]);
        if (!preg_match("/^[a-zA-Z ]+$/", $studentName)) {
            $errors["fullname"] = "Full Name may contain only alphabetic characters and spaces";
        } elseif (strlen($studentName) < 3) {
            $errors["fullname"] = "Full Name must contain at least 3 characters";
        } elseif (strlen($studentName) > 50) {
            $errors["fullname"] = "Full Name must not contain more than 50 characters";
        }
    }

    if (empty($_POST["username"])) {
        $errors["username"] = "Username is required";
    } else {
        $username = trim($_POST["username"]);
        if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
            $errors["username"] = "Username may contain only letters, numbers, and underscore";
        } elseif (strlen($username) < 5 || strlen($username) > 15) {
            $errors["username"] = "Username length must be between 5 and 15 characters";
        } elseif (!preg_match("/^[a-zA-Z]/", $username)) {
            $errors["username"] = "The first character of Username must be an alphabetic character";
        }
    }

    if (empty($_POST["email"])) {
        $errors["email"] = "Email Address is required";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Email Address must be a valid email address";
        } elseif (!preg_match("/\.(com|org|edu)$/i", $email)) {
            $errors["email"] = "Email Address must end with .com, .org, or .edu";
        }
    }

    if (empty($_POST["phone"])) {
        $errors["phone"] = "Phone Number is required";
    } else {
        $phone = trim($_POST["phone"]);
        if (!ctype_digit($phone)) {
            $errors["phone"] = "Phone Number must contain digits only";
        } elseif (strlen($phone) != 11) {
            $errors["phone"] = "Phone Number must contain exactly 11 digits";
        } elseif (substr($phone, 0, 2) != "01") {
            $errors["phone"] = "Phone Number must start with 01";
        }
    }

    if (empty($_POST["age"])) {
        $errors["age"] = "Age is required";
    } else {
        $age = trim($_POST["age"]);
        if (!is_numeric($age)) {
            $errors["age"] = "Age must contain a numeric value";
        } elseif ($age < 18 || $age > 30) {
            $errors["age"] = "Age must be between 18 and 30 inclusive";
        }
    }

    if (empty($_POST["password"])) {
        $errors["password"] = "Password is required";
    } else {
        $password = $_POST["password"];
        if (strlen($password) < 8) {
            $errors["password"] = "Password must contain at least 8 characters";
        } elseif (!preg_match("/[A-Z]/", $password)) {
            $errors["password"] = "Password must contain at least one uppercase English letter";
        } elseif (!preg_match("/[0-9]/", $password)) {
            $errors["password"] = "Password must contain at least one numeric digit";
        } elseif (!preg_match("/[@#\$%]/", $password)) {
            $errors["password"] = "Password must contain at least one of the following characters: @, #, \$, %";
        }
    }

    if (empty($_POST["confirm_password"])) {
        $errors["confirm_password"] = "Confirm Password is required";
    } else {
        $confirmPassword = $_POST["confirm_password"];
        if ($confirmPassword !== $password) {
            $errors["confirm_password"] = "Confirm Password must exactly match Password";
        }
    }

    if (empty($_POST["student_id"])) {
        $errors["student_id"] = "Student ID is required";
    } else {
        $studentID = trim($_POST["student_id"]);
        if (!preg_match("/^[0-9]{2}-[0-9]{5}-[0-9]$/", $studentID)) {
            $errors["student_id"] = "Student ID must follow the format XX-XXXXX-X, for example, 22-12345-1";
        }
    }

    if (empty($_POST["website"])) {
        $errors["website"] = "Personal Website is required";
    } else {
        $website = trim($_POST["website"]);
        if (!preg_match("/^https?:\/\//i", $website)) {
            $errors["website"] = "Personal Website must begin with either http:// or https://";
        } elseif (!filter_var($website, FILTER_VALIDATE_URL)) {
            $errors["website"] = "Personal Website must be a valid URL";
        }
    }

    if (empty($_POST["dob"])) {
        $errors["dob"] = "Date of Birth is required";
    } else {
        $dob = trim($_POST["dob"]);
    }
}
?>

<form method="post" action="">

    Full Name:<br>
    <input type="text" name="fullname" value="<?php echo htmlspecialchars($studentName); ?>">
    <span style="color:red"><?php echo isset($errors["fullname"]) ? $errors["fullname"] : ""; ?></span>
    <br><br>

    Username:<br>
    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
    <span style="color:red"><?php echo isset($errors["username"]) ? $errors["username"] : ""; ?></span>
    <br><br>

    Email Address:<br>
    <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <span style="color:red"><?php echo isset($errors["email"]) ? $errors["email"] : ""; ?></span>
    <br><br>

    Phone Number:<br>
    <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
    <span style="color:red"><?php echo isset($errors["phone"]) ? $errors["phone"] : ""; ?></span>
    <br><br>

    Age:<br>
    <input type="text" name="age" value="<?php echo htmlspecialchars($age); ?>">
    <span style="color:red"><?php echo isset($errors["age"]) ? $errors["age"] : ""; ?></span>
    <br><br>

    Password:<br>
    <input type="password" name="password" value="">
    <span style="color:red"><?php echo isset($errors["password"]) ? $errors["password"] : ""; ?></span>
    <br><br>

    Confirm Password:<br>
    <input type="password" name="confirm_password" value="">
    <span style="color:red"><?php echo isset($errors["confirm_password"]) ? $errors["confirm_password"] : ""; ?></span>
    <br><br>

    Student ID:<br>
    <input type="text" name="student_id" value="<?php echo htmlspecialchars($studentID); ?>">
    <span style="color:red"><?php echo isset($errors["student_id"]) ? $errors["student_id"] : ""; ?></span>
    <br><br>

    Personal Website:<br>
    <input type="text" name="website" value="<?php echo htmlspecialchars($website); ?>">
    <span style="color:red"><?php echo isset($errors["website"]) ? $errors["website"] : ""; ?></span>
    <br><br>

    Date of Birth:<br>
    <input type="text" name="dob" value="<?php echo htmlspecialchars($dob); ?>">
    <span style="color:red"><?php echo isset($errors["dob"]) ? $errors["dob"] : ""; ?></span>
    <br><br>

    <input type="submit" name="submit" value="Register">

</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && count($errors) == 0) {
    echo "<h3>Registration Successful!</h3>";
    echo "Full Name: " . htmlspecialchars($studentName) . "<br>";
    echo "Username: " . htmlspecialchars($username) . "<br>";
    echo "Student ID: " . htmlspecialchars($studentID) . "<br>";
    echo "Email Address: " . htmlspecialchars($email) . "<br>";
}
?>

<?php
// 1. htmlspecialchars() is used to convert special characters like <, >, " into
//    HTML entities before printing user input back into the page, so the browser
//    displays them as plain text instead of running them as HTML/JavaScript (this
//    prevents Cross-Site Scripting / XSS attacks).
// 2. Client-side (HTML/JS) validation runs in the user's browser and can be
//    disabled, bypassed, or skipped entirely by sending a request directly (e.g.
//    with Postman or curl), so server-side validation is still required to
//    actually protect the application and its data.
// 3. Example where order matters: for Age, is_numeric() must be checked before
//    comparing $age < 18 or $age > 30, because comparing a non-numeric string
//    with numbers can behave unpredictably; the numeric check must pass first.
?>

</body>
</html>