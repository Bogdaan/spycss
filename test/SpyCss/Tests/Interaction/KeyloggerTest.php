<?php

namespace SpyCss\Tests\Interaction;

use SpyCss\Tests\TestCase;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class PseudoTest extends TestCase
{
    public function testFontFace()
    {
        $trackChars = 'abcd';
        $className = 'myOwnClass';

        $interaction = new \SpyCss\Interaction\Keylogger($trackChars, $className);
        $spyCss = new \SpyCss\SpyCss('d', 'c');

        $snippet = $interaction->getSnippet($spyCss);
        $this->assertContains('@font-face', $snippet);
    }
}
