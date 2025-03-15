<?php
class AuthMiddleware {
    private static function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function isAuthenticated() {
        self::startSession();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    }

    public static function isGuest() {
        self::startSession();
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit();
        }
    }

    public static function getUser() {
        self::startSession();
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }
}
