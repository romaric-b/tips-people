<?php

class Service
{
	public static function dateFr()
	{
		$date = new \DateTime();
		
		return $dateFr = $date->format('d-m-Y H:i:s');
	}
}
