<?php

class Artist {

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
	
	
}