<?php

class Login extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    // $this->load->model('therapist_model');
    $this->load->helper('url_helper');
    $this->load->helper('html');
    $this->load->helper('form');
    $this->load->library('session');

  }

  function index()
  {
    $data['user'] = null;
    $data['al'] = null;
    $data['output'] = null;
    $data['title'] = 'Login';
    $data['main_content'] = 'login/login_form';
    $this->load->view('includes/template', $data);
  }

  // Uses the membership_model to access user data
  // and validate. Here we have the access level and
  // can respond accordinly.
  function validate_credentials()
  {
    $this->load->model('membership_model');
    $query = $this->membership_model->validate();

    if ($query['al'] == 1)
    {
      $data = $query;
      $this->session->set_userdata($data);
      redirect('site/admin_level');
    }

    elseif ($query['al'] > 1)
    {
      $data = $query;
      $this->session->set_userdata($data);
      redirect('site/members_area');
    }
    else {
      $this->index();
    }
  }

  function signup()
  {
    $data['main_content'] = 'login/signup_form';
    $this->load->view('includes/template', $data);
  }

  function create_member()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
    $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');

    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[32]');
    // $this->form_validation->set_rules('password2', 'Password2', 'trim|required|matches[password]');

    if ($this->form_validation->run() == FALSE)
    {
      $this->signup();
    }
    else
    {
      $this->load->model('membership_model');
      if ($query = $this->membership_model->create_member())
      {
        $data['main_content'] = 'login/signup_success';
        $this->load->view('includes/template', $data);
      }
      else {
        $this->load->view('login/signup_form');
      }
    }
  }

}

?>
