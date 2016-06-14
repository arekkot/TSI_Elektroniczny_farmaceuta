<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends Site_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		if ( logged_in() == false )
		{

			$this->session->set_flashdata( 'alert' , 'Musisz być zalogowany.' );
			redirect( base_url() );

		}

		$id = $this->session->userdata( 'id' );
		$where = array( 'id' => $id );
		$data['user'] = $this->Site_model->get_single( 'users' , $where );
		$password = $data['user']->password;

		if ( !empty( $_POST ) )
		{

			if ( $this->form_validation->run( 'site_account_index' ) == true )
			{

				$data_user = array(
					'name' => $this->input->post( 'name' , true ),
					'password' => password_hash( $this->input->post( 'password' , true ) , PASSWORD_BCRYPT ),
					'address' => $this->input->post( 'address' , true ),
					'zip_code' => $this->input->post( 'zip_code' , true ),
					'city' => $this->input->post( 'city' , true ),
					'country' => $this->input->post( 'country' , true ),
					'phone' => $this->input->post( 'phone' , true ),
				);

				if ( $this->input->post( 'password' , true ) == '' )
				{
					$data_user['password'] = $password;
				}

				$where = array( 'id' => $id );
				$this->Site_model->update( 'users' , $where , $data_user );			


				$this->session->set_flashdata( 'alert' , 'Zmiany zapisane.' );
				refresh();

			}
			else
			{
				$this->session->set_flashdata( 'alert' , validation_errors() );
				refresh();
			}

		}

		$this->load->view( 'site/account/index' , $data );
	}

	public function registration()
	{

		if ( logged_in() == true )
		{

			$this->session->set_flashdata( 'alert' , 'Jesteś zalogowany więc nie możesz się ponownie zarejestrować.' );
			redirect( base_url() );

		}

		if ( !empty( $_POST ) )
		{

			if ( $this->form_validation->run( 'site_account_registration' ) == true )
			{

				$activation_code = random_string();

				$data = array(
					'name' => $this->input->post( 'name' , true ),
					'email' => $this->input->post( 'email' , true ),
					'password' => password_hash( $this->input->post( 'password' , true ) , PASSWORD_BCRYPT ),
					'created_time' => time(),
					'activation_code' => $activation_code,
				);

				$this->Site_model->create( 'users' , $data );

				// Wysyłka emaila potwierdzającego rejestrację

				$subject = 'Aktywacja konta';
				$message = 
					'<p>Witaj ' . $data['name'] . '</p>
					<p>Aby aktywować konto kliknij w poniższy link aktywacyjny:</p>
					<a href="' . base_url( 'account/activation/' . $activation_code ) . '">Link aktywujący Twoje konto</a>'
					;

				$result = $this->email
					->from( 'farmaceuta123456@gmail.com' )
					->to( $data['email'] )
					->subject( $subject )
					->message( $message )
					->send();

				// Wyświetlenie komunikatu

				$this->session->set_flashdata( 'alert' , 'Zarejestrowałeś się w portalu' );
				redirect( base_url() );

			}
			else
			{
				$this->session->set_flashdata( 'alert' , validation_errors() );
				redirect( base_url() );
			}

		}

	}

	public function activation( $activation_code )
	{

		$where = array( 'activation_code' => $activation_code );
		$user = $this->Site_model->get_single( 'users' , $where );

		if ( $user->active == 1 )
		{
			$this->session->set_flashdata( 'alert' , 'Aktywowałeś swoje konto już wcześniej.' );
			redirect( '/' );
		}
		else
		{
			$data = array( 'active' => 1 );
			$this->Site_model->update( 'users' , $where , $data );

			$this->session->set_flashdata( 'alert' , 'Pomyślnie aktywowałeś swoje konto.' );
			redirect( '/' );

		}

	}

	public function login()
	{

		logged_in() == false || redirect( '/' );
		

		if ( !empty( $_POST ) )
		{

			if ( $this->form_validation->run( 'site_account_login' ) == true )
			{

				$email = $this->input->post( 'email' , true );
				$password = $this->input->post( 'password' , true );

				$where = array( 'email' => $email );
				$user = $this->Site_model->get_single( 'users' , $where );

				if ( !empty( $user ) )
				{
					
					if ( password_verify( $password , $user->password ) == 1 )
					{

						// Czy użytkownik jest aktywny

						if ( $user->active == 1 )
						{

							// Zalogowanie użytkownika

							$data_login = array(
								'id' => $user->id,
								'name' => $user->name,
								'email' => $user->email,
								'logged_in' => true,
							);
							$this->session->set_userdata( $data_login );

							if ( $this->input->post( 'remember' , true ) == 1 )
							{
								// Automatyczne logowanie użytkownika ( Zapamiętaj mnie )

								$remember_code = random_string();

								$where = array( 'id' => $user->id );
								$data = array( 'remember_code' => $remember_code );
								$this->Site_model->update( 'users' , $where , $data );

								$user_info_arr = array(
									'id' => $user->id,
									'name' => $user->name,
									'email' => $user->email,
									'logged_in' => true,
									'remember_code' => $remember_code,
								);
								$user_info_json = json_encode( $user_info_arr );

								$data_cookie = array(
									'name' => 'remember_me',
									'value' => $user_info_json,
									'expire' => 60*60*24*365,
									'path' => '/',
								);
								set_cookie( $data_cookie );
							}

							$this->session->set_flashdata( 'alert' , 'Zalogowałeś się poprawnie.' );
							redirect( '/' );
							
						}
						else
						{
							$this->session->set_flashdata( 'alert' , 'Musisz aktywować swoje konto.' );
							redirect( '/' );
						}

					}
					else
					{
						// Użytkownik podał błędne hasło dla podanego adresu email

						$this->session->set_flashdata( 'alert' , 'Błędne hasło.' );
						redirect( '/' );
					}

				}
				else
				{
					// Nie istnieje taki użytkownik

					$this->session->set_flashdata( 'alert' , 'Użytkownik z podanym adresem email nie istnieje.' );
					redirect( '/' );
				}

			}
			else
			{
				$this->session->set_flashdata( 'alert' , validation_errors() );
				redirect( '/' );
			}

		}
		
	}

	public function logout()
	{
		$this->session->sess_regenerate( true );
		delete_cookie( 'remember_me' );

		$this->session->set_flashdata( 'alert' , 'Wylogowałeś się.' );
		redirect( '/' );
	}

	public function forgot_password()
	{

		if ( !empty( $_POST ) )
		{

			if ( $this->form_validation->run( 'site_account_forgot_password' ) == true )
			{

				$email = $this->input->post( 'email' , true );

				$where = array( 'email' => $email );
				$user = $this->Site_model->get_single( 'users' , $where );

				if ( !empty( $user ) )
				{

					$reset_password_code = random_string();

					$where = array( 'email' => $email );
					$data = array( 'reset_password_code' => $reset_password_code );
					$this->Site_model->update( 'users' , $where , $data );

					$subject = 'Reset hasła';
					$message = 
						'<p>Witaj ' . $user->name . '</p>
						<p>Aby zresetować swoje hasło kliknij w poniższy link:</p>
						<p><a href="' . base_url( 'account/reset-password/' . $reset_password_code ) . '">Link resetujący Twoje hasło</a></p>
						<p>Jeśli nie resetowałeś swojego hasła, zignoruj tą wiadomość</p>'
						;

					$result = $this->email
						->from( 'farmaceuta123456@gmail.com' )
						->to( $user->email )
						->subject( $subject )
						->message( $message )
						->send();

					echo $user->email;

					// Wyświetlenie komunikatu

					$this->session->set_flashdata( 'alert' , 'Na podany adres email wysłany został link resetujący hasło.' );
					refresh();

				}
				else
				{
					$this->session->set_flashdata( 'alert' , 'Użytkownik z podanym adresem email nie istnieje.' );
					refresh();				
				}

			}
			else
			{
				$this->session->set_flashdata( 'alert' , validation_errors() );
				refresh();
			}

		}

		$this->load->view( 'site/account/forgot_password' );
	}

	public function reset_password( $reset_password_code )
	{
		$where = array( 'reset_password_code' => $reset_password_code );
		$user = $this->Site_model->get_single( 'users' , $where );

		// if ( !empty( $user ) )
		// {

			if ( !empty( $_POST ) )
			{
				if ( $this->form_validation->run( 'site_account_reset_password' ) == true )
				{

					$where = array( 'id' => $user->id );
					$data = array(
						'password' => password_hash( $this->input->post( 'password' , true ) , PASSWORD_BCRYPT ),
						'reset_password_code' => '',
					);
					$this->Site_model->update( 'users' , $where , $data );

					$this->session->set_flashdata( 'alert' , 'Pomyślnie zmieniłeś hasło do swojego konta.' );
					redirect( '/' );

				}
				else
				{
					$this->session->set_flashdata( 'alert' , validation_errors() );
					refresh();
				}
			}

			$this->load->view( 'site/account/reset_password' );
		// }
		// else
		// {
		// 	$this->session->set_flashdata( 'alert' , 'Kod resetujący hasło jest nieprawidłowy.' );
		// 	redirect( '/' );
		// }

	}

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */