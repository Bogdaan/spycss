<?php

namespace SpyCss\Interaction;

/**
 * Acitve interaction relies on *:hover* css pseudoclass.
 * When user hover over an element, payload will be sent to backend.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/CSS/%3Ahover
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Hover extends Pseudo
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'hover';
    }
}
