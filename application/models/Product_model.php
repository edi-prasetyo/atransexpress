<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_product()
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
}
