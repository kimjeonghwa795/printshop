#!/usr/bin/php
<?php
require('./fpdf/fpdf.php');
ini_set("memory_limit","512M");
define('FPDF_FONTPATH','./fpdf/');

if ($argc != 3 || in_array($argv[1], array('--help', '-help', '-h', '-?'))) {
?>

Photo Book Generator

  Usage:
  <?php echo $argv[0]; ?> <INPUT> <OUTPUT>

  <INPUT> is the path/name of the data file that defines your photo filenames and captions

  <OUTPUT> is the path/name of the PDF file to output

  With the --help, -help, -h, or -? options, you can get this help.

<?php
  exit;
}
include 'photo-book.php';


$input_file = $argv[1];
$output_file = $argv[2];

// read input file
$handle = fopen($input_file, "r");
if ($handle) {
  $p = new PhotoBook();
  
  while (($buffer = fgets($handle, 4096)) !== false) {
    $buffer = trim($buffer);

    // Skip comment lines
    if (substr($buffer, 0, 1) == '#') {
      continue;
    }

    // If a new page/cover hasn't already been created, or if we've hit a 
    // blank line and the previous page has content (this prevents
    // multiple blank lines from creating multiple pages), then create a new page.
    if (!isset($page) || ($buffer == '' && $page->hasContent())) {
      if ($p->coverCount() < 2) {
        $page = $p->newCover();
      } else {
        $page = $p->newPage();
      }
    }

    // Sniff content as image or caption
    if (preg_match('/.jpg$/i', $buffer)) {
      print "image: " . $buffer . "\n";
      $page->addImage($buffer);
    } elseif ($buffer != '') {
      print "caption: " . $buffer . "\n";
      $page->addCaption($buffer);
    }
  }
  if (!feof($handle)) {
    echo "Error: unexpected fgets() fail\n";
  }
  fclose($handle);
}

$p->render($output_file, dirname($input_file) . '/');

