<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
namespace adapters;

class Comments extends Main
{
	protected $order, $limit, $dirn, $site_id, $comments, $view, $alias;

	function __construct( \Config $config, $template ) {
		parent::__construct( $config, $template );
		$this->type = 'info';
		$this->site_id = $config->get('landingId');
		$this->rootUrl = $this->config->get('mainsite');
	}

	public function show($block, $i, $view, &$params)
	{
		$this->type = $block['type'];
		$this->id = $block['alias'];
		$this->title = $block['title'];
		$this->view = $view;
		$this->input = json_decode($block['input'], true);

		$this->order = !empty($this->input['order']) ? $this->input['order'] : 'ordering';
		$this->limit = !empty($this->input['limit']) ? (int)$this->input['limit'] : 3;
		$this->dirn = !empty($this->input['dirn']) ? $this->input['dirn'] : 'asc';
		if($view != 'main'){
			$order = 'created';
			$dirn = 'DESC';
			$limit = 100;
		}
		else{
			switch ($this->order){
				case 'ordering':
					$order = 'ordering';
					break;
				case 'date':
					$order = 'created';
					break;
				case 'random':
				default:
					$order = 'RAND()';
					break;
			}
			$dirn = 'ASC';
			if($order == 'RAND()'){
				$dirn = '';
			}
			else if($this->dirn == 'desc'){
				$dirn = 'DESC';
			}
			$limit = $this->limit;
		}

		$model = new \models\Comments($this->config);
		$this->comments = $model->getSelectorOptions($this->site_id, $order, $dirn, $limit);
		$this->loadTpl();
	}
}