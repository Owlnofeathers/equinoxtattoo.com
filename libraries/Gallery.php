<?php

class Gallery {

	public function getEnabledGalleries()
	{
		$galleries = "SELECT * FROM tblGallery WHERE GallerySwitch = 1";

		return $galleries;
	}
	
}