<?php

	/*

	Autor:
		Angel Redondo Pliego
	Fecha:
		Lunes 22 de Enero del 2024
	Descripcion:
		Página de configuración. Movidas para todo el control de la configuración
	*/

//Control
defined('ABSPATH') or die( "ERROR" );

//Comprueba que tienes permisos para acceder a esta pagina
if (! current_user_can ('manage_options')) wp_die (__ ('Vaya. Parece que no tienes suficientes permisos para acceder a esta página. Qué pasará, que misterio habrá.'));
?>
	<div class="wrap">
		<h1>Configuración de <?php _e( 'Api Shortcode Spotify', 'ass' ) ?></h1>
		Bienvenido a la configuración del ASS <small><?php _e( 'Api Shortcode Spotify', 'ass' ) ?></small>


		<?php

			echo ass_curl();
			
			//Controlamos un poquillo. Sin volvernos locos
			if($_POST && isset($_POST['ASS_control']) && $_POST['ASS_control'] == 'me_gusta_mas_mecano' ){

				$ass_bbdd_msg = '';

				foreach($_POST as $campo => $valor){

					if(strlen($valor) > 0 && $campo != 'submit' && $campo != 'ASS_control'){
						if(update_option($campo, $valor)) {
							$ass_bbdd_msg = $ass_bbdd_msg.' El valor de <strong>'.$campo.'</strong> ha sido almacenado como '.$valor;
						} else {
							$ass_bbdd_msg = $ass_bbdd_msg.' No se pudo configurar el valor de <strong>'.$campo.'</strong>';
						}
					}else{

						if($campo != 'submit' && $campo != 'ASS_control'){ $ass_bbdd_msg = $ass_bbdd_msg.' Vaya. Parece que no se pudo configurar el valor de <strong>'.$campo.'</strong> porque no has indicado nada :-( '; }
					}
					$ass_bbdd_msg = $ass_bbdd_msg.'<br />';

				} 


				echo '<div id="message" class="notice notice-success settings-error is-dismissible"><p><strong>Cambios almacenados</strong> <br />'.$ass_bbdd_msg.'</p></div>';

			}
		?>

			<form method="post" novalidate="novalidate">
				<input type='hidden' name='ASS_control' value='me_gusta_mas_mecano' />

				<table class="form-table" role="presentation">

					<tr>
						<th scope="row"><label for="api">OAuth Token API de Spotify</label></th>
						<td>
							<input name="ass_oauth_token_api" type="text" id="api" value="<?php echo ($ass_oauth_token_api = get_option('ass_oauth_token_api'))? $ass_oauth_token_api : ''; ?>" placeholder="API de Spotify" class="regular-text" aria-describedby="api-description" />
							<p class="description" id="api-description">OAuth Token de tu perfil de Spotify, para la V1. ¿No lo encuentras? <a href="https://developer.spotify.com/console/" target="_blank">Consiguelo aquí</a>.</p>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="secret">Secret ID de Spotify</label></th>
						<td>
							<input name="ass_secret" type="text" id="secret" value="<?php echo ($ass_oauth_token_api = get_option('ass_secret'))? $ass_oauth_token_api : ''; ?>" placeholder="API de Spotify" class="regular-text" aria-describedby="api-description" />
							<p class="description" id="api-description">OAuth Token de tu perfil de Spotify, para la V1. ¿No lo encuentras? <a href="https://developer.spotify.com/console/" target="_blank">Consiguelo aquí</a>.</p>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="clientId">OAuth Client ID de Spotify</label></th>
						<td>
							<input name="ass_clientId" type="text" id="clientId" value="<?php echo ($ass_oauth_token_api = get_option('ass_clientId'))? $ass_oauth_token_api : ''; ?>" placeholder="API de Spotify" class="regular-text" aria-describedby="api-description" />
							<p class="description" id="api-description">OAuth Token de tu perfil de Spotify, para la V1. ¿No lo encuentras? <a href="https://developer.spotify.com/console/" target="_blank">Consiguelo aquí</a>.</p>
						</td>
					</tr>


					<tr>
						<th scope="row"><label for="defaultid">ID por Defecto</label></th>
						<td><input name="ass_default_id" type="text" id="defaultid" aria-describedby="id-description" value="<?php echo ($ass_default_id = get_option('ass_default_id'))? $ass_default_id : ''; ?>" placeholder="ID por defecto" class="regular-text" />
						<p class="description" id="id-description">ID de artista por defecto. Algo semejante a esto: 4tZwfgrHOc3mvqYlEYSvVi</p></td>
					</tr>


				</table>
				
				<p class="submit">
					<input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar cambios"  />
				</p>
			</form>

		<div class="card">
			<h2 class="title">Instrucciones de Uso</h2>
			<p>Con este plugin podrás usar un Shortcode llamado ASS. Para ello, podrás añadir en cualquier 
				página, entrada, etc [ass id="id_de_artista"]</p>
			<p>Para usarlo, es necesario parametrizar tanto el token de la API de spotify como un ID de artista por defecto.
				Este es el mínimo de uso requerido para que el componente funcione en unos mínimos. Si no indicas ningún id 
				durante su definición, usará el del artista por defecto</p> 
		</div>

		<div class="card">
			<h2 class="title">Disclaimer</h2>
			<p>Ahora mismo el plugin está funcional en mínimos. No hay controles de NULL safety, cantidades, ni otras buenas recomendaciones</p>
		</div>


	</div>