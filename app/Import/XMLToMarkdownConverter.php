<?php
/**
*	XML Converter for the House of Representatives Bulk XML Legislation
* Currently only handles HR Bills
*/

namespace Import;

use Import\Exceptions\IncorrectArgumentCountException;
use Import\Exceptions\FileNotFoundException;
use SimpleXMLElement;

class XMLToMarkdownConverter{
	const ROOTTAG = 'legis-body';

	protected $structure = array(
					'section',
					'subsection',
					'paragraph',
					'subparagraph',
					'clause',
					'subclause',
					'item'
				);

	public $originalXML;
	public $md = '';
	protected $simplexml;

	public function __construct($xml = null){
        if(isset($xml)){
            $this->originalXML = $xml;
            $this->simplexml = simplexml_load_string($xml);
        }
	}

  public function setXML($xml){
      $this->originalXML = $xml;

      $this->simplexml = simplexml_load_string($xml);
  }

  public function getTitle(){
    $metas = $this->simplexml->metadata->dublinCore->children('http://purl.org/dc/elements/1.1/');

    $title = $metas->title;

    return (string)$title;
  }

	public function getBody(){
		$rootNode = $this->simplexml->xpath(self::ROOTTAG);
		$rootNode = $rootNode[0];

		if(!isset($rootNode)){
			throw new Exception("Unable to get simplexml root node.  Tag: " . self::ROOTTAG);
		}

		$markdown = $this->convertChildren($rootNode, 0);

		$this->md = $markdown;

		return $this->md;
	}

  public function createslug($title)
  {
      return str_replace(array(' ', '.', ':', ','), array('-', '', '', ''), strtolower($title));
  }

  public function getSponsor()
  {
      $sponsor = $this->simplexml->xpath('form//sponsor');

      return (string)$sponsor[0];
  }

  public function getStatus()
  {
      $status = $this->simplexml->attributes()['bill-stage'];
      $status = str_replace('-', ' ', (string)$status);
      
      return $status;
  }

  public function getCommittee()
  {
      $commitee_name = $this->simplexml->xpath('//committee-name');

      return (string)$commitee_name[0];
  }

	protected function convertChildren($node, $index){
		$nodeList = $node->xpath('section');
		$mdString = '';

		foreach($nodeList as $nodes){
			$section = new Structure('section');
			$section->level(0);

			$section->simplexml($nodes);
			$section->parseSelf();
			$mdString .= $section->toMarkdown();
		}

		return $mdString;
	}

	protected function dd()
	{
		array_map(function($x) { var_dump($x); }, func_get_args()); die;
	}

	protected function count_beg_chars($string, $char){
		$i = 0;
		echo "Starts with |" . $string{$i} . "|\n";

		while($string{$i} == $char){
			echo "|" .$string{$i} . "| ?= |" . $char . "|\n";
			$i++;
		}

		return $i;
	}
}
