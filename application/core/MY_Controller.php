<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author a7823
 */
class Application extends CI_Controller { 
    protected $data = array();
    
    function __construct()
    {
	parent::__construct();
	$this->data = array();
        $this->load->helper(array('common', 'url')); 
	$this->data['pagetitle'] = 'PHP Assignment Group 7';
    }
    
    function render() {
       // $this->data['header'] = $this->load->view('_header','',true);
        //$this->data['footer'] = $this->load->view('_footer','',true);
        
	$this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
	$this->data['data'] = &$this->data;
	$this->parser->parse('_template', $this->data);
    }
    //put your code here
}
