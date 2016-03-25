<?php

class Gallery {

	public function getAllGalleries()
	{
		$galleries = "SELECT * FROM tblGallery";

		return $galleries;
	}
	
	public function getEnabledGalleries()
	{
		$galleries = "SELECT * FROM tblGallery WHERE GallerySwitch = 1";

		return $galleries;
	}

	public function getGalleryById($id)
	{
		$gallery = "SELECT * FROM tblGallery WHERE id=" .$id;

		return $gallery;
	}
	

	public function updateGallery($enabled, $galleryName, $galleryLink, $galleryText, $id)
	{
		$update_row = "UPDATE tblGallery 
					SET GallerySwitch = '$enabled', 
						GalleryName = '$galleryName', 
						GalleryLink = '$galleryLink', 
						GalleryText = '$galleryText'
          			WHERE id = " .$id;

        return $update_row;
	}
	
	
}