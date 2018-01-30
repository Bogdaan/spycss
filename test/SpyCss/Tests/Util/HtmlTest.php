<?php

namespace SpyCss\Tests;

use \SpyCss\Util\Html;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class HtmlTest extends TestCase
{
    public function testTag()
    {
        $this->assertEquals('<a>link</a>',
            Html::tag('a', [], 'link', true));

        $this->assertEquals('<input />',
            Html::tag('input', [], false, true));

        $this->assertEquals('<input type="text" />',
            Html::tag('input', ['type' => 'text'], false, true));

        $this->assertEquals('<div><br /></div>',
            Html::tag('div', [], '<br />', true));
    }
}
