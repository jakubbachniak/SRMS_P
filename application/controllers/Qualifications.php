<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualifications extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');

        $this->load->library('grocery_CRUD');
    }

    public function qualifications_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/qualifications_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

    public function qualifications()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1) {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('qualifications');

        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Qualifications');
        $crud->columns('qId', 'qName', 'qLevel', 'qAccBody');

        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('qId', 'Qualification ID Number')
            ->display_as('qName', 'Qualification')
            ->display_as('qAccBody', 'Accrediting Body')
            ->display_as('enabled', 'Delete');

        $crud->where('enabled', 'Y');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes - Caution, this will remove entry from the table', 'Y' => 'No'));

        // provide dropdown list menu to choose values for qulifications level
        // due to constraint on values in database:
        // 'basic', 'intermediate', 'advanced'
        $crud->field_type('qLevel', 'dropdown', array('basic' => 'basic', 'intermediate' => 'intermediate', 'advanced' => 'advanced'));

        $crud->fields('qId', 'qName', 'qLevel', 'qAccBody', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('qId', 'qName', 'qLevel', 'qAccBody', 'enabled');

        // Prevent duplicating data
        $crud->unique_fields(array('qId','qName'));

        $crud->unset_export();
        $crud->unset_delete();

        $output = $crud->render();

		$this->qualifications_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };

    }

    public function qualificationsDeleted()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1) {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('qualifications');

        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Deleted Qualifications');
        $crud->columns('qId', 'qName', 'qLevel', 'qAccBody', 'enabled');

        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('qId', 'Qualification ID Number')
            ->display_as('qName', 'Qualification')
            ->display_as('qAccBody', 'Accrediting Body')
            ->display_as('enabled', 'Delete');

        $crud->where('enabled', 'N');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes', 'Y' => 'No - This option will restore data to the database'));

        $crud->fields('qId', 'qName', 'qLevel', 'qAccBody', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('qId', 'qName', 'qLevel', 'qAccBody', 'enabled');

        $crud->unset_add();
        $crud->unset_delete();
        $crud->unset_export();

        // Prevent duplicating data
        $crud->unique_fields(array('qId','qName'));

        $output = $crud->render();

        $this->qualifications_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };

    }

}
?>
