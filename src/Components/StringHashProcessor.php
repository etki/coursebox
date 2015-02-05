<?php
/**
 * Generates and verifies hashes.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
class StringHashProcessor
{
    /**
     * Generates hash based on input. Salt already included!.
     *
     * @param string $input String to hash.
     *
     * @return string Resulting hash.
     * @since 0.1.0
     */
    public static function generate($input)
    {
        return static::hash($input, static::generateRandomHash());
    }

    /**
     * Verifies that input string would resolve into provided hash.
     *
     * @param string $input Input string.
     * @param string $hash  Expected hashing result (with salt).
     *
     * @return bool
     * @since 0.1.0
     */
    public static function verify($input, $hash)
    {
        // ouch!
        $salt = substr($hash, 0, 32);
        return crypt($input, $salt) === $hash;
    }

    /**
     * Generates random hash.
     *
     * @return string Random hash.
     * @since 0.1.0
     */
    public static function generateRandomHash()
    {
        return md5(uniqid());
    }

    /**
     * Hashes input using salt.
     *
     * @param string $input Input string.
     * @param string $salt  Salt to use.
     *
     * @return string Hashed input string.
     * @since 0.1.0
     */
    private static function hash($input, $salt)
    {
        $saltTemplate = '$6$rounds=5000$%s$';
        $saltChunk = substr($salt, 0, 16);
        return crypt($input, sprintf($saltTemplate, $saltChunk));
    }
}
