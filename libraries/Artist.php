<?php

class Artist {

	public function getAllArtists()
	{
		$artists = "SELECT * FROM tblArtists";

		return $artists;
	}
	
	public function getArtistById($id)
	{
		$artist = "SELECT * FROM tblArtists WHERE id = " .$id;

		return $artist;
	}

	public function getEnabledArtists()
	{
		$artists = "SELECT * FROM tblArtists WHERE ArtistSwitch = 1";

		return $artists;
	}

	public function updateArtist($enabled, $name, $price, $description, $facebook, $instagram, $email, $id)
	{
		$update_row = "UPDATE tblArtists 
					SET ArtistSwitch = '$enabled', 
						Name = '$name', 
						Price = '$price', 
						Description = '$description', 
						Facebook = '$facebook', 
						Instagram = '$instagram', 
						Email = '$email'
          		 	WHERE id = " .$id;

        return $update_row;
	}
	
	
	
}