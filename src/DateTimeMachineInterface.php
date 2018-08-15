<?php

namespace RenaudDouze\DateTimeMachine;

/**
 * 
 */
interface DateTimeMachineInterface
{
	/**
	 * Travel through time.
	 * Set the datetime machine to a destination in time.
	 * 
	 * @param string 		$destination Datetime format, see http://php.net/manual/fr/datetime.formats.php
	 * @param \DateTimeZone $timezone 	 Destination timezone
	 *
	 * @return \DateTime The destination datetime 
	 *
	 * @see http://php.net/manual/fr/datetime.formats.php
	 *
	 * @throws \Exception See \Datetime::__construct
	 */
	public static function travel($destination, \DateTimeZone $timezone = null);

	/**
	 * When are we, get the current datetime. Current for the datetime machine
	 *
	 * @see \Datetime::construct
	 * 
	 * @param string        $time     
	 * @param \DateTimeZone $timezone 
	 *
	 * @return \DateTime The current datetime for the Datetime machine
	 *
	 * @throws \Exception See \Datetime::__construct
	 */
	public static function when($time = 'now', \DateTimeZone $timezone = null);

	/**
	 * Go back when the first travel begun 
	 * 
	 * @return \DateTime
	 */
	public static function goBack();
}