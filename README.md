# SpyCss

[![Build
Status](https://secure.travis-ci.org/Bogdaan/spycss.png)](http://travis-ci.org/Bogdaan/spycss)

Analyze user interactions via CSS, without JavaScript on client-side.
Demo at [spycss.hcbogdan.com](https://spycss.hcbogdan.com).

> - Why?
> - Because we can

## How it works

As you probably know, in css we can add external resources via `url(resource)`
property. Usualy, this resource is only loaded when its needed. So, we can
create HTML/CSS that will track user interactions, and send request to our
backend.

This library was created in order to simplify the creation of tracking css.

## How to use

First, install library with composer:

```bash
composer require bogdaan/spycss
```

For example, you want to track click on some link. We can use [this snippet](https://jsfiddle.net/hcbogdan/tp4cj3jy/) to
generates CSS and HTML for you link inside view:

```php
<?php
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
        new \SpyCss\Interaction\Active('click_on_hcbogdan_com')
    ])
    ->get();

// generates special styles like:
// .scsssXXXX:active::after {content: url(https://spy-css-backend/userId/active/click_on_hcbogdan_com);}'
echo '<style>'.$s->extractStyles().'</style>';
```

You can create keylogger for **input type="text"** fields (snippet at [jsfiddle](https://jsfiddle.net/hcbogdan/6hmm2z47/)):

```php
<?php
// ... init SpyCss

// set alphabet
$logThisChars = 'abcdefgABCDEFG';

// create input field
echo $s->builder()
    ->tag('input')
    ->attribute('name', 'field')
    ->interactions([
        new \SpyCss\Interaction\Keylogger($logThisChars)
    ])
    ->get();

// generates special styles
echo '<style>'.$s->extractStyles().'</style>';
```

See more examples at [spycss-demo](https://github.com/Bogdaan/spycss-demo/blob/master/src/controllers.php#L22)


## Directory structure

```
./src/
├── Builder.php          # Tag builder with fluent interface
├── Interaction          #
│   ├── Active.php       # Track :active state
│   ├── Checked.php      # Track :checked state on input and option
│   ├── Focus.php        # Track :focus state
│   ├── Hover.php        # Track :hover state
│   ├── Keylogger.php    # Track key press on text fields
│   ├── Online.php       # Online tracking
│   ├── Pseudo.php       #
│   └── Valid.php        # Track :valid state
├── Interaction.php      # Base class for interactions
├── SpyCss.php           #
└── Util                 #
    └── Html.php         # Html tag helpers
```

## Todo

- [ ] Review browser support
- [ ] Update demo
- [ ] Add more interactions
- [ ] Implement twig helper

## Read more

+ [Backend api](docs/backend-api.md)
+ [Demo sources](https://github.com/Bogdaan/spycss-demo)
+ [Habrahabr (ru language)](https://habrahabr.ru/post/348196/)

## Contributing

Pull request are welcome.

Inspired by [jbtronics/CrookedStyleSheets](https://github.com/jbtronics/CrookedStyleSheets).
