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
     * Test that the DateTimeMachine always return a \DateTime
     */
    public function testReturnDatetime()
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
     * Test that time-travel from now to now still get you to now
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
     * Time-travel to a date and check that we are (via WhenAreWe method)
     */
    public function testWhenAreWe()
    {
        $vanillaDateTime = new \Datetime('October 25, 1985');

        $dtmFirst = DateTimeMachine::travel('October 25, 1985');

        $this->assertEquals($dtmFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

        $dtmSecond = DateTimeMachine::whenAreWe();

        $this->assertEquals($dtmSecond->getTimestamp(), $vanillaDateTime->getTimestamp());
    }
    /**/

    /**
     * Time-travel to a date and check that we are (via When method)
     */
    public function testWhen()
    {
        $vanillaDateTime = new \Datetime('October 25, 1985');

        $dtmFirst = DateTimeMachine::travel('October 25, 1985');

        $this->assertEquals($dtmFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

        $dtmSecond = DateTimeMachine::when();

        $this->assertEquals($dtmSecond->getTimestamp(), $vanillaDateTime->getTimestamp());
    }
    /**/

    /**
     * Time-travel to now after time-travelling, so time-travel to the same date
     */
    public function testATravelForNothing()
    {
        $vanillaDateTime = new \Datetime('October 25, 1985');

        $dtmFirst = DateTimeMachine::travel('October 25, 1985');

        $this->assertEquals($dtmFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

        $dtmSecond = DateTimeMachine::travel('now');

        $this->assertEquals($dtmSecond->getTimestamp(), $vanillaDateTime->getTimestamp());
    }
    /**/

    /**
     * Test the go back
     */
    public function testGoBack()
    {
        $now = new \Datetime();
        $vanillaDateTime = new \Datetime('October 25, 1985');

        $dtmFirst = DateTimeMachine::travel('October 25, 1985');

        $this->assertEquals($dtmFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

        $dtmSecond = DateTimeMachine::goBack();

        $this->assertEquals($dtmSecond->getTimestamp(), $now->getTimestamp());
    }
    /**/

    /**
     * Test that when() method return the current datetime if there is no previous time-travel
     */
    public function testWhenFirst()
    {
        $now = new \Datetime();
        $vanillaDateTime = new \Datetime('October 25, 1985');

        $dtmFirst = DateTimeMachine::when();

        $this->assertEquals($dtmFirst->getTimestamp(), $now->getTimestamp());
        $this->assertNotEquals($dtmFirst->getTimestamp(), $vanillaDateTime->getTimestamp());
    }
    /**/

    /**
     * Test the exception when you try to go back and never time-travelled
     *
     * @expectedException \RunTimeException
     */
    public function testGoBackFirst()
    {
        DateTimeMachine::goBack();
    }
    /**/

    /**
     * Test when you try to instanciate a DateTimeMachine
     *
     * @expectedException \RunTimeException
     */
    public function testConstruct()
    {
        new DateTimeMachine();
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
