<?php

namespace SpyCss\Tests\Interaction;

use SpyCss\Tests\TestCase;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class PseudoTest extends TestCase
{
    public function testPseudoInteractions()
    {
        $interactions = [
            new \SpyCss\Interaction\Active('h'),
            new \SpyCss\Interaction\Checked('h'),
            new \SpyCss\Interaction\Focus('h'),
            new \SpyCss\Interaction\Hover('h'),
            new \SpyCss\Interaction\Valid('h'),
        ];

        $spyCss = new \SpyCss\SpyCss('d', 'c');
        foreach ($interactions as $i) {
            $this->assertStringStartsWith('.', $i->getSnippet($spyCss));
        }
    }
}
