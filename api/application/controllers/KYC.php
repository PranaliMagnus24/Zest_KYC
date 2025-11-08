<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KYC extends CI_Controller
{
	///Export data logic
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('download'); 
    }

	///export corporate data into excel
	   public function exportCorporateExcel()
{
	   $verified = $this->input->get('verified');
	   $this->load->database();
	   $table = 'kyc';
	   $this->db->select('*');
	   $this->db->from($table);
	   if ($verified === 'yes') {
	       $this->db->where('verified', 'yes');
	   } else {
	       $this->db->where('verified !=', 'yes');
	   }

	   $query = $this->db->get();
	   $data = $query->result_array();

	   $this->_exportToExcel($data, 'corporate_list');
}

//export agent data into excel
public function exportAgentExcel()
{
    $verified = $this->input->get('verified');
    $this->load->database();
    $table = 'agent';
    $this->db->select('*');
    $this->db->from($table);
    if ($verified === 'yes') {
        $this->db->where('verified', 'yes');
    } else {
        $this->db->where('verified !=', 'yes');
    }

    $query = $this->db->get();
    $data = $query->result_array();

    $this->_exportToExcel($data, 'agent_list');
}

// Common helper for Excel output
private function _exportToExcel($data, $filename)
{
    if (empty($data)) {
        echo "No data found.";
        return;
    }

    // Change to CSV format for better hyperlink support
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename={$filename}_" . date('Ymd_His') . ".csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    $output = fopen('php://output', 'w');

    $printHeader = false;
    $serialNumber = 1;
    foreach ($data as $key => $row) {
        if (!$printHeader) {
            // Remove 'id' column and add Serial Number as first column
            $headers = array_keys($row);
            $headers = array_filter($headers, function($header) {
                return $header !== 'id';
            });
            $headers = array_merge(['Sr. No.'], array_map(function($header) {
                return ucwords(str_replace('_', ' ', $header));
            }, $headers));
            fputcsv($output, $headers);
            $printHeader = true;
        }

        // Timezone
        if (isset($row['datetime']) && !empty($row['datetime'])) {
            $datetime = new DateTime($row['datetime'], new DateTimeZone('UTC'));
            $datetime->setTimezone(new DateTimeZone('Asia/Kolkata'));
            $row['datetime'] = $datetime->format('Y-m-d H:i:s');
        }

        // attachement clickable
        foreach ($row as $column => $value) {
            if (strpos($column, 'pan') !== false || strpos($column, 'aadhar') !== false ||
                strpos($column, 'gst') !== false || strpos($column, 'verification_document') !== false) {
                if (!empty($value) && filter_var($value, FILTER_VALIDATE_URL)) {
                    // Create Excel HYPERLINK formula
                    $row[$column] = '=HYPERLINK("' . $value . '","View Document")';
                }
            }
        }

        // Remove 'id' column and add serial number as first column
        unset($row['id']);
        $rowData = array_merge([$serialNumber], array_values($row));
        fputcsv($output, $rowData);
        $serialNumber++;
    }

    fclose($output);
}


    public function get_KYC_data()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->get_KYC_data();
    }
    public function get_agent_KYC_data()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->get_agent_KYC_data();
    }
    public function get_KYC()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->get_KYC();
    }
    public function get_agent_KYC()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->get_agent_KYC();
    }
    public function get_filter_KYC()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->get_filter_KYC();
    }
    public function get_filter_agent_KYC()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->get_filter_agent_KYC();
    }
    public function addCredit()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->addCredit();
    }
    public function addagentCredit()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->addagentCredit();
    }
    public function addKYC()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->addKYC();
    }
    public function addagentKYC()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->addagentKYC();
    }
    public function updateKYC()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->updateKYC();
    }
    public function updateagentKYC()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->updateagentKYC();
    }
    public function get_credit_data()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->get_credit_data();
    }
    public function get_agent_credit_data()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->get_agent_credit_data();
    }
    public function create_pdf()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->create_pdf();
    }
    public function create_agent_pdf()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->create_agent_pdf();
    }
    public function download_pdf()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->download_pdf();
    }
    public function get_kyc_form_data()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->get_kyc_form_data();
    }
    public function create_token()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->create_token();
    }
    public function validateToken()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->validateToken();
    }
    
    public function get_token_list()
    {
        $this->load->model('KYCModel');
        return $this->KYCModel->get_token_list();
    }

}
?>
