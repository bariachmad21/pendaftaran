<?php
// Function to try connection and execute SQL
function try_setup($password) {
    echo "Mencoba koneksi dengan password: '$password'...\n";
    
    // Suppress warnings for connection attempts
    $conn = @mysqli_connect('localhost', 'root', $password);
    
    if ($conn) {
        echo "BERHASIL terhubung dengan password: '$password'\n";
        
        // Read SQL file
        $sqlCountent = file_get_contents(__DIR__ . '/pendaftaran.sql');
        
        // Execute multi query
        if (mysqli_multi_query($conn, $sqlCountent)) {
            do {
                // Consume all results
                if ($result = mysqli_store_result($conn)) {
                    mysqli_free_result($result);
                }
            } while (mysqli_next_result($conn));
            
            echo "Database dan Tabel BERHASIL dibuat!\n";
            return true;
        } else {
            echo "Gagal menjalankan SQL: " . mysqli_error($conn) . "\n";
            return false;
        }
    } else {
        echo "Gagal terhubung: " . mysqli_connect_error() . "\n";
        return false;
    }
}

// List of common passwords to try
$passwords = ['', 'root', '123456', 'password', 'admin'];
$success_password = null;

foreach ($passwords as $pass) {
    if (try_setup($pass)) {
        $success_password = $pass;
        break;
    }
}

if ($success_password !== null) {
    // Update koneksi.php with the correct password
    $koneksi_content = "<?php
\$host = \"localhost\";
\$user = \"root\";
\$pass = \"$success_password\";
\$db   = \"lomba\";

\$koneksi = mysqli_connect(\$host, \$user, \$pass, \$db);

if (!\$koneksi) {
    die(\"Koneksi Menghubungkan Gagal: \" . mysqli_connect_error());
}
?>";
    file_put_contents(__DIR__ . '/koneksi.php', $koneksi_content);
    echo "File koneksi.php telah diperbarui dengan password yang benar.\n";
} else {
    echo "Semua percobaan password gagal. Mohon cek konfigurasi MySQL Anda secara manual.\n";
}
?>
