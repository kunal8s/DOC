


<?php
$name = $_POST['fullname'];
$dob = $_POST['dateofbirth'];
$telephone = $_POST['number'];
$email = $_POST['email'];
$password = $_POST['password'];

var_dump($_POST);

$conn = new mysqli('localhost', 'root', 'pappuCAN09@', 'SIGN_UP');

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    // Adjust SQL query to match form fields
    $stmt = $conn->prepare("INSERT INTO registration (fullName, dateOfBirth, email, phoneNumber, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $dob, $email, $telephone, $password);
    
    $execval = $stmt->execute();
    
    if ($execval) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
