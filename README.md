# php-filecoin-address 


```lang=bash
$ composer require adamyu1024/filecoin-address
```

## Usage

Create a new address:

```php
<?php

require_once 'vendor/autoload.php';

use adamyu1024\Filecoin\Address;

$address = new Address();

// get address
$address->get();
// hb4737umuzzbcfd3xxk3bdtwezgistj7dycypvi

$address->getPrivateKey();
// ee2868ca9485673b36c38ba4f18551be25d08dd9be9bd24c44cd626b37cadae4

$address->getPublicKey();
// 040c53eabf2389b06d36cb4e65a935c5473c0d2a0dd130b6a00bb1e3f987d7b7719079f5f1be4c3b35f3a12e31191632bf8fdd73de5cae553eadbd63d2cba41879
```

Or load one from private key:

```php
<?php

require_once 'vendor/autoload.php';

use adamyu1024\Filecoin\Address;

$privateKey = 'ee2868ca9485673b36c38ba4f18551be25d08dd9be9bd24c44cd626b37cadae4';
$address = new Address($privateKey);

// get address
$address->get();
// hb4737umuzzbcfd3xxk3bdtwezgistj7dycypvi

$address->getPrivateKey();
// ee2868ca9485673b36c38ba4f18551be25d08dd9be9bd24c44cd626b37cadae4

$address->getPublicKey();
// 040c53eabf2389b06d36cb4e65a935c5473c0d2a0dd130b6a00bb1e3f987d7b7719079f5f1be4c3b35f3a12e31191632bf8fdd73de5cae553eadbd63d2cba41879
```

## License

MIT
