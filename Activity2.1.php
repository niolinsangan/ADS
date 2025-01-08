<?php
include "conn.php";

// 1. Table 1 - All records from customers who are living in one specific city.
echo "All records from customers who are living in one specific city.";
$sql1 = "SELECT id, company, CONCAT(first_name, ' ', last_name) AS full_name, job_title, business_phone, fax_number, address, city, state_province, zip_postal_code, country_region FROM customers WHERE city = 'boston';";
$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr><th>ID</th><th>Company</th><th>Full Name</th><th>Job Title</th><th>Business Phone</th><th>Fax Number</th><th>Address</th><th>City</th><th>State/Province</th><th>Zip/Postal Code</th><th>Country/Region</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["company"] . "</td>";
        echo "<td>" . $row["full_name"] . "</td>";
        echo "<td>" . $row["job_title"] . "</td>";
        echo "<td>" . $row["business_phone"] . "</td>";
        echo "<td>" . $row["fax_number"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["city"] . "</td>";
        echo "<td>" . $row["state_province"] . "</td>";
        echo "<td>" . $row["zip_postal_code"] . "</td>";
        echo "<td>" . $row["country_region"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}
?>

<a href="add.php">ADD NEW RECORD</a>
