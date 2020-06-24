<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2009, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/*
 * ------------ ever forget how to write script to include css or js?
 * 
 * <link href="<?php echo base_url() ?>public/css/mycss1.css" rel="stylesheet" type="text/css" />
 * <link href="<?php echo base_url() ?>public/css/mycss2.css" rel="stylesheet" type="text/css" />
 * <link href="<?php echo base_url() ?>public/css/mycss3.css" rel="stylesheet" type="text/css" />
 * <link href="<?php echo base_url() ?>public/css/mycss4.css" rel="stylesheet" type="text/css" />
 * <script type="application/javascript" src="<?php echo base_url() ?>public/js/myjs1.js"></script>
 * <script type="application/javascript" src="<?php echo base_url() ?>public/js/myjs2.js"></script>
 * <script type="application/javascript" src="<?php echo base_url() ?>public/js/myjs3.js"></script>
 * <script type="application/javascript" src="<?php echo base_url() ?>public/js/myjs4.js"></script>
 * <script type="application/javascript" src="<?php echo base_url() ?>public/js/myjs5.js"></script>
 * 
 * ------------ the easier way to do it:
 * 
 * <?php echo css(array(
 * 'public/css/mycss1.css',
 * 'public/css/mycss2.css',
 * 'public/css/mycss3.css',
 * 'public/css/mycss4.css',
 * )); ?>
 * 
 * <?php echo js(array(
 * 'public/js/myjs1.js',
 * 'public/js/myjs2.js',
 * 'public/js/myjs3.js',
 * 'public/js/myjs4.js',
 * 'public/js/myjs5.js',
 * )); ?>
 * 
 * ------------ want to combine them into one file? just say where you want the combined file to be put, write it as second parameter.
 * 
 * <?php echo css(array(
 * 'public/css/mycss1.css',
 * 'public/css/mycss2.css',
 * 'public/css/mycss3.css',
 * 'public/css/mycss4.css',
 * ), 'themes/cache'); ?>
 * 
 * <?php echo js(array(
 * 'public/js/myjs1.js',
 * 'public/js/myjs2.js',
 * 'public/js/myjs3.js',
 * 'public/js/myjs4.js',
 * 'public/js/myjs5.js',
 * ), 'themes/cache'); ?>
 * 
 */

function css($files, $cache_folder = FALSE)
{
	if (is_string($files)) $files = array($files);
	if (!is_array($files)) return false;
	
	$links = '';

	if ($cache_folder === FALSE) {
		foreach ($files as $file)
		{
			$url = (preg_match('/^(http:\\/\\/)?([a-z0-9_-]*?\\.)+[a-z]{2,}\\//i', $file)) ? $file : base_url().$file;
			$links .= "\n".'<link href="'.$url.'" rel="stylesheet" type="text/css" />';
		}
		return $links;
	}

	$fileinfo = '';
	foreach ($files as $file)
	{
		if (preg_match('/^(http:\\/\\/)?([a-z0-9_-]*?\\.)+[a-z]{2,}\\//i', $file))
		{
			$links .= "\n".'<script type="application/javascript" src="'.$file.'"></script>';
			continue;
		}

		$filename = FCPATH.$file;
		if (!file_exists($filename)) {
			show_error("CSS function error, file <b>{$file}</b> not found.");
			return false;
		} else {
			$fileinfo .= $filename.filemtime($filename);
		}
	}
	
	$mfile = md5($fileinfo).'.css';
	$cache_folder = str_replace('\\', '/', trim($cache_folder, '/')).'/';
	$cache_full_path = FCPATH.$cache_folder.$mfile;

	if (!file_exists($cache_full_path)) {
		$string = '';
		foreach ($files as $file)
		{
			$filename = FCPATH.$file;
			$filecontent = file_get_contents($filename);
			// cari css yg menggunakan fungsi url() dan buat penanganan perubahan direktori pada fungsi url()
			// regex : url\((".*?"|'.*?'|.*?)\)
			if (preg_match_all('/url\\((".*?"|\'.*?\'|.*?)\\)/i', $filecontent, $m))
			{
				$m = array_unique($m[1]);
				rsort($m);
				
				foreach ($m as $kk=>$v)
				{
					$quote = in_array($v[0], array('"', "'")) ? $v[0] : '';
					$v2 = trim($v, '"\'');

					//1. if url is web, let it be
					if (preg_match('/^(http:\\/\\/)?([a-z0-9_-]*?\\.)+[a-z]{2,}\\//i', $v2)) unset($m[$k]);
					$filecontent = str_replace($v, "-|-$kk-|-", $filecontent);
				}

				foreach ($m as $kk=>$v)
				{
					$quote = in_array($v[0], array('"', "'")) ? $v[0] : '';
					$v2 = trim($v, '"\'');

					//1. if url is web, let it be
					if (preg_match('/^(http:\\/\\/)?([a-z0-9_-]*?\\.)+[a-z]{2,}\\//i', $v2)) continue;

					//2. if it's relative path, change it with the correct path relative to the current combined css' location
					$ori_file = str_replace('\\', '/', trim($file, '/'));
					$ori_path = explode('/', $ori_file);
					$ori_path = array_slice($ori_path, 0, -1);
					$css_path = explode('/', $v2);
					while($css_path[0] == '..' && count($ori_path) > 0) {
						$ori_path = array_slice($ori_path, 0, -1);
						$css_path = array_slice($css_path, 1);
					}
					$ori_path = array_merge($ori_path, $css_path);


					$cache_path = explode('/', trim($cache_folder, '/'));
					foreach ($cache_path as $k=>$vp) {
						if ($ori_path[$k] != $vp) break;
						unset($ori_path[$k]);
						unset($cache_path[$k]);
					}
					$ori_path = implode('/', $ori_path);
					$new_css_path = str_repeat('../', count($cache_path)).$ori_path;
					$filecontent = str_replace("-|-$kk-|-", $quote.$new_css_path.$quote, $filecontent);
				}
			}
			$string .= "/* CSS file {$file} */\n\n"
				.$filecontent
				."\n\n/* --- END OF {$file} --- */\n\n\n"
			;
		}
		file_put_contents($cache_full_path, $string);
	}
	return $links."\n".'<link href="'.base_url().$cache_folder.$mfile.'" rel="stylesheet" type="text/css" />';
}

