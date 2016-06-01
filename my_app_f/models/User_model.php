<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

  public function __construct(){
    parent::__construct();
    $this->load->library('encrypt');
  }
  public function create_user(){
	$data = array('username'=>$this->input->post('username'),
					'password'=>MD5($this->input->post('password')),
					'nama'=>$this->input->post('nama'),
					'email'=>$this->input->post('email'),
					'ttl'=>$this->input->post('Tahun')."-".$this->input->post('Bulan')."-".$this->input->post('Hari') ,
					'level'=>0
					);
	$this->db->insert('user',$data);
  } 	
  public function login($user, $pass){
    
    $this->db->select('username, password, level, nama');
    $this->db->where('username', $user);
    $query = $this->db->get('user');
    
    if($query = $query->result_array()[0])
      if($pass == $this->encrypt->decode($query['password']) )
        return $query;
    return 0;
  }

}

