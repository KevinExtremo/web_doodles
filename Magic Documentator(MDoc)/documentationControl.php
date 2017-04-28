<?php
require_once('vendor/autoload.php');
define('GeneratorKey_9mgKwTWdfNtczbV0xlj9QATp8wH8uxI3', TRUE);
include("generator.php");

$path = "test";

/* Establish directory listing */

$directories = glob($path . '/*', GLOB_ONLYDIR);
$modules = array();
/* Loop through directories */
foreach($directories as $dir)
{
  // Remove the path from the directory, so you only have the directory.
  $pathless_dir = str_replace($path . '/', "", $dir);
  // Find the last underscore, in case some guy uses one in their resource name
  $pos = strrpos($pathless_dir, "_");
  // remove everything including the last underscore, so the version remains
  $version = substr($pathless_dir,$pos+1);
  // remove the version, so the name remains
  $name = str_replace(substr($pathless_dir, $pos-2), "", $pathless_dir);
  // place them into an array of modules, updated = false by default, checked to see whether we made sure it exists yet
  $modules[$name] = array("version" => $version, "updated" => false, "dir" => $dir);
}
// check all unchecked modules, so we can add them to the updated ones for generation
foreach($modules as $mod => $data)
{
  if(!file_exists($data['dir'].'/generated.lock'))
  {
    $data['updated'] = true;
  }
}


/* Update the documentation by rebuilding it, if necessary: Pass current
   version to ignore it and only update whats necessary to save time. */
if(!empty($modules))
{
  $generator = new DocumentationGenerator($modules);
}

?>
