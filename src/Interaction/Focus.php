<?php

namespace SpyCss\Interaction;

/**
 * Acitve interaction relies on *:focus* css pseudoclass, witch represent
 * an element that has received focus. When user focus on element,
 * payload will be sent to backend.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/CSS/%3Afocus
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Focus extends Pseudo
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'focus';
    }
}
