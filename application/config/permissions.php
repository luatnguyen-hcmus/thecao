<?php 
	$config = array(
		'admin' => array('index', 'add', 'edit', 'delete'),
		'user' => array('index', 'add', 'edit', 'delete','lock'),
		'userlock' => array('index', 'edit'),
		'typecardchange' => array('index', 'add', 'edit', 'delete', 'del_all'),
		'typecardbuy' => array('index', 'add', 'edit', 'delete', 'del_all'),
		'typecardget' => array('index', 'add', 'edit', 'delete', 'del_all'),
		'catalog' => array('index', 'add', 'edit', 'delete', 'del_all'),
		'transaction' => array('index', 'add', 'edit', 'delete', 'del_all','process','put','get_bank','get_tcsr','buy','pay_card','process_error','process_bank','process_error_bank','napthe','rutvenh'),
		'pay_card' => array('add', 'edit', 'delete', 'del_all','process','put','get_bank','get_tcsr','buy','pay_card'),
		'news' => array('index', 'add', 'edit', 'delete', 'del_all'),
		'info' => array('index', 'add', 'edit', 'delete', 'del_all'),
		'phone' => array('index', 'add', 'edit', 'delete', 'del_all'),
	);
	