<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Contacts table.
 */
class Stocks extends CI_Model {
    // Constructor
    function __construct()
    {
	parent::__construct();
    }
    
    // return all images desc order by post date
    function all()
    {
        $this->db->order_by("Code", "asc");
        $query = $this->db->get('stocks');
        return $query->result_array();
    }
    
    function newest() 
    {
        $this->db->order_by("Datetime", "asc");
        $this->db->limit(1);
        $codes = $this->db->get('movements');
        $code = $codes->result_array()[0]['Code'];
        $query = $this->db->query('Select * From stocks '
                . 'Where Code = "'.$code.'"');
        return $query->result_array();
    }
    
    function selected($code)
    {
        $query = $this->db->query('Select * from stocks Where Code = "'.$code.'"');
        return $query->result_array();
    }
    
    function codes() {
        $query = $this->db->query("Select Code from stocks");
        return $query->result_array();
    }
}
/* End of file Contacts.php */
/* Location: application/models/Contacts.php */