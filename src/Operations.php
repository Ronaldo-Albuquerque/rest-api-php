<?php

namespace Src;

class Operations{
    private $db;
    private $requestMethod;

    public function __construct($db, $requestMethod)    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
    }

    public function processRequest()    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getAllRecords();
                break;
            case 'POST':
                $response = $this->notFoundResponse();
                break;
            case 'PUT':
                $response = $this->notFoundResponse();
                break;
            case 'DELETE':
                $response = $this->notFoundResponse();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllRecords()    {
        $query = "
            SELECT 
                movement.name as movement, 
                user.name,
                personal_record.value,
                personal_record.date
            FROM movement
                JOIN personal_record ON movement.id=personal_record.movement_id
                JOIN user ON personal_record.user_id=user.id
            ORDER BY personal_record.value DESC;
        ";

        try {
            $statement = $this->db->query($query);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function notFoundResponse()    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