function js($files, $cache_folder = FALSE)
{
	if (is_string($files)) $files = array($files);
	if (!is_array($files)) return false;
	
	$links = '';

	if ($cache_folder === FALSE) {
		foreach ($files as $file)
		{
			$url = (preg_match('/^(http:\\/\\/)?([a-z0-9_-]*?\\.)+[a-z]{2,}\\//i', $file)) ? $file : base_url().$file;
			$links .= "\n".'<script type="application/javascript" src="'.$url.'"></script>';
		}
		return $links;
	}

	$fileinfo = '';
	foreach ($files as $file)
	{
		if (preg_match('/^(http:\\/\\/)?([a-z0-9_-]*?\\.)+[a-z]{2,}\\//i', $file))
		{
			$links .= "\n".'<script type="application/javascript" src="'.$file.'"></script>';
			continue;
		}

		$filename = FCPATH.$file;
		if (!file_exists($filename)) {
			show_error("JS function error, file <b>{$file}</b> not found.");
			return false;
		} else {
			$fileinfo .= $filename.filemtime($filename);
		}
	}
	
	$mfile = md5($fileinfo).'.js';
	$cache_folder = str_replace('\\', '/', trim($cache_folder, '/')).'/';
	$cache_path = FCPATH.$cache_folder.$mfile;
	if (!file_exists($cache_path)) {
		$string = '';
		foreach ($files as $file)
		{
			$filename = FCPATH.$file;
			$string .= "/* JS file {$file} */\n\n".file_get_contents($filename)."\n\n/* --- END OF {$file} --- */\n\n\n";
		}
		file_put_contents($cache_path, $string);
	}
	return $links."\n".'<script type="application/javascript" src="'.base_url().$cache_folder.$mfile.'"></script>';
}

// ------------------------------------------------------------------------

/**
 * Parser Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Parser
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/parser.html
 */

class MY_Parser extends CI_Parser
{

	var $l_delim = '{';
	var $r_delim = '}';
	var $object;

	//Added by ~yk~
	var $_vars = array();
	var $_vars_element = array();
	var $_ajax_filter = array();
	var $_templates = array();

