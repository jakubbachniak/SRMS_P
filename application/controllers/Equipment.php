<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        $this->load->library('grocery_CRUD');
    }

    public function check_dates() {
      // will try notifications
    }

    public function equipment_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/equipment_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

    public function equipment()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1 || $al == 2) {
        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('equipment');

        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Equipment');
        $crud->columns('eIdNumber', 'eName', 'eReviewDate', 'eMntValue');

        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('eIdNumber', 'Equipment ID Number')
            ->display_as('eName', 'Equipment Name')
            ->display_as('eReviewDate', 'Review Date')
            ->display_as('enabled', 'Delete')
            ->display_as('eMntValue', 'Maintenance Value');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes - Caution, this will remove entry from the table', 'Y' => 'No'));

        // display dropdown menu for equipment maintenance value
        // allowed values: 'consumable', 'shared'

        $crud->field_type('eMntValue', 'dropdown', array('consumable' => 'consumable', 'shared' => 'shared'));
        
        $crud->where('enabled', 'Y');

        $crud->fields('eIdNumber', 'eName', 'eReviewDate', 'eMntValue', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('eIdNumber', 'eName', 'eReviewDate', 'enabled');

        // Prevent duplicating data
        $crud->unique_fields(array('eIdNumber','eName'));

        // Check to see if qualification has expired. If it has expired flag date in red
        $crud->callback_column('eReviewDate',array($this,'_callback_active_state'));

        $crud->unset_export();
        $crud->unset_delete();

        $output = $crud->render();
		    
        $this->equipment_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };

    }
    //////////////////////////////////////
    // equipment read only method
    //////////////////////////////////////
    public function read_only_equipment()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 3) {
        $crud = new grocery_CRUD();
        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('equipment');
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Equipment');
        $crud->columns('eIdNumber', 'eName', 'eReviewDate');
      
        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('eIdNumber', 'Equipment ID Number')
            ->display_as('eName', 'Equipment Name')
            ->display_as('eReviewDate', 'Review Date');

        $crud->unset_operations();

        $crud->where('enabled', 'Y');

        $output = $crud->render();

        $this->equipment_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };
    }

    public function equipmentDeleted()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1) {
        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('equipment');

        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Deleted Equipment');
        $crud->columns('eIdNumber', 'eName', 'eReviewDate', 'enabled');

                    //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('eIdNumber', 'Equipment ID Number')
            ->display_as('eName', 'Equipment Name')
            ->display_as('eReviewDate', 'Review Date')
            ->display_as('enabled', 'Delete');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes', 'Y' => 'No - This option will restore data to the database'));

        // Provide a visual alert if user selectes delete value Yes
        //$crud->callback_uedit_field('enabled',array($this,'_callback_delete_confirmation'));
        
        $crud->where('enabled', 'N');

        $crud->fields('eIdNumber', 'eName', 'eReviewDate', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('eIdNumber', 'eName', 'eReviewDate', 'enabled');

        // Prevent duplicating data
        $crud->unique_fields(array('eIdNumber','eName'));

        // Check to see if qualification has expired. If it has expired flag date in red
        $crud->callback_column('eReviewDate',array($this,'_callback_active_state'));

        $crud->unset_add();
        $crud->unset_delete();
        $crud->unset_export();

        $output = $crud->render();
            
        $this->equipment_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };
    }

    // Check to see if eReviewDate column is older than today. If it has expired flag date in red
    public function _callback_active_state($value, $row)
    {
        if ($row->eReviewDate < date('Y-m-d')) {
            return "<pre style='background-color: Red; color:white;'>".$row->eReviewDate."</pre>
                    <p>URGENT Equipment review required</p>";
        } if ($row->eReviewDate < date('Y-m-d', strtotime('3 months'))) {
            return "<pre style='background-color: #ffc200'>".$row->eReviewDate."</pre>
                    <p>Equipment review required</p>";
        }
        else {
            return $row->eReviewDate;
        };
    }

    //provide visual alert is user selects yes from the delete dropdown. This is before insert or update
    public function _callback_delete_confirmation($value, $row)
    {
        if ($row->enabled = 'N') {
           return "<pre style='background-color: Red; color:white;'>".$row->eReviewDate."</pre>
                    <p>UREGENT Equipment review required</p>";
        } else {
            return $row->enabled;
        };
    }

}
?>
