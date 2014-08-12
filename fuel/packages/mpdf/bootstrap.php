<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */


Autoloader::add_core_namespace('mPDF');

Autoloader::add_classes(array(
	'mPDF\\mPDF'                         => __DIR__.'/mpdf.php',
	'mPDF\\barcode'                  => __DIR__.'/classes/barcode.php',
	'mPDF\\bmp'                  => __DIR__.'/classes/bmp.php',
	'mPDF\\cssmgr'                  => __DIR__.'/classes/cssmgr.php',
	'mPDF\\directw'                  => __DIR__.'/classes/directw.php',
	'mPDF\\form'                  => __DIR__.'/classes/form.php',
	'mPDF\\gif'                  => __DIR__.'/classes/gif.php',
	'mPDF\\grad'                  => __DIR__.'/classes/grad.php',
	'mPDF\\indic'                  => __DIR__.'/classes/indic.php',
	'mPDF\\meter'                  => __DIR__.'/classes/meter.php',
	'mPDF\\svg'                  => __DIR__.'/classes/svg.php',
	'mPDF\\tocontents'                  => __DIR__.'/classes/tocontents.php',
	'mPDF\\ttfontsuni'                  => __DIR__.'/classes/ttfontsuni.php',
	'mPDF\\ttfontsuni_analysis'                  => __DIR__.'/classes/ttfontsuni_analysis.php',
	'mPDF\\wmf'                  => __DIR__.'/classes/wmf.php',

));
