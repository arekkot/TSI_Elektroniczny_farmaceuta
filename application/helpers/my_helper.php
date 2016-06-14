<?php

function refresh()
{
	$CI =& get_instance();
	return redirect( $CI->uri->uri_string() , 'refresh' );
}

function random_string()
{
	$string = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	$randomString = '';
	for ( $i = 1; $i <= 100; $i++ )
	{
		$randomString .= $string[rand( 0 , strlen( $string ) - 1 )];
	}

	$time = time();

	$md5hash = md5( $time . $randomString );

	return $md5hash;
}

function logged_in()
{
	$CI =& get_instance();
	return $CI->session->userdata( 'logged_in' );
}

function alias( $str )
{
	$str = convert_accented_characters( $str );
	$str = url_title( $str , '-' , true );
	return $str;
}

function check_group( $group_id )
{
	$CI =& get_instance();

	$user_id = $CI->session->userdata( 'id' );

	$where = array(
		'user_id' => $user_id,
		'group_id' => $group_id
	);
	$CI->load->model( 'Admin_model' );
	$user_is_admin = $CI->Admin_model->get_single( 'users_groups' , $where );

	if ( empty( $user_is_admin ) )
	{
		return false;
	}
	else
	{
		return true;
	}
	
}

function vd( $data )
{
	echo '<pre>';
	var_dump( $data );
	echo '</pre>';
}