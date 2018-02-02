# SpyCss

[![Build
Status](https://secure.travis-ci.org/Bogdaan/spycss.png)](http://travis-ci.org/Bogdaan/spycss)

Analyze user interactions via CSS, without JavaScript on client-side.
Demo at [spycss.hcbogdan.com](https://spycss.hcbogdan.com).

> - Why?
> - Because we can

## How it works

As you probably know, in css we can add external resources via `url(resource)`
property. Usually, this resource is only loaded when its needed. So, we can
create HTML/CSS that will track user interactions, and send request to our
backend.

This library was created in order to simplify the creation of tracking css.

## How to use

First, install library with composer:

```bash
composer require bogdaan/spycss
```

For example, you want to track click / focus / hover on some link. This snippet
generates css and html for you link, inside view:

```php
<?php
use SpyCss\SpyCss;
use SpyCss\Interaction\Active;
use SpyCss\Interaction\Focus;
use SpyCss\Interaction\Hover;

// inside controller or DI:
$userId = 'get_from_cookie--OR--fetch_from_db';
$backendUrl = 'https://spy-css-backend/';
$s = new \SpyCss\SpyCss($userId, $backendUrl);

// inside you view, generates element:
// <a class="scsssXXXX" href="https://hcbogdan.com">Novikov Bogdan</a>
echo $s->builder()
    ->tag('a')
    ->content('Novikov Bogdan')
    ->attribute('href', 'https://hcbogdan.com')
    ->interactions([
        new Active('when-user-active'),
        new Focus('when-user-focus'),
        new Hover('when-user-hover'),
    ])
    ->get();

// generates special styles
echo '<style>'.$s->extractStyles().'</style>';
```

## Todo

- [ ] Review browser support
- [ ] Update demo
- [ ] Add more interactions
- [ ] Implement twig helper

## Read more

+ [Backend api](docs/backend-api.md)
+ [Demo sources](https://github.com/Bogdaan/spycss-demo)

## Contributing

Pull request are welcome.

Inspired by [jbtronics/CrookedStyleSheets](https://github.com/jbtronics/CrookedStyleSheets).
