<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Description of Movement
 *
 * @author a7823
 */
class Movement extends CI_Model {
    // Constructor
    function __construct()
    {
	parent::__construct();
    }
    
    // return all images desc order by post date
    function all()
    {
        $this->db->order_by("Datetime", "asc");
        $query = $this->db->get('movements');
        return $query->result_array();
    }
    
    function newest() 
    {
        $this->db->order_by("Datetime", "asc");
        $this->db->limit(1);
        $codes = $this->db->get('movements');
        $code = $codes->result_array()[0]['Code'];
        $query = $this->db->query('Select * From movements '
                . 'Where Code = "'.$code.'"');
        return $query->result_array();
    }
    
    function selected($code) {
        $query = $this->db->query('Select * from movements Where Code = "'.$code.'"');
        return $query->result_array();
    }
}