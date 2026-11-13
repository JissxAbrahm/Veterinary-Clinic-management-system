
<?php
include "db.php";

$message = "";

if (isset($_POST['submit'])) {

    $pet_id = $_POST['pet_id'];
    $vet_id = $_POST['vet_id'];
    $visit_date = $_POST['visit_date'];
    $reason = $_POST['reason'];

    $sql = "INSERT INTO visit (pet_id, vet_id, visit_date, reason)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $pet_id, $vet_id, $visit_date, $reason);

    if ($stmt->execute()) {
        $message = "Visit added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$pet_result = $conn->query("SELECT * FROM pet");
$vet_result = $conn->query("SELECT * FROM veterinarian");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Veterinary Clinic</title>
</head>

<body>

<h2>Veterinary Clinic - Visit Entry</h2>

<p><?php echo htmlspecialchars($message); ?></p>

<form method="POST">

    <label>Select Pet:</label>
    <select name="pet_id" required>
        <option value="">Select Pet</option>

        <?php while ($pet = $pet_result->fetch_assoc()) { ?>
            <option value="<?php echo $pet['pet_id']; ?>">
                <?php echo htmlspecialchars($pet['pet_name']); ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <label>Select Veterinarian:</label>
    <select name="vet_id" required>
        <option value="">Select Veterinarian</option>

        <?php while ($vet = $vet_result->fetch_assoc()) { ?>
            <option value="<?php echo $vet['vet_id']; ?>">
                <?php echo htmlspecialchars($vet['name']); ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <label>Visit Date:</label>
    <input type="date" name="visit_date" required>

    <br><br>

    <label>Reason:</label>
    <input type="text" name="reason" required>

    <br><br>

    <input type="submit" name="submit" value="Add Visit">

</form>

<br>

<a href="report.php">View Visit Report</a>

</body>
</html>
