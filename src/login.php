<?php
session_start();
require_once 'config/db.php';
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-950 to-blue-600 flex items-center justify-center p-4 sm:p-6 font-sans">
    <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 max-w-sm w-full animate-fade-in">
        <h1 class="text-2xl sm:text-3xl font-bold text-center text-blue-900 mb-6">Login Admin</h1>
        <?php if (isset($error)): ?>
            <p class="text-red-500 text-center mb-4 text-sm sm:text-base"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST" class="space-y-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2 text-sm sm:text-base" for="username">Username</label>
                <input type="text" name="username" id="username" class="w-full p-2 sm:p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2 text-sm sm:text-base" for="password">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 sm:p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-2 sm:p-3 rounded-lg hover:bg-blue-700 transition text-sm sm:text-base">Login</button>
        </form>
    </div>
</body>
</html>