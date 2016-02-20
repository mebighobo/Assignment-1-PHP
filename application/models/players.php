<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Contacts table.
 */
class Players extends CI_Model {
    // Constructor
    function __construct()
    {
	parent::__construct();
	//$this->setTable('contacts', 'ID');
    }
    
    // return all images desc order by post date
    function all()
    {

        $this->db->order_by("Player", "asc");
        $query = $this->db->get('players');
        return $query->result_array();
        
    }
    
    
    
    function all_with_equity()
    {
        $players = $this->players->all();
        
        $playerarr = array();
        
        foreach($players as $player)
        {
            $item = array('Player' => $player['Player'],
                          'Cash'   => $player['Cash'], 
                          'Equity' => (
                                        ($this->players->get_equity($player['Player'])
                                        + 
                                        $player['Cash']
                                        )
                                      )
                         );
            
            
            array_push($playerarr, $item);
        }
        
        
        return $playerarr;
    } 
    
    public function get($which)
    {

        $sql = "SELECT * FROM players WHERE Player = ?"; 
           
        $query = $this->db->query($sql, array($which));
        $row = $query->row_array();

        return $row;
        //return null;
    }
    
    
    public function get_equity($player)
    {
        $equity = 0;
        $sql  = "SELECT t.Stock, t.Quantity, t.Trans "
                        ."FROM transactions t "
                        ."WHERE t.Player = '"  
                        .$player
                        ."'";
        
        $query_rows = $this->db->query($sql)->result_array();

        foreach($query_rows as $row)
        {
            $stock_value = ($this->transactions->get_stock_value($row['Stock']))
                           *
                           $row['Quantity'];
            
            if($row['Stock'] == "buy")
            {
                $equity += $stock_value;
            }
            else
            {
                $equity -= $stock_value;
            }
        }
        
        return $equity;
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
