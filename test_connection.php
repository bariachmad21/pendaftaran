<?php
// Function to try connection
function check_connection($password) {
    echo "Testing password: '$password'... ";
    $conn = @mysqli_connect('localhost', 'root', $password);
    if ($conn) {
        echo "SUCCESS! \n";
        return $conn;
    } else {
        echo "FAILED. Error: " . mysqli_connect_error() . "\n";
        return false;
    }
}

echo "Diagnostic Connection Test:\n";
echo "---------------------------\n";

// 1. Test Empty Password
$conn = check_connection("");
if ($conn) {
    // If empty works, setup database
    $sql = file_get_contents('pendaftaran.sql');
    if (mysqli_multi_query($conn, $sql)) {
        echo "Database 'lomba' imported successfully using EMPTY password.\n";
    }
    mysqli_close($conn);
    // Update koneksi.php
    $config = '<?php $host="localhost"; $user="root"; $pass=""; $db="lomba"; $koneksi=mysqli_connect($host,$user,$pass,$db); ?>';
    file_put_contents('koneksi.php', $config);
    exit;
}

// 2. Test User Provided Password
$user_pass = "BARI_ACHMAD217";
$conn = check_connection($user_pass);
if ($conn) {
    // If user pass works, setup database
    $sql = file_get_contents('pendaftaran.sql');
    if (mysqli_multi_query($conn, $sql)) {
        echo "Database 'lomba' imported successfully using password '$user_pass'.\n";
    }
    mysqli_close($conn);
    // Update koneksi.php
    $config = '<?php $host="localhost"; $user="root"; $pass="' . $user_pass . '"; $db="lomba"; $koneksi=mysqli_connect($host,$user,$pass,$db); ?>';
    file_put_contents('koneksi.php', $config);
    exit;
}

echo "\nCONCLUSION:\n";
echo "Both empty password and '$user_pass' were rejected by your MySQL server.\n";
echo "Please verify your MySQL root password in XAMPP config (config.inc.php) or reset it.\n";
?>
