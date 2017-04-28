<?php
require_once("vendor/autoload.php");

/*
WE WILL CALL THIS "M(agic)Doc(umentator)"!!!
*/
$example = "
/***
  @api_function
  @name: IsPlayerLoggedIn
	@author: Kevin 'Extremo' Sekin
  @version: 0001
	@description: This function checks whether a player is logged in or not.
	@return_type: boolean
	@return: true|If the player is logged in.
	@return: false|If the player is not logged in.
	@param: client|The player to check.
***/

function IsPlayerLoggedIn(Client client)
{
  // some code here
}

public function int SomeFunction(random, paramters[args*])

more random SQLiteUnbuffered
/***
  @api_function
  @name: IsPlayerBad
	@author: Kevin 'Extremo' Sekin
  @version: 0001
	@description: This function checks whether a player is logged in or not.
	@return_type: boolean
	@return: true|If the player is logged in.
	@return: false|If the player is not logged in.
	@param: client|The player to check.
***/
";

echo '<pre>';
$lines = array();
$x = 0;
foreach(preg_split("/((\r?\n)|(\r\n?))/", $example) as $line){
  $lines[$x] = $line;
  $x++;
}
$tok = DocLexer::lexify($lines);
$data = DocParser::parse($tok);

echo 'We successfully extracted '.count($data[1])." blocks</br>";
print_r($data[0]);
print_r($data[1]);
print_r($data[2]);
echo '</pre>';

class Documentator
{
  /*
  Take resource folder, extract all docblocks, make sense of it
  see if it has a resource block, string together all the functions,
  make it ready for building a documentation website
  */
}
class DocFunction
{
  public $name;
  public $author;
  public $description;
  public $version;
  public $return_type;
  public $returns;
  public $parameters;
  public $examples;
  public $changelog;
  public $created_at;
  public function __construct()
  {
    $this->returns = array();
    $this->parameters = array();
    $this->examples = array();
    $this->changelog = array();
    $this->created_at = new DateTime();
  }
}
class DocEvent
{
  public $name;
  public $author;
  public $description;
  public $version;
  public $parameters;
  public $examples;
  public $changelog;
  public $created_at;
  public function __construct()
  {
    $this->parameters = array();
    $this->examples = array();
    $this->changelog = array();
    $this->created_at = new DateTime();
  }
}
class DocResource
{
  public $name;
  public $author;
  public $description;
  public $version;
  public $functions;
  public $events;
  public $changelog;
  public $created_at;
  public function __construct()
  {
    $this->functions = array();
    $this->events = array();
    $this->changelog = array();
    $this->created_at = new DateTime();
  }
}
class DocClass
{
  public $name;
  public $author;
  public $description;
  public $version;
  public $attributes;
  public $methods;
  public $changelog;
  public $created_at;
  public function __construct()
  {
    $this->attributes = array();
    $this->methods = array();
    $this->changelog = array();
    $this->created_at = new DateTime();
  }
}
class DocLexer
{
  protected static $_grammar = array(
    "/(\/\*\*\*)/" => "DOC_BLOCK_START",
    "/(?<=@)(\w+)/" => "DOC_NODE",
    "/(\w+)/" => "DOC_IDENTIFIER",
    "/(\|)/" => "DOC_DATA_SEPERATOR",
    "/(\*\*\*\/)/" => "DOC_BLOCK_END"
  );
  public static function lexify($source)
  {
    $tokens = array();
    foreach($source as $line_number => $code)
    {
      $result = static::_match($line_number, $code);
      if($result === false) {
        continue;
      }
      foreach($result as $token)
      {
        $tokens[] = $token;
      }
    }
    return $tokens;
  }
  protected static function _match($number, $line)
  {
    $parts = array();
    $seperator = ' ';
    $l = strtok($line, $seperator);
    $parts[] = $l;
    while($l != false)
    {
      $l = strtok($seperator);
      $parts[] = $l;
    }
    array_filter($parts);
    if(empty($parts)) return false;
    $matchedTokens = array();
    foreach($parts as $part)
    {
      foreach(static::$_grammar as $pattern => $name)
      {
        if(preg_match($pattern, $part, $matches))
        {
          $part_end = substr($part, -1);
          if($name === "DOC_NODE")
          {
            $matchedTokens[] = array(
              'match' => "@",
              'token' => "DOC_NODE",
              'line' => $number+1
            );
            $matchedTokens[] = array(
              'match' => $matches[1],
              'token' => "DOC_IDENTIFIER",
              'line' => $number+1
            );
            $subpart = str_replace($matches[1], "", $part);
            if(substr($part, -1)===":")
            {
              $matchedTokens[] = array(
                      'match' => ":",
                      'token' => "DOC_SEPERATOR",
                      'line' => $number+1
                  );
              $subpart = str_replace(":", "", $subpart);
            }
            $found = false;
            do
            {
              $found = false;
              if(preg_match("/(@?)(:)(\w?)/", $subpart, $match))
              {
                // fix if they dont add a space after node identifier and colon.
                if(!empty($match[1]))
                {
                  $subpart = str_replace("@", "", $subpart);
                }
                if(!empty($match[2]))
                {
                  $subpart = str_replace(":", "", $subpart);
                  $matchedTokens[] = array(
                        'match' => ":",
                        'token' => "DOC_SEPERATOR",
                        'line' => $number+1
                    );
                }
              }
              if(preg_match("/(\w+)/", $subpart, $match))
              {
                $matchedTokens[] = array(
                      'match' => $match[1],
                      'token' => "DOC_IDENTIFIER",
                      'line' => $number+1
                  );
                $subpart = substr($subpart, strlen($match[1])+1);
                $found = true;
              }
              if(preg_match("/(\|)(\w?)/", $subpart, $match))
              {
                $matchedTokens[] = array(
                      'match' => $match[1],
                      'token' => "DOC_DATA_SEPERATOR",
                      'line' => $number+1
                  );
                $subpart = substr($subpart, strlen($match[1]));
                $found = true;
              }
              if(preg_match("/(\w+)/", $subpart, $match))
              {
                $matchedTokens[] = array(
                      'match' => $match[1],
                      'token' => "DOC_IDENTIFIER",
                      'line' => $number+1
                  );
                $subpart = substr($subpart, strlen($match[1])+1);
                $found = true;
              }
            } while ($found);
            break; // break because this will be detected twice for whatever reason
          }
          else if($name==="DOC_IDENTIFIER" && $part_end===":")
          {
            $matchedTokens[] = array(
              'match' => "@",
              'token' => "DOC_NODE",
              'line' => $number+1,
              'generated' => true
            );
            $matchedTokens[] = array(
              'match' => $matches[1],
              'token' => "DOC_IDENTIFIER",
              'line' => $number+1
            );
            $matchedTokens[] = array(
                    'match' => ":",
                    'token' => "DOC_SEPERATOR",
                    'line' => $number+1
              );
            break;
          }
          else if($name==="DOC_IDENTIFIER" && $part_end != ":"  && $part[0] != "@"|| $name==="DOC_DATA_SEPERATOR" && $part_end != ":" && $part[0] != "@")
          {
            $subpart = $part;
            $found = false;
            do
            {
              $found = false;
              if(preg_match("/(@?)(:)(\w?)/", $subpart, $match))
              {
                // fix if they dont add a space after node identifier and colon.
                if(!empty($match[1]))
                {
                  $subpart = str_replace("@", "", $subpart);
                }
                if(!empty($match[2]))
                {
                  $subpart = str_replace(":", "", $subpart);
                  $matchedTokens[] = array(
                        'match' => ":",
                        'token' => "DOC_SEPERATOR",
                        'line' => $number+1
                    );
                }
              }
              if(preg_match("/^(\|)(\w?)/", $subpart, $match))
              {
                $matchedTokens[] = array(
                      'match' => $match[1],
                      'token' => "DOC_DATA_SEPERATOR",
                      'line' => $number+1
                  );
                $subpart = substr($subpart, strlen($match[1]));
                $found = true;
              }
              if(preg_match("/(\w+)/", $subpart, $match))
              {
                $matchedTokens[] = array(
                      'match' => $match[1],
                      'token' => "DOC_IDENTIFIER",
                      'line' => $number+1
                  );
                $subpart = str_replace($match[1], "", $subpart);
                $found = true;
              }
            } while ($found);
            break;
          }
          else
          {
            $matchedTokens[] = array(
                  'match' => $matches[1],
                  'token' => $name,
                  'line' => $number+1
              );
            continue;
          }
        }
      }
    }
    array_filter($matchedTokens);
    if(empty($matchedTokens)) return false;
    return $matchedTokens;
  }
}

class DocParser
{
  private static $_mapTypeToClass = array(
    "api_function" => "DocFunction",
    "api_event" => "DocEvent",
    "function" => "DocFunction",
    "event" => "DocEvent",
    "class" => "DocClass",
    "resource" => "DocResource"
  );
  public static function parse($tokens, $ignore_errors = false)
  {
    $unvalidated_data = DocTree::build_tree($tokens);
    array_map("array_filter", $unvalidated_data);
    if(empty($unvalidated_data)) return false;
    $json_files = array();
    $data = DocValidator::validate($unvalidated_data[1], $unvalidated_data[0]);
    foreach($data[0] as $block)
    {
      $parsed_nodes = array();
      foreach($block['children'] as $node)
      {
        if($node['token'] != "DOC_BLOCK_END") $parsed_nodes[] = self::_parse_node($node);
      }
      $type = "unknown";
      foreach($parsed_nodes as $key => $element)
      {
        if($element['type'] === true)
        {
          $type = $element['node'];
        }
      }
      if($type==="unknown")
      {
        $data[1][] = array('error' => 'Fatal error: Type unknown during parsing.',
                       'error_message' => 'A compile error occured during parsing. A type was unknown.',
                       'line' => 'unknown');
        return [$json_files,$data[0],$data[1],$data[2]];
      }
      switch($type)
      {
        case 'api_function':
        case 'function':
          /*
          public $name;
          public $author;
          public $description;
          public $return_type;
          public $returns;
          public $parameters;
          public $examples;
          public $changelog;
          */
          $function = new DocFunction;
          foreach($parsed_nodes as $pnode)
          {
            if($pnode['node'] === "name" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $function->name = $function->name.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "author" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $function->author = $function->author.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "description" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $function->description = $function->description.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "version" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $function->version = $function->version.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "return_type" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $function->return_type = $function->return_type.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "example" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $function->examples[] = substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "return" && isset($pnode['data']))
            {
              $x = 1; $return_type = "";
              foreach($pnode['data'] as $ndata)
              {
                if(($x%2)>0)
                {
                  $return_type = substr($ndata,0,-1);
                  $x++;
                }
                else
                {
                  $function->returns[] = array('value' => $return_type, 'description' => substr($ndata,0,-1));
                  $return_type = "";
                  $x++;
                }
              }
            }
            if($pnode['node'] === "param" && isset($pnode['data']))
            {
              $x = 1; $param_type = "";
              foreach($pnode['data'] as $ndata)
              {
                if(($x%2)>0)
                {
                  $param_type = substr($ndata,0,-1);
                  $x++;
                }
                else
                {
                  $function->parameters[] = array('value' => $param_type, 'description' => substr($ndata,0,-1));
                  $param_type = "";
                  $x++;
                }
              }
            }
            if($pnode['node'] === "change" && isset($pnode['data']))
            {
              $x = 1; $change_version = "";
              foreach($pnode['data'] as $ndata)
              {
                if(($x%2)>0)
                {
                  $change_version = substr($ndata,0,-1);
                  $x++;
                }
                else
                {
                  $function->changelog[] = array('version' => $change_version, 'description' => substr($ndata,0,-1));
                  $change_version = "";
                  $x++;
                }
              }
            }
          }
          $json_files[] = array('type' => $type, 'name' => $function->name, 'json' => json_encode($function));
          break;
        case 'api_event':
        case 'event':
          /*
          public $name;
          public $author;
          public $description;
          public $parameters;
          public $examples;
          public $changelog;
          */
          $event = new DocEvent;
          foreach($parsed_nodes as $pnode)
          {
            if($pnode['node'] === "name" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $event->name = $event->name.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "author" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $event->author = $event->author.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "description" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $event->description = $event->description.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "version" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $event->version = $event->version.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "example" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $event->examples[] = substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "param" && isset($pnode['data']))
            {
              $x = 1; $param_type = "";
              foreach($pnode['data'] as $ndata)
              {
                if(($x%2)>0)
                {
                  $param_type = substr($ndata,0,-1);
                  $x++;
                }
                else
                {
                  $event->parameters[] = array('value' => $param_type, 'description' => substr($ndata,0,-1));
                  $param_type = "";
                  $x++;
                }
              }
            }
            if($pnode['node'] === "change" && isset($pnode['data']))
            {
              $x = 1; $change_version = "";
              foreach($pnode['data'] as $ndata)
              {
                if(($x%2)>0)
                {
                  $change_version = substr($ndata,0,-1);
                  $x++;
                }
                else
                {
                  $event->changelog[] = array('version' => $change_version, 'description' => substr($ndata,0,-1));
                  $change_version = "";
                  $x++;
                }
              }
            }
          }
          $json_files[] = array('type' => $type, 'name' => $event->name, 'json' => json_encode($event));
          break;
        case 'class':
          /*
          public $name;
          public $author;
          public $description;
          public $attributes;
          public $methods;
          public $changelog;
          */
          $class = new DocClass;
          foreach($parsed_nodes as $pnode)
          {
            if($pnode['node'] === "name" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $class->name = $class->name.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "author" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $class->author = $class->author.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "description" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $class->description = $class->description.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "version" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $class->version = $class->version.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "attribute" && isset($pnode['data']))
            {
              $x = 1; $attribute_name = "";
              foreach($pnode['data'] as $ndata)
              {
                if(($x%2)>0)
                {
                  $attribute_name = substr($ndata,0,-1);
                  $x++;
                }
                else
                {
                  $class->attributes[] = array('name' => $attribute_name, 'description' => substr($ndata,0,-1));
                  $attribute_name = "";
                  $x++;
                }
              }
            }
            if($pnode['node'] === "method" && isset($pnode['data']))
            {
              $x = 1; $method_name = "";
              foreach($pnode['data'] as $ndata)
              {
                if(($x%2)>0)
                {
                  $method_name = substr($ndata,0,-1);
                  $x++;
                }
                else
                {
                  $class->methods[] = array('name' => $method_name, 'description' => substr($ndata,0,-1));
                  $method_name = "";
                  $x++;
                }
              }
            }
            if($pnode['node'] === "change" && isset($pnode['data']))
            {
              $x = 1; $change_version = "";
              foreach($pnode['data'] as $ndata)
              {
                if(($x%2)>0)
                {
                  $change_version = substr($ndata,0,-1);
                  $x++;
                }
                else
                {
                  $class->changelog[] = array('version' => $change_version, 'description' => substr($ndata,0,-1));
                  $change_version = "";
                  $x++;
                }
              }
            }
          }
          $json_files[] = array('type' => $type, 'name' => $class->name, 'json' => json_encode($class));
          break;
        case 'resource':
          /*
          public $name;
          public $author;
          public $description;
          public $functions;
          public $events;
          public $changelog;
          */
          $resource = new DocResource;
          foreach($parsed_nodes as $pnode)
          {
            if($pnode['node'] === "name" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $resource->name = $resource->name.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "author" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $resource->author = $resource->author.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "description" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $resource->description = $resource->description.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "version" && isset($pnode['data']))
            {
              foreach($pnode['data'] as $ndata)
              {
                $resource->version = $resource->version.substr($ndata,0,-1);
              }
            }
            if($pnode['node'] === "attribute" && isset($pnode['data']))
            {
              $x = 1; $attribute_name = "";
              foreach($pnode['data'] as $ndata)
              {
                if(($x%2)>0)
                {
                  $attribute_name = substr($ndata,0,-1);
                  $x++;
                }
                else
                {
                  $class->attributes[] = array('name' => $attribute_name, 'description' => substr($ndata,0,-1));
                  $attribute_name = "";
                  $x++;
                }
              }
            }
            if($pnode['node'] === "register_function" && isset($pnode['data']))
            {
              $x = 1; $function_name = "";
              foreach($pnode['data'] as $ndata)
              {
                if(($x%2)>0)
                {
                  $function_name = substr($ndata,0,-1);
                  $x++;
                }
                else
                {
                  $resource->functions[] = array('name' => $function_name, 'description' => substr($ndata,0,-1));
                  $function_name = "";
                  $x++;
                }
              }
            }
            if($pnode['node'] === "register_event" && isset($pnode['data']))
            {
              $x = 1; $event_name = "";
              foreach($pnode['data'] as $ndata)
              {
                if(($x%2)>0)
                {
                  $event_name = substr($ndata,0,-1);
                  $x++;
                }
                else
                {
                  $resource->events[] = array('name' => $event_name, 'description' => substr($ndata,0,-1));
                  $event_name = "";
                  $x++;
                }
              }
            }
            if($pnode['node'] === "change" && isset($pnode['data']))
            {
              $x = 1; $change_version = "";
              foreach($pnode['data'] as $ndata)
              {
                if(($x%2)>0)
                {
                  $change_version = substr($ndata,0,-1);
                  $x++;
                }
                else
                {
                  $resource->changelog[] = array('version' => $change_version, 'description' => substr($ndata,0,-1));
                  $change_version = "";
                  $x++;
                }
              }
            }
          }
          $json_files[] = array('type' => $type, 'name' => $resource->name, 'json' => json_encode($resource));
          break;
      }
    }
    if($ignore_errors === true)
    {
      return [$json_files,$data[0]];
    }
    else
    {
      array_map("array_filter", $data);
      return [$json_files,$data[0],$data[1],$data[2]];
    }
  }
  private static function _parse_node($node)
  {
    $node_name = "";
    $node_data = array();
    if(isset($node['children']))
    {
      $collection = ""; $seperator = false;
      foreach($node['children'] as $data_element)
      {
        if($data_element['token'] === "DOC_SEPERATOR") $seperator = true;
        if($seperator === false)
        {
          $node_name = $node_name.$data_element['match'];
        }
        else
        {
          if($data_element['token'] === "DOC_IDENTIFIER")
          {
            $collection = $collection.$data_element['match'].' ';
          }
          if($data_element['token'] === "DOC_DATA_SEPERATOR")
          {
            $node_data[] = $collection;
            $collection = "";
          }
        }
      }
      if(!empty($collection)) $node_data[] = $collection;
    }
    $compiled_node = array();
    $compiled_node['node'] = $node_name;
    if(!empty($node_data))
    {
      foreach($node_data as $data)
      {
        $compiled_node['data'][] = $data;
      }
    }
    foreach(DocValidator::$_types as $type)
    {
      if($node_name === $type)
      {
        $compiled_node['type'] = true;
        break;
      }
      else
      {
        $compiled_node['type'] = false;
      }
    }
    return $compiled_node;
  }
}

