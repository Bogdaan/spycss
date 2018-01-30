<?php

namespace SpyCss;

/**
 * Tag builder
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Builder
{
    /**
     * SpyCss instance
     *
     * @var \SpyCss\SpyCss
     */
    private $spyCss;

    /**
     * HTML tag name.
     *
     * @var string
     */
    private $tag;

    /**
     * Interaction list.
     *
     * @var \SpyCss\Interaction
     */
    private $interactions = [];

    /**
     * HTML tag attributes.
     *
     * @var array
     */
    private $attributes = [];

    /**
     * HTML tag content.
     *
     * @var string|boolean
     */
    private $content = false;

    /**
     * Generate close tag or not.
     *
     * @var boolean
     */
    private $closeTag = true;

    /**
     * Create new builder instance.
     *
     * @param \SpyCss\SpyCss $spyCss
     */
    public function __construct(\SpyCss\SpyCss $spyCss)
    {
        $this->spyCss = $spyCss;
    }

    /**
     * Set tag name.
     *
     * @param  string $tag Html tag name
     * @return self
     */
    public function tag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * Set interaction list.
     *
     * @param  array  $interactions new interaction list
     * @return self
     */
    public function interactions(array $interactions)
    {
        $this->interactions = $interactions;
        return $this;
    }

    /**
     * Add interaction.
     *
     * @param \SpyCss\Interaction $interaction
     * @return self
     */
    public function addInteraction(\SpyCss\Interaction $interaction)
    {
        $this->interactions[] = $interaction;
        return $this;
    }

    /**
     * Set html tag attribtes.
     *
     * @see \SpyCss\Util\Html
     * @param  array $attributes
     * @return self
     */
    public function attributes(array $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * Set html tag attribute.
     *
     * @param  string $name  attribute name
     * @param  mixed $value  attribute value
     * @return self
     */
    public function attribute($name, $value)
    {
        $this->attributes[ $name ] = $value;
        return $this;
    }

    /**
     * Set html tag content.
     *
     * @param  mixed $content html tag content
     * @return self
     */
    public function content($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Its closed or open tag (like DIV or HR)?
     *
     * @param  boolean $closeTag true if its closed tag
     * @return self
     */
    public function closeTag($closeTag)
    {
        $this->closeTag = $closeTag;
        return $this;
    }

    /**
     * Create HTML tag string and update styles.
     *
     * @return string HTML tag
     */
    public function get()
    {
        $classList = [];
        foreach ($this->interactions as $i) {
            // if no cssClass provided - generate new one
            $cssClass = $i->getCssClass();
            if (empty($cssClass)) {
                $cssClass = uniqid('scss');
                $i->setCssClass($cssClass);
            }

            // add class to element attributes
            $this->spyCss->addCss(
                $i->getSnippet($this->spyCss)
            );
            $classList[] = $cssClass;
        }

        // add classes
        $attributes = $this->attributes;
        if (!empty($classList)) {
            if (!isset($attributes['class'])) {
                $attributes['class'] = '';
            } else {
                $attributes['class'] .= ' ';
            }
            $attributes['class'] .= implode(' ', $classList);
        }

        return \SpyCss\Util\Html::tag(
            $this->tag, $attributes, $this->content, $this->closeTag);
    }
}
