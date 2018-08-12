<?php

namespace RenaudDouze\DateTimeMachine\Test;

use PHPUnit\Framework\TestCase;

// use \DateTime as \Datetime;
use RenaudDouze\DateTimeMachine\DateTime;

/**
 * 
 */
final class DateTimeTest extends TestCase
{
	/**
	 * 
	 * /
	public function testConstructBasic()
	{
		$machineDatetime = new DateTime();

		$this->assertEquals('RenaudDouze\DateTimeMachine\DateTime', get_class($machineDatetime));
		$this->assertNotEquals('DateTime', get_class($machineDatetime));
	}
	/**/

	/**
	 * 
	 * /
	public function testComparaisonBasic()
	{
		$machineDatetime = new DateTime();
		$vanillaDateTime = new \Datetime();

		$this->assertEquals($machineDatetime->getTimestamp(), $vanillaDateTime->getTimestamp());
	}
	/**/

	/**
	 * 
	 */
	public function testNamedConstruct()
	{
		$vanillaDateTime = new \Datetime('October 25, 1985');		
		$machineDatetimeFirst = DateTime::travel('October 25, 1985');

		$this->assertEquals($machineDatetimeFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

		// var_dump('SECOND');
		$machineDatetimeSecond = DateTime::new();

		// var_dump($machineDatetimeSecond->format('Ymd his'));
		// var_dump($vanillaDateTime->format('Ymd his'));
		
		$this->assertEquals($machineDatetimeSecond->getTimestamp(), $vanillaDateTime->getTimestamp());
	}
	/**/

	/**
	 * 
	 */
	public function testConstruct()
	{
		$vanillaDateTime = new \Datetime('October 25, 1985');		
		$machineDatetimeFirst = DateTime::travel('October 25, 1985');

		$this->assertEquals($machineDatetimeFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

		// var_dump('SECOND');
		$machineDatetimeSecond = new DateTime();
		var_dump($machineDatetimeSecond);

		// var_dump($machineDatetimeSecond->format('Ymd his'));
		// var_dump($vanillaDateTime->format('Ymd his'));
		
		$this->assertEquals($machineDatetimeSecond->getTimestamp(), $vanillaDateTime->getTimestamp());
	}
	/**/

	/**
	 * Set up
	 */
	protected function setUp()
    {
    	if ('' !== session_id()) {
			session_reset();
		}

	}
}