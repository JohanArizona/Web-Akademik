<?php
require_once 'config/db.php';
try {
    $semesters = $conn->query("SELECT DISTINCT semester FROM mata_kuliah ORDER BY semester")->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    $error = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mata Kuliah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-950 to-blue-600 flex items-center justify-center p-4 sm:p-6 font-sans">
    <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 max-w-5xl w-full animate-fade-in">
        <h1 class="text-2xl sm:text-3xl font-bold text-center text-blue-900 mb-6">Daftar Mata Kuliah</h1>
        <?php if (isset($error)): ?>
            <p class="text-red-500 text-center mb-4 text-sm sm:text-base"><?php echo $error; ?></p>
        <?php endif; ?>
        <div class="flex flex-wrap gap-2 mb-6 overflow-x-auto">
            <?php foreach ($semesters as $sem): ?>
                <button onclick="showTab(<?php echo $sem; ?>)"
                        class="tab-button px-3 sm:px-4 py-1 sm:py-2 rounded-lg font-semibold text-gray-700 bg-gray-100 sm:text-base"
                        id="tab-<?php echo $sem; ?>">
                    Semester <?php echo $sem; ?>
                </button>
            <?php endforeach; ?>
        </div>
        <?php foreach ($semesters as $sem): ?>
            <div id="content-<?php echo $sem; ?>" class="tab-content hidden">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-blue-800 text-white text-sm sm:text-base">
                                <th class="p-3 sm:p-4 text-left rounded-tl-xl">Kode</th>
                                <th class="p-3 sm:p-4 text-left">Nama Mata Kuliah</th>
                                <th class="p-3 sm:p-4 text-left">SKS</th>
                                <th class="p-3 sm:p-4 text-left rounded-tr-xl">Semester</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $stmt = $conn->prepare("SELECT * FROM mata_kuliah WHERE semester = ?");
                                $stmt->execute([$sem]);
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr class='border-b border-gray-200 hover:bg-blue-100 transition text-sm sm:text-base'>";
                                    echo "<td class='p-3 sm:p-4 text-gray-700'>" . htmlspecialchars($row['kode']) . "</td>";
                                    echo "<td class='p-3 sm:p-4 text-gray-700'>" . htmlspecialchars($row['nama']) . "</td>";
                                    echo "<td class='p-3 sm:p-4 text-gray-700'>" . htmlspecialchars($row['sks']) . "</td>";
                                    echo "<td class='p-3 sm:p-4 text-gray-700'>" . htmlspecialchars($row['semester']) . "</td>";
                                    echo "</tr>";
                                }
                            } catch(PDOException $e) {
                                echo "<tr><td colspan='4' class='p-3 sm:p-4 text-center text-red-500 text-sm sm:text-base'>Error: " . $e->getMessage() . "</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="mt-6 text-center">
            <a href="login.php" class="bg-blue-600 text-white px-4 sm:px-6 py-2 rounded-lg hover:bg-blue-700 transition text-sm sm:text-base">Login Admin</a>
        </div>
    </div>
    <script>
        function showTab(semester) {
            document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('bg-blue-800', 'text-white');
                button.classList.add('bg-gray-100');
            });
            document.getElementById(`content-${semester}`).classList.remove('hidden');
            document.getElementById(`tab-${semester}`).classList.remove('bg-gray-100');
            document.getElementById(`tab-${semester}`).classList.add('bg-blue-800', 'text-white');
        }
        if (document.querySelector('.tab-button')) {
            document.querySelector('.tab-button').click();
        }
    </script>
</body>
</html>