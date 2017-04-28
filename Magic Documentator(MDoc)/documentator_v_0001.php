<?php
require_once("vendor/autoload.php");

$example = "/***
  @api_function
	@author: Kevin 'Extremo' Sekin
	@description: This function checks whether a player is logged in or not.
	@return_type: boolean
	@return: true - If the player is logged in.
	@return: false - If the player is not logged in.
	@param: client - The player to check.
***/

function IsPlayerLoggedIn(Client client)
{
  // some code here
}

public function int SomeFunction(random, paramters[args*])

more random SQLiteUnbuffered

/***
	@author: Kevin 'Extremo' Sekin
	@description: This function checks whether a player is logged in or not.
  @api_event
	@return_type: boolean
	@return: true - If the player is logged in.
	@return: random - If the player is not logged in.
	@param: client - The player to check.
***/";

$documentator = new Documentator();
$documentator->generateDoc($example);

class Documentator
{
  private const path = 'test';
  public function generateDoc($content)
  {
    $extract = $this->extract($content);
    array_map('array_filter', $extract);
    if(empty($extract)) return false;
    $blocks = array();
    foreach($extract[1] as $block)
    {
      $blocks[] = $this->tokenizer($block);
    }
    array_map('array_filter', $blocks);
    if(empty($blocks)) return false;
    $json_files = array();
    foreach($blocks as $block)
    {
      $json_files[] = $this->produceJSON($block);
    }
    if(array_filter($json_files)) return false;
    foreach($json_files as $file)
    {
      $this->writeFile(self::path.'/'.uniqid('doc_'), $file);
    }
    return true;
  }
  private function produceJSON($tokens)
  {
    return json_encode($tokens, JSON_PRETTY_PRINT);
  }
  private function writeFile($file, $contents)
  {
    $handler = fopen($file, "w");
    if(!$handler)
    {
      return false;
    }
    else
    {
      fwrite($handler, $contents);
      return true;
    }
    return false;
  }
  private function extract($content)
  {
    preg_match_all("/\/\*{3}([\s\S]+?)\*{3}\//", $content, $extract);
    return $extract;
  }
  private function tokenizer($content)
  {
    $tokens = array();
    /* IMPROVES PERFORMANCE BY 30%
    preg_match_all("/(?<=@)(\w+)(?=\s)|(?<=@)(\w+)(?=\:)|(?<=\:\s)(.*)/", $content, $data, PREG_PATTERN_ORDER);
    $clean_data = array_filter(array_map('array_filter', $data));
    echo '<pre>';
    print_r($clean_data);
    echo '</pre>'; */
    preg_match_all("/(?<=@)(\w+)(?=\s)/", $content, $type);
    preg_match_all("/(?<=@)(\w+)(?=\:)/", $content, $keys);
    preg_match_all("/(?<=\:\s)(.*)/", $content, $data);
    $x = 0;
    $tokens[] = array('category'=>$type[0][0]);
    foreach($keys[0] as $token)
    {
      $tokens[] = array($token =>$data[0][$x]);
      $x++;
    }
    return $tokens;
  }
}

 ?>
