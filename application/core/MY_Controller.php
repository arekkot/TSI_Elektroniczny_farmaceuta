<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model( 'Site_model' );

		// Automatyczne logowanie jeśli użytkownik zaznaczył pole zapamiętaj mnie

		$user_cookie = json_decode( get_cookie( 'remember_me' ) );

		if ( get_cookie( 'remember_me' ) == true )
		{

			$where = array( 'id' => $user_cookie->id );

			$user = $this->Site_model->get_single( 'users' , $where );

			if ( $user->remember_code == $user_cookie->remember_code )
			{
				$data_login = array(
					'id' => $user_cookie->id,
					'name' => $user_cookie->name,
					'email' => $user_cookie->email,
					'logged_in' => true,
				);
				$this->session->set_userdata( $data_login );
			}

		}


		// Poziom pierwszy kategorii

		$this->load->model( 'Admin_model' );

		$first_level_arr = array();
		$second_level_arr = array();

		$where = array( 'parent_id' => 0 );
		$first_level_cats = $this->Admin_model->get( 'ad_categories' , $where );

		foreach ( $first_level_cats as $first )
		{
			
			$first_level_arr[] = array(
				'id' => $first->id,
				'name' => $first->name,
				'alias' => $first->alias,
				'parent_id' => $first->parent_id,
			);

			// Poziom drugi kategorii

			$where = array( 'parent_id' => $first->id );
			$second_level_cats = $this->Admin_model->get( 'ad_categories' , $where );


			if ( !empty( $second_level_cats ) )
			{

				foreach ( $second_level_cats as $second )
				{
					
					$second_level_arr[] = array(
						'id' => $second->id,
						'name' => $second->name,
						'alias' => $second->alias,
						'parent_id' => $second->parent_id,
					);

				}

			}

		}

		$data['first_level'] = json_decode( json_encode( $first_level_arr ) );
		$data['second_level'] = json_decode( json_encode( $second_level_arr ) );

		$ads_cats = $this->Site_model->get( 'ads_cats' );

		foreach ( $ads_cats as $ad_cat )
		{
			$ads_cats_count[] = $ad_cat->cat_id;

			$where = array( 'id' => $ad_cat->cat_id );
			$ad_category = $this->Site_model->get_single( 'ad_categories' , $where );

			if ( $ad_category->parent_id != 0 )
			{
				$ads_cats_count[] = $ad_category->parent_id;
			}
		}

		if( !empty( $ads_cats_count ) )
		{
			$this->ads_cats_count = array_count_values( $ads_cats_count );
		}
		else
		{
			$this->ads_cats_count = 0;
		}

		$data['ads'] = $this->Site_model->get( 'ads' );
		$data['ads_cats_count_menu'] = $this->ads_cats_count;

		// Załadowanie zmiennej data do wszystkich widoków

		$this->load->vars( $data );

	}

}

class Admin_Controller extends My_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model( 'Admin_model' );

		if ( logged_in() == true )
		{
			// 1 - grupa admina
			if ( !check_group( 1 ) )
			{
				$this->session->set_flashdata( 'alert' , 'Nie masz dostępu do tej części serwisu.' );
				redirect( '/' );
				exit();
			}
		}
		else
		{
			$this->session->set_flashdata( 'alert' , 'Nie jesteś zalogowany.' );
			redirect( '/' );
		}



	}

}

class Site_Controller extends My_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model( 'Site_model' );
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */