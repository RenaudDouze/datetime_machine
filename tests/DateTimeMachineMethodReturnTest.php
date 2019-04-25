<?php

namespace RenaudDouze\DateTimeMachine\Test;

use RenaudDouze\DateTimeMachine\DateTimeMachine;

/**
 * Test that the main methods always return the correct object/value
 */
final class DateTimeMachineMethodReturnTest extends AbstractDateTimeMachineTest
{
    /**
     * Test that the DateTimeMachine::when() always return a \DateTime
     */
    public function testReturnDatetime()
    {
        $machineDatetime = DateTimeMachine::when();

        $this->assertEquals('DateTime', get_class($machineDatetime));
        $this->assertNotEquals('RenaudDouze\DateTimeMachine\DateTimeMachine', get_class($machineDatetime));

        DateTimeMachine::travel('1985-10-25 08:25:12');

        $machineDatetime = DateTimeMachine::when();

        $this->assertEquals('DateTime', get_class($machineDatetime));
        $this->assertNotEquals('RenaudDouze\DateTimeMachine\DateTimeMachine', get_class($machineDatetime));
    }

    /**
     * Test that the DateTimeMachine::traval() always return a \DateTime
     */
    public function testMethodTraval()
    {
        $machineDatetime = DateTimeMachine::travel('now');

        $this->assertEquals('DateTime', get_class($machineDatetime));
        $this->assertNotEquals('RenaudDouze\DateTimeMachine\DateTimeMachine', get_class($machineDatetime));

        $machineDatetime = DateTimeMachine::travel('1985-10-25 08:25:12');

        $this->assertEquals('DateTime', get_class($machineDatetime));
        $this->assertNotEquals('RenaudDouze\DateTimeMachine\DateTimeMachine', get_class($machineDatetime));
    }

    /**
     * Test that the DateTimeMachine::goBack() always return a \DateTime
     */
    public function testMethodGoBack()
    {
        DateTimeMachine::travel('now');
        $machineDatetime = DateTimeMachine::goBack();

        $this->assertEquals('DateTime', get_class($machineDatetime));
        $this->assertNotEquals('RenaudDouze\DateTimeMachine\DateTimeMachine', get_class($machineDatetime));
    }
}
