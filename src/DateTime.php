<?php

namespace RenaudDouze\DateTimeMachine;

/**
 * 
 */
class DateTime
{
	const SESSION_ITEMS_BAG = 'dmc_12';
	const SESSION_CONFIG_BAG = 'deLorean';

	const CONFIG_START_POINT = 'start_point';
	const CONFIG_INITIAL_DESTINATION = 'destination';
	const CONFIG_INTERVAL = 'interval';

	/**
	 * Travel through time.
	 * Set the datetime machine to a destination in time.
	 * 
	 * @param string 		$destination Datetime format, see http://php.net/manual/fr/datetime.formats.php
	 * @param \DateTimeZone $timezone 	 Destination timezone
	 *
	 * @see http://php.net/manual/fr/datetime.formats.php
	 *
	 * @throws \Exception See \Datetime::__construct
	 */
	public static function travel($destination, \DateTimeZone $timezone = null) 
	{
		$now = new \DateTime('now', $timezone);

		self::setInSession(self::CONFIG_START_POINT, $now, self::SESSION_CONFIG_BAG);
		self::setInSession(self::CONFIG_INITIAL_DESTINATION, $destination, self::SESSION_CONFIG_BAG);

		$new = new \DateTime($destination, $timezone);

		self::setInSession(self::CONFIG_INTERVAL, $now->diff($new), self::SESSION_CONFIG_BAG);

		return $new;
	}

	/**
	 * Constructor
	 */
	public function __construct()
	{
		throw new \RuntimeException("You can't instantiate an object. Use ::new() instead");
	}

	/**
	 * Named constructor
	 *
	 * @see \Datetime::construct
	 * 
	 * @param string        $time     
	 * @param \DateTimeZone $timezone 
	 *
	 * @throws \Exception See \Datetime::__construct
	 *
	 * @return DateTimeMachine
	 */
	public static function new($time = 'now', \DateTimeZone $timezone = null)
	{
		// var_dump(__METHOD__);

		// $new = parent::__construct($time);
		$new = new \DateTime($time, $timezone);
		
		// var_dump($new);		

		$interval = self::getInSession(self::CONFIG_INTERVAL, self::SESSION_CONFIG_BAG);
		
		// var_dump($interval);		

		if (null !== $interval && null !== $new) {
			$new->add($interval);	
		}

		// var_dump($new);	

		return $new;
	}

	/**
	 * Open the session
	 */
	protected static function openSession()
	{
		if ('' === session_id()) {
			session_start();
		}
	}

	/**
	 * Set in session
	 * @param mixed  $key   Item key
	 * @param mixed  $value Item value
	 * @param string $bag 	Session bag name where to save the item
	 */
	protected static function setInSession($key, $value, $bag = self::SESSION_ITEMS_BAG)
	{
		self::openSession();

		$_SESSION[$bag][$key] = $value;
	}

	/**
	 * Get in session
	 * @param mixed  $key Item key
	 * @param string $bag  bag name where to save the item
	 * 
	 * @return mixed Item value
	 */
	protected static function getInSession($key, $bag = self::SESSION_ITEMS_BAG)
	{
		self::openSession();

		return ((isset($_SESSION[$bag][$key])) ? $_SESSION[$bag][$key] : null);
	}
}