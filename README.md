# PEST PLUGIN INSIDE

This plugin checks what's inside the files.


[![Tests](https://github.com/faissaloux/pest-plugin-inside/actions/workflows/tests.yml/badge.svg)](https://github.com/faissaloux/pest-plugin-inside/actions/workflows/tests.yml) ![Codecov](https://img.shields.io/codecov/c/github/faissaloux/pest-plugin-inside) ![Packagist Version](https://img.shields.io/packagist/v/faissaloux/pest-plugin-inside) ![Packagist License](https://img.shields.io/packagist/l/faissaloux/pest-plugin-inside)

### Success

```php
<?php

// lowercase.php

return [
    'lower',
    'case',
    'lowercase',
];

```

```php
expect('lowercase.php')->toReturnLowercase();
```

### Failure

```php
<?php

// notlowercase.php

return [
    'lower',
    'caSe',
    'lowercase',
];

```

```php
expect('notlowercase.php')->toReturnLowercase();
```

### Scan directory

You can scan all directory files at once

```php
expect('directory')->toReturnLowercase();
```