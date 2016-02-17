<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Contacts table.
 */
class Transactions extends CI_Model {
    // Constructor
    function __construct()
    {
	parent::__construct();
    }
    
    // return all images desc order by post date
    function all()
    {
        $this->db->order_by("DateTime", "asc");
        $query = $this->db->get('transactions');
        return $query->result_array();
    }
    
    public function get_all_by_player($which)
    {

            $sql = "SELECT * FROM transactions WHERE Player = ?"; 

            $query = $this->db->query($sql, array($which));
            if($query->num_rows() > 0)
                return $query->result_array();
            
            return null;

		
	}
    
    //return last 3 newest images
   /* function newest()
    {
        $this->db->order_by("id", "desc");
        $this->db->limit(3);
        $query = $this->db->get('images');
        return $query->result_array();
    }*/
}
/* End of file Contacts.php */
/* Location: application/models/Contacts.php */