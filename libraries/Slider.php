<?php

class Slider {

	public function getEnabledSliders()
	{
		$slider = "SELECT * FROM tblSliders WHERE SlideSwitch = 1";

		return $slider;
	}
	
}