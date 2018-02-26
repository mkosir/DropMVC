<?php

namespace DroplineMVC\Core;

use PDO;

abstract class Model
{
    // database connection
    protected $db;

    public function __construct(PDO $db = null)
    {
        if (is_null($db)){
            $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8';
            $this->db = new PDO($dsn, DB_USER, DB_PASS);
            // Persistent connection state is not reset before reuse, if script terminates unexpectedly in the middle of
            // database operations, the next request that gets the left over connection will pick up where the dead script left off
            //$this->db = new PDO($dsn, DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true));

            // Throw an exception when a database error occurs
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } else {
            $this->db = $db;
        }
    }
}



// Trying some stuff to create a wrapper for PDO where I realized there isn't too much
// reasons to do it. Just execute raw PDO statements directly.

//abstract class Model
//{
//    protected $db;
//    protected $stmt;
//
//    public function __construct()
//    {
//        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
//        $this->db = new PDO($dsn, DB_USER, DB_PASS);
//        // persistent connection state is not reset before reuse, if script terminates unexpectedly in the middle of
//        // database operations, the next request that gets the left over connection will pick up where the dead script left off
//        //$this->db = new PDO($dsn, DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true));
//
//        // Throw an exception when a database error occurs
//        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    }
//
//    protected function query($query)
//    {
//        $this->stmt = $this->db->prepare($query);
//    }
//
//    /**
//     * Binds the prep statement - bindValue()
//     *
//     * @param $param
//     * @param $variable
//     * @param null $data_type
//     */
//    protected function bindValue($param, $variable, $data_type = null)
//    {
//        if (is_null($data_type)) {
//            switch (true) {
//                case is_int($variable):
//                    $data_type = PDO::PARAM_INT;
//                    break;
//                case is_bool($variable):
//                    $data_type = PDO::PARAM_BOOL;
//                    break;
//                case is_null($variable):
//                    $data_type = PDO::PARAM_NULL;
//                    break;
//                default:
//                    $data_type = PDO::PARAM_STR;
//            }
//        }
//        $this->stmt->bindValue($param, $variable, $data_type);
//    }
//
//    /**
//     * Binds the prep statement for stored procedure - bindParam()
//     *
//     * @param $param
//     * @param $variable
//     * @param null $data_type
//     * @param null $length
//     */
//    protected function bindParam($param, $variable, $data_type = null, $length = null)
//    {
//        if (is_null($data_type)) {
//            switch (true) {
//                case is_int($variable):
//                    $data_type = PDO::PARAM_INT;
//                    break;
//                case is_bool($variable):
//                    $data_type = PDO::PARAM_BOOL;
//                    break;
//                case is_null($variable):
//                    $data_type = PDO::PARAM_NULL;
//                    break;
//                default:
//                    $data_type = PDO::PARAM_STR;
//            }
//        }
//        $this->stmt->bindParam($param, $variable, $data_type, $length);
//    }
//
//    protected function resultSet()
//    {
//        $this->execute();
//        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
//    }
//
//    protected function execute()
//    {
//        $this->stmt->execute();
//    }
//
//    protected function lastInsertId()
//    {
//        return $this->db->lastInsertId();
//    }
//
//    protected function single()
//    {
//        $this->execute();
//        return $this->stmt->fetch(PDO::FETCH_ASSOC);
//    }
//}