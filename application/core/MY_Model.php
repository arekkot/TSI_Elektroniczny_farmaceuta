<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function create( $table , $data )
	{
		$this->db->insert( $table , $data );
	}

	public function get( $table , $where = false )
	{
		if ( $where == true )
		{

			$where_value = current( $where );
			$key = array_search( $where_value , $where );

			if ( is_array( $where_value ) )
			{
				$this->db->where_in( $key , $where_value );
			}
			else
			{
				$this->db->where( $where );
			}

		}
		
		$q = $this->db->get( $table );
		return $q->result();
	}

	public function get_single( $table , $where )
	{
		$this->db->where( $where );
		$q = $this->db->get( $table );
		return $q->row();
	}

	public function update( $table , $where , $data )
	{
		$this->db->where( $where );
		$this->db->update( $table , $data );
	}

	public function delete( $table , $where )
	{
		$this->db->where( $where );
		$this->db->delete( $table );
	}

	public function last_id()
	{
		return $this->db->insert_id();
	}

}

/* End of file MY_Model.php */
/* Location: ./application/models/MY_Model.php */