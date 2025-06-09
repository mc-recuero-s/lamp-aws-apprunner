<?php
	function seo(){
		global $conexion;
		global $catUrlReal;
		global $subUrlReal;
		global $itemUrlReal;
		global $catIdReal;
		global $subIdReal;
		global $itemIdReal;
		global $tituloReal;
		global $descripcionReal;
		global $keywordsReal;
		global $pagIdReal;
		global $sindatos;
		global $migas;
		global $id;
		
		if(!empty($itemUrlReal)){ 
			item();
		}elseif(!empty($subUrlReal)){ 
			subcategoria();
		}elseif($_SERVER['REQUEST_URI'] == "/"){
			$catUrlReal = "/";
			$pagIdReal = 1;
		}
	}

	function migas(){
		global $conexion;
		global $catUrlReal;
		global $subUrlReal;
		global $itemUrlReal;
		global $subNombreReal;
		global $itemNombreReal;
		global $tituloReal;
		global $DescripcionReal;
		global $keywordsReal;
		global $pagIdReal;
		global $sindatos;
		global $id;
		
		if(!empty($itemUrlReal)){ 
			subcategoria();
			item();
			$migas = "<a href='/'>Home</a> > <a href='/".$subUrlReal."/'>".$subNombreReal."</a> > ".$itemNombreReal;
		}elseif(!empty($subNombreReal)){ 
			subcategoria();
			$migas = "<a href='/'>Home</a> > ".$subNombreReal;
		}
		$migas = "<div id='migas'>Usted está en: ".$migas."</div>";
		echo $migas;
	}
	
	function categoria(){
		global $conexion;
		global $catUrlReal;
		global $catIdReal;
		global $catNombreReal;
		global $tituloReal;
		global $descripcionReal;
		global $keywordsReal;
		global $pagIdReal;
		global $sindatos;
		
		$sql = "SELECT cat_titulo, cat_descripcion, cat_keywords, cat_id_diseno 
		          FROM soc_categoria WHERE cat_id = '".$catIdReal."'"; 
		$result = mysqli_query($conexion,$sql);
		while($rows = $result->fetch_object()) {
			$catNombreReal = utf8_encode($rows->cat_titulo);
			$descripcionReal = utf8_encode($rows->cat_descripcion);
			$keywordsReal = utf8_encode($rows->cat_keywords);
			if(empty($pagIdReal)){
				$pagIdReal = $rows->cat_id_diseno;
				//echo "SEO 75: ".$pagIdReal;
			}
		}
	}

	function subcategoria(){
		global $conexion;
		global $catUrlReal;
		global $subUrlReal;
		global $catIdReal;
		global $subIdReal;
		global $itemUrlReal;
		global $catNombreReal;
		global $subNombreReal;
		global $itemNombreReal;
		global $tituloReal;
		global $DescripcionReal;
		global $keywordsReal;
		global $pagIdReal;
		global $sindatos;
		global $id;
		
		$sql = "SELECT sub_id, sub_id_categoria, sub_titulo, sub_descripcion, sub_keywords, sub_id_diseno 
		          FROM soc_subcategoria WHERE sub_ruta = '".$subUrlReal."' AND sub_id_sitio = ".$_SESSION['idSitio'];
		$result = mysqli_query($conexion,$sql);
		while($rows = $result->fetch_object()) {
			$subIdReal = $rows->sub_id;
			$catIdReal = $rows->sub_id_categoria;
			$subNombreReal = utf8_encode($rows->sub_titulo);
			$DescripcionReal = utf8_encode($rows->sub_descripcion);
			$keywordsReal = utf8_encode($rows->sub_keywords);
			if(empty($pagIdReal)){
				$pagIdReal = $rows->sub_id_diseno;
				//echo "SEO 108: ".$pagIdReal;
			}
		}
		categoria();
		if(!empty($itemNombreReal)){
			$tituloReal = $itemNombreReal." | ".$subNombreReal." | ".$catNombreReal." | ".$_SESSION['nombreSitio'];
		}else{
			$tituloReal = $subNombreReal." | ".$catNombreReal." | ".$_SESSION['nombreSitio'];
		}
	}

	function item(){
		global $conexion;
		global $catUrlReal;
		global $subUrlReal;
		global $itemUrlReal;
		global $itemNombreReal;
		global $itemIdReal;
		global $tituloReal;
		global $DescripcionReal;
		global $keywordsReal;
		global $pagIdReal;
		global $sindatos;
		global $id;
			
		$sql = "SELECT item_id, item_titulo, item_descripcion, item_keywords, item_id_diseno 
		          FROM soc_item WHERE item_ruta = '".$itemUrlReal."'"; 
		$result = mysqli_query($conexion,$sql);
		while($rows = $result->fetch_object()) {
			$itemIdReal = $rows->item_id;
			$itemNombreReal = utf8_encode($rows->item_titulo);
			$DescripcionReal = utf8_encode($rows->item_descripcion);
			$keywordsReal = utf8_encode($rows->item_keywords);
			$pagIdReal = $rows->item_id_diseno;
			//echo "SEO 142: ".$pagIdReal;
		}
		subcategoria();
	}
?>