<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_pending_review extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');

        $this->load->library('grocery_CRUD');
    }

    public function equipment_pending_review_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/equipment_pending_review_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }


	public function equipment_pending_review()
	{
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1 || $al == 2) {
        $crud = new grocery_CRUD();
	    $crud->set_model('custom_query_model');
	    $crud->set_table('equipment');
	    $crud->basic_model->set_query_str(' SELECT *
											FROM equipment
											WHERE eReviewDate <= NOW() - INTERVAL 3 MONTH;');

	    $crud->unset_operations();


	    $output = $crud->render();

	    $this->equipment_pending_review_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };
	}
}
?>
