<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapist extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');

        $this->load->library('grocery_CRUD');
    }

    public function therapist_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/therapist_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

    public function therapist()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1) {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapist');
        $crud->set_subject('Therapist'); 

        // replace staff number with name of therapist

        $crud->set_relation('staffNo', 'staff', '{fName} {lName} - {staffNo}', array('enabled' => 'Y'));

        // choose room number from list of rooms available
        $crud->set_relation('roomNo', 'room', 'roomNo', array('enabled' => 'Y'));

        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->columns('staffNo', 'phoneNo', 'roomNo', 'managerNo');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')

        $crud->display_as('staffNo', 'Therapist Id and Name')
            ->display_as('phoneNo', 'Phone Number')
            ->display_as('roomNo', 'Room Number')
            ->display_as('managerNo', 'Manager name')
            ->display_as('enabled', 'Delete');

        $crud->callback_column('therapist.enabled','Y');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes - Caution, this will remove entry from the table', 'Y' => 'No'));
        $crud->field_type('managerNo', 'dropdown', array('SN9230' => 'Arthur Bryant', 'SN0772' => 'Theresa Bailey'));

        $crud->where('therapist.enabled', 'Y');

        $crud->fields('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');

        // Prevent duplicating data
        $crud->unique_fields(array('staffNo'));

        $crud->unset_export();
        $crud->unset_delete();


        $output = $crud->render();

		$this->therapist_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };
    }

    public function therapistReadOnly()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        
        $crud = new grocery_CRUD();

        //Check to see if user is marketing or therapist
        if ($al == 3) {
        $staffNumber = $this->session->userdata('staffnum');
        $crud->where('therapist.staffNo',$staffNumber);
        };

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapist');
        $crud->set_subject('Therapist'); 

        // replace staff number with name of therapist

        $crud->set_relation('staffNo', 'staff', '{fName} {lName} - {staffNo}', array('enabled' => 'Y'));

        // choose room number from list of rooms available
        $crud->set_relation('roomNo', 'room', 'roomNo');

                    //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->columns('staffNo', 'phoneNo', 'roomNo', 'managerNo');
                    //change column heading name for readability ('columm name', 'name to display in frontend column header')

        $crud->display_as('staffNo', 'Therapist Id and Name')
            ->display_as('phoneNo', 'Phone Number')
            ->display_as('roomNo', 'Room Number')
            ->display_as('managerNo', 'Manager ID Number')
            ->display_as('enabled', 'Delete');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes - Caution, this will remove entry from the table', 'Y' => 'No'));
        $crud->field_type('managerNo', 'dropdown', array('SN9230' => 'Arthur Bryant', 'SN0772' => 'Theresa Bailey'));

        $crud->where('therapist.enabled', 'Y');

        //remove add new staff function
        $crud->unset_operations();
        $crud->unset_edit_fields('enabled');


        $output = $crud->render();

        $this->therapist_output($output);
    }

    public function therapistDeleted()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1) {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapist');

        $crud->set_subject('Deleted Therapists'); 

        // replace staff number with name of therapist

        $crud->set_relation('staffNo', 'staff', '{fName} {lName} - {staffNo}', array('enabled' => 'Y'));

        // choose room number from list of rooms available
        $crud->set_relation('roomNo', 'room', 'roomNo');

                    //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->columns('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');
                    //change column heading name for readability ('columm name', 'name to display in frontend column header')

        $crud->display_as('staffNo', 'Therapist Id and Name')
            ->display_as('phoneNo', 'Phone Number')
            ->display_as('roomNo', 'Room Number')
            ->display_as('managerNo', 'Manager ID Number')
            ->display_as('enabled', 'Delete');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes', 'Y' => 'No - This option will restore data to the database'));
        $crud->field_type('managerNo', 'dropdown', array('SN9230' => 'Arthur Bryant', 'SN0772' => 'Theresa Bailey'));

        $crud->where('therapist.enabled', 'N');

        $crud->fields('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');

        // Prevent duplicating data
        $crud->unique_fields(array('staffNo','roomNo'));

        $crud->unset_add();
        $crud->unset_delete();

        $output = $crud->render();

        $this->therapist_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };
    }
}
?>