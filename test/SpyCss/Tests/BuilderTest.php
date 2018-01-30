<?php

namespace SpyCss\Tests;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class BuilderTest extends TestCase
{
    protected function getBuilder()
    {
        return new \SpyCss\Builder(
            new \SpyCss\SpyCss('d', 'c')
        );
    }

    /**
     * @covers \SpyCss\Builder::tag
     * @covers \SpyCss\Builder::content
     * @covers \SpyCss\Builder::attributes
     * @covers \SpyCss\Builder::attribute
     * @covers \SpyCss\Builder::closeTag
     */
    public function testTagBuilder()
    {
        $tag = $this->getBuilder()
            ->tag('a')
            ->content('sample')
            ->attributes([
                'href' => '/'
            ])
            ->get();
        $this->assertEquals('<a href="/">sample</a>', $tag);

        $tag = $this->getBuilder()
            ->tag('input')
            ->attribute('name', 'name')
            ->attribute('value', 'value')
            ->get();
        $this->assertEquals('<input name="name" value="value" />', $tag);
    }

    /**
     * @covers \SpyCss\Builder::get
     * @covers \SpuCss\SpyCss::getCss
     */
    public function testInteractionBuilder()
    {
        $spyCss = new \SpyCss\SpyCss('user', '/');
        $b = new \SpyCss\Builder($spyCss);

        $this->assertEmpty($spyCss->getCss());

        $className = 'css-class';
        $tag = $b
            ->tag('a')
            ->content('sample')
            ->attributes([
                'href' => '/'
            ])
            ->interactions([
                new \SpyCss\Interaction\Hover('payload', $className)
            ])
            ->get();
        $this->assertEquals('<a href="/" class="'.$className.'">sample</a>', $tag);

        $this->assertNotEmpty($spyCss->getCss());
        $this->assertContains('.'.$className, $spyCss->getCss());
    }
}
