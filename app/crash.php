<?php include 'auth.php'; ?>
<?php include '_header.php'; ?>
<h2>Crash Test</h2>
<?php
$factor = $_GET['factor'] ?? 1;

// Validasi input dan cegah division by zero
if (!is_numeric($factor) || $factor == 0) {
    echo "Error: Invalid factor. Please provide a non-zero number.";
} else {
    $result = 100 / $factor; 
    echo "100 / " . htmlspecialchars($factor) . " = " . $result;
}
?>
<?php include '_footer.php'; ?>