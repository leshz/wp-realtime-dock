<?php

function deleteField()
{
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  global $wpdb;
  $DelenteID = $_POST['id'];
  $table_name = $wpdb->prefix . 'muelle_status';
  $sql = "DELETE FROM $table_name WHERE  `id` = $DelenteID;";
  $wpdb->query($sql);
  return $wpdb;
  die();
}

function process_form_data()
{
  global $wpdb;
  $table_name = $wpdb->prefix . 'muelle_status';
  $formInfo = $_POST;
  unset($formInfo['action']);
  foreach ($formInfo as $item => $info) {

    if ($info['id'] != "") {
      $wpdb->update(
        $table_name,
        array(
          'motonave' => $info['motonave'],
          'muelle_actual' => $info['muelle'],
          'orientacion' => $info['orientacion'],
          'fecha_atrac' => $info['date'],
          'hora' => $info['hora'],
          'agente' => $info['agente'],
          'client_princp' => $info['cliente'],
          'producto' => $info['producto'],
          'eslora' => $info['eslora'],
          'calado' => $info['calado'],
          'ton_anun' => limpiarString($info['tonelaje-anun']),
          'ton_desc' => limpiarString($info['tonelaje-desc']),
          'ton_acum' => limpiarString($info['tonelaje-acum']),
          'sal-motonave' => $info['sal-motonave'],
          'responsable' => $info['responsable'],
          'actualizacion' => setdatedb($info['actualizacion'])
        ),
        array('id' => $info['id'])
      );
    } else {
      $wpdb->insert($table_name, array(
        'motonave' => $info['motonave'],
        'muelle_actual' => $info['muelle'],
        'orientacion' => $info['orientacion'],
        'fecha_atrac' => $info['date'],
        'hora' => $info['hora'],
        'agente' => $info['agente'],
        'client_princp' => $info['cliente'],
        'producto' => $info['producto'],
        'eslora' => $info['eslora'],
        'calado' => $info['calado'],
        'ton_anun' => limpiarString($info['tonelaje-anun']),
        'ton_desc' => limpiarString($info['tonelaje-desc']),
        'ton_acum' => limpiarString($info['tonelaje-acum']),
        'sal-motonave' => $info['sal-motonave'],
        'responsable' => $info['responsable'],
        'actualizacion' => setdatedb($info['actualizacion'])
      ));
    }
  }
  wp_redirect($_SERVER['HTTP_REFERER']);
}

function setdatedb($date)
{
  date_default_timezone_set('America/Bogota');
  if ($date == '') {
    $fecha =  date("d/m/Y");
    $hora = date("h:i:sa");
    $completa = $fecha . " - " . $hora;
    return  $completa;
  } elseif (strlen($date) == 10) {
    $hora = date("h:i:sa");
    return $date . " - " . $hora;
  } else {
    return $date;
  }
}


add_action('wp_ajax_deleteField', 'deleteField');
add_action('admin_post_process_form', 'process_form_data');
