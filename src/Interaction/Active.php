<?php

namespace SpyCss\Interaction;

/**
 * Acitve interaction relies on *:active* css pseudoclass, witch represent
 * an element that is being activated by the user. When user activates element,
 * payload will be sent to backend.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/CSS/%3Aactive
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Active extends Pseudo
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'active';
    }
}
