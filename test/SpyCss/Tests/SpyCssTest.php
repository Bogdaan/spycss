<?php

namespace SpyCss\Tests;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class SpyCss extends TestCase
{
    protected function getSpyCss()
    {
        return new \SpyCss\SpyCss('d', 'c');
    }

    /**
     * @covers \SpyCss\SpyCss::__construct
     * @covers \SpyCss\SpyCss::getUid
     * @covers \SpyCss\SpyCss::getBackend
     */
    public function testConstructor()
    {
        $userId = 'd';
        $backend = 'http://c/';

        $s = new \SpyCss\SpyCss($userId, $backend);
        $this->assertEquals($userId, $s->getUid());
        $this->assertEquals($backend, $s->getBackend());
    }

    /**
     * @covers \SpyCss\SpyCss::getCss
     * @covers \SpyCss\SpyCss::cleanCss
     * @covers \SpyCss\SpyCss::addCss
     * @covers \SpyCss\SpyCss::extractCss
     */
    public function testCssContainer()
    {
        $s = $this->getSpyCss();
        $this->assertEmpty($s->getCss());

        $newStyles = 'a {}';
        $this->assertInstanceOf(\SpyCss\SpyCss::class, $s->cleanCss());
        $this->assertInstanceOf(\SpyCss\SpyCss::class, $s->addCss($newStyles));

        $this->assertEquals($newStyles, $s->getCss());
        $this->assertEquals($newStyles, $s->extractCss());
        $this->assertEmpty($s->getCss());
    }

    /**
     * @covers \SpyCss\SpyCss::builder
     */
    public function testBuilder()
    {
        $s = $this->getSpyCss();
        $this->assertInstanceOf(\SpyCss\Builder::class, $s->builder());
    }
}
