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
        $now = new \DateTime();
        DateTimeMachine::travel('1985-10-25 08:25');

        $machineDatetime = DateTimeMachine::goBack();

        $this->assertEquals($machineDatetime->getTimestamp(), $now->getTimestamp());
    }

    /**
     * Test the go back after many travel
     */
    public function testGoBackAfterManyTravel()
    {
        DateTimeMachine::travel('2018-01-01 10:00');
        $dtmFirst = DateTimeMachine::travel('2016-01-01 10:00');
        $dtmSecond = DateTimeMachine::travel('2017-01-01 10:00');

        $dtmFirstBack = DateTimeMachine::goBack();

        $this->assertEquals($dtmFirst->getTimestamp(), $dtmFirstBack->getTimestamp());

        DateTimeMachine::travel('2015-01-01 10:00');

        $dtmSecondBack = DateTimeMachine::goBack();

        $this->assertEquals($dtmSecond->getTimestamp(), $dtmSecondBack->getTimestamp());
    }

    /**
     * Test that when() method return the current datetime if there is no previous time-travel
     */
    public function testWhenFirst()
    {
        $vanillaDateTime = new \Datetime('1985-10-25 08:25');

        $dtmFirst = DateTimeMachine::when();

        $this->assertNotEquals($dtmFirst->getTimestamp(), $vanillaDateTime->getTimestamp());
    }
}