class DocTree
{
  public static $_depth = array(
    "DOC_BLOCK_START" => 1,
      "DOC_NODE" => 2,
        "DOC_IDENTIFIER" => 3,
        "DOC_SEPERATOR" => 3,
        "DOC_DATA_SEPERATOR" => 3,
      "DOC_BLOCK_END" => 2
  );
  public static function build_tree($tokens)
  {
    return self::_arrange_elements($tokens);
  }
  private static function _arrange_elements(&$tokens)
  {
    $tree = array();
    $errors = array();
    $root = -1;
    $node = -1;
    $last_root = -1;
    foreach($tokens as $key=>$value)
    {
      if(self::$_depth[$value['token']]==1)
      {
        $root++;
        $tree[$root] = $value;
      }
      if(self::$_depth[$value['token']]==2)
      {
        if($last_root == $root)
        {
          $errors[] = array('Node found, but no corresponding root.', 'data'=>$value);
          continue;
        }
        $node++;
        $tree[$root]['children'][] = $value;
        if($value['token'] === 'DOC_BLOCK_END'){ $last_root=$root;$node = -1;}
      }
      if(self::$_depth[$value['token']]==3)
      {
        if($last_root == $root)
        {
          $errors[] = array('Data found, but no corresponding root or node.', 'data'=>$value);
          continue;
        }
        $tree[$root]['children'][$node]['children'][] = $value;
      }
    }
    return [$tree,$errors];
  }
}

