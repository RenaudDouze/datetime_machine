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
     * Test corrects formats for the datetime machine
     */
    public function testCorrectFormats()
    {
        $this->assertEquals('DateTime', get_class(DateTimeMachine::travel('now')));

        $this->assertEquals('DateTime', get_class(DateTimeMachine::travel('1985-10-25 08:25')));

        $this->assertEquals('DateTime', get_class(DateTimeMachine::travel('1985-10-25 08:25:12')));
    }

    /**
     * Test non corrects format for the datetime machine with a relative datetime
     *
     * @expectedException \InvalidArgumentException
     */
    public function testNoncorrectFormatRelative()
    {
        DateTimeMachine::travel('yesterday');
    }

    /**
     * Test non corrects format for the datetime machine with only the hours
     *
     * @expectedException \InvalidArgumentException
     */
    public function testNoncorrectFormatOnlyHour()
    {
        DateTimeMachine::travel('1985-10-25 08');
    }

    /**
     * Test non corrects format for the datetime machine with microseconds
     *
     * @expectedException \InvalidArgumentException
     */
    public function testNoncorrectFormatWithMicroseconds()
    {
        DateTimeMachine::travel('1985-10-25 08:25:12.12345');
    }

    /**
     * Test non corrects format for the datetime machine with french format
     *
     * @expectedException \InvalidArgumentException
     */
    public function testNoncorrectFormatFrench()
    {
        DateTimeMachine::travel('25/10/1985 08:25:12');
    }

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
        $vanillaDateTime = new \Datetime('1985-10-25 08:25');

        $dtmFirst = DateTimeMachine::travel('1985-10-25 08:25');

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
        $vanillaDateTime = new \Datetime('1985-10-25 08:25');

        $dtmFirst = DateTimeMachine::travel('1985-10-25 08:25');

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
        $vanillaDateTime = new \Datetime('1985-10-25 08:25');

        $dtmFirst = DateTimeMachine::travel('1985-10-25 08:25');

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
        $vanillaDateTime = new \Datetime('1985-10-25 08:25');

        $dtmFirst = DateTimeMachine::travel('1985-10-25 08:25');

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
        $vanillaDateTime = new \Datetime('1985-10-25 08:25');

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
