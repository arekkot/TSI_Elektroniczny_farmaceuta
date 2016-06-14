<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_model extends MY_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function search( $search_string )
	{

		$this->db->select( '*' );
		$this->db->from( 'ads' );
		$this->db->like( 'subject' , $search_string );
		$this->db->like( 'marka' , $search_string );
		$this->db->or_like( 'marka' , $search_string );
		$this->db->or_like( 'description' , $search_string );
		
		$q = $this->db->get();
		return $q->result();
	}

	public function filter( $table , $where , $where_filter )
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

		foreach ( $where_filter as $key => $value )
		{

			if ( !empty( $value ) )
			{
				$this->db->where( array( $key => $value ) );
			}
			
		}

		
		$q = $this->db->get( $table );
		return $q->result();
	}

}

/* End of file Site_model.php */
/* Location: ./application/models/Site_model.php */