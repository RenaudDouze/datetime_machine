<?php

namespace RenaudDouze\DateTimeMachine\Test;

use PHPUnit\Framework\TestCase;
use RenaudDouze\DateTimeMachine\DateTimeMachine;

/**
 * 
 */
final class DateTimeMachineTest extends TestCase
{
	/**
	 * 
	 */
	public function testBasics()
	{
		$machineDatetime = DateTimeMachine::when();

		$this->assertEquals('DateTime', get_class($machineDatetime));
		$this->assertNotEquals('RenaudDouze\DateTimeMachine\DateTimeMachine', get_class($machineDatetime));

		$machineDatetime = DateTimeMachine::travel('now');

		$this->assertEquals('DateTime', get_class($machineDatetime));
		$this->assertNotEquals('RenaudDouze\DateTimeMachine\DateTimeMachine', get_class($machineDatetime));

		$machineDatetime = DateTimeMachine::goBack();

		$this->assertEquals('DateTime', get_class($machineDatetime));
		$this->assertNotEquals('RenaudDouze\DateTimeMachine\DateTimeMachine', get_class($machineDatetime));
	}
	/**/

	/**
	 * 
	 */
	public function testComparaisonsBasic()
	{
		$machineDatetime = DateTimeMachine::when();
		$vanillaDateTime = new \Datetime();

		$this->assertEquals($machineDatetime->getTimestamp(), $vanillaDateTime->getTimestamp());

		$machineDatetime = DateTimeMachine::travel('now');
		$vanillaDateTime = new \Datetime();

		$this->assertEquals($machineDatetime->getTimestamp(), $vanillaDateTime->getTimestamp());

		$machineDatetime = DateTimeMachine::goBack();
		$vanillaDateTime = new \Datetime();

		$this->assertEquals($machineDatetime->getTimestamp(), $vanillaDateTime->getTimestamp());
	}
	/**/

	/**
	 * 
	 */
	public function testWhenAreWe()
	{
		$vanillaDateTime = new \Datetime('October 25, 1985');	

		$machineDatetimeFirst = DateTimeMachine::travel('October 25, 1985');

		$this->assertEquals($machineDatetimeFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

		$machineDatetimeSecond = DateTimeMachine::whenAreWe();

		$this->assertEquals($machineDatetimeSecond->getTimestamp(), $vanillaDateTime->getTimestamp());
	}
	/**/

	/**
	 * 
	 */
	public function testWhen()
	{
		$vanillaDateTime = new \Datetime('October 25, 1985');	

		$machineDatetimeFirst = DateTimeMachine::travel('October 25, 1985');

		$this->assertEquals($machineDatetimeFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

		$machineDatetimeSecond = DateTimeMachine::when();

		$this->assertEquals($machineDatetimeSecond->getTimestamp(), $vanillaDateTime->getTimestamp());
	}
	/**/

	/**
	 * 
	 */
	public function testATravelForNothing()
	{
		$vanillaDateTime = new \Datetime('October 25, 1985');	

		$machineDatetimeFirst = DateTimeMachine::travel('October 25, 1985');

		$this->assertEquals($machineDatetimeFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

		$machineDatetimeSecond = DateTimeMachine::travel('now');

		$this->assertEquals($machineDatetimeSecond->getTimestamp(), $vanillaDateTime->getTimestamp());
	}
	/**/

	/**
	 * 
	 */
	public function testGoBack()
	{
		$now = new \Datetime();
		$vanillaDateTime = new \Datetime('October 25, 1985');	

		$machineDatetimeFirst = DateTimeMachine::travel('October 25, 1985');

		$this->assertEquals($machineDatetimeFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

		$machineDatetimeSecond = DateTimeMachine::goBack();

		$this->assertEquals($machineDatetimeSecond->getTimestamp(), $now->getTimestamp());
	}
	/**/

	/**
	 * 
	 */
	public function testWhenFirst()
	{
		$now = new \Datetime();
		$vanillaDateTime = new \Datetime('October 25, 1985');	

		$machineDatetimeFirst = DateTimeMachine::when();

		$this->assertEquals($machineDatetimeFirst->getTimestamp(), $now->getTimestamp());
		$this->assertNotEquals($machineDatetimeFirst->getTimestamp(), $vanillaDateTime->getTimestamp());
	}
	/**/

	/**
	 * @expectedException \RunTimeException
	 */
	public function testGoBackFirst()
	{
		$machineDatetimeFirst = DateTimeMachine::goBack();
	}
	/**/

	/**
	 * @expectedException \RunTimeException
	 */
	public function testConstruct()
	{
		$datetime = new DateTimeMachine();
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