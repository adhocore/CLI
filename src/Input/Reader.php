<?php

namespace Ahc\Cli\Input;

/**
 * Cli Reader.
 *
 * @author  Jitendra Adhikari <jiten.adhikary@gmail.com>
 * @license MIT
 *
 * @link    https://github.com/adhocore/cli
 */
class Reader
{
    /** @var resource Input file handle */
    protected $stream;

    /**
     * Constructor.
     *
     * @param string|null $path Read path. Defaults to STDIN.
     */
    public function __construct(string $path = null)
    {
        $this->stream = $path ? \fopen($path, 'r') : \STDIN;
    }

    /**
     * Read a line from configured stream (or terminal).
     *
     * @param mixed         $default The default value.
     * @param callable|null $fn      The validator/sanitizer callback.
     *
     * @throws \Exception When value is not valid.
     *
     * @return mixed
     */
    public function read($default = null, callable $fn = null)
    {
        $in = \rtrim(\fgets($this->stream), "\r\n");

        if ('' === $in && null !== $default) {
            return $default;
        }

        return $fn ? $fn($in) : $in;
    }
}
