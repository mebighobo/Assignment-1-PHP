<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StockController
 *
 * @author a7823
 */
class Stock extends Application{
    //Default landing for the stock page. This loads the stock with newest movements.
    public function index()
    {
        //Grabs the information stored in the database.(stock and stock movements)
        $movements = $this->movement->newest();
        $stocks = $this->stocks->newest();
       
   
        //parse information to the tables layout file
        foreach($stocks as $stock) 
        {
            $stockarr[] = $this->parser->parse('Stocks/stock_table',(array)$stock,true);
        }
        
        //define a class for the table for css use
        $parms = array(
            'table_open' => '<table class="stocks">'
        );
        $this->table->set_template($parms);
        
        //generate column and html content
        $rows = $this->table->make_columns($stockarr,1);
        $this->data['stocktable'] = $this->table->generate($rows);
        
        foreach($movements as $moves)
        {
            $movementarr[] = $this->parser->parse('Stocks/movement_table',(array)$moves,true);
        }
        
        $parm = array (
            'table_open' => '<table class ="movements">'
        );
        
        $this->table->set_template($parm);
            
        $rows_movement = $this->table->make_columns($movementarr,1);
        $this->data['movementtable'] = $this->table->generate($rows_movement);
        
        //define main view for the content and the drop down menu
        $this->data['pageselect'] = Self::populate_options();
        $this->data['pagebody'] = 'Stocks/stockview';
        $this->render();    
    }
    
    //landing page when a specific stock has been passed in the url.
    //loads that particular stock's information and movement history
    function picked_stocks($code) 
    {
        //grab informatino from database.
        
        $movements = $this->movement->selected($code);
        $stocks = $this->stocks->selected($code);
        
        //set table layout and view
        foreach($stocks as $stock) 
        {
            $stockarr[] = $this->parser->parse('Stocks/stock_table',(array)$stock,true);
        }
        
        $parms = array(
            'table_open' => '<table class="stocks">'
        );
        $this->table->set_template($parms);
        
        //generate html elements
        $rows = $this->table->make_columns($stockarr,1);
        $this->data['stocktable'] = $this->table->generate($rows);
        
        foreach($movements as $moves)
        {
            $movementarr[] = $this->parser->parse('Stocks/movement_table',(array)$moves,true);
        }
        
        $parm = array (
            'table_open' => '<table class ="movements">'
        );
        
        $this->table->set_template($parm);
        
        $rows_movement = $this->table->make_columns($movementarr,1);
        $this->data['movementtable'] = $this->table->generate($rows_movement);
        
        //generate drop down menu and tables
        $this->data['pageselect'] = Self::populate_options();
        $this->data['pagebody'] = 'Stocks/stockview';
        $this->render();  
    }
    
    //creates a drop down menu populated with stock codes
    function populate_options()
    {
        
        //make a drop down form and add onclick function to it.
            $this->load->helper('form');
            $entries = $this->stocks->codes();
            $js = 'id="stocklist" onChange="stock_onclick();"';
            $newArr = array();
            $newArr[""] = "Please Select";
            //making a new array to add a null option and better formating
            foreach($entries as $loopArr)
            {
                $temp = $loopArr['Code'];
                $newArr[$temp] = $loopArr['Code'] ;
            }
            return form_dropdown('stock', $newArr,null,$js);
    }
}
