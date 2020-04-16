
# Data Type Mapper
 Digunakan untuk merubah format array / json menjadi php syntax valuenya akan dirubah jadi type, jadi intinya tinggal copy paste trus bisa buat validasi type data. Pokoknya gitu deh.


----------
# Support me
- ![Paypal](https://raw.githubusercontent.com/walangkaji/emboh/master/img/paypal.png) Paypal: [Se-Ikhlasnya Saja](https://www.paypal.me/walangkaji)
----------
### Cara Install

### Composer
```sh
$ composer require walangkaji/data-type-mapper
```

### Clone
```sh
$ git clone https://github.com/walangkaji/data-type-mapper.git
$ cd data-type-mapper/
$ composer install
```

### Cara Pakai

```php
require __DIR__ . '/vendor/autoload.php';

$mapper = new walangkaji\Mapper\DataTypeMapper();

// Array data to be process
$array = [
    'siji' => [
        'loro'  => 2,
        'telu'  => 'mangan watu',
        'papat' => [
            'papat siji',
            'papat loro',
        ],
        'limo' => 'mangan tumo',
    ],
    'enem' => [
        'pitu' => 'pitu telu',
        'wolu' => [
            'songo',
            'sepuloh',
        ],
        'songolas' => [],
    ],
];

$result = $mapper->getResult($array);

echo $result;
```

Bisa menggunakan json data :

```php
// Json data to be process
$json = '{
  "siji": {
    "loro": 2,
    "telu": "mangan watu",
    "papat": [
      "papat siji",
      "papat loro"
    ],
    "limo": "mangan tumo"
  },
  "enem": {
    "pitu": "pitu telu",
    "wolu": [
      "songo",
      "sepuloh"
    ],
    "songolas": []
  }
}';

$result = $mapper->getResult($json);

echo $result;
```

Output :
```php
[
    'siji' => [
        'loro' => 'integer',
        'telu' => 'string',
        'papat' => [
            'string',
            'string',
        ],
        'limo' => 'string',
    ],
    'enem' => [
        'pitu' => 'string',
        'wolu' => [
            'string',
            'string',
        ],
        'songolas' => 'array',
    ],
]
```
Cukup sekian dan Matursuwun.

Jangan lupa kalo mau support seikhlasnya bisa lewat sini:
- ![Paypal](https://raw.githubusercontent.com/walangkaji/emboh/master/img/paypal.png) Paypal: [Se-Ikhlasnya Saja](https://www.paypal.me/walangkaji)