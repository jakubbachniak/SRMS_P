<?php
class Therapist_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_therapists($name = FALSE)
  {
    if ($name === FALSE)
    {
      $query = $this->db->get('staff');
      return $query->result_array();
    }

    // no need for else statement, above returns if $name is FALSE
    $query = $this->db->get_where('staff', array('staffLogin' => $name));
    return $query->row_array();
  }


  public function add_therapist($data)
  {
    return $this->db->insert('therapists', $data);
  }


  public function delete_therapist($name)
  {
    $this->db->where('therapists', $name);
  }

}
