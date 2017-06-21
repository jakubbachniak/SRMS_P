<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapy extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        
        $this->load->library('grocery_CRUD');
    }

    public function therapy_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/therapy_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

    public function therapy()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1 || $al == 2) {
        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapy');

        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapy'); 
        $crud->columns('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered');
        	   
        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('therapyId', 'Unique Therapy ID Number')
            ->display_as('therapyName', 'Therapy Name')
            ->display_as('tCategory', 'Therapy Category')
            ->display_as('tType', 'Therapy Type')
            ->display_as('tReviewDate', 'Therapy Review Date')
            ->display_as('isOffered', 'Therapy Available')
            ->display_as('enabled', 'Deleted');

        $crud->callback_column('therapy.enabled','Y');

        $crud->fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered','enabled');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes - Caution, this will remove entry from the table', 'Y' => 'No'));

        // provide dropdown list menu to choose therapy category
        // either 'health' or 'beauty'

        $crud->field_type('tCategory', 'dropdown', array('health' => 'health', 'beauty'=> 'beauty'));

        // provide dropdown list menu to choose therapy type
        // either 'individual' or group
        $crud->field_type('tType', 'dropdown', array('individual'=> 'individual', 'group' => 'group'));

        $crud->where('enabled', 'Y');
        
        $crud->field_type('isOffered', 'dropdown', array('Y' => 'Yes', 'N' => 'No'));

        $crud->where('isOffered', 'Y'); // Only show available therapies. Archived therapies available from another view

        // Prevent duplicating data
        $crud->unique_fields(array('therapyId', 'therapyName'));

        $crud->unset_export();
        $crud->unset_delete();

        $output = $crud->render();
        
		$this->therapy_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };

    }

    ////////////////////////////////
    // read only therapy view method
    ////////////////////////////////

    public function read_only_therapy()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 3) {
        $crud = new grocery_CRUD();
        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapy');
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapy');

        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('therapyId', 'Therapy ID Number')
            ->display_as('therapyName', 'Therapy')
            ->display_as('tCategory', 'Therapy Category')
            ->display_as('tType', 'Therapy Type')
            ->display_as('tReviewDate', 'Therapy Review Date')
            ->display_as('isOffered', 'Therapy Available')
            ->display_as('enabled', 'Delete');

        $crud->columns('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered');


        $crud->where('enabled', 'Y');

        $crud->where('therapy.isOffered', 'Y'); // Only show available therapies. Archived therapies available from another view

        $crud->unset_operations();

        // Prevent duplicating data
        $crud->unique_fields(array('therapyId', 'therapyName'));

        $output = $crud->render();

        $this->therapy_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };
    }


    public function archived_therapy()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1 || $al == 2) {
        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapy');
                    //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Deleted Therapies'); 
        $crud->columns('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered');
               
        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('therapyId', 'Therapy ID Number')
            ->display_as('therapyName', 'Therapy')
            ->display_as('tCategory', 'Therapy Category')
            ->display_as('tType', 'Therapy Type')
            ->display_as('tReviewDate', 'Therapy Review Date')
            ->display_as('isOffered', 'Therapy Available')
            ->display_as('enabled', 'Delete');

        $crud->fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered', 'enabled');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes - Caution, this will remove entry from the table', 'Y' => 'No'));

        $crud->where('enabled', 'Y');
        
        // When adding Present radial button to archive yes or no
        $crud->callback_add_field('isOffered',function () {
                return  '<form>
                        <input type="radio" value="Y" name="isOffered" id="isOfferedY" checked
                             if (isset($_POST["isOffered"]) && $_POST["isOffered"] == "Y"): endif; /> Yes
                        <input type="radio" value="N" name="isOffered" id="isOfferedN" checked
                             if (isset($_POST["isOffered"]) && $_POST["isOffered"] == "N"): endif; /> No
                        </form>';
                    });

        // When adding Present radial button to archive yes or no
        $crud->callback_edit_field('isOffered',function () {
                return  '<form>
                        <input type="radio" value="Y" name="isOffered" id="isOfferedY" checked
                             if (isset($_POST["isOffered"]) && $_POST["isOffered"] == "Y"): endif; /> Yes
                        <input type="radio" value="N" name="isOffered" id="isOfferedN" checked
                             if (isset($_POST["isOffered"]) && $_POST["isOffered"] == "N"): endif; /> No
                        </form>';
                    });

        $crud->where('isOffered', 'N'); // Only show available therapies. Archived therapies available from another view

        $crud->unset_add();
        $crud->unset_delete();
        $crud->unset_export();

        $output = $crud->render();
        
        $this->therapy_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };
    }

    public function therapyDeleted()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1) {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapy');

        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapy'); 
        $crud->columns('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered');
               
        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('therapyId', 'Therapy ID Number')
            ->display_as('therapyName', 'Therapy')
            ->display_as('tCategory', 'Therapy Category')
            ->display_as('tType', 'Therapy Type')
            ->display_as('tReviewDate', 'Therapy Review Date')
            ->display_as('isOffered', 'Therapy Available')
            ->display_as('enabled', 'Deleted');

        $crud->fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered','enabled');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes', 'Y' => 'No - This option will restore data to the database'));

        $crud->where('enabled', 'N');
        
        $crud->field_type('isOffered', 'dropdown', array('Y' => 'Yes', 'N' => 'No'));

        // Prevent duplicating data
        $crud->unique_fields(array('therapyId', 'therapyName'));

        $crud->unset_add();
        $crud->unset_delete();
        $crud->unset_export();

        $output = $crud->render();
        
        $this->therapy_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };
    }

}
?>