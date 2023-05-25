<?php
$arch=array($_FILES['imagenes']);
$cont=0;
$add=[];
$temp=[];
foreach ($arch as $str){
	 if (is_array($str['name'])) {  
			  for ($a=0; $a<count($str['name']);$a++){
			   $add[$a]=$str['name'][$a];
			   if(file_exists('./imagenes/'.$add[$a])){
					echo "El Archivo ".$add[$a]. " ya existe";
					return;
				}  
			  }	   
      }
	  if (is_array($str['tmp_name'])){
		 for ($a=0; $a<count($str['name']);$a++){
		$temp[$a]=$str['tmp_name'][$a];
		 }
	  }
	  if (is_array($str['tmp_name'])){
		for ($a=0; $a<count($str['name']);$a++){
		if( $str['size'][$a] >5000000){//Aca se fijan si el archivo tiene el tamaño adecuado el q ustedes quieran
			echo "El Archivo ".$str['name'][$a]." Es muy grande";
			return;
		}
			
		 }

		
	 }
	 
}	

foreach ($add as $ver){
	$archivin= basename($ver);
	$imageFileTypes = strtolower(pathinfo($archivin,PATHINFO_EXTENSION));
		if($imageFileTypes != "jpg" && $imageFileTypes != "png" && $imageFileTypes != "jpeg"
				&& $imageFileTypes != "gif" ) {	
					echo "nopermitido";
					return;
				}
				 			  
}
 foreach ($add as $ad){
	     
		
		  $target_dir = "./imagenes/";
		  $target_file = $target_dir . basename($ad);//cargo los nombres o las rutas de las imagenes y la ruta a donde la voy a poner
		  $check = getimagesize($temp[$cont]);
			
					
				list($width, $height, $type) = $check;
				$newwidth = '700';
				$newheight = '500';
				
				$thumb = imagecreatetruecolor($newwidth, $newheight);
				
				   if( $type == IMAGETYPE_JPEG ) {
					   $source = imagecreatefromjpeg($temp[$cont]);

	
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					   imagejpeg($thumb,$target_dir.$add[$cont]);

					}
					elseif( $type == IMAGETYPE_PNG ) {
						$source = imagecreatefrompng($temp[$cont]);

					  imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					   imagepng($thumb,$target_dir.$add[$cont]);
					}
					elseif( $type == IMAGETYPE_GIF ) {
						$source = imagecreatefromgif($temp[$cont]);

					
						imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
						imagegif($thumb,$target_dir.$add[$cont]);
					}
				echo "<img width='700' height='500' src='$target_dir$add[$cont]'>";
					
			  $cont+=1;
		}
	
?>