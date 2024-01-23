<?php

	/*

	Autor:
		Angel Redondo Pliego
	Fecha:
		Martes 23 de Enero del 2024
	Descripcion:
		Para añadir el menu
	*/

//Control 
defined('ABSPATH') or die( "ERROR" );

//Manejamos lo mostrado todo con un shortcode. Función espagueti para tirar millas

function ass_shortcode( $atribs) {

	//Defaults
	$ass_default_id = get_option('ass_default_id');
	$ass_oauth_token_api = get_option('ass_oauth_token_api');

	$a = shortcode_atts( array(
		'id' => $ass_default_id,
	), $atribs );
	
	$id = esc_attr($a['id']); //Un pelín de limpieza

	$ass_oauth_token_api = get_spotify_access_token();
    if (!$ass_oauth_token_api) {
        return '<p>Error obteniendo token de acceso a Spotify.</p>';
    }

    $ASS_authorization = "Authorization: Bearer " . $ass_oauth_token_api;
    

	//$ASS_authorization = "authorization: Bearer " . $ass_oauth_token_api;	
	$ASS_url = 'https://api.spotify.com/v1/artists/'.$id.'/albums?limit=50';
	$ASS_curl = curl_init();
	
	curl_setopt($ASS_curl, CURLOPT_URL, $ASS_url);
	curl_setopt($ASS_curl,  CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $ASS_authorization));
	curl_setopt($ASS_curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ASS_curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
	curl_setopt($ASS_curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ASS_curl, CURLOPT_SSL_VERIFYPEER, false);
	$ASS_json = curl_exec($ASS_curl);
	curl_close($ASS_curl);

	$ASS_json = json_decode($ASS_json, true);

	echo '<h3>Resultados de #'. $id .'</h3>';

	echo '<table>
			<thead>
				<th>Álbum</th>
				<th>Fecha Lanzamiento</th>
			</thead>
			<tbody>';


	foreach($ASS_json['items'] as $item) {
		echo '<tr><td>'. $item['name'] .'</td><td>'.$item['release_date'] .'</td></tr>';
	}

	echo '	</tbody>
			<tfooter>
				<th>Álbum</th>
				<th>Fecha Lanzamiento</th>
			</tfooter>
		<table>';
}
add_shortcode( 'ass', 'ass_shortcode' );

//Por si el CURL no está Ok :_(
function ass_curl(){
    if( !function_exists('curl_version') ){
		return '<p><strong>Cuidado</strong>CURL no está activo. Es necesario para poder mostrar contenido desde Spotify</p>';
	}
}

function get_spotify_access_token() {

    $client_id = get_option('ass_clientId');
    $client_secret = get_option('ass_secret');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret),
        'Content-Type: application/x-www-form-urlencoded'
    ));

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        // Manejo del error
        return null;
    }
    curl_close($ch);

    $result = json_decode($result, true);
    return $result['access_token'] ?? null;
}
