<?php  

// Functions for getting and displaying images from folder into lightbox

	function gallery_display($dir_to_search, $rel, $artist){
		$image_dir = $dir_to_search;
		$dir_to_search = scandir($dir_to_search);
		$image_exts = array('gif', 'jpg', 'jpeg', 'png');
			foreach ($dir_to_search as $image_file){
			$dot = strrpos($image_file, '.');
			$filename = substr($image_file, 0, $dot);
			$filetype = substr($image_file, $dot+1);		
				if (array_search($filetype, $image_exts) !== false){
					echo "<div class='grid-item'><a href='".$image_dir.$image_file."' data-lightbox='".$rel."' data-title='".$artist."`s Gallery'
					data-toggle='tooltip' data-placement='bottom' title='Open ".$artist."`s Gallery'>
					<img src='".$image_dir.$image_file."' alt='".$filename."' class='img-thumbnail img-responsive' title=''/>
					</a></div>"."\n";
				}
			}
	}

// This function will show the images in the lightbox but not display on the page.

	function gallery_no_display($dir_to_search, $rel, $artist){
		$filecount = 0;
		$image_dir = $dir_to_search;
		$dir_to_search = scandir($dir_to_search);
		$image_exts = array('gif', 'jpg', 'jpeg', 'png');
		
		if($dir_to_search){
			$filecount = count($dir_to_search);
		}
			foreach ($dir_to_search as $image_file){
			$dot = strrpos($image_file, '.');
			$filename = substr($image_file, 0, $dot);
			$filetype = substr($image_file, $dot+1);		
				if ( array_search($filetype, $image_exts) !== false){
					echo "<a href='".$image_dir.$image_file."' data-lightbox='".$rel."' data-title='".$artist."`s Gallery'></a>"."\n";
				}
			}
		echo "<small>&nbsp;&nbsp;Select $artist`s picture to see a gallery with $filecount more images.</small>";
	}
?>