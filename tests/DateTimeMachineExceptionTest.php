<?php

namespace RenaudDouze\DateTimeMachine\Test;

use RenaudDouze\DateTimeMachine\DateTimeMachine;

/**
 * Test exception
 */
final class DateTimeMachineExceptionTest extends AbstractDateTimeMachineTest
{
    /**
     * Test the exception when you try to go back and never time-travelled
     *
     * @expectedException \RunTimeException
     */
    public function testGoBackFirst()
    {
        DateTimeMachine::goBack();
    }

    /**
     * Test when you try to instanciate a DateTimeMachine
     *
     * @expectedException \RunTimeException
     */
    public function testConstruct()
    {
        new DateTimeMachine();
    }
}
