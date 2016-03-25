<?php

class Event {

	public function getAllEvents()
	{
		$events = "SELECT * FROM tblEvents";

		return $events;
	}
	
	public function getEnabledEvents()
	{
		$events = "SELECT * FROM tblEvents WHERE EventSwitch = 1";

		return $events;
	}

	public function getEventById($id)
	{
		$event = "SELECT * FROM tblEvents WHERE id =" .$id;

		return $event;
	}
	
	public function insertEvent($enabled, $heading, $text, $buttonSwitch, $buttonText, $buttonLink)
	{
		$insert_row = "INSERT INTO tblEvents (EventSwitch, Heading, EventText, ButtonSwitch, ButtonText, ButtonLink) 
					VALUES (
        			'$enabled', '$heading', '$text', '$buttonSwitch', '$buttonText', '$buttonLink')";

        return $insert_row;
	}
	

	public function updateEvent($enabled, $heading, $text, $buttonSwitch, $buttonText, $buttonLink, $id)
	{
		$update_row = "UPDATE tblEvents 
				SET EventSwitch = '$enabled', 
					Heading = '$heading', 
					EventText = '$text', 
					ButtonSwitch = '$buttonSwitch', 
					ButtonText = '$buttonText', 
					ButtonLink = '$buttonLink'
          		WHERE id =" .$id;

        return $update_row;
	}

	public function deleteEvent($id)
	{
		$event = "DELETE FROM tblEvents WHERE id=" .$id;

		return $event;
	}
	
}