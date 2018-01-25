<?php

namespace SpyCss\Interaction;

/**
 * Valid interaction relies on *:valid* css pseudoclass.
 * This ineraction actual only for *<input>* and *<form>* tags.
 * Particular, interesting *<input>* attribtes such as *pattern*, *required*.
 *
 * When user input valid content, payload will be sent to backend.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/CSS/%3Avalid
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Valid extends \SpyCss\Interaction
{
    /**
     * {@inheritDoc}
     */
    public function getSnippet(\SpyCss\SpyCss $spyCss)
    {
        $route = implode('/', [
            $spyCss->getBackend(),
            $spyCss->getUid(),
            'valid',
            $this->payload
        ]);
        return $this->cssClass.':valid {background-image: url('.$route.');}';
    }
}
