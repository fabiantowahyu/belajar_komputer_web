<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function tcpdf()
{
    require_once('tcpdf/config/lang/eng.php');
	require_once('tcpdf/tcpdf_barcodes_1d.php');
	require_once('tcpdf/tcpdf_barcodes_2d.php');
    require_once('tcpdf/tcpdf.php');
}

function phpexcel()
{
   require_once('PHPExcel.php');
   require_once('PHPExcel/IOFactory.php');
}

function phpword()
{
   require_once('PHPWord.php');
}

function fckeditor()
{
   require_once('fckeditor.php');
}
?>