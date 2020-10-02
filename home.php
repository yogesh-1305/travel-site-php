<?php
    $insert = false;
    if(isset($_POST['name'])){
        $server = "localhost";
        $username = "root";
        $password = "";

        $connection = mysqli_connect($server, $username, $password);

        if(!$connection){
            die(mysqli_connect_error());
        }
        // echo "Success connecting to the server";
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = test_input($_POST["name"]);
            $age = test_input($_POST["age"]);
            $phone = test_input($_POST["phone"]);
            $email = test_input($_POST["email"]);
            $source = test_input($_POST["source"]);
            $destination = test_input($_POST["destination"]);
        }
        $sql = "INSERT INTO `travellerdetails`.`trip2` (`Name`, `age`, `phone`, `email`, `souce`, `destination`, `date of entry`)
        VALUES ('$name', '$age', '$phone', '$email', '$source', '$destination', current_timestamp());";

        if($connection->query($sql) == true){
            $insert = true;
        }else{
            // echo '<script>alert("Error")</script>';
            $insert = false;
        }
        $connection->close();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <img class="bg" src="bg.jpg" alt="background">
    <script src="home.js"></script>
    <div class="container">
        <h1>Welcome to xyz Tours and Travels</h1>
        <p>Please fill out the below form to proceed with the booking.</p>


        <!-- The $_SERVER["PHP_SELF"] is a super global variable that returns the filename of the currently executing script.
        So, the $_SERVER["PHP_SELF"] sends the submitted form data to the page itself, instead of jumping to a different page. 
        This way, the user will get error messages on the same page as the form. 
    
        The htmlspecialchars() function converts special characters to HTML entities. 
        This means that it will replace HTML characters like < and > with &lt; and &gt;. 
        This prevents attackers from exploiting the code by injecting HTML or 
        Javascript code (Cross-site Scripting attacks) in forms.-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="text" name="name" id="name" placeholder="Enter your Name">
            <input type="text" name="age" id="age" placeholder="Enter your age">
            <input type="phone" name=phone id="phone" placeholder="Enter your Phone Number">
            <input type="email" name="email" id="email" placeholder="Enter your email">
            <input type="text" name="source" id="source" placeholder="Enter Source Station Name">
            <input type="text" name="destination" id="destination" placeholder="Enter Destination Name">
            <button class="btn">Submit</button>
        </form>
    </div>
</body>
</html>



