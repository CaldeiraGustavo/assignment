<?php

namespace Tests\Unit\Utils;

use App\Utils\Converter;
use Tests\TestCase;

class ConverterTest extends TestCase
{
    public function testShouldConvertGbIntoValue()
    {
        $expected = 3200;
        $string = '32GB';

        $this->assertEquals($expected, Converter::convertMemorySize($string));    
    }

    public function testShouldConvertMbIntoValue()
    {
        $expected = 160;
        $string = '16MB';

        $this->assertEquals($expected, Converter::convertMemorySize($string));
    }
    
    public function testShouldConvertTbIntoValue()
    {
        $expected = 64000;
        $string = '64TB';

        $this->assertEquals($expected, Converter::convertMemorySize($string));
    }

    public function testShouldNotConvertKbIntoValue()
    {
        $expected = null;
        $string = '64KB';

        $this->assertEquals($expected, Converter::convertMemorySize($string));
    }
}
