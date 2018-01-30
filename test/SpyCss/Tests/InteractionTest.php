<?php

namespace SpyCss\Tests;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class InteractionTest extends TestCase
{
    public function testConstruct()
    {
        $css = 'a';
        $payload = 'b';
        $i = new \SpyCss\Interaction($payload, $css);
        $this->assertEquals($css, $i->getCssClass());
        $this->assertEquals($payload, $i->getPayload());
    }
}
