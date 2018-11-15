<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Breadcrumbs Class
 *
 * This class manages the breadcrumb object
 *
 * @package		Breadcrumb
 * @version		1.0
 * @author 		Tomo
 * 
 * 
 */
class Breadcrumbs {
	private $breadcrumbs = array();
	private $separator = '  >>  ';
	//private $start = '<div id="breadcrumb">';
	//private $end = '</div>';
	private $start = '<ul class="breadcrumb">';
	private $end = '</ul>';
	 	
	 /**
	  * Constructor
	  *
	  * @access	public
	  *
	  */
	public function __construct($params = array()) {	
		if(count($params > 0)) {
			$this->initialize($params);
		}
	}
	
	// --------------------------------------------------------------------

	private function initialize($params = array()) {
		if (count($params) > 0) {
			foreach ($params as $key => $val) {
				if (isset($this->{'_' . $key})) {
					$this->{'_' . $key} = $val;
				}
			}
		}
	}

	function add($title, $href, $icon='') {
		if (!$title OR !$href) return;
		$this->breadcrumbs[] = array('title' => $title, 'href' => $href, 'icon' => $icon);
	}

	function output() {
		if ($this->breadcrumbs) {
			$output = $this->start;
			foreach ($this->breadcrumbs as $key => $crumb) {
				if ($key) {
					//$output .= $this->separator;
				}
				
				if (end(array_keys($this->breadcrumbs)) == $key) {
					$output .= '
						<li>
							' . $crumb['title'] . '
						</li>
					';
				} else {
					$output .= '
						<li>
							<i class="' . $crumb['icon'] . ' home-icon"></i>
							<a href="' . $crumb['href'] . '">' . $crumb['title'] . '</a>
							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
					';
				}
			}
			return $output . $this->end . PHP_EOL;
		}
		return '';
	}

}
// END Breadcrumbs Class

/* End of file Breadcrumbs.php */
/* Location: ./application/libraries/Breadcrumbs.php */
