<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['users'] = $this->Admin_model->get( 'users' );

		$groups = $this->Admin_model->get( 'groups' );


		foreach ( $groups as $group )
		{
			$groups_ids_names_arr[$group->id] = $group->name;
		}
		$data['groups_ids_names_arr'] = $groups_ids_names_arr;


		$data['users_groups'] = $this->Admin_model->get( 'users_groups' );

		$this->load->view( 'admin/users/index' , $data );
	}

	public function create()
	{

		if ( !empty( $_POST ) )
		{

			if ( $this->form_validation->run( 'admin_users_create' ) == true )
			{

				$data = array(
					'name' => $this->input->post( 'name' , true ),
					'email' => $this->input->post( 'email' , true ),
					'password' => password_hash( $this->input->post( 'password' , true ) , PASSWORD_BCRYPT ),
				);
				$this->Admin_model->create( 'users' , $data );

				$where = array( 'email' => $this->input->post( 'email' , true ) );
				$user = $this->Admin_model->get_single( 'users' , $where );

				$groups = $this->input->post( 'groups' , true );
				foreach ( $groups as $group_id => $group_name )
				{
					$data = array(
						'user_id' => $user->id,
						'group_id' => $group_id,
					);
					$this->Admin_model->create( 'users_groups' , $data );
				}

				$this->session->set_flashdata( 'alert' , 'Użytkownik dodany poprawnie.' );
				refresh();

			}
			else
			{
				$this->session->set_flashdata( 'alert' , validation_errors() );
				refresh();
			}

		}

		$data['groups'] = $this->Admin_model->get('groups');

		$this->load->view( 'admin/users/create' , $data );
	}

	public function edit( $id )
	{

		$where = array( 'id' => $id );
		$user = $this->Admin_model->get_single( 'users' , $where );
		$data['user'] = $user;
		$password = $user->password;


		$groups = $this->Admin_model->get( 'groups' );
		foreach ( $groups as $group )
		{
			$groups_ids_names_arr[$group->id] = $group->name;
		}


		$data['groups'] = $this->Admin_model->get('groups');

		$user_in_groups = array();
		$users_groups = $this->Admin_model->get( 'users_groups' );
		foreach ( $users_groups as $user_group )
		{
			if ( $user->id == $user_group->user_id )
			{
				$user_in_groups[$user_group->group_id] = $groups_ids_names_arr[$user_group->group_id];
			}
		}
		$data['user_in_groups'] = $user_in_groups;


		if ( !empty( $_POST ) )
		{

			if ( $this->form_validation->run( 'admin_users_edit' ) == true )
			{

				$data_user = array(
					'name' => $this->input->post( 'name' , true ),
					'email' => $this->input->post( 'email' , true ),
					'password' => password_hash( $this->input->post( 'password' , true ) , PASSWORD_BCRYPT ),
				);

				if ( $this->input->post( 'password' , true ) == '' )
				{
					$data_user['password'] = $password;
				}

				$where = array( 'id' => $id );
				$this->Admin_model->update( 'users' , $where , $data_user );


				$groups = $this->input->post( 'groups' , true );
				if ( empty( $groups ) )
				{
					$groups = array();
				}

				$to_instert = array_diff( $groups , $user_in_groups );
				foreach ( $to_instert as $group_id => $group_name )
				{
					$data_groups = array(
						'user_id' => $user->id,
						'group_id' => $group_id,
					);
					$this->Admin_model->create( 'users_groups' , $data_groups );
				}

				$to_delete = array_diff( $user_in_groups , $groups );
				foreach ( $to_delete as $group_id => $group_name )
				{
					$data_groups = array(
						'user_id' => $user->id,
						'group_id' => $group_id,
					);
					$this->Admin_model->delete( 'users_groups' , $data_groups );
				}				


				$this->session->set_flashdata( 'alert' , 'Zmiany zapisane.' );
				refresh();

			}
			else
			{
				$this->session->set_flashdata( 'alert' , validation_errors() );
				refresh();
			}

		}

		$this->load->view( 'admin/users/edit' , $data );
	}

	public function delete( $id )
	{
		$where = array( 'id' => $id );
		$this->Admin_model->delete( 'users' , $where );

		$where = array( 'user_id' => $id );
		$this->Admin_model->delete( 'users_groups' , $where );

		redirect( 'admin/users' );
	}

	public function unique_email_edit( $email )
	{
		$id = $this->uri->segment( 4 );

		$where = array( 'email' => $email );
		$user = $this->Admin_model->get_single( 'users' , $where );

		if ( !empty( $user ) && $user->id != $id )
		{
			$this->form_validation->set_message( 'unique_email_edit' , 'Inny użytkownik ma taki email' );
			return false;
		}
		else
		{
			return true;
		}

	}

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */