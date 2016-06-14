<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['groups'] = $this->Admin_model->get( 'groups' );

		$this->load->view( 'admin/groups/index' , $data );
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


			if ( $this->form_validation->run( 'admin_groups_create' ) == true )
			{

				$data = array(
					'name' => $this->input->post( 'name' , true ),
					'alias' => $this->input->post( 'alias' , true ),
				);
				$this->Admin_model->create( 'groups' , $data );

				$this->session->set_flashdata( 'alert' , 'Grupa dodana poprawnie.' );
				refresh();

			}
			else
			{
				$this->session->set_flashdata( 'alert' , validation_errors() );
				refresh();
			}

		}

		$this->load->view( 'admin/groups/create' );
	}

	public function edit( $id )
	{

		$where = array( 'id' => $id );
		$data['group'] = $this->Admin_model->get_single( 'groups' , $where );

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


			if ( $this->form_validation->run( 'admin_groups_edit' ) == true )
			{

				$data = array(
					'name' => $this->input->post( 'name' , true ),
					'alias' => $this->input->post( 'alias' , true ),
				);

				$where = array( 'id' => $id );
				$this->Admin_model->update( 'groups' , $where , $data );

				$this->session->set_flashdata( 'alert' , 'Zmiany zapisane.' );
				refresh();

			}
			else
			{
				$this->session->set_flashdata( 'alert' , validation_errors() );
				refresh();
			}

		}



		$this->load->view( 'admin/groups/edit' , $data );
	}

	public function delete( $id )
	{
		$where = array( 'id' => $id );
		$this->Admin_model->delete( 'groups' , $where );

		$where = array( 'group_id' => $id );
		$this->Admin_model->delete( 'users_groups' , $where );

		redirect( 'admin/groups' );
	}

	public function unique_alias_edit( $alias )
	{
		$id = $this->uri->segment( 4 );

		$where = array( 'alias' => $alias );
		$group = $this->Admin_model->get_single( 'groups' , $where );

		if ( !empty( $group ) && $group->id != $id )
		{
			$this->form_validation->set_message( 'unique_alias_edit' , 'Inny grupa ma taki alias' );
			return false;
		}
		else
		{
			return true;
		}

	}

}

/* End of file Groups.php */
/* Location: ./application/controllers/Groups.php */