	function __construct() {
		//AJAX Related
		define('AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		$CI =& get_instance();
	}

	// Deprecated
	function set_var($varname, $string = false, $data = false)
	{
		$this->set($varname, $string, $data);
	}
	function append_var($varname, $string = false, $data = array())
	{
		$this->append($varname, $string, $data);
	}
	function prepend_var($varname, $string = false, $data = array())
	{
		$this->prepend($varname, $string, $data);
	}
	
	
	function set($varname, $string = false, $data = false)
	{
		if (is_string($varname))
		{
			$this->_vars[$varname] = is_array($data) ?
				$this->parse($string, $data, TRUE)
				: $string;
		}
		elseif (is_array($varname))
		{
			foreach ($varname as $k=>$v)
			{
				$this->_vars[$k] = is_array($v) ?
					$this->parse($v[0], $v[1], TRUE)
					: $v;
			}
		}
		else
		{
			return FALSE;
		}
	}

	function append($varname, $string = false, $data = array())
	{
		if (is_string($varname))
		{
			if (is_array($data)) {
				$this->_vars[$varname] =
					(isset($this->_vars[$varname])?$this->_vars[$varname]:'')
					.$this->parse($string, $data, TRUE);
			} else {
				$this->_vars[$varname] =
					(isset($this->_vars[$varname])?$this->_vars[$varname]:'')
					.$string;
			}

		}
		elseif (is_array($varname))
		{
			foreach ($varname as $k=>$v)
			{
				$this->_vars[$k] = (isset($this->_vars[$k])?$this->_vars[$k]:'').$v;
			}
		}
		else
		{
			return FALSE;
		}
	}

	function prepend($varname, $string = false, $data = array())
	{
		if (is_string($varname))
		{
			if (is_array($data)) {
				$this->_vars[$varname] = $this->parse($string, $data, TRUE).(isset($this->_vars[$varname])?$this->_vars[$varname]:'');
			} else {
				$this->_vars[$varname] = $string.(isset($this->_vars[$varname])?$this->_vars[$varname]:'');
			}

		}
		elseif (is_array($varname))
		{
			foreach ($varname as $k=>$v)
			{
				$this->_vars[$k] = $v.(isset($this->_vars[$k])?$this->_vars[$k]:'');
			}
		}
		else
		{
			return FALSE;
		}
	}

	//For HTML output
	function set_template($template_name, $template_view)
	{
		$this->_templates[$template_name] = $template_view;
	}
	
	function render($template)
	{
		isset($this->_templates[$template]) AND $template = $this->_templates[$template];
		return $this->parse($template, $this->_vars);
	}

	//For AJAX output (in JSON)
	function ajax($custom_vars = array())
	{
		$response = array('response'=>array(), 'alert'=>array());
		foreach($this->_ajaxvars as $k=>$v) {
			$response['response'][$k]['html'] = $this->_vars[$v];
		}
		foreach($this->_ajaxcontents as $k=>$v) {
			$response['response'][$k]['html'] = $v;
		}
		if (is_array($custom)) {
			foreach ($custom as $k=>$v) if ($k != 'response') $response[$k] = $v;
		} else {
			$response['custom'] = $custom;
		}
		$CI->output->set_output('yk!'.json_encode($response));
	}

	//automatically choose between HTML or AJAX output
	function renderajax($template, $ajax_custom_vars)
	{
		if (AJAX)
		{
			$this->ajax($ajax_custom_vars);
		}
		else
		{
			$this->render($template);
		}
	}

	//Directly write a text as an output without parsing any variables
	function output($text) {
		$CI->output->set_output($text);
	}

	// ~yk~ ----*/

	/**
	 *  Parse a template
	 *
	 * Parses pseudo-variables contained in the specified template,
	 * replacing them with the data in the second param
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	function parse($template, $data = FALSE, $return = FALSE)
	{
		$CI =& get_instance();
		$template = $CI->load->view($template, $data, TRUE);

		if ($template == '')
		{
			return FALSE;
		}

		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{
				if (is_array($val))
				{
					$template = $this->_parse_pair($key, $val, $template);
				}
				elseif (!is_object($val))
				{
					$template = $this->_parse_single($key, (string)$val, $template);
				}
			}
		}

		if ($return == FALSE)
		{
			$CI->output->append_output($template);
		}

		return $template;
	}

	// --------------------------------------------------------------------

	/**
	 *  Set the left/right variable delimiters
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	void
	 */
	function set_delimiters($l = '{', $r = '}')
	{
		$this->l_delim = $l;
		$this->r_delim = $r;
	}

	// --------------------------------------------------------------------

	/**
	 *  Parse a single key/value
	 *
	 * @access	private
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	function _parse_single($key, $val, $string)
	{
		return str_replace($this->l_delim.$key.$this->r_delim, $val, $string);
	}

	// --------------------------------------------------------------------

	/**
	 *  Parse a tag pair
	 *
	 * Parses tag pairs:  {some_tag} string... {/some_tag}
	 *
	 * @access	private
	 * @param	string
	 * @param	array
	 * @param	string
	 * @return	string
	 */
	function _parse_pair($variable, $data, $string)
	{
		if (FALSE === ($match = $this->_match_pair($string, $variable)))
		{
			return $string;
		}

		$str = '';
		foreach ($data as $row)
		{
			$temp = $match['1'];
			foreach ($row as $key => $val)
			{
				if ( ! is_array($val))
				{
					$temp = $this->_parse_single($key, $val, $temp);
				}
				else
				{
					$temp = $this->_parse_pair($key, $val, $temp);
				}
			}

			$str .= $temp;
		}

		return str_replace($match['0'], $str, $string);
	}

	// --------------------------------------------------------------------

	/**
	 *  Matches a variable pair
	 *
	 * @access	private
	 * @param	string
	 * @param	string
	 * @return	mixed
	 */
	function _match_pair($string, $variable)
	{
		if ( ! preg_match("|".$this->l_delim . $variable . $this->r_delim."(.+?)".$this->l_delim . '/' . $variable . $this->r_delim."|s", $string, $match))
		{
			return FALSE;
		}

		return $match;
	}

}

// END Parser Class

/* End of file Parser.php */
/* Location: ./system/libraries/Parser.php */