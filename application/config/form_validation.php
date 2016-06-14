<?php

$config = array(

	'admin_users_create' => array(
		array(
			'field' => 'name',
			'label' => 'Imię',
			'rules' => 'trim|required',
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email|is_unique[users.email]',
		),
		array(
			'field' => 'password',
			'label' => 'Hasło',
			'rules' => 'trim|required|matches[passconf]',
		),
		array(
			'field' => 'passconf',
			'label' => 'Potwierdź hasło',
			'rules' => 'trim',
		),
	),

	'admin_users_edit' => array(
		array(
			'field' => 'name',
			'label' => 'Imię',
			'rules' => 'trim|required',
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email|callback_unique_email_edit',
		),
		array(
			'field' => 'password',
			'label' => 'Nowe hasło',
			'rules' => 'trim|matches[passconf]',
		),
		array(
			'field' => 'passconf',
			'label' => 'Potwierdź nowe hasło',
			'rules' => 'trim',
		),
	),

	'admin_groups_create' => array(
		array(
			'field' => 'name',
			'label' => 'Imię',
			'rules' => 'trim|required',
		),
		array(
			'field' => 'alias',
			'label' => 'Alias',
			'rules' => 'trim|is_unique[groups.alias]',
		),
	),

	'admin_groups_edit' => array(
		array(
			'field' => 'name',
			'label' => 'Imię',
			'rules' => 'trim|required',
		),
		array(
			'field' => 'alias',
			'label' => 'Alias',
			'rules' => 'trim|callback_unique_alias_edit',
		),
	),

	'admin_ad_categories_create' => array(
		array(
			'field' => 'name',
			'label' => 'Imię',
			'rules' => 'trim|required',
		),
		array(
			'field' => 'alias',
			'label' => 'Alias',
			'rules' => 'trim|is_unique[ad_categories.alias]',
		),
	),

	'admin_ad_categories_edit' => array(
		array(
			'field' => 'name',
			'label' => 'Imię',
			'rules' => 'trim|required',
		),
		array(
			'field' => 'alias',
			'label' => 'Alias',
			'rules' => 'trim|callback_unique_alias_edit',
		),
	),

	///////////////// SITE /////////////////////////

	'site_account_registration' => array(
		array(
			'field' => 'name',
			'label' => 'Imię',
			'rules' => 'trim|required',
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email|is_unique[users.email]',
		),
		array(
			'field' => 'password',
			'label' => 'Hasło',
			'rules' => 'trim|required|matches[passconf]',
		),
		array(
			'field' => 'passconf',
			'label' => 'Potwierdź hasło',
			'rules' => 'trim',
		),
	),

	'site_account_login' => array(
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email',
		),
		array(
			'field' => 'password',
			'label' => 'Hasło',
			'rules' => 'trim|required',
		),
	),

	'site_account_forgot_password' => array(
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email',
		),
	),

	'site_account_reset_password' => array(
		array(
			'field' => 'password',
			'label' => 'Nowe hasło',
			'rules' => 'trim|required|matches[passconf]',
		),
		array(
			'field' => 'passconf',
			'label' => 'Potwierdź nowe hasło',
			'rules' => 'trim',
		),
	),

	'site_account_index' => array(
		array(
			'field' => 'name',
			'label' => 'Imię',
			'rules' => 'trim|required',
		),
		array(
			'field' => 'password',
			'label' => 'Nowe hasło',
			'rules' => 'trim|matches[passconf]',
		),
		array(
			'field' => 'passconf',
			'label' => 'Potwierdź nowe hasło',
			'rules' => 'trim',
		),
	),

	'site_ads_create' => array(
		array(
			'field' => 'subject',
			'label' => 'Temat',
			'rules' => 'trim|required',
		),
		array(
			'field' => 'description',
			'label' => 'Opis',
			'rules' => 'trim|required',
		),
		array(
			'field' => 'category_id',
			'label' => 'Kategoria',
			'rules' => 'trim|callback_has_subcategory',
		),
		array(
			'field' => 'thumb',
			'label' => 'Miniatura',
			'rules' => 'trim|required',
		),
	),
	'site_ads_edit' => array(
		array(
			'field' => 'subject',
			'label' => 'Temat',
			'rules' => 'trim|required',
		),
		array(
			'field' => 'description',
			'label' => 'Opis',
			'rules' => 'trim|required',
		),
	),

);