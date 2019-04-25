<?php

namespace RenaudDouze\DateTimeMachine\Test;

use RenaudDouze\DateTimeMachine\DateTimeMachine;

/**
 * Test that DateTimeMachine traval to the good time
 */
final class DateTimeMachineTravelGoodTimeTest extends AbstractDateTimeMachineTest
{
    /**
     * Test that time-travel from now to now still get you to now
     */
    public function testComparaisonsBasic()
    {
        $vanillaDateTime = new \Datetime();

        $machineDatetime = DateTimeMachine::when();

        $this->assertEquals($machineDatetime->getTimestamp(), $vanillaDateTime->getTimestamp());

        $machineDatetime = DateTimeMachine::travel('now');

        $this->assertEquals($machineDatetime->getTimestamp(), $vanillaDateTime->getTimestamp());

        $machineDatetime = DateTimeMachine::goBack();

        $this->assertEquals($machineDatetime->getTimestamp(), $vanillaDateTime->getTimestamp());
    }

    /**
     * Time-travel to a date and check that we are (via WhenAreWe method)
     */
    public function testWhenAreWe()
    {
        $vanillaDateTime = new \Datetime('1985-10-25 08:25');

        $dtmFirst = DateTimeMachine::travel('1985-10-25 08:25');

        $this->assertEquals($dtmFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

        $dtmSecond = DateTimeMachine::whenAreWe();

        $this->assertEquals($dtmSecond->getTimestamp(), $vanillaDateTime->getTimestamp());
    }

    /**
     * Time-travel to a date and check that we are (via When method)
     */
    public function testWhen()
    {
        $vanillaDateTime = new \Datetime('1985-10-25 08:25');

        $dtmFirst = DateTimeMachine::travel('1985-10-25 08:25');

        $this->assertEquals($dtmFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

        $dtmSecond = DateTimeMachine::when();

        $this->assertEquals($dtmSecond->getTimestamp(), $vanillaDateTime->getTimestamp());
    }

    /**
     * Time-travel to now after time-travelling, so time-travel to the same date
     */
    public function testATravelForNothing()
    {
        $vanillaDateTime = new \Datetime('1985-10-25 08:25');

        $dtmFirst = DateTimeMachine::travel('1985-10-25 08:25');

        $this->assertEquals($dtmFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

        $dtmSecond = DateTimeMachine::travel('now');

        $this->assertEquals($dtmSecond->getTimestamp(), $vanillaDateTime->getTimestamp());
    }

    /**
     * Test the go back
     */
    public function testGoBack()
    {
        $now = new \Datetime();

        $vanillaDateTime = new \Datetime('1985-10-25 08:25');

        $dtmFirst = DateTimeMachine::travel('1985-10-25 08:25');

        $this->assertEquals($dtmFirst->getTimestamp(), $vanillaDateTime->getTimestamp());

        $dtmSecond = DateTimeMachine::goBack();

        $this->assertEquals($dtmSecond->getTimestamp(), $now->getTimestamp());
    }

    /**
     * Test that when() method return the current datetime if there is no previous time-travel
     */
    public function testWhenFirst()
    {
        $now = new \Datetime();
        $vanillaDateTime = new \Datetime('1985-10-25 08:25');

        $dtmFirst = DateTimeMachine::when();

        $this->assertEquals($dtmFirst->getTimestamp(), $now->getTimestamp());
        $this->assertNotEquals($dtmFirst->getTimestamp(), $vanillaDateTime->getTimestamp());
    }
}
