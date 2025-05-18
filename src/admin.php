<?php
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mata Kuliah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-950 to-blue-600 flex items-center justify-center p-4 sm:p-6 font-sans">
    <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 max-w-5xl w-full animate-fade-in">
        <h1 class="text-2xl sm:text-3xl font-bold text-center text-blue-900 mb-6">Kelola Mata Kuliah</h1>
        <div class="flex flex-col sm:flex-row justify-between items-center mb-4 space-y-2 sm:space-y-0">
            <a href="logout.php"
            class="inline-block px-4 py-2 bg-red-100 text-red-600 font-semibold rounded-lg hover:bg-red-200 transition text-sm sm:text-base">
            Logout
            </a>
            <a href="add_matkul.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm sm:text-base">Tambah Mata Kuliah</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-blue-800 text-white text-sm sm:text-base">
                        <th class="p-3 sm:p-4 text-left rounded-tl-xl">Kode</th>
                        <th class="p-3 sm:p-4 text-left">Nama Mata Kuliah</th>
                        <th class="p-3 sm:p-4 text-left">SKS</th>
                        <th class="p-3 sm:p-4 text-left">Semester</th>
                        <th class="p-3 sm:p-4 text-left rounded-tr-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $stmt = $conn->query("SELECT * FROM mata_kuliah ORDER BY semester, kode");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr class='border-b border-gray-200 hover:bg-blue-100 transition text-sm sm:text-base'>";
                            echo "<td class='p-3 sm:p-4 text-gray-700'>" . htmlspecialchars($row['kode']) . "</td>";
                            echo "<td class='p-3 sm:p-4 text-gray-700'>" . htmlspecialchars($row['nama']) . "</td>";
                            echo "<td class='p-3 sm:p-4 text-gray-700'>" . htmlspecialchars($row['sks']) . "</td>";
                            echo "<td class='p-3 sm:p-4 text-gray-700'>" . htmlspecialchars($row['semester']) . "</td>";
                            echo "<td class='p-3 sm:p-4'>";
                            echo "<a href='process.php?action=edit&kode=" . urlencode($row['kode']) . "' class='text-blue-600 hover:underline mr-2'>Edit</a>";
                            echo "<a href='process.php?action=delete&kode=" . urlencode($row['kode']) . "' class='text-red-600 hover:underline' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } catch(PDOException $e) {
                        echo "<tr><td colspan='5' class='p-3 sm:p-4 text-center text-red-500 text-sm sm:text-base'>Error: " . $e->getMessage() . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>