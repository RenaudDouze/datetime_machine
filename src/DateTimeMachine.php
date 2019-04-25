<?php

namespace RenaudDouze\DateTimeMachine;

/**
 *
 */
class DateTimeMachine implements DateTimeMachineInterface
{
    const SESSION_CONFIG_BAG = 'deLorean';

    const CONFIG_START_POINT = 'start_point';
    const CONFIG_INITIAL_DESTINATION = 'destination';
    const CONFIG_INTERVAL = 'interval';

    /**
     * Constructor, Don't use it
     *
     * @throws \RunTimeException, in case somebody try to use it
     */
    public function __construct()
    {
        throw new \RunTimeException("You can't make a new DateTimeMachine. There is only one");
    }

    /**
     * {@inheritdoc}
     */
    public static function travel($destination, \DateTimeZone $timezone = null)
    {
        $new = self::when($destination, $timezone);

        if (null == self::getInSession(self::CONFIG_INTERVAL)) {
            $now = DateTimeMachine::getDateTime('now', $timezone);

            self::setInSession(self::CONFIG_START_POINT, $now);

            self::setInSession(self::CONFIG_INTERVAL, $now->diff($new));
        }

        return $new;
    }

    /**
     * {@inheritdoc}
     */
    public static function when($time = 'now', \DateTimeZone $timezone = null)
    {
        $new = DateTimeMachine::getDateTime($time, $timezone);

        // var_dump($time);
        // var_dump($new);

        $interval = self::getInSession(self::CONFIG_INTERVAL);

        if (null !== $interval && null !== $new) {
            $new->add($interval);
        }

        // var_dump($new);

        return $new;
    }

    /**
     * {@inheritdoc}
     */
    public static function goBack()
    {
        self::setInSession(self::CONFIG_INTERVAL, new \DateInterval('PT0S'));

        $start = self::getInSession(self::CONFIG_START_POINT);

        if (null === $start) {
            throw new \RunTimeException("You can't go back if you never left");

        }

        return $start;
    }

    /**
     * Alias for when()
     *
     * @see DateTimeMachine::when
     *
     * @param string        $time
     * @param \DateTimeZone $timezone
     *
     * @return \DateTime
     */
    public static function whenAreWe($time = 'now', \DateTimeZone $timezone = null)
    {
        return self::when($time, $timezone);
    }

    /**
     * Return a DateTime if the $time parameter is correct
     * The DateTime machine doesn't working well with relative and not enought precise $time except 'now'
     *
     * @param string        $time
     * @param \DateTimeZone $timezone
     *
     * @return \DateTime
     *
     * @throws \Exception
     */
    public static function getDateTime($time = 'now', \DateTimeZone $timezone = null)
    {
        if ('now' !== $time && ! preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}(:\d{2})?$/', $time)) {
            throw new \InvalidArgumentException("The time must be 'now' or YYYY-MM-DD HH:ii or YYYY-MM-DD HH:ii:ss.");
        }

        return new \DateTime($time, $timezone);

    }

    /**
     * Open the session
     */
    protected static function openSession()
    {
        if ('' === session_id()) {
            session_start();
        }
    }

    /**
     * Set in session
     * @param mixed  $key   Item key
     * @param mixed  $value Item value
     * @param string $bag   Session bag name where to save the item
     */
    protected static function setInSession($key, $value, $bag = self::SESSION_CONFIG_BAG)
    {
        self::openSession();

        $_SESSION[$bag][$key] = $value;
    }

    /**
     * Get in session
     * @param mixed  $key Item key
     * @param string $bag  bag name where to save the item
     *
     * @return mixed Item value
     */
    protected static function getInSession($key, $bag = self::SESSION_CONFIG_BAG)
    {
        self::openSession();

        return ((isset($_SESSION[$bag][$key])) ? $_SESSION[$bag][$key] : null);
    }
}
