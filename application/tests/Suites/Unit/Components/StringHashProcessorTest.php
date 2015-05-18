<?php

namespace Etki\Coursebox\Tests\Unit\Components;

use StringHashProcessor;
use Codeception\TestCase\Test;
use UnitTester;

class StringHashProcessorTest extends Test
{
    /**
     * Tester instance.
     *
     * @type UnitTester
     * @since 0.1.0
     */
    protected $tester;

    /**
     * Provides test data.
     *
     * @return string[][]
     * @since 0.1.0
     */
    public function inputProvider()
    {
        return array(
            array('test string',),
        );
    }

    // tests

    /**
     * Test hashing and hash verification.
     *
     * @param string $input String to hash.
     *
     * @dataProvider inputProvider
     *
     * @return void
     * @since
     */
    public function testHashVerification($input)
    {
        $hash = StringHashProcessor::generate($input);
        $this->assertTrue(StringHashProcessor::verify($input, $hash));
    }

    /**
     * Test hash generation randomness.
     *
     * @return void
     * @since 0.1.0
     */
    public function testRandomHashGeneration()
    {
        $this->assertNotSame(
            StringHashProcessor::generateRandomHash(),
            StringHashProcessor::generateRandomHash()
        );
    }

}