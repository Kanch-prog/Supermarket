<?php
class User {
    private $pdo;
    private $username;
    private $email;
    private $password;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Setters
    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // Getters
    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    // Register user
    public function registerUser() {
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");

        $stmt->bindValue(':username', $this->username);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':password', $hashedPassword);

        return $stmt->execute();
    }

    // Authenticate a user
    public function authenticateUser() {
        $stmt = $this->pdo->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bindValue(1, $this->username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Debugging output
            // echo "Stored hash: " . htmlspecialchars($user['password']) . "<br>";
            // echo "Password to verify: " . htmlspecialchars($this->password) . "<br>";
            
            if (password_verify($this->password, $user['password'])) {
                // echo "Password is correct.";
                return $user['id'];
            } else {
                // echo "Password is incorrect.";
            }
        } else {
            // echo "User not found.";
        }
        return false;
    }

    // Check if user is an admin
    public static function isAdmin($username, $password) {
        $adminUsername = 'admin';
        $adminPassword = 'password123'; 

        return ($username === $adminUsername && $password === $adminPassword);
    }

    // Handle session messages
    public static function setSessionMessage($message) {
        $_SESSION['message'] = $message;
    }

    // Clear session data
    public static function clearSession() {
        session_unset();
        session_destroy();
    }
}
?>
