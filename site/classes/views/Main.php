<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace views;

class Main{
	protected
		$template,
		$title,
		$published,
		$logo,
		$phone,
		$address,
		$abstract,
		$text,
		$blocks,
		$config,
		$view,
		$menu,
        $content
	;

	public function __construct($data, $config)
	{
		if(empty($data['title'])){
			throw new \Exception('Error loading Site Data.', 500);
		}
		$this->view = 'main';
		$this->config = $config;
        $this->template = 'main';
		$this->title = !empty($data['title']) ? $data['title']:  '';
		$this->metaTitle = !empty($data['metatitle']) ? $data['metatitle']:  $this->title;
		$this->metaDescription = !empty($data['metadesc']) ? $data['metadesc']:  '';
		$this->published = !empty($data['published']) ? $data['published'] : '0';
		$this->logo = !empty($data['logo']) ? \Helper::prepareImage($data['logo']) : '';
		$this->phone = !empty($data['phone']) ? $data['phone'] : '';
		$this->address = !empty($data['address']) ? $data['address'] : '';
		$this->abstract = !empty($data['abstract']) ? $this->prepareAbstract($data['abstract']) : array();
		$this->text = $data['introtext'].$data['fulltext'];
		$this->blocks = $data['blocks'];
		$this->menu = $data['menu'];
	}

	public function show()
    {
        ob_start();
        $i=0;
        $params = array();
        foreach ($this->blocks as $block) {
            $this->getHtml($block, $i, $params);
            $i++;
        }

        $this->content = ob_get_clean();

        if(!empty($params['title'])){
            $this->title .= ' ' . $params['title'];
        }
        if(!empty($params['metaDescription'])){
            $this->metaDescription .= ' ' . $params['metaDescription'];
        }
		$tpl = 'template/'.$this->config->get('template').'/'.$this->template.'.php';

		if(is_file($tpl)){
			require $tpl;
		}
	}

    public function getHtml($block, $i, &$params)
    {
        $adapterName = "\adapters\\".ucfirst($block['type']);

        $adapter = new $adapterName($this->config, $this->template);

        $adapter->show($block, $i, $this->view, $params);
    }

    private function prepareAbstract($data){
	    if(!is_array($data)){
	        return array();
        }

	    $array = array();
        foreach ($data as $v) {
            $array[$v['name']] = $v['desc'];
	    }

        return $array;
    }
}