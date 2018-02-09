<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main_model extends CI_Model {
    
	function multiple_insert($table_name,$data)
	{
		$this->db->insert_batch($table_name, $data); 
		return $this->db->insert_id();
	}

	function insert_table($table_name,$data)
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}
	
 	public function update_table($tablename,$data,$where)
    {
   	 	$this->db->where($where);
		$this->db->update($tablename,$data);	
		return $this->db->affected_rows();
    }
    public function update_table_with_return_affected_row($tablename,$data,$where){
 		$this->db->where($where);
		$this->db->update($tablename,$data);
		return $this->db->affected_rows();
	}
   	public function delete_table($tablename){
		$this->db->truncate($tablename);
		return $this->db->affected_rows();
	}
	public function empty_table($tablename){
		$this->db->empty_table($tablename); 
		return $this->db->affected_rows();
	}
   public function delete_row_from_table($tablename,$where)
   {   	
		$this->db->delete($tablename,$where);	
		return $this->db->affected_rows();
   }

	public function run_manual_query($query)
	{
		$query=$this->db->query($query);
		
	}
	public function run_manual_query_with_return_nof_affected_rows($query)
	{
		$query=$this->db->query($query);
		return $this->db->affected_rows();
	}	
    public function run_manual_query_with_return($query)
	{
		$query=$this->db->query($query);
		return $query->result();
	}
	function run_manual_query_return_result($query)
	{
		$query=$this->db->query($query);
		return $query->result();
	}
	public function run_manual_query_with_return_row($query)
	{
		$query=$this->db->query($query);
		return $query->row();
	}
	public function run_manual_query_with_return_array($query)
	{
		$query=$this->db->query($query);
		return $query->result_array();
	}
	
	
	function get_all_branches()
    {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type','branch'); 
		$this->db->where('is_deleted','0');
		$query = $this->db->get();
		return $query->result();
	}	
	function get_all_hubs()
    {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type','hub'); 
		$query = $this->db->get();
		return $query->result();
	}	
	function get_cities_area_pin($cities)
	{
		$this->db->select('*');
		$this->db->from('cities');
		$this->db->where('city_name',$cities); 
		$query = $this->db->get();
		return $query->result();
	}
	function get_suppliers($huid)
	{
		$this->db->select('*');
		$this->db->from('suppliers');
		$this->db->where('hub_user_id',$huid); 
		$query = $this->db->get();
		return $query->result();
	}
	
	//-----------------INDENT DETAILS-----------------------------		
	function get_item_unit($iid)
	{
		$this->db->select('item_unit,full_item_unit');
		$this->db->from('items');
		$this->db->where('item_id',$iid); 
		$query = $this->db->get();
		return $query->row(); 
	}	
	function get_suppliers_item_uid($iid,$huid)
	{
		$this->db->select('si.supplier_id,s.supplier_id,s.sup_name,i.item_unit,i.full_item_unit');
		$this->db->distinct();
		$this->db->from('supplier_item si');
		$this->db->where('si.item_id',$iid); 
		$this->db->where('si.hub_user_id',$huid); 
		$this->db->join('suppliers s', 's.supplier_id = si.supplier_id');
		$this->db->join('items i', 'i.item_id = si.item_id');
		$query = $this->db->get();
		return $query->result();
	}
	//------------------------------LIVE_STOCK_TABLE-------------------------------------------
	 function Insert_hubs($dd)
	{
		$this->db->insert('users', $dd);
		return $this->db->insert_id(); 
		
	}
	
	 function Insert_branches($dd)
	{
		$this->db->insert('users', $dd); 
		return $this->db->insert_id();
	}
	
	function insert_into_table($data,$table_name)
	{
		$this->db->insert($table_name, $data); 
		return $this->db->insert_id();
	}
	 
	function Insert_manager($dd)
	{
		$this->db->insert('users', $dd); 
		return $this->db->insert_id();
	}
	function Insert_suppliers($dd)
	{
		$this->db->insert('suppliers', $dd); 
		return $this->db->insert_id();
	}
	
	function check_username($un)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username',$un); 
		$query = $this->db->get();
		return $query->row();
	}
	function check_code($un)
	{
		$this->db->select('*');
		$this->db->from('items');
		$this->db->where('item_code',$un); 
		$query = $this->db->get();
		return $query->row();
	}
	function select_from_where($select,$from,$where,$order_by='')
	{
		$this->db->select($select);
		$this->db->from($from);
		$this->db->where($where);
		if($order_by!=''){
		$this->db->order_by($order_by,'desc');
	
		}
				$query=$this->db->get();
		return $query->result();
	}
	
	function select_from_where_ROW($select,$from,$where)
	{
		$this->db->select($select);
		$this->db->from($from);
		$this->db->where($where);
		$query=$this->db->get();
		return $query->row();
	}
	function select_from_where_result($select,$from,$where)
	{
		$this->db->select($select);
		$this->db->from($from);
		$this->db->where($where);
		$query=$this->db->get();
		return $query->result();
	}
	function getAllOutlets(){

$this->db->select('*');
$this->db->from('users');

$this->db->where('user_type','branch');
$query = $this->db->get();
return $query->result();
}

function get_data_where_return_result($where,$table_name,$select)
{
    $this->db->select($select);
	$this->db->from($table_name);
	$this->db->where($where);
	$q=$this->db->get();
	return $q->result();
}
	function  get_data_where_return_result_limit($where,$table_name,$select,$offset)
{
    $this->db->select($select);
	$this->db->from($table_name);
	$this->db->where($where);
    $this->db->limit($offset);
	$q=$this->db->get();
	return $q->result();
}	
	
	function login($un,$pw)
    {
		$this->db->select('*');
		$this->db->from('register');
		$this->db->where('username',$un);
		$this->db->where('password',$pw);
		$query=$this->db->get();
		return $query->row();	
	
	}


	public function select_authentication($append)
{
	$this->db->select('*');
	$this->db ->from('loginuser');
	$this->db->where($append);
	$log=$this->db->get();
	return $log->row();
	
}
	public function loyalty()
	{
		    $this->db->select('*');
			$this->db->from('loyalty_master');
			$query = $this->db->get();  
            return $query->row();		
}
	function insert_toloyalty($data)
{
$this->db->insert('loyalty_master', $data);
}
	

	function insert_todummy($data)
{
$this->db->insert('1dummy', $data);

} 
	public function Delete_loyalty($query)
	{
		$this->db->query($query);
	}
	public function run_manual_query_row_count($query)
	{
		$query=$this->db->query($query);
		return $query->num_rows();
	}
	
	
	public function run_manual_query_with_row($query)
	{
		$query=$this->db->query($query);
		return $query->row();
	}
	
	function get_cities()
    {
		$this->db->select('city_name,city_id');
		$this->db->distinct();
		$this->db->from('cities');
		$query = $this->db->get();
		return $query->result();
	}
}
?>