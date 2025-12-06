# Larabill Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/aichadigital/larabill-filament.svg?style=flat-square)](https://packagist.org/packages/aichadigital/larabill-filament)
[![Total Downloads](https://img.shields.io/packagist/dt/aichadigital/larabill-filament.svg?style=flat-square)](https://packagist.org/packages/aichadigital/larabill-filament)

> **Warning**
> This package is under active development and is NOT ready for production use.
> API and features may change without notice.

---

Filament admin panel resources for [Larabill](https://github.com/AichaDigital/larabill) billing package.

## Requirements

- PHP 8.4+
- Laravel 11.x / 12.x
- Filament 4.x
- [aichadigital/larabill](https://github.com/AichaDigital/larabill) ^0.4

## Installation

```bash
composer require aichadigital/larabill-filament
```

## Resources Included

This package provides Filament Resources for:

- **CustomerResource** - Manage customers and their tax profiles
- **ArticleResource** - Products and services with recurring billing
- **InvoiceResource** - Invoices, proformas, and rectificatives
- **PaymentResource** - Payment management (coming soon)

## Usage

Resources are automatically registered with your Filament panel.

## Related Packages

| Package | Description |
|---------|-------------|
| [larabill](https://github.com/AichaDigital/larabill) | Core billing backend |
| [lara-verifactu-filament](https://github.com/AichaDigital/lara-verifactu-filament) | Spanish AEAT Verifactu UI |
| [lararoi-filament](https://github.com/AichaDigital/lararoi-filament) | EU VAT/ROI verification UI |
| [laratickets-filament](https://github.com/AichaDigital/laratickets-filament) | Support tickets UI |

## Testing

```bash
composer test
```

## Credits

- [Abdelkarim Mateos Sanchez](https://github.com/abkrim)
- [All Contributors](../../contributors)

## License

MIT License. See [LICENSE](LICENSE.md) for details.
