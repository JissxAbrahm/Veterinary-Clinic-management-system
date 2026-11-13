
<?php
include "db.php";

$sql = "SELECT
            p.pet_name,
            p.species,
            p.owner_name,
            v.name AS vet_name,
            vi.visit_date,
            vi.reason
        FROM visit vi
        INNER JOIN pet p ON vi.pet_id = p.pet_id
        INNER JOIN veterinarian v ON vi.vet_id = v.vet_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Visit Report</title>
</head>

<body>

<h2>Veterinary Clinic Visit Report</h2>

<table border="1" cellpadding="10">

    <tr>
        <th>Pet Name</th>
        <th>Species</th>
        <th>Owner Name</th>
        <th>Veterinarian</th>
        <th>Visit Date</th>
        <th>Reason</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>

    <tr>
        <td><?php echo htmlspecialchars($row['pet_name']); ?></td>
        <td><?php echo htmlspecialchars($row['species']); ?></td>
        <td><?php echo htmlspecialchars($row['owner_name']); ?></td>
        <td><?php echo htmlspecialchars($row['vet_name']); ?></td>
        <td><?php echo htmlspecialchars($row['visit_date']); ?></td>
        <td><?php echo htmlspecialchars($row['reason']); ?></td>
    </tr>

    <?php } ?>

</table>

<br>

<a href="visit.php">Back to Visit Entry</a>

</body>
</html>
