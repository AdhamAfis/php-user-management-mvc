<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function index() {
        AuthMiddleware::isAuthenticated();
        return $this->userModel->getAll();
    }

    public function update($id, $data) {
        AuthMiddleware::isAuthenticated();
        
        error_log('Update called with ID: ' . $id . ' and data: ' . json_encode($data));
        $errors = [];
        if (empty($data['name'])) {
            $errors[] = "Name is required";
        }
        if (empty($data['email'])) {
            $errors[] = "Email is required";
        }

        if (empty($errors)) {
            if ($this->userModel->update($id, $data)) {
                error_log('User updated successfully');
                return ['success' => true, 'message' => 'User updated successfully'];
            }
            error_log('Failed to update user');
            return ['success' => false, 'message' => 'Failed to update user'];
        }

        error_log('Validation errors: ' . json_encode($errors));
        return ['success' => false, 'errors' => $errors];
    }

    public function delete($id) {
        AuthMiddleware::isAuthenticated();
        
        if ($this->userModel->delete($id)) {
            return ['success' => true, 'message' => 'User deleted successfully'];
        }
        return ['success' => false, 'message' => 'Failed to delete user'];
    }

    public function getUserById($id) {
        AuthMiddleware::isAuthenticated();
        return $this->userModel->findById($id);
    }
}
