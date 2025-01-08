<?php
include "db_conn_30.php";

if (isset($_POST['submit'])) {
    $s_num = $_POST['s_number'];
    $s_fn = $_POST['s_fn'];
    $s_mn = $_POST['s_mn'];
    $s_ln = $_POST['s_ln'];
    $s_gender = $_POST['s_gender'];
    $s_bday = $_POST['s_birthday'];
    $s_contact = $_POST['s_contact'];
    $s_street = $_POST['s_street'];
    $s_town = $_POST['s_town'];
    $s_province = $_POST['s_province'];
    $s_zipcode = $_POST['s_zipcode'];

    $conn->begin_transaction();
    try {
        // Insert into students table
        $stmt = $conn->prepare("INSERT INTO students (student_number, first_name, middle_name, last_name, gender, birthday) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $s_num, $s_fn, $s_mn, $s_ln, $s_gender, $s_bday);
        $stmt->execute();

        // Insert into student_details table
        $stmt = $conn->prepare("INSERT INTO student_details (contact_number, street, town, province, zipcode) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $s_contact, $s_street, $s_town, $s_province, $s_zipcode);
        $stmt->execute();

        // Additional insert statements can be added here if needed
        // For example, inserting into another related table

        $conn->commit();
        echo "New transaction added.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Failed to add records: " . $e->getMessage();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student Record</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Link to CSS file -->
</head>
<body>
    <h1>Add Student Record</h1>
    <form action="" method="post">
        <label>Student Number:</label> <input type="text" name="s_number" required><br><br>
        <label>First Name:</label><input type="text" name="s_fn" required><br><br>
        <label>Middle Name:</label><input type="text" name="s_mn"><br><br>                
        <label>Last Name:</label><input type="text" name="s_ln" required><br><br>       
        <label>Gender:</label><input type="text" name="s_gender" required><br><br>          
        <label>Birthday:</label><input type="date" name="s_birthday" required><br><br>      
        <label>Contact Number:</label><input type="text" name="s_contact" required><br><br>    
        <label>Street Name:</label><input type="text" name="s_street" required><br><br>   
        <label>Town Name:</label><input type="text" name="s_town" required><br><br>               
        <label>Province Name:</label><input type="text" name="s_province" required><br><br>
        <label>Zip Code:</label><input type="text" name="s_zipcode" required><br><br>                                
        <button type="submit" name="submit"> Submit </button>
    </form>
</body>
</html>