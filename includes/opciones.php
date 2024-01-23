<?php

	/*

	Autor:
		Angel Redondo Pliego
	Fecha:
		Lunes 23 de Enero del 2024
	Descripcion:
		Para añadir el menu
	*/

//Control
defined('ABSPATH') or die( "ERROR" );

add_action( 'admin_menu', 'ass_admin_menu' );
 
function ass_admin_menu(){
	add_menu_page(ASS_NOMBRE,ASS_NOMBRE,'manage_options',ASS_RUTA . '/admin/configuracion.php');
}