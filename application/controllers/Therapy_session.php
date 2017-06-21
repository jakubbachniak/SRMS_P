<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapy_session extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');

        $this->load->library('grocery_CRUD');
    }

    public function therapy_session_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/therapy_session_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

    public function therapy_session()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1 || $al == 2) {

        $crud = new grocery_CRUD();

        $crud->where('therapySession.enabled', 'Y');

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapySession');
        $crud->set_subject('Therapy session Archive');

        // replace staff number with name of therapist
        $crud->set_relation('staffNo', 'staff', '{fName} {lName}', array('accessLevel' => '3'));

        // choose room number from list of rooms available
        $crud->set_relation('therapyId', 'therapy', '{therapyName} - {tType}', array('isOffered' => 'Y'));

        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->columns('sessionId', 'therapyId', 'staffNo', 'sDate', 'startTime', 'finishTime');
	    
        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('sessionId', 'Unique Therapy Session Reference')
            ->display_as('therapyId', 'Therapy Name')
            ->display_as('staffNo', 'Therapist Name')
            ->display_as('sDate', 'Therapy Date')
            ->display_as('startTime', 'Therapy Start Time')
            ->display_as('finishTime', 'Therapy Finish Time')
			->display_as('enabled', 'Delete');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes - Caution, this will remove entry from the table', 'Y' => 'No'));


        $crud->fields('sessionId', 'therapyId', 'staffNo', 'sDate', 'startTime', 'finishTime', 'enabled');

        $crud->required_fields('sessionId', 'therapyId', 'staffNo', 'sDate', 'startTime', 'finishTime', 'enabled');

        $crud->unset_delete();
        $crud->unset_export();

        // Prevent duplicating data
        $crud->unique_fields(array('sessionId'));

        $output = $crud->render();

		$this->therapy_session_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
        };
    }

    public function therapy_sessionDeleted()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1) {
        $crud = new grocery_CRUD();

        $crud->where('therapySession.enabled', 'N');

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapySession');
        $crud->set_subject('Deleted Therapy session Archives');

        // replace staff number with name of therapist
        $crud->set_relation('staffNo', 'staff', '{fName} {lName}', array('accessLevel' => '3'));

        // choose room number from list of rooms available
        $crud->set_relation('therapyId', 'therapy', '{therapyName} - {tType}', array('isOffered' => 'Y'));

        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->columns('sessionId', 'therapyId', 'staffNo', 'sDate', 'startTime', 'finishTime', 'enabled');
        
        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('sessionId', 'Therapy Session Reference')
            ->display_as('therapyId', 'Therapy Name')
            ->display_as('staffNo', 'Therapist Name')
            ->display_as('sDate', 'Therapy Date')
            ->display_as('startTime', 'Therapy Start Time')
            ->display_as('finishTime', 'Therapy finishTime')
            ->display_as('enabled', 'Delete');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes', 'Y' => 'No - This option will restore data to the database'));

        $crud->fields('sessionId', 'therapyId', 'staffNo', 'sDate', 'startTime', 'finishTime');
        $crud->edit_fields('sessionId', 'therapyId', 'staffNo', 'sDate', 'startTime', 'finishTime', 'enabled');

        $crud->required_fields('sessionId', 'therapyId', 'staffNo', 'sDate', 'startTime', 'finishTime', 'enabled');

        // Prevent duplicating data
        $crud->unique_fields(array('sessionId'));

        $crud->unset_add();
        $crud->unset_delete();
        $crud->unset_export();

        $output = $crud->render();

        $this->therapy_session_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };
    }

}
?>
