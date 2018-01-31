<?php

namespace SpyCss\Interaction;

/**
 * Class Pseudo represent interactions with pseudoclass-base
 * (such as hover, active, focus, etc.)
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Pseudo extends \SpyCss\Interaction
{
    /**
     * Get pseudoclass name
     *
     * @return string
     */
    public function getName()
    {
        throw new \RuntimeException('not implemented');
    }

    /**
     * {@inheritDoc}
     */
    public function getSnippet(\SpyCss\SpyCss $spyCss)
    {
        $pseudoClass = $this->getName();
        $route = implode('/', [
            $spyCss->getBackend(),
            $spyCss->getUid(),
            $pseudoClass,
            $this->getPayload()
        ]);
        return '.'.$this->cssClass.':'.$pseudoClass.'::after {content: url('.$route.');}';
    }
}
