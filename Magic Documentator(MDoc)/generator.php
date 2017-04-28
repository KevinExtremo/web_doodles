<?php
if(!defined('GeneratorKey_9mgKwTWdfNtczbV0xlj9QATp8wH8uxI3'))
{
  die('Direct access not permitted. Please follow the security protocol.');
}


class DocumentationGenerator
{
  private $path = "./generatedDocumentation";
  public function __construct($modules)
  {
    // build the sidebar
    $sidebar = $this->build_sidebar($modules);

    // build the resource files
    foreach($modules as $name => $data)
    {
      if($data['updated'])
      {
        // generate files using json
      }
    }

    // update welcome page with the new resources just like sidebar

/*
    $sourceCode = 'if(IsPlayerLoggedIn(client))
{
  // do something crazy here
}';
    $geshi = new GeSHi($sourceCode, 'c#');
    $geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
    $geshi->set_line_style('color: black;');
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);
    $page = $twig->render('function.template', array(
      'site' => array('title' => 'Documentation',
                      'description' => 'This is a function documentation.',
                      'keywords' => 'function, documentation'),
      'sections' => $sections,
      'function' => array('name' => 'IsPlayerLoggedIn',
                          'author' => 'Extremo',
                          'description' => 'This function checks whether a player is logged in or not.',
                          'return_type' => 'boolean'),
      'return_list' => array(
        array('value' => 'true', 'description' => 'If the player is logged in.'),
        array('value' => 'false', 'description' => 'If the player is not logged in.')),
      'examples' => array(
        array('code' => $geshi->parse_code())),
      'changelog' => array(
        array('version' => '0001', 'description' => 'Initial release'),
        array('version' => '0002', 'description' => 'Fixed rare case where login did not register.')
      )));
    echo $this->sanitize($page); */
  }
  private function build_sidebar($mods)
  {
    $sections = array();
    $sections[] = array('header' => 'Main', 'menu' => array('<a href="index.php">Main Page</a>', '<a href="tutorial.php">Tutorial</a>', '<a href="faq.php">FAQ</a>'));
    $resource_section = array();
    foreach($modules as $name => $data)
    {
      $resource_section[] = '<a href="'.$name.'/'.$data['version'].'/index.php">'.ucfirst($name).'</a>';
    }
    $sections[] = array('header' => 'Resources', 'menu' => $resource_section);
    return $sections;
  }
  private function sanitize($buffer)
  {
    $search = array(
        '/\>[^\S ]+/s', //strip whitespaces after tags, except space
        '/[^\S ]+\</s', //strip whitespaces before tags, except space
        '/(\s)+/s'  // shorten multiple whitespace sequences
        );
    $replace = array(
        '>',
        '<',
        '\\1'
        );
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
  }
}


?>
