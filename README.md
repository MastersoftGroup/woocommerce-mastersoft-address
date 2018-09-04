# mastersoft-address-woocommerce

Australia and New Zealand Address Autocomplete plugin for WooCommerce Checkout and Account's Billing Address and Shipping Address.

## Description

Mastersoft Address Autocomplete plugin for WooCommerce.

Features:
* Autocomplete billing and shipping address in Checkout page
* Autocomplete address in My Account page for Customer's billing address and shipping address
* Only enabled when country is selected as Australia or New Zealand
* Settings for Mastersoft Address, such as Source of Truth

Get started with a FREE licence key [here](https://hosted.mastersoftgroup.com/console/#/).

## Installation 

This plugin requires WooCommerce. Please make sure WooCommerce is installed.

### Automatic installation

Currently automatic installation is not available.

### Manual installation

1. 	Download the zip file of the latest release from [GitHub](https://github.com/MastersoftGroup/woocommerce-mastersoft-address).
1. 	Upload the zip file to your WordPress plugins directory by one of these ways:
	1.	Upload and unzip the zip file in your WordPress plugins directory: `WP_ROOT/wp-content/plugins/` - `WP_ROOT` usually is `/var/www/html/`. 
		Under WordPress plugins directory, there should be `woocommerce-mastersoft-address` directory with its file contents and file structures the same as in GitHub. 						
		**OR**		   
	1.	Upload the zip file via your WordPress Admin URL: 
		Log in to your WordPress Admin > go to `Plugins` > `Add New` > `Upload Plugin` button > upload the zip file
1. 	If the zip file is uploaded manually to `WP_ROOT/wp-content/plugings/` (option 1), make sure all files are owned by `www-data`:  
	In `woocommerce-mastersoft-address` directory > ``` chown -R www-data:www-data * ``` 
		
### Composer installation

It is available in [Packagist](https://packagist.org/packages/mastersoft/woocommerce-mastersoft-address).

Run composer command: ```composer require mastersoft/woocommerce-mastersoft-address```		
		    
### Post installation

1. Activate plugin: go to `Plugins` page in your WordPress Admin > click `Activate` on `Mastersoft Address` plugin
1. Configure plugin in `Mastersoft Address` settings tab - see [Configuration](#configuration) for more detail.
	
### Updating existing Composer installation

1. Update `./composer.json` with the version to be downloaded: ```composer require mastersoft/woocommerce-mastersoft-address:<version> --no-update```
1. Download and install the specific `mastersoft/woocommerce-mastersoft-address` version: `composer update`

### Disable/enable plugin

To disable: log in to your WordPress Admin > go to `Plugins` > click `Deactivate` to disable plugin (click `Activate` to enable plugin).  

This will disable the functionality but will still keep all your configuration settings, so you do not need to configure when you enable the plugin again. 

### Uninstallation

Log in to your WordPress Admin > go to `Plugin` > click `Deactivate` and `Delete`. 

This will uninstall and delete all the configuration settings in your database.  

## Configuration

Log in to your WordPress Admin > go to `WooCommerce` > `Settings` > `Mastersoft Address` tab.

* 	**Licence Key** (mandatory) 	
	
	**Get your FREE licence key [here](https://hosted.mastersoftgroup.com/console/#/).**			
	Must be in **username-without-domain:password** format. Default value: blank/empty.
					 
*	**URL**	
	
	Default value if empty/blank: `https://hosted.mastersoftgroup.com`.
			
*	**Default Widget Options**
	
	Generic Widget Options for both AUSTRALIA and NEW ZEALAND.		 
	Pre-configured and default value: `{ singleLineHitNumber: 5, caseType: "TITLE" }`.
			
*	**Widget Options for AUSTRALIA**		

	Widget Options for AUSTRALIA only. If the same key is in the Default Widget Options, the value here will take precedence for AUSTRALIA.		
	Pre-configured and default value: `{ sot: "GNAF" }`.		
	
*	**Widget Options for NEW ZEALAND**		

	Widget Options for NEW ZEALAND only. If the same key is in the Default Widget Options, the value here will take precedence for NEW ZEALAND. 		
	Pre-configured and default value: `{ sot: "NZAD", exposeAttributes: "1" }`.
	
All Widget Options must be in valid JSON format. To configure the Widget Options, here is the full list of available [FeatureOption](http://developer.mastersoftgroup.com/harmony/api/object/address.html#FeatureOption).

## Frequently Asked Questions

### How to get the licence key?

You can get a FREE licence key [here](https://hosted.mastersoftgroup.com/console/#/) and start using it right away.

### What are all available Widget Options to configure in the settings?

Widget Options are basically `sot` for `Source of Truth` value and key value of `FeatureOptions`. 

Currently these Source of Truth are available for AUSTRALIA: `AUPAF`, `GNAF` and for NEW ZEALAND: `NZPAF`, `NZAD`.

You can get the full list of `FeatureOptions` [here](http://developer.mastersoftgroup.com/harmony/api/object/address.html#FeatureOption).

### Where can I report bugs or have further questions to ask?

Any questions or bugs can be reported either by opening an issue on [Mastersoft GitHub](https://github.com/MastersoftGroup/mastersoft-address-woocommerce/issues). 

Alternatively you can contact us via e-mail to <support@mastersoftgroup.com> or via our website <https://www.mastersoftgroup.com/>.

### Where can I find the REST API documentation?

You can find the documentation of our REST API [here](http://developer.mastersoftgroup.com/harmony/api/).

## Changelog

Please see [here](https://github.com/MastersoftGroup/woocommerce-mastersoft-address/releases) for release history on GitHub.

## Copyright

(c) 2018 Mastersoft
