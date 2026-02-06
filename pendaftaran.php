<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debug Log Function
function log_debug($msg) {
    file_put_contents('debug_system.txt', date("Y-m-d H:i:s") . " - " . $msg . "\n", FILE_APPEND);
}

log_debug("Script pendaftaran.php started.");

include 'koneksi.php';

if (!$koneksi) {
    log_debug("DB Connection Failed: " . mysqli_connect_error());
    die("Koneksi gagal");
}
log_debug("DB Connection Success");

if (isset($_POST['daftar'])) {
    log_debug("Form submitted");

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $gender = $_POST['gender'];
    $lomba = $_POST['lomba'];
    $sekolah = $_POST['sekolah'];
    $whatsapp = $_POST['whatsapp'];
    $alamat = $_POST['alamat'];

    log_debug("Data to insert: $nama, $email, $whatsapp");

    // Insert data ke database
    $query = "INSERT INTO pendaftaranlomba (nama, email, tgl_lahir, gender, lomba, sekolah, whatsapp, alamat) 
              VALUES ('$nama', '$email', '$tgl_lahir', '$gender', '$lomba', '$sekolah', '$whatsapp', '$alamat')";
    
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        log_debug("Database Insert Success");

        // Kirim Pesan WhatsApp dengan Fonnte
        $token = "XHeg2u3e4DSj7eu8HfMr";
        $target = $whatsapp; 
        // Pesan yang dikirim
        $pesan = "Halo *$nama*,\n\n" .
                 "Selamat! Pendaftaran Anda berhasil diterima.\n\n" .
                 "*Detail Pendaftaran:*\n" .
                 "• Nama: $nama\n" .
                 "• Email: $email\n" .
                 "• Tgl Lahir: $tgl_lahir\n" .
                 "• Gender: $gender\n" .
                 "• Kategori Lomba: *$lomba*\n" .
                 "• Asal Sekolah: $sekolah\n" .
                 "• Alamat: $alamat\n\n" .
                 "Panitia akan segera menghubungi Anda untuk info selanjutnya.\n" .
                 "Terima Kasih & Semangat Berkarya! 🚀";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $target,
                'message' => $pesan,
                'countryCode' => '62', 
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
            // FIX: Disable SSL verification for XAMPP localhost
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $curl_error = curl_error($curl);
        curl_close($curl);

        log_debug("WA API Response: $response");
        log_debug("WA API Error: $curl_error");

        // Alert sukses dan redirect
        echo "<script>
            alert('Pendaftaran Berhasil! Cek debug_system.txt jika WA tidak masuk.');
            window.location.href = 'index.php';
        </script>";
    } else {
        log_debug("Database Insert Failed: " . mysqli_error($koneksi));
        echo "<script>
            alert('Pendaftaran Gagal Database: " . mysqli_error($koneksi) . "');
            window.location.href = 'index.php';
        </script>";
    }
} else {
    log_debug("POST['daftar'] not set");
    header("Location: index.php");
}
?>
