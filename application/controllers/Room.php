<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        
        $this->load->library('grocery_CRUD');
    }

    public function room_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/room_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

    public function room()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1) {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('room');
        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapy Rooms'); 
        $crud->columns('roomNo');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('roomNo', 'Therapy Room Number')
            ->display_as('enabled', 'Delete');

        $crud->fields('roomNo', 'enabled');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes - Caution, this will remove entry from the table', 'Y' => 'No'));

        //form validation (could match database columns set to "not null")
        $crud->required_fields('roomNo', 'enabled');

        $crud->where('enabled','Y');

        // Prevent duplicating data
        $crud->unique_fields(array('roomNo'));

        $crud->unset_export();
        $crud->unset_delete();

        $output = $crud->render();

		$this->room_output($output);
         } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };

    }

    public function roomDeleted()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1) {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('room');
                    //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Deleted Therapy Rooms'); 
        $crud->columns('roomNo', 'enabled');
                    //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('roomNo', 'Therapy Room Number')
            ->display_as('enabled', 'Delete');

        $crud->fields('roomNo', 'enabled');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes', 'Y' => 'No - This option will restore data to the database'));

        //form validation (could match database columns set to "not null")
        $crud->required_fields('roomNo', 'enabled');

        $crud->where('enabled','N');

        // Prevent duplicating data
        $crud->unique_fields(array('roomNo'));

        $crud->unset_add();
        $crud->unset_delete();
        $crud->unset_export();

        $output = $crud->render();

        $this->room_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };

    }

}
?>