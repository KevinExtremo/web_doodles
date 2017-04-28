<?php

include("../php/template.php");

$landing = new Template("../templates/index.template");
$landing->set("description", "");
$landing->set("keywords", "");
$landing->set("title", "Welcome to SLS Roleplay!");

echo $landing->output();

?>