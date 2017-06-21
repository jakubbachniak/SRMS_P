<?php
class Membership_model extends CI_Model
{
  function validate()
  {
    $this->db->where('staffLogin', $this->input->post('username'));
    $this->db->where('staffPassword', $this->input->post('password')); // MD5 hash it
    $query = $this->db->get('staff');

    if ($query->num_rows() == 1)
    {
      $res = $query->row_array();
      $accessLevel = $res['accessLevel'];
      $username = $res['staffLogin'];
      $staffnum = $res['staffNo'];
      // get details about user and return

      $data = array(
        'al' => $accessLevel,
        'username' => $username,
        'staffnum' => $staffnum,
        'is_logged_in' => true,
      );
      // return true;
      return $data;
    }
  }

  function create_member()
  {
    // if validation passed inside controller
    $new_member_insert_data = array(
      'first_name' => $this->input->post('first_name'),
      'last_name' => $this->input->post('last_name'),
      'email_address' => $this->input->post('email_address'),
      'username' => $this->input->post('username'),
      'password' => $this->input->post('password'), // convert MD5
    );

    $insert = $this->db->insert('membership', $new_member_insert_data);
    return $insert; // true or false
  }
}
 ?>
