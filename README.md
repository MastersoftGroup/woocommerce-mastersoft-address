# mastersoft-address-woocommerce

Loqate AU NZ Address Autocomplete plugin for WooCommerce.

For the up to date user guide pelase visit https://docs.mastersoftgroup.com/loqate-harmony-api/integrations/woocommerce-plugin/woocommerce-user-guide

## Description

Australia and New Zealand Address Autocomplete plugin for WooCommerce Checkout and Account Billing and Shipping Addresses.

Features:
* Autocomplete billing and shipping address in Checkout page
* Autocomplete address in My Account page for Customer's billing address and shipping address
* Only activated when the selected country is Australia or New Zealand
* Settings for Mastersoft Address, such as Source of Truth

Get started with a [FREE Trial licence key](https://www.loqate.com/anz/register/).

## Installation 

This plugin requires WooCommerce. Please make sure WooCommerce is installed.

### Automatic installation

Automatic installation is not currently available.

### Manual installation

1. Download the zip file of the latest release from [GitHub](https://github.com/MastersoftGroup/woocommerce-mastersoft-address).
1. Upload the zip file to your WordPress plugins directory by either:
    * Upload the zip file using your WordPress Admin:

        Log in to WordPress Admin > go to `Plugins` > `Add New` > `Upload Plugin` button > upload the zip file

        **OR**
    * Upload and unzip the zip file into your WordPress plugins directory: `WP_ROOT/wp-content/plugins/`. The `WP_ROOT` is usually `/var/www/html/`.

After installation, the WordPress plugins directory should include the `woocommerce-mastersoft-address` directory with the same file structure as the GitHub.

### Composer installation

The plugin is also available for installation from [Packagist](https://packagist.org/packages/mastersoft/woocommerce-mastersoft-address).

1. Download and install composer:

    ```
    $ curl -sS https://getcomposer.org/installer | php
    $ mv composer.phar /usr/local/bin/composer
    ```
1. Install with composer by either:
    * Create `composer.json` file in the `WP_ROOT` and add the `mastersoft/woocommerce-mastersoft-address` package. For example, to add `woocommerce-mastersoft address` v1.0.1.

        ```
        {
            "require": {
                "mastersoft/woocommerce-mastersoft-address": "1.0.1"
            }
        }
        ```
        Install the package:

        `$ composer install`

        **OR**
    * Use extended composer command and install:

        `$ composer require mastersoft/woocommerce-mastersoft-address:<version>`

        The `<version>` is optional.

After installation, the WordPress plugins directory should include the `woocommerce-mastersoft-address` directory with the same file structure as the GitHub.

#### Updating an existing Composer installation

1. Update `composer.json` in your WordPress plugins directory with the version to be downloaded:

    `$ composer require mastersoft/woocommerce-mastersoft-address:<version> --no-update `

    Alternatively, you can also update the version of `mastersoft/woocommerce-mastersoft-address` package in the `composer.json` file by directly editing it.

1. Download and install the updated version of `mastersoft/woocommerce-mastersoft-address`:

    `$ composer update`

### Post installation

1. Activate plugin: log in your WordPress Admin > got to `Plugins` > `Installed Plugins` > scroll to `Mastersoft Address` plugin and click `Activate`
1. Configure plugin by following the [Configuration](#configuration) guide.

### Disable/enable plugin

To disable: log in to your WordPress Admin > go to `Plugins` > `Installed Plugins` > scroll to `Mastersoft Address` plugin and click `Deactivate` to disable plugin.

This will disable the functionality but will still keep all your configuration settings, so you do not need to configure when you enable the plugin again. 

To enable: log in to your WordPress Admin > go to `Plugins` > `Installed Plugins` > scroll to `Mastersoft Address` plugin and click `Activate` to enable plugin.

### Uninstallation

Log in to your WordPress Admin > go to `Plugins` > `Installed Plugins` > scroll to `Mastersoft Address` and click `Deactivate` and `Delete`.

This will uninstall and delete all the configuration settings in your database. 

If there is an error message during the deleting process `Could not fully remove the plugin ....`, please make sure the file ownership is set to `www-data`. To correct the ownership, change to your WordPress plugins directory:

`$ chown -R www-data:www-data woocommerce-mastersoft-address`

## Configuration

Log in to your WordPress Admin > go to `WooCommerce` > `Settings` > `Mastersoft Address` tab.

* **Licence Key:** (mandatory). Get your [FREE Trial licence key](https://www.loqate.com/anz/register/). Must be in **username-without-domain:password** format. Default Value: blank/empty.
* **URL:** Default value if empty/blank: `https://hosted.mastersoftgroup.com`.
* **Default Widget Options:** Generic Widget Options for both AUSTRALIA and NEW ZEALAND. Pre-configured and default value:

    `{ singleLineHitNumber: 5, caseType: "TITLE" }`
* **Widget Options for AUSTRALIA:** Widget Options for AUSTRALIA only. If the same key is in the Default Widget Options, the value here will take precedence for AUSTRALIA. Pre-configured and default value:

    `{ sot: "GNAF" }`.
* **Widget Options for NEW ZEALAND:** Widget Options for NEW ZEALAND only. If the same key is in the Default Widget Options, the value here will take precedence for NEW ZEALAND. Pre-configured and default value:

    `{ sot: "NZAD", exposeAttributes: "1" }`.

    All Widget Options must be in valid JSON format. Here is the full list of available [Feature Options](https://docs.mastersoftgroup.com/loqate-harmony-api/api-specification/objects/address-objects#featureoption).

## Frequently Asked Questions

### How do I get a licence key?
You can get a [FREE Trial licence key](https://www.loqate.com/anz/register/) and start using it right away.

### What are all available Widget Options to configure in the settings?
Widget Options are basically `sot` for `Source of Truth` value and key value of `FeatureOptions`. 

Currently these Source of Truth are available for AUSTRALIA: `AUPAF`, `GNAF` and for NEW ZEALAND: `NZPAF`, `NZAD`.

Here is the full list of [Feature Options](https://docs.mastersoftgroup.com/loqate-harmony-api/api-specification/objects/address-objects#featureoption).

### Why the Region for New Zealand is not auto-selected after selecting an address?
New Zealand Region will only be selected if Source of Truth is `NZAD` and `exposeAttributes` is turned on. 

Go to `Mastersoft Address` WooCommerce Settings in your WordPress Admin and change `Widget Options for NEW ZEALAND` value to `{ sot: "NZAD", exposeAttributes: "1" }`.

### Where can I report bugs or ask further questions?
Any questions or bugs can be reported either by opening an issue on [Mastersoft GitHub](https://github.com/MastersoftGroup/mastersoft-address-woocommerce/issues). 

Alternatively, you can contact us via our website <https://www.loqate.com/anz/contact/customer-support/>.

### Where can I find the REST API documentation?
You can find the documentation of our REST API [here](https://docs.mastersoftgroup.com/loqate-harmony-api/api-specification).

## Changelog
The [release history](https://github.com/MastersoftGroup/woocommerce-mastersoft-address/releases) is available on GitHub.

## Support
If you have any questions or issues with this module, open an issue on [GitHub](https://github.com/MastersoftGroup/woocommerce-mastersoft-address/issues). Alternatively you can contact us via our website:

<https://www.loqate.com/anz/contact/customer-support/>

## Copyright
(c) 2023 Mastersoft
