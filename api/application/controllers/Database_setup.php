<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Database_setup extends CI_Controller
{
    public function check_and_update_token_table()
    {
        $this->load->database();
        
        // Check if remark column exists
        $fields = $this->db->list_fields('token');
        
        if (!in_array('remark', $fields)) {
            // Add remark column if it doesn't exist
            $this->db->query('ALTER TABLE token ADD COLUMN remark TEXT');
            echo "Remark column added successfully";
        } else {
            echo "Remark column already exists";
        }
        
        // Show current table structure
        echo "\nCurrent token table structure:\n";
        $query = $this->db->query('DESCRIBE token');
        foreach ($query->result() as $row) {
            echo $row->Field . " - " . $row->Type . "\n";
        }
    }
}
?>
