<?php

namespace DroplineMVC\Test;

use PHPUnit\Framework\TestCase;
use DroplineMVC\Utils\Validation;

class ValidationTest extends TestCase
{
    /**
     * @param string $originalString String to be checked
     * @param string $expectedResult What we expect our slug result to be
     *
     * @dataProvider providerTestStringEmpty
     */
    public function testStringEmpty(string $originalString, $expectedResult)
    {
        //$originalString = 'This is a test string';
        //$expectedResult = false;

        $result = Validation::stringEmpty($originalString);
        $this->assertEquals($expectedResult, $result);
    }

    public function providerTestStringEmpty()
    {
        return array(
            array('This is a test string',  false),
            array('',                       true),
            array('Another one',            false),
            array('   ',                    true),
        );
    }

    /**
     * @param string $originalString String to be checked
     * @param string $expectedResult What we expect our slug result to be
     *
     * @dataProvider providerTestValidEmailFormat
     */
    public function testValidEmailFormat(string $originalString, $expectedResult)
    {
        $result = Validation::validEmailFormat($originalString);
        $this->assertEquals($expectedResult, $result);
    }

    public function providerTestValidEmailFormat()
    {
        return array(
            array('test email',     false),
            array(' ',              false),
            array('test@mail.com',  true),
            array('tes t@mail.com', false),
        );
    }
}