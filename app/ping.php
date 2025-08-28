<?php include 'auth.php'; ?>
<?php include '_header.php'; ?>
<h2>Ping Server</h2>
<form><input name="target"><button>Ping!</button></form>
<?php
if (!isset($_GET['target'])) {
    die("Missing parameter.");
}
    $target = $_GET['target'];
    
    // Validasi input - hanya allow IP address dan hostname yang valid
    if (!filter_var($target, FILTER_VALIDATE_IP) && !preg_match('/^[a-zA-Z0-9.-]+$/', $target)) {
        die("Invalid target. Only IP addresses and valid hostnames allowed.");
    }
    
    // Escape shell arguments untuk mencegah command injection
    $safe_target = escapeshellarg($target);
    echo "<h3>Ping Result for: " . htmlspecialchars($target) . "</h3>";
    $output = shell_exec("ping -c 2 " . $safe_target);
    echo "<pre>" . htmlspecialchars($output) . "</pre>";

?>
<?php include '_footer.php'; ?>