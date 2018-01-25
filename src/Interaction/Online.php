<?php

namespace SpyCss\Interaction;

/**
 * Online interaction can give answer for questions like:
 * "how long user hover over div".
 * Here we define inifinity animation with keyframes, that will request a URL
 * every time when new keyframe is requested.
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Online extends \SpyCss\Interaction
{
    /**
     * {@inheritDoc}
     */
    public function getSnippet(\SpyCss\SpyCss $spyCss)
    {
        $baseRoute = implode('/', [
            $spyCss->getBackend(),
            $spyCss->getUid(),
            'online',
            $this->payload
        ]);

        $durationSeconds = 5;
        $durationTemplate = '';
        $durationPc = 100 / $durationSeconds;
        for ($i = 0; $i <= 5; $i++) {
            $timing = $i * $durationPc;
            $durationTemplate .= $timing.'% {background-image: url("'.$baseRoute.'?t='.$timing.'")} ';
        }

        $browserPrefixes = [
            '-webkit-',
            '-moz-',
            '',
        ];

        $animationName = 'online'.$this->cssClass;

        $template = '';
        $propTemplate = '';

        foreach ($browserPrefixes as $preffix) {
            $template .= '@'.$preffix.'keyframes'.' '.$animationName
                .' { '.$durationTemplate.' }';

            $propTemplate .= $preffix.'animation: '.$animationName.' '.$durationSeconds.'s infinite;';
        }

        $template .= $this->cssClass.':hover::after { '
            .$propTemplate
            .'content: url("'. $baseRoute.'?t=-'.$durationSeconds.'"); }';

        return $template;
    }
}
