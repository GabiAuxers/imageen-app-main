<?php
class ErrorLogger {
    private $db;
    private $errorLogTable;


    public function __construct($db = null, $errorLogTable = 'error_logs') {
        $this->db = $db;
        $this->errorLogTable = $errorLogTable;
        
    }

    public function logError($errorMessage, $additionalInfo = '') {
        if ($this->db !== null) {
            $timestamp = date('Y-m-d H:i:s');

            $query = "INSERT INTO error_logs (timestamp, error_message, additional_info) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            if ($stmt) {
                $stmt->bind_param("sss", $timestamp, $errorMessage, $additionalInfo);
                $stmt->execute();
                $stmt->close();
            } else {
                $this->logErrorToFile('errors.txt', "Error al intentar registrar el error", $this->db->error);
            }
        }
    }
    
    public function logErrorToFile($fileName, $errorMessage, $additionalInfo = '') {
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = $timestamp . " | Error Message: " . $errorMessage . " | Additional Info: " . $additionalInfo . PHP_EOL;
        file_put_contents($fileName, $logMessage, FILE_APPEND | LOCK_EX);
    }
}
?>