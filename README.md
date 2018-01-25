# SpyCss

Analyze user interaction via CSS, without JavaScript on client-side.

> - Why?
> - Because we can

## How it works

As you probably know, in css we can add external resources via `url(resource)`
property. Usualy, this resource is only loaded when its needed. So, we can
create HTML/CSS that will track user interactions, and send request to our
backend.

This library was created in order to simplify the creation of tracking css.


## How to use

Generate css + html inside you views:
```
<?php

// <- inside controller or DI
$userId = 'get_from_cookie--OR--fetch_from_db';
$backendUrl = 'https://spy-css-backend/';
$s = new \SpyCss\SpyCss($userId, $backendUrl);


// <- inside you view
echo $s->builder()
    ->tag('a')
    ->attribute('href', 'https://hcbogdan.com')
    ->interactions([
        new Active('when-user-active'),
        new Focus('when-user-focus'),
        new Hover('when-user-hover'),
    ])
    ->get();

echo '<style>'.$s->extractStyles().'</style>';
```

## Read more

+ [Backend api](backend-api)

## To be done

- [ ] Create simplest backend
- [ ] Review browser support

## Contributing

Inspired by [jbtronics/CrookedStyleSheets](https://github.com/jbtronics/CrookedStyleSheets).

Pull request are welcome.
