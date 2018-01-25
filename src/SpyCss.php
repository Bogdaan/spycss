<?php

namespace SpyCss;

/**
 * SpyCss provides methods for create HTML elements, with tracking css.
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class SpyCss
{
    /**
     * Unique user identifier
     *
     * @var string
     */
    private $uid;

    /**
     * Collected styles
     *
     * @var string
     */
    private $css = '';

    /**
     * SpyCss backend url.
     *
     * @var string
     */
    private $backend;

    /**
     * @param string $token User-related token
     */
    public function __construct($uid, $backend)
    {
        $this->uid = $uid;
        $this->backend = $backend;
    }

    /**
     * Get unique user identifier
     *
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Get SpyCss backend url
     *
     * @return string
     */
    public function getBackend()
    {
        return $this->backend;
    }

    /**
     * Get styles.
     *
     * @return string
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * Clean styles.
     *
     * @return \SpyCss\SpyCss
     */
    public function cleanCss()
    {
        $this->css = '';
        return $this;
    }

    /**
     * Get and clean styles.
     *
     * @return string
     */
    public function extractCss()
    {
        $tmp = $this->css;
        $this->css = '';
        return $tmp;
    }

    /**
     * Add new styles.
     *
     * @return \SpyCss\SpyCss
     */
    public function addCss($style)
    {
        $this->css .= $style;
        return $this;
    }

    /**
     * Create new tag builder.
     *
     * @see \SpyCss\Builder
     * @return \SpyCss\Builder
     */
    public function builder()
    {
        return new Builder($this);
    }

    /**
     * Create new builder with <a> tag.
     *
     * @param  string $content link content
     * @param  string $href    link href
     * @return \SpyCss\Builder
     */
    public function link($content, $href)
    {
        return (new Builder($this))
            ->tag('a')
            ->content($content)
            ->attribute('href', $href);
    }

    /**
     * Create new builder with <div> tag.
     *
     * @param  string $content tag content
     * @return \SpyCss\Builder
     */
    public function div($content)
    {
        return (new Builder($this))
            ->tag('a')
            ->content($content);
    }

    /**
     * Create new builder with <input type="text"> tag.
     *
     * @param  string $name  name attribute
     * @param  string $value value attribute
     * @return \SpyCss\Builder
     */
    public function textField($name, $value = '')
    {
        return (new Builder($this))
            ->tag('input')
            ->closeTag(false)
            ->attributes([
                'type' => 'text',
                'name' => $name,
                'value' => $value
            ]);
    }
}