class DocValidator
{
  public static $_types = array(
    "api_function",
    "api_event",
    "function",
    "event",
    "class",
    "resource",
  );
  public static $_nodes = array(
    "author",
    "name",
    "description",
    "return_type",
    "param",
    "return",
    "change",
    "version",
    "attribute",
    "method",
    "register_function",
    "register_event"
  );
  public static $_required = array(
    "name",
    "author",
    "description",
    "version",
  );
  private static function _isAcceptedNode($name)
  {
    foreach(self::$_nodes as $node)
    {
      if($node === $name) return true;
    }
    return false;
  }
  private static function _isAcceptedType($name)
  {
    foreach(self::$_types as $type)
    {
      if($type === $name) return true;
    }
    return false;
  }
  public static function validate($errors, &$tree)
  {
    $warnings = array();
    $fatal = array();
    $node_found = 0; $identifier_found = 0;
    foreach($errors as $error)
    {
      if($error['data']['token'] === "DOC_BLOCK_START")
      {
        $fatal[] = array('error' => 'Fatal error: DOC_BLOCK_END missing.',
                       'error_message' => 'We found a documentation block beginning: \\*** but no corresponding end tag ***/',
                       'line' => $error['data']['line']);
      }
      if($error['data']['token'] === "DOC_BLOCK_END")
      {
        $fatal[] = array('error' => 'Fatal error: DOC_BLOCK_START missing.',
                       'error_message' => 'We found a documentation block end: ***/ but no corresponding beginning tag \\***',
                       'line' => $error['data']['line']);
      }
      if($error['data']['token'] === "DOC_SEPERATOR" && $identifier_found > 0)
      {
        $warnings[] = array('error' => 'Warning: Found documentation elements',
                       'error_message' => 'We found documentation elements that could not be associated with a documentation block',
                       'line' => $error['data']['line']);
      }
      $identifier_found = 0;
      if($error['data']['token'] === "DOC_IDENTIFIER" && $node_found > 0)
      {
        $identifier_found = $error['data']['line'];
      }
      $node_found = 0;
      if($error['data']['token'] === "DOC_NODE")
      {
        $node_found = $error['data']['line'];
      }
    }
    foreach($tree as $key => $block)
    {
      $flags = array();
      $flags['block_type'] = false;
      foreach(self::$_required as $required)
      {
        $flags['required_'.$required] = false;
      }
      $flags['has_end'] = false;
      foreach($block['children'] as $node)
      {
        if($node['token'] != "DOC_NODE" && $node['token'] != "DOC_BLOCK_END" || $node['match'] != "@" && $node['match'] != "***/" || isset($node['generated']))
        {
          $fatal[] = array('error' => 'Fatal error: Node misses @.',
                         'error_message' => 'We found a documentation block that misses an @ before a node.',
                         'line' => $node['line']);
          unset($tree[$key]);
          continue;
        }
        $nodeflags = array();
        $nodeflags['has_seperator'] = false;
        $nodeflags['has_identifier'] = false;
        $nodeflags['is_type'] = false;
        if($node['token'] === "DOC_BLOCK_END")
        {
          $flags['has_end'] = true;
          continue;
        }
        if(!isset($node['children']))
        {
          $fatal[] = array('error' => 'Fatal error: Node Data missing.',
                         'error_message' => 'We found a @node that has no data. Please specify an element after @.',
                         'line' => $element['line']);
          unset($tree[$key]);
          continue;
        }
        foreach($node['children'] as $element)
        {
          $count = count($node['children']);
          if($count==1 && $element['token']==="DOC_IDENTIFIER")
          {
            if(!self::_isAcceptedType($element['match']))
            {
              $fatal[] = array('error' => 'Fatal error: Unknown type specified.',
                             'error_message' => 'We found a documentation block with an unknown type.',
                             'line' => $element['line']);
              unset($tree[$key]);
              continue;
            }
            $flags['block_type'] = true;
            $nodeflags['is_type'] = true;
          }
          if($count>=3 && $element['token']==="DOC_IDENTIFIER") $nodeflags['has_identifier'] = true;
          if($count>=3 && $element['token']==="DOC_SEPERATOR")
          {
            if($nodeflags['has_identifier'] === false)
            {
              $fatal[] = array('error' => 'Fatal error: Node Key missing.',
                             'error_message' => 'We found a @node that has no key. Please specify an element after @.',
                             'line' => $element['line']);
              unset($tree[$key]);
              continue;
            }
            $nodeflags['has_seperator'] = true;
          }
          if($count>=3 && $element['token']==="DOC_IDENTIFIER" && $nodeflags['has_seperator'] === false)
          {
            if(!self::_isAcceptedNode($element['match']))
            {
              $fatal[] = array('error' => 'Fatal error: Unknown node specified.',
                             'error_message' => 'We found a documentation block with an unknown node.',
                             'line' => $element['line']);
              unset($tree[$key]);
              continue;
            }
            foreach(self::$_required as $required)
            {
              if($required === $element['match']) $flags['required_'.$required] = true;
            }
          }
        }
        if($nodeflags['has_seperator'] === false && $nodeflags['is_type'] === false)
        {
          $fatal[] = array('error' => 'Fatal error: Node Seperator missing.',
                         'error_message' => 'We found a @node that has no seperator(:). Please use the seperator(:) after the @node(:).',
                         'line' => $node['line']);
          unset($tree[$key]);
        }
      }
      if($flags['block_type'] === false)
      {
        $fatal[] = array('error' => 'Fatal error: Block Type missing.',
                       'error_message' => 'We found a documentation block that is missing a type[@api_function,@api_event,@resource].',
                       'line' => $block['line']);
        unset($tree[$key]);
      }
      if($flags['has_end'] === false)
      {
        $fatal[] = array('error' => 'Fatal error: Documentation End Block missing.',
                       'error_message' => 'We found a documentation block with no end tag \*\*\*\/.',
                       'line' => $block['line']);
        unset($tree[$key]);
      }
      foreach(self::$_required as $required)
      {
        if($flags['required_'.$required] === false)
        {
          $fatal[] = array('error' => 'Fatal error: Required field missing.',
                         'error_message' => 'We found a documentation block that misses a required field[@'.$required.'].',
                         'line' => $block['line']);
          unset($tree[$key]);
        }
      }
    }
    return [$tree,$fatal,$warnings];
  }
}
 ?>
