<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapy_equipment extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        $this->load->library('grocery_CRUD');
    }

    public function therapy_equipment_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/therapy_equipment_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

    public function therapy_equipment()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1 || $al == 2) {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database to read data from
        $crud->set_table('therapyEquipment');

        // replace Primary key and Foreign key values with therapy name and equipment name

        $crud->set_relation('therapyId', 'therapy', 'therapyName', array('enabled' => 'Y'));
        $crud->set_relation('eIdNumber', 'equipment', 'eName', array('enabled' => 'Y'));
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapy Equipment');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes - Caution, this will remove entry from the table', 'Y' => 'No'));

        $crud->where('therapyEquipment.enabled', 'Y');

        // display user friendly columns
        $crud->display_as('therapyId', 'Therapy')
            ->display_as('eIdNumber', 'Equipment')
            ->display_as('enabled', 'Deleted');
        // specify what columns appear in the view
        $crud->columns('eIdNumber', 'therapyId');
        $crud->required_fields('eIdNumber', 'therapyId', 'enabled');

        $crud->callback_column('therapyEquipment.enabled','Y');

        $crud->unset_export();
        $crud->unset_delete();

        $output = $crud->render();

		$this->therapy_equipment_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };

    }

    public function therapy_equipmentDeleted()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1) {
        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database to read data from
        $crud->set_table('therapyEquipment');

        // replace Primary key and Foreign key values with therapy name and equipment name

        $crud->set_relation('therapyId', 'therapy', 'therapyName');
        $crud->set_relation('eIdNumber', 'equipment', 'eName');
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Deleted Therapy Equipment');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes', 'Y' => 'No - This option will restore data to the database'));

        $crud->where('therapyEquipment.enabled', 'N');

        // display user friendly columns
        $crud->display_as('therapyId', 'Therapy')
            ->display_as('eIdNumber', 'Equipment')
            ->display_as('enabled', 'Deleted');
        // specify what columns appear in the view
        $crud->columns('eIdNumber', 'therapyId', 'enabled');

        $crud->unset_add();
        $crud->unset_delete();
        $crud->unset_export();

        $output = $crud->render();

        $this->therapy_equipment_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };

    }

}
?>