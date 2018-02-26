<?php

namespace DroplineMVC\Models;

use DroplineMVC\Core\Model;
use DroplineMVC\Utils\Messages;
use DroplineMVC\Utils\HTTP;
use DroplineMVC\Utils\Validation;
use PDO;

class Drop extends Model
{
    public function getWordsDropsTitles($numOfLastTitlesLimit): array
    {
        // Get drop by id
        $stmt = $this->db->prepare('CALL Drops_GetWordsDropsTitles(?)');
        $stmt->bindParam(1, $numOfLastTitlesLimit, PDO::PARAM_INT, 11);
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

    public function getDrops(): array
    {
//        $stmt = $this->db->prepare(
//            'SELECT Drops.id, Users.name, Drops.title, Drops.body, Drops.link, Drops.create_date
//                  FROM Drops INNER JOIN Users
//                  ON Drops.user_id = Users.id
//                  ORDER BY Drops.create_date DESC;');
//        $stmt->execute();
//        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get all drops
        $stmt = $this->db->prepare('CALL Drops_GetAllWithUsername()');
        $status = $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($status and $rows) {
            // Statement execution status - success
            return array(\ModelReturnStatus::SUCCESS, $rows);
        } else {
            // Statement execution status - failure
            return array(\ModelReturnStatus::FAILURE_GENERAL, null);
        }
    }

    public function getDrop($id): array
    {
        // Get drop by id
        $stmt = $this->db->prepare('CALL Drops_GetDropByIdWithUsername(?)');
        $stmt->bindParam(1, $id, PDO::PARAM_INT, 11);
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

    public function deleteDrop($drop_id, $current_user_id): array
    {
        // Validate data
        $drop_user_id = $this->getDrop($drop_id)[1]['user_id'];
        if ($current_user_id !== $drop_user_id) {
            Messages::setMsg('You can only delete drops you have created!', \MSG::USER_ERROR);
            return array(\ModelReturnStatus::FAILURE_VALIDATION, null);
        }

        $stmt = $this->db->prepare('CALL Drops_DeleteDropById(?)');
        $stmt->bindParam(1, $drop_id, PDO::PARAM_INT, 11);
        $status = $stmt->execute();

        if ($status) {
            // Statement execution status - success
            return array(\ModelReturnStatus::SUCCESS, null);
        } else {
            // Statement execution status - failure
            return array(\ModelReturnStatus::FAILURE_GENERAL, null);
        }
    }

    public function addDrop(array $data): array
    {
        // Validate data
        if (Validation::stringEmpty($data['title']) || Validation::stringEmpty($data['body']) || Validation::stringEmpty($data['link'])) {
            Messages::setMsg('Please Fill In All Fields', \MSG::USER_ERROR);
            return array(\ModelReturnStatus::FAILURE_VALIDATION, null);
        }

        // Insert
        $stmt = $this->db->prepare('CALL Drops_AddDrop(?, ?, ?, ?)');
        $stmt->bindParam(1, $data['title'], PDO::PARAM_STR, 255);
        $stmt->bindParam(2, $data['body'], PDO::PARAM_LOB);
        $stmt->bindParam(3, $data['link'], PDO::PARAM_STR, 255);
        $stmt->bindParam(4, $_SESSION['user_data']['id'], PDO::PARAM_INT, 11);
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


//        $stmt = $this->db->prepare('INSERT INTO Drops (title, body, link, user_id) VALUES(:title, :body, :link, :user_id)');
//        $stmt->bindParam(':title', $post['title']);
//        $stmt->bindParam(':body', $post['body']);
//        $stmt->bindParam(':link', $post['link']);
//        $stmt->bindParam(':user_id', $_SESSION['user_data']['id']);
//        $stmt->execute();
//
//        // Doesn't work well with stored procedures
//        // Verify - Get back "id" parameter from the database
//        if ($this->db->lastInsertId()) {
//            // Redirect
//            HTTP::headerRedirectTo(ROOT_URL . 'drops');
//        }
    }

    public function updateDrop($id, array $data): array
    {
        // Validate data
        if (Validation::stringEmpty($data['title']) || Validation::stringEmpty($data['body']) || Validation::stringEmpty($data['link'])) {
            Messages::setMsg('Please Fill In All Fields', \MSG::USER_ERROR);
            return array(\ModelReturnStatus::FAILURE_VALIDATION, null);
        }

        // Update
        $stmt = $this->db->prepare('CALL Drops_EditDropById(?, ?, ?, ?, ?)');
        $stmt->bindParam(1, $id, PDO::PARAM_INT, 11);
        $stmt->bindParam(2, $data['title'], PDO::PARAM_STR, 255);
        $stmt->bindParam(3, $data['body'], PDO::PARAM_LOB);
        $stmt->bindParam(4, $data['link'], PDO::PARAM_STR, 255);
        $stmt->bindParam(5, $_SESSION['user_data']['id'], PDO::PARAM_INT, 11);
        $status = $stmt->execute();

        // number of rows affected
        //$count = $stmt->rowCount();

        if ($status) {
            // Statement execution status - success
            return array(\ModelReturnStatus::SUCCESS, null);
        } else {
            // Statement execution status - failure
            return array(\ModelReturnStatus::FAILURE_GENERAL, null);
        }
    }
}