<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utils {

	public function permisos($library_aauth){
		$ver = null;
		$añadir = null;
		$editar = null;
		$borrar = null;
		$admin = null;

		if ( $library_aauth->is_loggedin() ){

			$userGroups = $library_aauth->get_user_groups();
			foreach ($userGroups as $group) {
			if($library_aauth->is_group_allowed('ver', $group->name ))
				$ver = 1;

			if($library_aauth->is_group_allowed('añadir', $group->name ))
				$añadir = 1;

			if($library_aauth->is_group_allowed('editar', $group->name))
				$editar = 1;

			if($library_aauth->is_group_allowed('borrar', $group->name))
				$borrar = 1;

			if($library_aauth->is_group_allowed('admin', $group->name))
				$admin = 1;

			}

			return array($ver, $añadir, $editar, $borrar, $admin);
		}
	}

	public function permisos_grupos($library_aauth){
		$permisos = array();

		if ( $library_aauth->is_loggedin() ){

			$userGroups = $library_aauth->list_groups();
			foreach ($userGroups as $group) {
			$ver = null;
			$añadir = null;
			$editar = null;
			$borrar = null;
			$admin = null;

			if($library_aauth->is_group_allowed('ver', $group->name ))
				$ver = 1;

			if($library_aauth->is_group_allowed('añadir', $group->name ))
				$añadir = 1;

			if($library_aauth->is_group_allowed('editar', $group->name))
				$editar = 1;

			if($library_aauth->is_group_allowed('borrar', $group->name))
				$borrar = 1;

			if($library_aauth->is_group_allowed('admin', $group->name))
				$admin = 1;

			$tmp = new stdClass;
			$tmp->ver = $ver;
			$tmp->añadir = $añadir;
			$tmp->editar = $editar;
			$tmp->borrar = $borrar;
			$tmp->admin = $admin;

			array_push($permisos, $tmp);
			}

			return $permisos;
		}
	}

	public function usuarios_grupos($library_aauth, $arrayUsuarios){
		if ( $library_aauth->is_loggedin() ){

			$array = array();
			foreach ($arrayUsuarios as $usuario) {
				$userGroups = $library_aauth->get_user_groups($usuario->id);
				$grupos = "";
				foreach ($userGroups as $group) {
					$grupos .= " ".$group->name.", ";
				}
				$grupos = substr_replace($grupos, "", -1);
				array_push($array, $grupos);
			}
		return $array;
		}
	}

	// Function to get the client IP address
	public function get_client_ip() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

	public function getNombreApellidos($nombreCompleto, $apellido_primero = false){
      $campos = ($apellido_primero)
          ? explode(" ", strtoupper($nombreCompleto))
          : array_reverse(explode(" ", strtoupper($nombreCompleto)));
      $exceptions = ["DA", "DE", "DEL", "LA", "LAS", "DEL", "LOS", "SAN", "SANTA", 'MAC', 'MC', 'VAN', 'VON', 'Y', 'I'];

      $existen = array_intersect($campos, $exceptions);
      $nombre = array( "Materno" => "", "Paterno" => "", "Nombres" => "" );
      $agregar_en = ($apellido_primero)
          ? "paterno"
          : "materno";
      $primera_vez = true;
      if($apellido_primero){
          if(!empty($existen)){
              foreach ($campos as $campo) {
                  if($primera_vez){
                      $nombre["Paterno"] = $nombre["Paterno"] . " " . $campo;
                      $primera_vez = false;
                  }else{
                      if(in_array($campo, $exceptions)){
                          if($agregar_en == "paterno")
                              $nombre["Paterno"] = $nombre["Paterno"] . " " . $campo;
                          elseif($agregar_en == "materno")
                              $nombre["Materno"] = $nombre["Materno"] . " " . $campo;
                          else
                              $nombre["Nombres"] = $nombre["Nombres"] . " " . $campo;
                      }else{
                          if($agregar_en == "paterno"){
                              $nombre["Paterno"] = $nombre["Paterno"] . " " . $campo;
                              $agregar_en = "materno";
                          }elseif($agregar_en == "materno"){
                              $nombre["Materno"] = $nombre["Materno"] . " " . $campo;
                              $agregar_en = "nombres";
                          }else{
                              $nombre["Nombres"] = $nombre["Nombres"] . " " . $campo;
                          }
                      }
                  }
              }
          }else{
              foreach ($campos as $campo) {
                  if($primera_vez){
                      $nombre["Paterno"] = $nombre["Paterno"] . " " . $campo;
                      $primera_vez = false;
                  }else{
                      if(in_array($campo, $exceptions)){
                          if($agregar_en == "paterno")
                              $nombre["Paterno"] = $nombre["Paterno"] . " " . $campo;
                          elseif($agregar_en == "materno")
                              $nombre["Materno"] = $nombre["Materno"] . " " . $campo;
                          else
                              $nombre["Nombres"] = $nombre["Nombres"] . " " . $campo;
                      }else{
                          if($agregar_en == "paterno"){
                              $nombre["Materno"] = $nombre["Materno"] . " " . $campo;
                              $agregar_en = "materno";
                          }elseif($agregar_en == "materno"){
                              $nombre["Nombres"] = $nombre["Nombres"] . " " . $campo;
                              $agregar_en = "nombres";
                          }else{
                              $nombre["Nombres"] = $nombre["Nombres"] . " " . $campo;
                          }
                      }
                  }
              }
          }
      }else{
          foreach($campos as $campo){
              if($primera_vez){
                  $nombre["Materno"] = $campo . " " . $nombre["Materno"];
                  $primera_vez = false;
              }else{
                  if(in_array($campo, $exceptions)){
                      if($agregar_en == "materno")
                          $nombre["Materno"] = $campo . " " . $nombre["Materno"];
                      elseif($agregar_en == "paterno")
                          $nombre["Paterno"] = $campo . " " . $nombre["Paterno"];
                      else
                          $nombre["Nombres"] = $campo . " " . $nombre["Nombres"];
                  }else{
                      if($agregar_en == "materno"){
                          $agregar_en = "paterno";
                          $nombre["Paterno"] = $campo . " " . $nombre["Paterno"];
                      }elseif($agregar_en == "paterno"){
                          $agregar_en = "nombres";
                          $nombre["Nombres"] = $campo . " " . $nombre["Nombres"];
                      }else{
                          $nombre["Nombres"] = $campo . " " . $nombre["Nombres"];
                      }
                  }
              }
          }
      }
      // LIMPIEZA DE ESPACIOS, SE DEVUELVE EN MINÚSCULA Y DESPU
      $nombre["Materno"] = ucwords(mb_strtolower(trim($nombre["Materno"])));
      $nombre["Paterno"] = ucwords(mb_strtolower(trim($nombre["Paterno"])));
      $nombre["Nombres"] = ucwords(mb_strtolower(trim($nombre["Nombres"])));
      //
      return array('Nombre' => $nombre["Nombres"], 'Apellidos'=> $nombre["Paterno"].' '.$nombre["Materno"]);
  }

  public function eliminar_tildes($cadena){

       //Ahora reemplazamos las letras
       $cadena = str_replace(
           array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
           array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
           $cadena
       );

       $cadena = str_replace(
           array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
           array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
           $cadena );

       $cadena = str_replace(
           array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
           array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
           $cadena );

       $cadena = str_replace(
           array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
           array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
           $cadena );

       $cadena = str_replace(
           array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
           array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
           $cadena );

       $cadena = str_replace(
           array('ñ', 'Ñ', 'ç', 'Ç'),
           array('n', 'N', 'c', 'C'),
           $cadena
       );
      return $cadena;
  }

  public function previewImageBase64($rutaOrigen, $archivoOrigen){
    $ruta = $rutaOrigen.$archivoOrigen;
    $type = pathinfo($ruta, PATHINFO_EXTENSION);
    $data = file_get_contents($ruta);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return $base64;
  }

  public function imageBase64($rutaOrigen, $archivoOrigen){
    return base64_encode(file_get_contents($rutaOrigen.$archivoOrigen));
  }

}
