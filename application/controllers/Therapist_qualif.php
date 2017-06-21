<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapist_qualif extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        $this->load->library('grocery_CRUD');
    }

    public function staff_qualif_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/staff_qualif_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

    public function staff_qualif()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        //if ($al == 1) {
        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        $crud->set_table('therapistQualifications');
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapist Qualifications');

        $crud->set_relation('qId', 'qualifications', '{qName} - {qLevel}', array('enabled' => 'Y'));
        $crud->set_relation('staffNo', 'staff', '{staffNo} {fName} {lName}', array('enabled' => 'Y'));
        
        $crud->display_as('staffNo', 'Therapist ID and Name')
            ->display_as('qId', 'Qualification and Level')
            ->display_as('dateQualified', 'Date Qualified')
            ->display_as('qExpiryDdate', 'Qualification Expiry Date')
            ->display_as('enabled', 'Delete');

        $crud->callback_column('therapistQualifications.enabled','Y');
        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes - Caution, this will remove entry from the table', 'Y' => 'No'));

        $crud->where('therapistQualifications.enabled', 'Y');

        // Check to see if qualification has expired. If it has expired flag date in red
        $crud->callback_column('qExpiryDdate',array($this,'_callback_active_state'));

        $crud->columns('staffNo', 'qId', 'dateQualified', 'qExpiryDdate');
        $crud->fields('staffNo', 'qId', 'dateQualified', 'qExpiryDdate', 'enabled');

        $crud->required_fields('staffNo', 'qId', 'dateQualified', 'qExpiryDdate', 'enabled');

        $crud->unset_edit_fields('staffNo');

        $crud->unset_export();
        $crud->unset_delete();

        $output = $crud->render();
		
        $this->staff_qualif_output($output);
        //} else {
        //echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
        //                                                        <script>function goBack() {
        //                                                                window.history.back();
        //                                                                }</script>';
    //};

    }

    public function _callback_active_state($value, $row)
    {
        if ($row->qExpiryDdate < date('Y-m-d')) {
            return "<pre style='background-color: Red; color:white;'>".$row->qExpiryDdate."</pre>
                    <p>URGENT Qulification has expired</p>";
        } if ($row->qExpiryDdate < date('Y-m-d', strtotime('3 months'))) {
            return "<pre style='background-color: #ffc200'>".$row->qExpiryDdate."</pre>
                    <p>Qualification needs review</p>";
        }
        else {
            return $row->qExpiryDdate;
        };

    }

    public function member_qualifications()
    {
        // Loading view home page views, Grocery CRUD Standard Library
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 3) {
        $crud = new grocery_CRUD();

        $staffNumber = $this->session->userdata('staffnum');
        $crud->where('therapistQualifications.staffNo',$staffNumber);

        // read only
        $crud->unset_operations();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapistQualifications');

        $crud->where('therapistQualifications.staffNo',$staffNumber);

        $crud->set_subject('My Qualifications');

        $crud->set_relation('qId', 'qualifications', '{qName} - {qLevel}');
        $crud->set_relation('staffNo', 'staff', '{staffNo} {fName} {lName}');
        
        $crud->display_as('staffNo', 'Therapist ID and Name')
            ->display_as('qId', 'Qualification and Level')
            ->display_as('dateQualified', 'Date Qualified')
            ->display_as('qExpiryDdate', 'Qualification Expiry Date');

        $crud->where('therapistQualifications.enabled', 'Y');

        $crud->columns('staffNo', 'qId', 'dateQualified', 'qExpiryDdate');
        $crud->fields('staffNo', 'qId', 'dateQualified', 'qExpiryDdate');

        $output = $crud->render();

        $this->staff_qualif_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };

    }

    public function staff_qualifReadOnly()
    {
        // Loading view home page views, Grocery CRUD Standard Library
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 2) {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapistQualifications');
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapist Qualifications');

        $crud->set_relation('qId', 'qualifications', '{qName} - {qLevel}');
        $crud->set_relation('staffNo', 'staff', '{staffNo} {fName} {lName}');
            
        $crud->display_as('staffNo', 'Therapist ID and Name')
            ->display_as('qId', 'Qualification and Level')
            ->display_as('dateQualified', 'Date Qualified')
            ->display_as('qExpiryDdate', 'Qualification Expiry Date');

        $crud->columns('staffNo', 'qId', 'dateQualified', 'qExpiryDdate');
        $crud->fields('staffNo', 'qId', 'dateQualified', 'qExpiryDdate');

        // Read Only
        $crud->unset_operations();

        $crud->where('therapistQualifications.enabled', 'Y');

        $output = $crud->render();
            
        $this->staff_qualif_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };

    }

    public function staff_qualifDeleted()
    {
        // Loading view home page views, Grocery CRUD Standard Library
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1) {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        $crud->set_table('therapistQualifications');
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Deleted Therapist & Qualifications');

        $crud->set_relation('qId', 'qualifications', '{qName} - {qLevel}');
        $crud->set_relation('staffNo', 'staff', '{staffNo} {fName} {lName}');
        
        $crud->display_as('staffNo', 'Therapist ID and Name')
            ->display_as('qId', 'Qualification and Level')
            ->display_as('dateQualified', 'Date Qualified')
            ->display_as('qExpiryDdate', 'Qualification Expiry Date')
            ->display_as('enabled', 'Delete');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes', 'Y' => 'No - This option will restore data to the database'));

        $crud->where('therapistQualifications.enabled', 'N');


        // Check to see if qualification has expired. If it has expired flag date in red
        $crud->callback_column('qExpiryDdate',array($this,'_callback_active_state'));

        $crud->columns('staffNo', 'qId', 'dateQualified', 'qExpiryDdate','enabled');
        $crud->fields('staffNo', 'qId', 'dateQualified', 'qExpiryDdate','enabled');

        $crud->unset_add();
        $crud->unset_delete();
        $crud->unset_export();

        $output = $crud->render();
        
        $this->staff_qualif_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };

    }

}
?>