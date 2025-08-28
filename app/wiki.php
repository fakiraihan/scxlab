<?php include 'auth.php'; ?>
<?php include '_header.php'; ?>
<h2>Wiki Search</h2>
<form><input name="q"><button>Search</button></form>
<?php
if (isset($_GET['q'])) {
    $q = $_GET['q'];
    
    // Gunakan prepared statement untuk mencegah SQL injection
    $sql = "SELECT * FROM articles WHERE title LIKE ?";
    echo "<p>Searching for: " . htmlspecialchars($q) . "</p>";
    
    $stmt = $GLOBALS['PDO']->prepare($sql);
    $stmt->execute(['%' . $q . '%']);
    
    foreach ($stmt as $row) {
        echo "<li>" . htmlspecialchars($row['title']) . ": " . htmlspecialchars($row['body']) . "</li>";
    }
}
?>
<?php include '_footer.php'; ?>