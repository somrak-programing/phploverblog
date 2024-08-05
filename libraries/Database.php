<?php

ob_start();
class Database
{
    public $host = DB_HOST;
    public $username = DB_USER;
    public $password = DB_PASS;
    public $db_name = DB_NAME;

    public $link;
    public $error;

    /**
     *  Class Constructor
     */
    public function __construct()
    {
        // Start output buffering
        ob_start();
        // Call Connect Function
        $this->connect();
    }

    /**
     *  Connector
     */
    private function connect()
    {
        $this->link = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if (!$this->link) {
            $this->error = "Connection Failed: " . $this->link->connect_error;
            return false;
        }
    }

    /**
     *  Select
     */
    public function select($query)
    {
        $result = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     *  Insert
     */
    public function insert($query)
    {
        $insert_row = $this->link->query($query) or die($this->link->error . __LINE__);

        // Validate Insert
        return $insert_row;
    }

    /**
     *  Update
     */
    public function update($query)
    {
        $update_row = $this->link->query($query) or die($this->link->error . __LINE__);

        // Validate Update
        return $update_row;
    }

    /**
     *  Delete
     */
    public function delete($query)
    {
        $delete_row = $this->link->query($query) or die($this->link->error . __LINE__);

        // Validate Delete
        return $delete_row;
    }
}
