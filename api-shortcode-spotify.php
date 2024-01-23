<?php
/*
Plugin Name: api shortcode spotify
Plugin URI: https://www.saulot.net
Description: Add your own albums list from spotify's api
Version: 1.0.0
Requires at least: 5.2
Requires PHP:      7.0
Author: Angel Redondo
Author URI: https://www.saulot.net
============================================================================================================
This software is provided "as is" and any express or implied warranties, including, but not limited to, the
implied warranties of merchantibility and fitness for a particular purpose are disclaimed. In no event shall
the copyright owner or contributors be liable for any direct, indirect, incidental, special, exemplary, or
consequential damages(including, but not limited to, procurement of substitute goods or services; loss of
use, data, or profits; or business interruption) however caused and on any theory of liability, whether in
contract, strict liability, or tort(including negligence or otherwise) arising in any way out of the use of
this software, even if advised of the possibility of such damage.

For full license details see license.txt
============================================================================================================
*/

//Control
defined('ABSPATH') or die( "ERROR" );

//Aqui se definen las constantes
define('ASS_RUTA',plugin_dir_path(__FILE__));
define('ASS_NOMBRE','Api Shortcode Spotify');

//Includes
include(ASS_RUTA.'/includes/opciones.php');

//Functions
include(ASS_RUTA.'/functions/funciones.php');