<?php

namespace SpyCss\Interaction;

/**
 * Checked interaction relies on *:checked* css pseudoclass. It actual for:
 * - <input type="radio">
 * - <input type="checkbox">
 * - select / option
 *
 * When user "check" element, payload will be sent to backend.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/CSS/%3Achecked
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Checked extends Pseudo
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'checked';
    }
}
