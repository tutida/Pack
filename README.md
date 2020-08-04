# Pack plugin is for CakePHP3

You can easy to pass CakePHP4 variables to JS in View.

## Requirements ##

* PHP >= 7.0
* CakePHP >= 4.0

## Installation

In Application.php

```php
<?php
    $this->addPlugin('Pack');
```

In controller.

```php
<?php
    class AppController extends Controller
    {

        public function initialize()
        {
            $this->loadComponent('Pack.Pack');
        }
        ...
    }
```

In layout php or template php.

```php
    <?= $this->Pack->render();?>
```

## Usage

Just set variables in your controller.
```
<?php

    $entity = $this->Hoge->get($id);
    $array  = [...];

    $this->Pack->set('entity', $entity);
    $this->Pack->set('array', $array);

    ## OR ##
    $this->Pack->set(compact('entity', 'array'));

```

Just get the variables in your JS in view.
```js
    Pack.entity;
    Pack.array;
```


## Methods

1. set($varName, $variable) … Set variable in Pack.
2. remove($varNamee) … Remove variable in Pack.
3. show() … Show all variable in Pack.
4. rename($namespace) … Change Pack's namespace in JS.

example

In controller
```php
    $this->Pack->rename('Hoge');
    $this->Pack->set('array', $array);
```

In js
```js
    Hoge.array;
```

