<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$conn = new mysqli('localhost', 'root', 'root123', 'loginpage');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, email, name, surname, gender, dob, tel FROM users WHERE id='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No user found";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        
        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .sidebar {
            max-width: 80%;
            height: 80vh;
            padding: 30px;
            background-color: #f4f4f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f4f4f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .user-info p {
            font-size: 18px;
            margin-bottom: 20px 0;

        }

        .user-info span {
            font-weight: bold;
            color: black;
            font-size: 24px;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0,0,0,0.05);
            width: 500px;
            display: inline-block; 

        }

        .user-info {
            margin-top: 20px;
            margin-bottom: 20px;
            color: black;
        }

        .btn-logout {
            display: block;
            width: 75%;
            margin: auto;
            text-align: center;
            padding: 10px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
        }

        .btn-logout:hover {
            background-color: brown;
        }

        .grid-container {
            display: grid;
            grid-template-columns: 25% auto;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="grid-container">
    <div class="sidebar">
        <h2>Welcome</h2>
        <h1><?php echo $row['username']; ?></h1>
        <a class="btn-logout" href="logout.php">Logout</a>
    </div>
    <div class="user-info">
            <p>Username</p>
            <span><?php echo $row['username']; ?></span>
            <p>Email</p>
            <span><?php echo $row['email']; ?></span>
            <p>Fullname</p>
            <span><?php echo $row['name']. ' ' . $row['surname']; ?></span> 
            <p>Gender</p>
            <span><?php echo $row['gender']; ?></span> 
            <p> Date of Birth</p>
            <span><?php echo $row['dob']; ?></span> 
            <p>Tel.</p>
            <span><?php echo $row['tel']; ?></span> 
        </div>
    </div>


    <?php include 'footer.php'; ?>
</body>
</html>