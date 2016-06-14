<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ad_categories extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view( 'admin/ad_categories/index' );
	}

	public function create()
	{


		if ( !empty( $_POST ) )
		{

			if ( $_POST['alias'] == '' )
			{
				$_POST['alias'] = alias( $_POST['name'] );
			}
			else
			{
				$_POST['alias'] = alias( $_POST['alias'] );
			}

			$parent_id = $this->input->post( 'parent_id' , true );

			if ( !empty( $this->second_level ) )
			{
				foreach ( $this->second_level as $second )
				{
					if ( $second->id == $parent_id )
					{
						$this->session->set_flashdata( 'alert' , 'Nie możesz wybrać tej kategorii jako nadrzędnej.' );
						refresh();
					}
				}
			}

			if ( $this->form_validation->run( 'admin_ad_categories_create' ) == true )
			{

				$data = array(
					'name' => $this->input->post( 'name' , true ),
					'alias' => $this->input->post( 'alias' , true ),
					'parent_id' => $this->input->post( 'parent_id' , true ),
				);
				$this->Admin_model->create( 'ad_categories' , $data );

				$this->session->set_flashdata( 'alert' , 'Kategoria dodana poprawnie.' );
				refresh();

			}
			else
			{
				$this->session->set_flashdata( 'alert' , validation_errors() );
				refresh();
			}

		}

		$this->load->view( 'admin/ad_categories/create' );
	}

	public function edit( $id )
	{

		$where = array( 'id' => $id );
		$data['ad_category'] = $this->Admin_model->get_single( 'ad_categories' , $where );

		if ( !empty( $_POST ) )
		{

			if ( $_POST['alias'] == '' )
			{
				$_POST['alias'] = alias( $_POST['name'] );
			}
			else
			{
				$_POST['alias'] = alias( $_POST['alias'] );
			}


			if ( $this->form_validation->run( 'admin_ad_categories_edit' ) == true )
			{

				$data = array(
					'name' => $this->input->post( 'name' , true ),
					'alias' => $this->input->post( 'alias' , true ),
					'parent_id' => $this->input->post( 'parent_id' , true ),
				);

				$where = array( 'id' => $id );
				$this->Admin_model->update( 'ad_categories' , $where , $data );

				$this->session->set_flashdata( 'alert' , 'Zmiany zapisane.' );
				refresh();

			}
			else
			{
				$this->session->set_flashdata( 'alert' , validation_errors() );
				refresh();
			}

		}

		$this->load->view( 'admin/ad_categories/edit' , $data );
	}

	public function delete( $id )
	{
		$where = array( 'id' => $id );
		$this->Admin_model->delete( 'ad_categories' , $where );

		$where = array( 'cat_id' => $id );
		$this->Admin_model->delete( 'ads_cats' , $where );

		redirect( 'admin/ad_categories' );
	}

	public function unique_alias_edit( $alias )
	{
		$id = $this->uri->segment( 4 );

		$where = array( 'alias' => $alias );
		$ad_category = $this->Admin_model->get_single( 'ad_categories' , $where );

		if ( !empty( $ad_category ) && $ad_category->id != $id )
		{
			$this->form_validation->set_message( 'unique_alias_edit' , 'Inny kategoria ma taki alias' );
			return false;
		}
		else
		{
			return true;
		}

	}

}

/* End of file Ads_cats.php */
/* Location: ./application/controllers/Ads_cats.php */