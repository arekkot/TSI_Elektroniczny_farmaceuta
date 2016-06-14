<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads extends Site_Controller {

	public function __construct()
	{
		parent::__construct();

		if ( logged_in() == true )
		{
			$user_id = $this->session->userdata( 'id' );
			$this->user_dir = BASEPATH . '../public_html/img/users/' . $user_id;
			$this->user_url = base_url() . 'img/users/' . $user_id . '/';
		}
		else
		{
			$this->user_dir = 0;
		}


	}

	public function index()
	{

		$where = array( 'promo_date !=' => '' );
		$data['promo_ads'] = $this->Site_model->get( 'ads' , $where );

		if ( !empty( $_POST ) )
		{
			$search_string = $this->input->post( 'search' , true );
			$data['ads'] = $this->Site_model->search( $search_string );
			$this->load->view( 'site/ads/search' , $data );
		}
		else
		{
			$this->load->view( 'site/ads/index' , $data );
		}
		
	}

	public function cat( $cat_alias )
	{

		$where = array( 'alias' => $cat_alias );
		$ad_category = $this->Site_model->get_single( 'ad_categories' , $where );

		if ( !empty( $ad_category ) )
		{


			if ( $ad_category->parent_id == 0 )
			{
				$where = array( 'parent_id' => $ad_category->id );
				$ad_categories = $this->Site_model->get( 'ad_categories' , $where );

				$data['ad_categories'] = $ad_categories;

				foreach ( $ad_categories as $ad_category )
				{
					$child_cats[] = $ad_category->id;
				}

				if ( empty( $child_cats ) )
				{
					$where = array( 'cat_id' => $ad_category->id );
				}
				else
				{
					$where = array( 'cat_id' => $child_cats );
				}


			}
			else
			{
				$where = array( 'cat_id' => $ad_category->id );
			}

			$ads_cats = $this->Site_model->get( 'ads_cats' , $where );

			if ( !empty( $ads_cats ) )
			{

				foreach ( $ads_cats as $ad_cat )
				{
					$ad_ids[] = $ad_cat->ad_id;
				}

				$where = array( 'id' => $ad_ids );

				if ( !empty( $_GET ) )
				{
					$where_filter['stan'] = $this->input->get( 'stan' , true );
					$where_filter['marka'] = $this->input->get( 'marka' , true );
					$data['ads'] = $this->Site_model->filter( 'ads' , $where , $where_filter );
				}
				else
				{
					$data['ads'] = $this->Site_model->get( 'ads' , $where );
				}


				$this->load->view( 'site/ads/cat' , $data );

			}
			else
			{
				$this->session->set_flashdata( 'alert' , 'Aktualnie brak ogłoszeń w tej kategorii.' );
				redirect( 'ads' );
			}

		}
		else
		{
			$this->session->set_flashdata( 'alert' , 'Niepoprawna nazwa kategorii.' );
			redirect( 'ads' );			
		}



	}

	public function show( $ad_id , $ad_alias )
	{

		if ( empty( $ad_id ) || empty( $ad_alias ) )
		{
			$this->session->set_flashdata( 'alert' , 'Niepoprawny link ogłoszenia.' );
			redirect( 'ads' );
		}

		$where = array( 'id' => $ad_id );
		$ad = $this->Site_model->get_single( 'ads' , $where );

		if ( alias( $ad->subject ) == $ad_alias )
		{

			// Wyświetlanie ogłoszenia

			if ( logged_in() == true )
			{

				$data['user_id'] = $this->session->userdata( 'id' );

			}
			else
			{
				$data['user_id'] = false;
			}


			$author_id = $ad->user_id;
			$where = array( 'id' => $author_id );
			$user = $this->Site_model->get_single( 'users' , $where );
			$data['user'] = $user;

			if ( !empty( $_POST ) )
			{

				// Wysyłka emaila potwierdzającego rejestrację

				$result = $this->email
					->from( 'farmaceuta123456@gmail.com' )
					->reply_to( $this->input->post( 'email' , true ) )
					->to( $user->email )
					->subject( $this->input->post( 'subject' , true ) )
					->message( $this->input->post( 'message' , true ) )
					->send();

				// Wyświetlenie komunikatu

				$this->session->set_flashdata( 'alert' , 'Twoja wiadomość została wysłana.' );
				refresh();

			}


			$path_to_images = BASEPATH . '../public_html/img/ogloszenia/' . $ad_id;

			if ( file_exists( $path_to_images ) )
			{

				$files = scandir( $path_to_images );
				$delete_from_array = array( '.' , '..' , 'thumbs' );
				$files = array_diff( $files , $delete_from_array );

				$data['uploaded_files'] = $files;
				$data['thumbs_url'] = base_url() . 'img/ogloszenia/' . $ad_id . '/thumbs/';
				$data['full_img_url'] = base_url() . 'img/ogloszenia/' . $ad_id . '/';

			}

			$this->session->set_flashdata( 'url' , current_url() );


			$data['ad'] = $ad;
			$this->load->view( 'site/ads/show' , $data );
		}
		else
		{
			$this->session->set_flashdata( 'alert' , 'Niepoprawny link ogłoszenia.' );
			redirect( 'ads' );
		}

	}

	public function create()
	{

		// $this->session->unset_userdata( 'temp_dir_path' );

		if ( logged_in() == false )
		{
			$this->session->set_flashdata( 'alert' , 'Musisz być zalogowany, żeby dodać ogłoszenie.' );
			redirect( 'ads' );
		}

		$user_id = $this->session->userdata( 'id' );
		$where = array( 'id' => $user_id );
		$user = $this->Site_model->get_single( 'users' , $where );
		$data['user'] = $user;

		if ( !empty( $_POST ) )
		{

			if ( $this->form_validation->run( 'site_ads_create' ) == true )
			{

				$data = array(
					'user_id' => $this->session->userdata( 'id' ),
					'subject' => $this->input->post( 'subject' , true ),
					'description' => $this->input->post( 'description' , true ),
					'thumb' => $this->input->post( 'thumb' , true ),
					'stan' => $this->input->post( 'stan' , true ),
					'marka' => $this->input->post( 'marka' , true ),
					'price' => $this->input->post( 'price' , true ),
				);
				$this->Site_model->create( 'ads' , $data );

				$temp_dir_path = $this->session->userdata( 'temp_dir_path' );
				$ad_id = $this->Site_model->last_id();

				$ad_images_path = BASEPATH . '../public_html/img/ogloszenia/' . $ad_id;

				if ( !file_exists( $ad_images_path ) )
				{
					mkdir( $ad_images_path , 0777 );
				}

				if ( !file_exists( $ad_images_path . '/thumbs' ) )
				{
					mkdir( $ad_images_path . '/thumbs' , 0777 );
				}

				$this->move_dir( $temp_dir_path , $ad_images_path );


				$where = array( 'id' => $this->Site_model->last_id() );
				$ad = $this->Site_model->get_single( 'ads' , $where );

				$category_id = $this->input->post( 'category_id' , true );

				$data = array(
					'ad_id' => $ad->id,
					'cat_id' => $category_id,
				);
				$this->Site_model->create( 'ads_cats' , $data );


				$data_user = array(
					'phone' => $this->input->post( 'phone' , true ),
				);
				$where = array( 'id' => $user->id );
				$this->Site_model->update( 'users' , $where , $data_user );	


				$this->session->unset_userdata( 'temp_dir_path' );


				if ( $this->input->post( 'promo' , true ) == 'tak' )
				{
					$this->session->set_userdata( 'promo_id' , $ad->id );
					redirect( 'ads/promo' );
				}


				$this->session->set_flashdata( 'alert' , 'Ogłoszenie zostało dodane.' );
				refresh();

			}
			else
			{
				$this->session->set_flashdata( 'alert' , validation_errors() );
				refresh();
			}

		}

		if ( $this->session->has_userdata( 'temp_dir_path' ) )
		{

			$temp_dir_path = $this->session->userdata( 'temp_dir_path' );

			if ( file_exists( $temp_dir_path ) )
			{

				$files = scandir( $temp_dir_path . '/thumbs' );
				$delete_from_array = array( '.' , '..' );
				$files = array_diff( $files , $delete_from_array );

				$data['uploaded_files'] = $files;
				$data['temp_url'] = $this->session->userdata( 'temp_url' ) . '/thumbs/';

			}

		}
		else
		{
			$data['uploaded_files'] = '';
		}

		$this->load->view( 'site/ads/create' , $data );

	}

	public function edit( $id )
	{

		$where = array( 'id' => $id );
		$ad = $this->Site_model->get_single( 'ads' , $where );
		$data['ad'] = $ad;


		if ( logged_in() == true )
		{

			$user_id = $this->session->userdata( 'id' );

			if ( $user_id == $ad->user_id || check_group( 1 ) == true )
			{


				if ( !empty( $_POST ) )
				{

					if ( $this->form_validation->run( 'site_ads_edit' ) == true )
					{

						$data_ad = array(
							'user_id' => $this->session->userdata( 'id' ),
							'subject' => $this->input->post( 'subject' , true ),
							'description' => $this->input->post( 'description' , true ),
							'thumb' => $this->input->post( 'thumb' , true ),
							'stan' => $this->input->post( 'stan' , true ),
							'marka' => $this->input->post( 'marka' , true ),
							'price' => $this->input->post( 'price' , true ),
						);

						$where = array( 'id' => $id );
						$this->Site_model->update( 'ads' , $where , $data_ad );

						$data_ads_cats = array(
							'cat_id' => $this->input->post( 'category_id' , true ),
						);

						$where = array( 'ad_id' => $id );
						$this->Site_model->update( 'ads_cats' , $where , $data_ads_cats );

						$this->session->set_flashdata( 'alert' , 'Zmiany zapisane.' );
						refresh();

					}
					else
					{
						$this->session->set_flashdata( 'alert' , validation_errors() );
						refresh();
					}

				}

			}
			else
			{
				$this->session->set_flashdata( 'alert' , 'Nie masz uprawnień do edycji tego ogłoszenia.' );
				redirect( 'ads' );
			}

		}
		else
		{
			$this->session->set_flashdata( 'alert' , 'Musisz być zalogowany aby mieć dostęp do tej części serwisu.' );
			redirect( 'ads' );
		}


		$path_to_images = BASEPATH . '../public_html/img/ogloszenia/' . $id;

		if ( file_exists( $path_to_images ) )
		{

			$files = scandir( $path_to_images );
			$delete_from_array = array( '.' , '..' , 'thumbs' );
			$files = array_diff( $files , $delete_from_array );

			$data['uploaded_files'] = $files;
			$data['thumbs_url'] = base_url() . 'img/ogloszenia/' . $id . '/thumbs/';

		}


		$where = array( 'ad_id' => $id );
		$data['ads_cats'] = $this->Site_model->get_single( 'ads_cats' , $where );

		$this->load->view( 'site/ads/edit' , $data );
	}

	public function delete( $id )
	{

		$where = array( 'id' => $id );
		$ad = $this->Site_model->get_single( 'ads' , $where );

		if ( logged_in() == true )
		{

			$user_id = $this->session->userdata( 'id' );

			if ( $user_id == $ad->user_id || check_group( 1 ) == true )
			{

				$where = array( 'id' => $id );
				$this->Site_model->delete( 'ads' , $where );

				$where = array( 'ad_id' => $id );
				$this->Site_model->delete( 'ads_cats' , $where );

				$path = BASEPATH . '../public_html/img/ogloszenia/' . $id;
				if ( file_exists( $path ) )
				{
					$this->del_dir( $path );
				}

				$this->session->set_flashdata( 'alert' , 'Ogłoszenie usunięte.' );
				redirect( 'ads' );

			}
			else
			{
				$this->session->set_flashdata( 'alert' , 'Nie masz uprawnień do usunięcia tego ogłoszenia.' );
				redirect( 'ads' );
			}

		}
		else
		{
			$this->session->set_flashdata( 'alert' , 'Musisz być zalogowany aby mieć dostęp do tej części serwisu.' );
			redirect( 'ads' );
		}


	}

	public function upload()
	{

		$temp_folder_name = random_string();
		$new_temp_dir = $this->user_dir . '/' . $temp_folder_name;
		$temp_url = $this->user_url . $temp_folder_name;


		if ( !file_exists( $this->user_dir ) )
		{
			mkdir( $this->user_dir , 0777 );
		}


		if ( !$this->session->has_userdata( 'temp_dir_path' ) )
		{
			$this->session->set_userdata( 'temp_dir_path' , $new_temp_dir );
			$this->session->set_userdata( 'temp_url' , $temp_url );

			if ( !file_exists( $new_temp_dir ) )
			{
				mkdir( $new_temp_dir , 0777 );
			}

			if ( !file_exists( $new_temp_dir . '/thumbs' ) )
			{
				mkdir( $new_temp_dir . '/thumbs' , 0777 );
			}

		}

		$upload_path = $this->session->userdata( 'temp_dir_path' );
		$new_temp_dir_thumbs = $upload_path . '/thumbs/';

		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = 4096;

		$this->load->library( 'upload' , $config );

		if ( $this->upload->do_upload() )
		{

			$this->load->library( 'image_lib' );

			$image_data = $this->upload->data();

			$config['source_image'] = $image_data['full_path'];
			$config['new_image'] = $new_temp_dir_thumbs;
			$config['maintain_ratio'] = true;
			$config['width'] = 320;

			$this->image_lib->initialize( $config );
			$this->image_lib->resize();


			$config['source_image'] = $new_temp_dir_thumbs . $image_data['file_name'];
			$config['maintain_ratio'] = false;
			$config['width'] = 320;
			$config['height'] = 180;

			$this->image_lib->initialize( $config );
			$this->image_lib->crop();


			$this->session->set_flashdata( 'alert' , 'Zdjęcie załadowane poprawnie.' );
			redirect( 'ads/create' );

		}
		else
		{
			$this->session->set_flashdata( 'alert' , $this->upload->display_errors() );
			redirect( 'ads/create' );
		}


	}

	public function delimg( $filename )
	{
	$this->session->unset_userdata( 'temp_dir_path' );
		$temp_dir_path = $this->session->userdata( 'temp_dir_path' );

		if ( file_exists( $temp_dir_path . '/' . $filename ) )
		{
			unlink( $temp_dir_path . '/' . $filename );
			unlink( $temp_dir_path . '/thumbs/' . $filename );
			redirect( 'ads/create' );
		}
		else
		{
			$this->session->set_flashdata( 'alert' , 'Nie ma takiego zdjęcia, które chcesz usunąć.' );
			redirect( 'ads/create' );
		}

	}

	public function move_dir( $old_path , $new_path )
	{
		
		$objects = scandir( $old_path );
		$delete_from_array = array( '.' , '..' );
		$objects = array_diff( $objects , $delete_from_array );

		foreach ( $objects as $object )
		{
			
			if ( filetype( $old_path . '/' . $object ) == 'dir' )
			{
				$this->move_dir( $old_path . '/' . $object , $new_path . '/' . $object );
			}
			else
			{
				rename( $old_path . '/' . $object , $new_path . '/' . $object );
			}

		}

		reset( $objects );

		if ( file_exists( $old_path ) )
		{
			rmdir( $old_path );
		}

	}

	public function del_dir( $dir_path )
	{
		
		$objects = scandir( $dir_path );
		$delete_from_array = array( '.' , '..' );
		$objects = array_diff( $objects , $delete_from_array );

		foreach ( $objects as $object )
		{
			
			if ( filetype( $dir_path . '/' . $object ) == 'dir' )
			{
				$this->del_dir( $dir_path . '/' . $object );
			}
			else
			{
				unlink( $dir_path . '/' . $object );
			}

		}

		reset( $objects );
		rmdir( $dir_path );

	}


	public function has_subcategory( $category_id )
	{

		$category_id = $this->input->post( 'category_id' , true );

		$where = array( 'id' => $category_id );
		$category = $this->Site_model->get_single( 'ad_categories' , $where );

		if ( $category->parent_id == 0 )
		{
			
			$where = array( 'parent_id' => $category_id );
			$child_category = $this->Site_model->get_single( 'ad_categories' , $where );

			if ( !empty( $child_category ) )
			{

				$this->form_validation->set_message( 'has_subcategory' , 'Musisz wybrać podkategorię.' );
				return false;

			}
			else
			{

				return true;

			}

		}

	}

	public function crone()
	{

		$path = BASEPATH . '../public_html/img/users/';
	
		$objects = scandir( $path );
		$delete_from_array = array( '.' , '..' );
		$objects = array_diff( $objects , $delete_from_array );

		foreach ( $objects as $object )
		{
			
			$objctime_plus_24h = filectime( $path . $object ) + 60 * 60 * 24;

			if ( $objctime_plus_24h < time() )
			{

				$this->del_dir( $path . $object );

			}

		}
		

	}

	public function promo()
	{
		$data['ad_id'] = $this->session->userdata( 'promo_id' );
		$this->load->view( 'site/ads/promo' , $data );
	}

	public function payment()
	{


		// sprawdzenie adresu IP oraz występowania zmiennych POST 
		if( $_SERVER['REMOTE_ADDR'] == '195.149.229.109' && !empty( $_POST ) )
		{

			$id_sprzedawcy = $_POST['id'];
			$status_transakcji = $_POST['tr_status'];
			$id_transakcji = $_POST['tr_id'];
			$kwota_transakcji = $_POST['tr_amount'];
			$kwota_zaplacona = $_POST['tr_paid'];
			$blad = $_POST['tr_error'];
			$data_transakcji = $_POST['tr_date'];
			$opis_transakcji = $_POST['tr_desc'];
			$ciag_pomocniczy = $_POST['tr_crc'];
			$email_klienta = $_POST['tr_email'];
			$suma_kontrolna = $_POST['md5sum'];

			// sprawdzenie stanu transakcji
			if( $status_transakcji == 'TRUE' && $blad=='none' )
			{


				/* Dalsze przetwarzanie, np:
				- identyfikacja transakcji na podstawie ciągu pomocniczego
				- weryfikacja transakcji (sprawdzenie poprawności kwoty itp.)
				- realizacja zamówienia */

				/* DLA TESTÓW */

				// $data_transakcji = '2015-01-20 22:17:05';
				// $ciag_pomocniczy = 27; // id ogłoszenia

				/* KONIEC TESTÓW */

				$ad_id = $ciag_pomocniczy;

				$ilosc_dni_promowania = 30;

				$data_transakcji = strtotime( $data_transakcji );
				$data_zakonczenia_promowania = $data_transakcji + 60 * 60 * 24 * $ilosc_dni_promowania;

				$data_ad = array(
					'promo_date' => $data_zakonczenia_promowania,
				);

				$where = array( 'id' => $ad_id );
				$this->Site_model->update( 'ads' , $where , $data_ad );



			}
			else
			{ 
				// transakcja wykonana niepoprawnie
			}

		}

		// odpowiedź dla serwera o odebraniu danych
		echo 'TRUE';


	}

	public function cart( $id = false , $del = false )
	{

		// $this->session->unset_userdata( 'cart' );

		if ( $id != false && $del == false )
		{

			$where = array( 'id' => $id );
			$item = $this->Site_model->get_single( 'ads' , $where );

			$cart[$id] = array(
				'subject' => $item->subject,
				'price' => $item->price,
			);

			if ( $this->session->has_userdata( 'cart' ) )
			{

				$cart = $this->session->userdata( 'cart' );
				$cart[$id] = array(
					'subject' => $item->subject,
					'price' => $item->price,
				);

				$this->session->set_userdata( 'cart' , $cart );

			}
			else
			{
				$this->session->set_userdata( 'cart' , $cart );
			}

			$this->session->set_flashdata( 'alert' , 'Dodano do koszyka.' );
			redirect( $this->session->flashdata( 'url' ) );

		}
		elseif ( $id != false && $del == 'del' )
		{

			$cart = $this->session->userdata( 'cart' );
			unset( $cart[$id] );

			$this->session->set_userdata( 'cart' , $cart );

			redirect( 'ads/cart' );

		}
		elseif ( $id != false && $del == 'clear' )
		{

			$cart = $this->session->userdata( 'cart' );
			$cart = array();

			$this->session->set_userdata( 'cart' , $cart );

			redirect( 'ads/cart' );

		}
		else
		{

			$data['cart'] = $this->session->userdata( 'cart' );

			$this->load->view( 'site/ads/cart' , $data );

		}

		





	}


}

/* End of file Ad.php */
/* Location: ./application/controllers/Ad.php */