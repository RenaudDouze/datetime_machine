<?php

namespace RenaudDouze\DateTimeMachine\Test;

use PHPUnit\Framework\TestCase;

/**
 *
 */
abstract class AbstractDateTimeMachineTest extends TestCase
{
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
