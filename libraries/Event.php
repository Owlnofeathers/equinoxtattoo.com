<?php

class Event {

	public function getEnabledEvents()
	{
		$events = "SELECT * FROM tblEvents WHERE EventSwitch = 1";

		return $events;
	}
	
}