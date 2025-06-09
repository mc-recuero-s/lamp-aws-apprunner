<?php
    function limpiar_metas($string,$corte = null){
        $s = html_entity_decode($string,ENT_COMPAT,'iso-8859-1');
        $s = strip_tags($s);
        $s = preg_replace('/(?<!>)n/', "<br />n", $s);
        $s = preg_replace('/[ ]+/', ' ', $s);
        $s = preg_replace('/<!--[^-]*-->/', '', $s);
        $s = strip_tags($s);
		
        if (isset($corte) && (is_numeric($corte))){
        	$s = mb_substr($s,0,$corte, 'iso-8859-1');
	    }	 
        return $s;
    }
	
	function urlamigable($url) {
		// Tranformamos todo a minusculas
		$url = strtolower($url);
		//Rememplazamos caracteres especiales latinos
		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
		$repl = array('a', 'e', 'i', 'o', 'u', 'n');
		$url = str_replace ($find, $repl, $url);
		// AÃ±adimos los guiones
		$find = array(' ', '&', '\r\n', '\n', '+');
		$url = str_replace ($find, '-', $url);
		// Eliminamos y Reemplazamos el resto de caracteres especiales
		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
		$repl = array('','-','');
		$url = preg_replace ($find, $repl, $url);
		return $url;
	}

	function cortarTexto($texto,$tamano,$colilla) {
		$texto=substr($texto,0,$tamano);
		$index=strrpos($texto," ");
		$texto=substr($texto,0,$index); $texto.=$colilla;
		return $texto;
	}

	function sitio(){
		global $conexion;
		global $sindatos;
		global $sitNombre;
		global $sitNombreCorto;
		global $sitDescripcion;
		global $sitLogo;
		global $sitDireccion;
		global $sitTelefono;
		global $sitCelular;
		global $sitCoordenadas;
		global $sitAnalytics;
		global $sitApiMaps;
		global $sitGoogleSite;
		global $sitLugar;
		global $sitEmail;
		global $creditos;
		global $redesf;
		global $redesw;
		global $datose;
		global $datosc;
		
		$sql = "SELECT sit_nombre, sit_nombre_corto, sit_descripcion, sit_logo, sit_direccion, sit_coordenadas, 
					   sit_analytics, sit_apimaps, sit_google_site, sit_lugar, sit_telefono, sit_celular, 
					   sit_email, sit_facebook, sit_twitter, sit_youtube, sit_instagram, sit_pinterest 
				  FROM soc_sitio WHERE sit_id = ".$_SESSION['idSitio'];
		$result = mysqli_query($conexion,$sql);
		$num_rows = $result->num_rows;
		if($num_rows > 0){
			while($rows = $result->fetch_object()) {
				$sitNombre = utf8_encode($rows->sit_nombre);
				$sitNombreCorto = utf8_encode($rows->sit_nombre_corto);
				$sitDescripcion = utf8_encode($rows->sit_descripcion);
				$sitLogo = utf8_encode($rows->sit_logo);
				$sitDireccion = utf8_encode($rows->sit_direccion);
				$sitCoordenadas = utf8_encode($rows->sit_coordenadas);
				$sitAnalytics = utf8_encode($rows->sit_analytics);
				$sitApiMaps = utf8_encode($rows->sit_apimaps);
				$sitGoogleSite = utf8_encode($rows->sit_google_site);
				$sitLugar = utf8_encode($rows->sit_lugar);
				$sitTelefono = utf8_encode($rows->sit_telefono);
				$sitCelular = utf8_encode($rows->sit_celular);
				$sitEmail = utf8_encode($rows->sit_email);
				$sitFacebook = utf8_encode($rows->sit_facebook);
				$sitTwitter = utf8_encode($rows->sit_twitter);
				$sitYoutube = utf8_encode($rows->sit_youtube);
				$sitInstagram = utf8_encode($rows->sit_instagram);
				$sitPinterest = utf8_encode($rows->sit_pinterest);
				$sitLogo = "<img src='/images/".$sitLogo."' alt=".$sitNombreCorto.">";
				
				if(!empty($sitTelefono) && !empty($sitCelular)){
					$datose = "<div class='titulo'>".$sitNombreCorto."</div>
								<p>PBX: ".$sitTelefono."</p><p>CEL: ".$sitCelular."</p><p>".$sitDireccion."</p><p>".$sitLugar."</p><p>".$sitEmail."</p>";
				}elseif(!empty($sitTelefono)){
					$datose = "<div class='titulo'>".$sitNombreCorto."</div>
								<p>PBX: ".$sitTelefono."</p><p>".$sitDireccion."</p><p>".$sitLugar."</p><p>".$sitEmail."</p>";
				}elseif(!empty($sitCelular)){
					$datose = "<div class='titulo'>".$sitNombreCorto."</div>
								<p>PBX: ".$sitCelular."</p><p>".$sitDireccion."</p><p>".$sitLugar."</p><p>".$sitEmail."</p>";
				}
				
				$datosc = $sitDireccion."<br>".$sitLugar."<br>Ll&aacute;menos al ".$sitTelefono." &oacute; al ".$sitCelular;
				if(!empty($sitFacebook)){
					$redesf .= "<a href='".$sitFacebook."' rel='noreferrer' target='_blank'><img src='/themes/svg/iconFacebook.svg' alt='Facebook' title='Facebook'></a>";
					$redesw .= "<a href='".$sitFacebook."' rel='noreferrer' target='_blank'><img src='/themes/svg/iconFacebookW.svg' alt='Facebook' title='Facebook'></a>";
				}
				if(!empty($sitTwitter)){
					$redesf .= "<a href='".$sitTwitter."' rel='noreferrer' target='_blank'><img src='/themes/svg/iconTwitter.svg' alt='Twitter' title='Twitter'></a>";
					$redesw .= "<a href='".$sitTwitter."' rel='noreferrer' target='_blank'><img src='/themes/svg/iconTwitterW.svg' alt='Twitter' title='Twitter'></a>";
				}
				if(!empty($sitYoutube)){
					$redesf .= "<a href='".$sitYoutube."' rel='noreferrer' target='_blank'><img src='/themes/svg/iconYoutube.svg' alt='Youtube' title='Youtube'></a>";
					$redesw .= "<a href='".$sitYoutube."' rel='noreferrer' target='_blank'><img src='/themes/svg/iconYoutubeW.svg' alt='Youtube' title='Youtube'></a>";
				}
				if(!empty($sitInstagram)){
					$redesf .= "<a href='".$sitInstagram."' rel='noreferrer' target='_blank'><img src='/themes/svg/iconInstagram.svg' alt='Instagram' title='Instagram'></a>";
					$redesw .= "<a href='".$sitInstagram."' rel='noreferrer' target='_blank'><img src='/themes/svg/iconInstagramW.svg' alt='Instagram' title='Instagram'></a>";
				}
				if(!empty($sitPinterest)){
					$redesf .= "<a href='".$sitPinterest."' rel='noreferrer' target='_blank'><img src='/themes/svg/iconPinterest.svg' alt='Pinterest' title='Pinterest'></a>";
					$redesw .= "<a href='".$sitPinterest."' rel='noreferrer' target='_blank'><img src='/themes/svg/iconPinterestW.svg' alt='Pinterest' title='Pinterest'></a>";
				}
			}
		}else{
			echo $sindatos;
		}
		$creditos = "<a href='http://www.socolombia.com/' rel='noreferrer' target='_blank'><img src='/themes/img/hector-ocampo.png' alt='<0> Desarrollo Web' title='</SOC> Desarrollo Web'></a>"; 
	}

	function contenido(){
		global $conexion;
		global $catIdReal;
		global $subIdReal;
		global $itemIdReal;

		$contenido = '<div id="articulo">';
		$sql = "SELECT not_id, not_nombre, not_texto, not_imagen, not_vistas FROM soc_noticia 
					 WHERE not_id_estado = 1 AND not_id_categoria = ".$catIdReal." 
					   AND not_id_subcategoria = ".$subIdReal." AND not_id_item = ".$itemIdReal." 
				  ORDER BY not_id DESC LIMIT 1";
		//echo "Globales 221: ".$sql;
		$result = mysqli_query($conexion,$sql);
		if($result){
			$num_rows = $result->num_rows;
			if($num_rows>0){
				while($rowts = $result->fetch_object()) {
					$notId = $rowts->not_id;
					$notNombre = utf8_encode(trim($rowts->not_nombre));
					$notRuta = urlamigable($notNombre);	
					$notResumen = utf8_encode(trim($rowts->not_texto));
					$notImagen = $rowts->not_imagen;
					$notVistas = $rowts->not_vistas+1;

					$sqlv = "UPDATE soc_noticia SET not_vista = not_vista + 1 
							  WHERE not_idestado = 1 AND not_idcategoria = 8 AND not_id = ".$notId;
					$resultv = mysqli_query($conexion,$sqlv);	

					$contenido .= '<h2>'.$notNombre.'</h2>';
					if(!empty($notImagen)){
						$noticias .= '<div class="fotos"><img src="images/'.$notImagen.'" alt="'.$notNombre.'" border="0"></div>';
					}
					$contenido .= '<p>'.$notResumen.'</p>';
				}
			}
		}
		$contenido .= '</div>';
		echo $contenido;
	}

	function sidebarleft(){
		echo '<div id="sidebar">sidebar</div>';
		
	}

	function sidebarright(){
		echo '<div id="sidebar">sidebar</div>';
		
	}
?>