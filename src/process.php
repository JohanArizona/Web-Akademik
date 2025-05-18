<?php
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit;
}
$action = $_GET['action'] ?? $_POST['action'] ?? '';
if ($action === 'create') {
    $kode = $_POST['kode'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $sks = $_POST['sks'] ?? '';
    $semester = $_POST['semester'] ?? '';
    if ($kode && $nama && $sks && $semester) {
        try {
            $stmt = $conn->prepare("INSERT INTO mata_kuliah (kode, nama, sks, semester) VALUES (?, ?, ?, ?)");
            $stmt->execute([$kode, $nama, $sks, $semester]);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    header("Location: admin.php");
    exit;
}
if ($action === 'edit') {
    $kode = $_GET['kode'] ?? '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_kode = $_POST['kode'] ?? '';
        $nama = $_POST['nama'] ?? '';
        $sks = $_POST['sks'] ?? '';
        $semester = $_POST['semester'] ?? '';
        if ($new_kode && $nama && $sks && $semester) {
            try {
                $stmt = $conn->prepare("UPDATE mata_kuliah SET kode = ?, nama = ?, sks = ?, semester = ? WHERE kode = ?");
                $stmt->execute([$new_kode, $nama, $sks, $semester, $kode]);
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            header("Location: admin.php");
            exit;
        }
    }
    $stmt = $conn->prepare("SELECT * FROM mata_kuliah WHERE kode = ?");
    $stmt->execute([$kode]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        header("Location: admin.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Kuliah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-950 to-blue-600 flex items-center justify-center p-4 font-sans">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-lg w-full animate-fade-in">
        <h1 class="text-3xl font-bold text-center text-blue-900 mb-6">Edit Mata Kuliah</h1>
        <form action="process.php?action=edit&kode=<?php echo urlencode($kode); ?>" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="kode">Kode</label>
                <input type="text" name="kode" id="kode" value="<?php echo htmlspecialchars($row['kode']); ?>" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="nama">Nama Mata Kuliah</label>
                <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="sks">SKS</label>
                <input type="number" name="sks" id="sks" value="<?php echo htmlspecialchars($row['sks']); ?>" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" min="1" max="6" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2" for="semester">Semester</label>
                <input type="number" name="semester" id="semester" value="<?php echo htmlspecialchars($row['semester']); ?>" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" min="1" max="8" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition">Simpan Perubahan</button>
        </form>
        <a href="admin.php" class="block text-center text-blue-600 hover:underline mt-4">Kembali</a>
    </div>
</body>
</html>
<?php } ?>
<?php
if ($action === 'delete') {
    $kode = $_GET['kode'] ?? '';
    if ($kode) {
        try {
            $stmt = $conn->prepare("DELETE FROM mata_kuliah WHERE kode = ?");
            $stmt->execute([$kode]);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    header("Location: admin.php");
    exit;
}
?>