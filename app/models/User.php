<?php

namespace DroplineMVC\Models;

use DroplineMVC\Core\Model;
use DroplineMVC\Utils\Messages;
use DroplineMVC\Utils\HTTP;
use DroplineMVC\Utils\Validation;
use PDO;

class User extends Model
{
    public function addUser(array $data): array
    {
        // Validate data
        $textArray = $this->validateAddUser($data);
        if (!empty($textArray)) {
            Messages::setMsg('', \MSG::USER_ERROR, $textArray);
            return array(\ModelReturnStatus::FAILURE_VALIDATION, null);
        }

        //$password = \DroplineMVC\Utils\Password::create('sha256', ($post['password']), HASH_KEY);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        // Insert new user into database
        $stmt = $this->db->prepare('CALL Users_AddUser(?, ?, ?)');
        $stmt->bindParam(1, $data['name'], PDO::PARAM_STR, 255);
        $stmt->bindParam(2, $data['email'], PDO::PARAM_STR, 255);
        $stmt->bindParam(3, $password, PDO::PARAM_STR, 255);
        $status = $stmt->execute();

        if ($status) {
            // Statement execution status - success
            return array(\ModelReturnStatus::SUCCESS, null);
        } else {
            // Statement execution status - failure
            return array(\ModelReturnStatus::FAILURE_GENERAL, null);
        }

//        // In stored procedure added line at the end "SELECT LAST_INSERT_ID();"
//        $rowLastInsertId = $stmt->fetch(PDO::FETCH_ASSOC);
//
//        return $rowLastInsertId['LAST_INSERT_ID()'];


//            $stmt = $this->db->prepare('INSERT INTO Users (name, email, password) VALUES(:name, :email, :password)');
//            $stmt->bindValue(':name', $post['name']);
//            $stmt->bindValue(':email', $post['email']);
//            $stmt->bindValue(':password', $password);
//            $stmt->execute();
//
//          // Doesn't work well with stored procedures
//          // Verify - Get back "id" parameter from the database
//          if ($this->db->lastInsertId()) {
//              Messages::setMsg('User ' . $post['name'] . ' successfully created.', MSG_USER_SUCCESS_MSG);
//              // Redirect to login page if user is successfully created
//              HTTP_Header::redirectTo(ROOT_URL . 'users/login');
//          }
    }

    private function validateAddUser($data): array
    {
        $textArray =[];

        if (Validation::stringEmpty($data['name'])) {
            $textArray[] = 'Please fill in Name field.';
        }
        if (Validation::stringEmpty($data['email'])) {
            $textArray[] = 'Please fill in Email field.';
        }
        if (Validation::stringEmpty($data['password'])) {
            $textArray[] = 'Please fill in Password field.';
        }
        if ($this->getUserByName($data['name'])[0] === \ModelReturnStatus::SUCCESS) {
            $textArray[] = 'User \'' . $data['name'] . '\' already exists.';
        }
        if ($this->getUserByEmail($data['email'])[0] === \ModelReturnStatus::SUCCESS) {
            $textArray[] = 'Email \'' . $data['email'] . '\' already exists.';
        }
        return $textArray;
    }

    public function getUserByName(string $username): array
    {
        // Get user from database
        $stmt = $this->db->prepare('CALL Users_GetUserByName(?)');
        $stmt->bindParam(1, $username, PDO::PARAM_STR, 255);
        $status = $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($status and $row) {
            // Statement execution status - success
            return array(\ModelReturnStatus::SUCCESS, $row);
        } else {
            // Statement execution status - failure
            return array(\ModelReturnStatus::FAILURE_GENERAL, null);
        }
    }

    public function getUserByEmail(string $email): array
    {
        // Validate data
        if (Validation::stringEmpty($email)) {
            Messages::setMsg('Please fill in all fields.', \MSG::USER_ERROR);
            return array(\ModelReturnStatus::FAILURE_VALIDATION, null);
        }

//            $stmt = $this->db->prepare('SELECT * FROM Users WHERE email = :email');
//            $stmt->bindValue(':email', $post['email']);
//            $stmt->execute();
//            $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Get user from database
        $stmt = $this->db->prepare('CALL Users_GetUserByEmail(?)');
        $stmt->bindParam(1, $email, PDO::PARAM_STR, 255);
        $status = $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($status and $row) {
            // Statement execution status - success
            return array(\ModelReturnStatus::SUCCESS, $row);
        } else {
            // Statement execution status - failure
            return array(\ModelReturnStatus::FAILURE_GENERAL, null);
        }
    }
}