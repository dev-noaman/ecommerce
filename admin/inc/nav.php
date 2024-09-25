<?php
require_once 'config.php';

// Check if a session hasn't been started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$loginError = '';

// Simple login logic
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Secure login using prepared statements and password hashing
    $stmt = $connection->prepare("SELECT * FROM User WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $loginError = "Invalid email or password";
        }
    } else {
        $loginError = "Invalid email or password";
    }
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . BASE_URL . "admin/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drophut Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>
<body>
    <nav class="bg-white shadow-lg" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="<?php echo BASE_URL . "admin/index.php"; ?>" class="text-xl font-bold text-gray-800">Drophut Store</a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <span class="text-gray-800">Welcome, <?php echo $_SESSION['user_name']; ?></span>
                        <a href="?logout=true" class="text-gray-800 hover:text-gray-600">Logout</a>
                    <?php else: ?>
                        <button @click="open = true" class="text-gray-800 hover:text-gray-600">Login</button>
                    <?php endif; ?>
                </div>
                <div class="-mr-2 flex md:hidden">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-800 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="md:hidden" x-show="open" x-cloak>
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#" class="text-gray-800 hover:text-gray-600 block px-3 py-2 rounded-md text-base font-medium">Home</a>
            </div>
        </div>
    </nav>


</body>
</html>
