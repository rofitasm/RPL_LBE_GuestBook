<html>
<head>
    <title>Add Users</title>
</head>

<body>
    <a href="index.php">Go to Home</a>
    <br/><br/>

    <form action="add.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr> 
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr> 
                <td>Alamat</td>
                <td><input type="text" name="alamat"></td>
            </tr>
            <tr>
                <td>Kota</td>
                <td><input type="text" name="kota"></td>
            </tr>
            <tr>
                <td>Pesan</td>
                <td><input type="text" name="pesan"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>

    <?php

    // Check If form submitted, insert form data into users table.
    if(isset($_POST['Submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['alamat'];
        $city = $_POST['kota'];
        $msg = $_POST['pesan'];

        // include database connection file
        include_once("condb.php");

        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO guestbook(name,email,address,city,msg) VALUES('$name','$email','$address','$city','$msg')");

        // Show message when user added
        echo "User added successfully. <a href='index.php'>View Users</a>";
    }
    ?>
</body>
</html>