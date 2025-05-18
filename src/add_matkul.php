<?php
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mata Kuliah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-950 to-blue-600 flex items-center justify-center p-4 font-sans">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-lg w-full animate-fade-in">
        <h1 class="text-3xl font-bold text-center text-blue-900 mb-6">Tambah Mata Kuliah</h1>
        <form action="process.php" method="POST">
            <input type="hidden" name="action" value="create">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="kode">Kode</label>
                <input type="text" name="kode" id="kode" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="nama">Nama Mata Kuliah</label>
                <input type="text" name="nama" id="nama" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="sks">SKS</label>
                <input type="number" name="sks" id="sks" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" min="1" max="6" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2" for="semester">Semester</label>
                <input type="number" name="semester" id="semester" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" min="1" max="8" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition">Tambah Mata Kuliah</button>
        </form>
        <a href="admin.php" class="block text-center text-blue-600 hover:underline mt-4">Kembali</a>
    </div>
</body>
</html>