<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends Application 
{
    
	public function index()
	{
            $players = $this->players->all_with_equity();
            $stocks = $this->stocks->all();
        
            foreach($players as $player) 
            {
                $playerarr[] = $this->parser->parse('Homepage/player_table',(array)$player,true);
            }
            
            foreach($stocks as $stock) 
            {
                $stockarr[] = $this->parser->parse('Homepage/stock_table',(array)$stock,true);
            }
        
            $parms = array('table_open' => '<table class="players">'
            );
            $this->table->set_template($parms);

            $rows = $this->table->make_columns($playerarr,1);
            $this->data['playertable'] = $this->table->generate($rows);

            $parm = array (
                'table_open' => '<table class ="stocks">'
            );

            $this->table->set_template($parm);

            $rows_stock = $this->table->make_columns($stockarr,1);
            $this->data['stocktable'] = $this->table->generate($rows_stock);

            $this->data['pagebody'] = 'Homepage/homeview';
            $this->render();    
	}
}


	