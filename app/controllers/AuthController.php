<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register($data) {
        $errors = [];

        // Validate input
        if (empty($data['name'])) {
            $errors[] = "Name is required";
        }
        if (empty($data['email'])) {
            $errors[] = "Email is required";
        }
        if (empty($data['password'])) {
            $errors[] = "Password is required";
        }
        if ($data['password'] !== $data['confirm_password']) {
            $errors[] = "Passwords do not match";
        }

        // Check if email exists
        if ($this->userModel->findByEmail($data['email'])) {
            $errors[] = "Email already exists";
        }

        if (empty($errors)) {
            if ($this->userModel->create($data['name'], $data['email'], $data['password'])) {
                return ['success' => true, 'message' => 'Registration successful'];
            } else {
                return ['success' => false, 'message' => 'Something went wrong'];
            }
        }

        return ['success' => false, 'errors' => $errors];
    }

    public function login($email, $password) {
        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            return ['success' => true];
        }

        return ['success' => false, 'message' => 'Invalid email or password'];
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit();
    }
}
