<?php

use \SpyCss\SpyCss;
use \SpyCss\Interaction\Active;
use \SpyCss\Interaction\Focus;
use \SpyCss\Interaction\Hover;
use \SpyCss\Interaction\Online;
use \SpyCss\Interaction\Valid;

$userId = 'get_from_cookie--OR--fetch_from_db';
$backendUrl = 'https://spy-css-backend/';

$s = new SpyCss($userId, $backendUrl);

echo $s->builder()
    ->tag('a')
    ->attribute('href', 'https://hcbogdan.com')
    ->interactions([
        new Active('payload'),
        new Focus('payload2'),
        new Hover('payload3'),
    ])
    ->get();

echo $s->builder()
    ->tag('div')
    ->content('Lorem ipsum dolor sit amet')
    ->interactions([
        new Hover('payload-div'),
    ])
    ->get();

echo $s->builder()
    ->tag('input')
    ->closeTag(false)
    ->attribute('required', true)
    ->interactions([
        new Valid('payload-input'),
    ])
    ->get();

echo '<style>'.$s->extractStyles().'</style>';
