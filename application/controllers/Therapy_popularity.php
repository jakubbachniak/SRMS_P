<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapy_popularity extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');

        $this->load->library('grocery_CRUD');
    }

    public function therapy_popularity_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/therapy_popularity_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

    public function therapy_popularity()
    {
        $al = $this->session->userdata('al');
        //Checking if user has permission to view table
        if ($al == 1 || $al == 2) {
        $crud = new grocery_CRUD();
        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapypopularity');
        $crud->set_primary_key('Therapy');
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Popularity');
        $crud->unset_operations();

        $output = $crud->render();

        $this->therapy_popularity_output($output);
        } else {
        echo '<p>You don\'t have permission to view this page</p> <button class="btn btn-default"onclick="goBack()">Go Back</button>
                                                                <script>function goBack() {
                                                                        window.history.back();
                                                                        }</script>';
    };
    }

}
?>
