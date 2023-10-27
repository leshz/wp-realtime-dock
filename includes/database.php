<?php
function dock_install()
{
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  global $wpdb;

  $table_name = $wpdb->prefix . 'muelle_status';

  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (`id` int(5) NOT NULL,
		  `motonave` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
		  `muelle_actual` int(2) DEFAULT NULL,
		  `orientacion` int(2) DEFAULT NULL,
		  `fecha_atrac` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `hora` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `agente` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `client_princp` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `producto` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
      `eslora` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
      `calado` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `ton_anun` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `ton_desc` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `ton_acum` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `sal-motonave` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
		 	`responsable` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
			`actualizacion` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL) $charset_collate;";

    dbDelta($sql);
    $sql = "ALTER TABLE $table_name ADD PRIMARY KEY (`id`);";
    $wpdb->query($sql);
    $sql = "ALTER TABLE $table_name MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;";
    $wpdb->query($sql);
  }
}

function dock_uninstall()
{
  global $wpdb;
  $table_name = $wpdb->prefix . 'muelle_status';
  $sql = "DROP table IF EXISTS $table_name";
  $wpdb->query($sql);
}

function createFormConsulDb()
{
  global $wpdb;
  $table_name = $wpdb->prefix . 'muelle_status';
  $results = $wpdb->get_results("SELECT * FROM $table_name");
  if (count($results) == 0) {
    $results = array(
      0 => array(
        'id' => "",
        'motonave' => "",
        'muelle_actual' => "",
        'orientacion' => "",
        'fecha_atrac' => "",
        'hora'  =>  "",
        'agente' => "",
        'client_princp' => "",
        'producto' => "",
        'eslora' => "",
        'calado' => "",
        'ton_anun' => "",
        'ton_desc' => "",
        'ton_acum' => "",
        'sal-motonave' => "",
        'responsable' => "",
        'actualizacion' => ""
      )
    );
  }
  $results = json_decode(json_encode($results), true);
  return $results;
}

function limpiarString($texto)
{
  //$textoLimpio = preg_replace('([^0-9])', '', $texto);
  //return $textoLimpio;
  return $texto;
}
