<?php

class Slider {

	public function getAllSliders()
	{
		$sliders = "SELECT * FROM tblSliders";

		return $sliders;
	}

	public function getSliderById($id)
	{
		$slider = "SELECT * FROM tblSliders WHERE id =" .$id;

		return $slider;
	}
	
	
	public function getEnabledSliders()
	{
		$slider = "SELECT * FROM tblSliders WHERE SlideSwitch = 1";

		return $slider;
	}

	public function updateSlider($enabled, $heading, $text, $buttonSwitch, $buttonText, $buttonLink, $id)
	{
		$update_row = "UPDATE tblSliders 
						SET SlideSwitch='$enabled', 
							Heading='$heading', 
							SlideText='$text', 
							ButtonSwitch='$buttonSwitch', 
							ButtonText='$buttonText', 
							ButtonLink='$buttonLink'
          				WHERE id =" .$id;

        return $update_row;
	}
	
	
}