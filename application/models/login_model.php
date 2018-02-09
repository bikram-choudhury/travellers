<?php
class Login_model extends CI_Model{
	function login($username,$password)
    {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$this->db->where('is_freeze',0);
		$query=$this->db->get();
		return $query->row();
	}
}