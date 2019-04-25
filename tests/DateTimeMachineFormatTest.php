<?php

namespace RenaudDouze\DateTimeMachine\Test;

use RenaudDouze\DateTimeMachine\DateTimeMachine;

/**
 * Test the enter format
 */
final class DateTimeMachineFormatTest extends AbstractDateTimeMachineTest
{
    /**
     * Test corrects formats for the datetime machine
     *
     * @param string $time The incorrect time
     *
     * @dataProvider validArgumentProvider
     */
    public function testCorrectFormats($time)
    {
        $this->assertEquals('DateTime', get_class(DateTimeMachine::travel($time)));
    }

    /**
     * Test non corrects format for the datetime machine
     *
     * @param string $time The incorrect time
     *
     * @dataProvider invalidArgumentProvider
     *
     * @expectedException \InvalidArgumentException
     */
    public function testNoncorrectFormatRelative($time)
    {
        DateTimeMachine::travel($time);
    }

    /**
     * List of all valid argument we want to test
     *
     * @return array
     */
    public function validArgumentProvider()
    {
        return [
            [
                'now',
                '1985-10-25 08:25',
                '1985-10-25 08:25:12',
            ],
        ];
    }

    /**
     * List of all invalid argument we want to test
     *
     * @return array
     */
    public function invalidArgumentProvider()
    {
        return [
            [
                'yesterday',
                '1985-10-25 08',
                '1985-10-25 08:25:12.12345',
                '25/10/1985 08:25:12',
            ],
        ];
    }
}
