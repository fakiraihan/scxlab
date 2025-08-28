<?php
include 'auth.php';

class Profile {
    public $username;
    public $isAdmin = false;

    function __toString() {
        return "User: {$this->username}, Role: " . ($this->isAdmin ? "Admin" : "User");
    }
}

if (!isset($_COOKIE['profile'])) {
    die("Profile cookie tidak ditemukan. Silakan login ulang.");
}

// Validasi deserialization - gunakan session instead untuk security
if (!isset($_SESSION['user']) || !isset($_SESSION['role'])) {
    die("Invalid session. Please login again.");
}

// Buat profile object dari session data (lebih aman)
$profile = new Profile($_SESSION['user'], $_SESSION['role'] === 'admin');

// jika admin, boleh hapus user lain
if ($profile->isAdmin && isset($_POST['delete_user'])) {
    $target = $_POST['delete_user'];
    
    // Gunakan prepared statement untuk mencegah SQL injection
    $stmt = $GLOBALS['PDO']->prepare("DELETE FROM users WHERE username=?");
    $stmt->execute([$target]);
    $msg = "<p style='color:green'>User <b>" . htmlspecialchars($target) . "</b> berhasil dihapus!</p>";
}

include '_header.php';
?>
<h2>Profile Page</h2>
<p><?php echo $profile; ?></p>

<?php if ($profile->isAdmin): ?>
  <h3>Admin Panel</h3>
  <form method="post">
    <label>Delete user:
      <select name="delete_user">
        <?php
        $users = $GLOBALS['PDO']->query("SELECT username FROM users");
        foreach ($users as $u) {
            if ($u['username'] !== $profile->username) {
                echo "<option value='{$u['username']}'>{$u['username']}</option>";
            }
        }
        ?>
      </select>
    </label>
    <button type="submit">Delete</button>
  </form>
  <?php if (!empty($msg)) echo $msg; ?>
<?php else: ?>
  <p style="color:red">You are a regular user. You do not have admin panel access.</p>
<?php endif; ?>

<?php include '_footer.php'; ?>