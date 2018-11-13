<?php

namespace mitsuhitofujita;

use PHPUnit\Framework\TestCase;

class JsonTest extends TestCase
{

    /**
     * @throws \mitsuhitofujita\JsonException
     */
    public function testDecodeToObject()
    {
        $value = (new Json())->decode('{"a":"A","b":2,"c":[5,4,3]}');
        $this->assertEquals((object)['a' => 'A', 'b' => 2, 'c' => [5, 4, 3]], $value);
    }

    /**
     * @throws \mitsuhitofujita\JsonException
     */
    public function testDecodeToArray()
    {
        $value = (new Json())->decode('{"a":"A","b":2,"c":[5,4,3]}', true);
        $this->assertSame(['a' => 'A', 'b' => 2, 'c' => [5, 4, 3]], $value);
    }

    /**
     * @throws \mitsuhitofujita\JsonException
     */
    public function testDecodeFromNumber()
    {
        $value = (new Json())->decode(123);
        $this->assertSame(123, $value);
    }

    /**
     * @throws \mitsuhitofujita\JsonException
     */
    public function testDecodeFromTrue()
    {
        $value = (new Json())->decode(true);
        $this->assertSame(1, $value);
    }

    /**
     * @expectedException \mitsuhitofujita\JsonException
     */
    public function testDecodeFromFalse()
    {
        (new Json())->decode(false);
    }

    /**
     * @expectedException \mitsuhitofujita\JsonException
     */
    public function testDecodeToThrowExceptionWhenFailed()
    {
        (new Json())->decode('{"a":"A","b":2,"c":[5,4,3');
    }

    /**
     * @throws JsonException
     */
    public function testEncodeFromArray()
    {
        $actual = (new Json())->encode([
            'a' => 'A',
            'b' => 'B',
            'c' => [0, 1, 2],
        ]);
        $this->assertSame('{"a":"A","b":"B","c":[0,1,2]}', $actual);
    }

    /**
     * @throws JsonException
     */
    public function testEncodeFromObject()
    {
        $actual = (new Json())->encode((object)[
            'a' => 'A',
            'b' => 'B',
            'c' => [0, 1, 2],
        ]);
        $this->assertSame('{"a":"A","b":"B","c":[0,1,2]}', $actual);
    }

    /**
     * @throws JsonException
     */
    public function testEncodeFromString()
    {
        $actual = (new Json())->encode('string');
        $this->assertSame('"string"', $actual);
    }

    /**
     * @throws JsonException
     */
    public function testEncodeFromInteger()
    {
        $actual = (new Json())->encode(123);
        $this->assertSame('123', $actual);
    }

    /**
     * @throws JsonException
     */
    public function testEncodeFromFalse()
    {
        $actual = (new Json())->encode(false);
        $this->assertSame('false', $actual);
    }

    /**
     * @throws JsonException
     */
    public function testEncodeFromNull()
    {
        $actual = (new Json())->encode(null);
        $this->assertSame('null', $actual);
    }
}
