<?php

	require_once 'smarty/Smarty.class.php';
	class MySmarty extends Smarty
	{
		var $headerUnsent = true;

		function isAdmin()
		{
			if (array_key_exists('HTTPS', $_SERVER))
				return ($_SERVER['HTTPS'] == 'on');
			else
				return false;
		}

		function __construct()
		{
			$this->template_dir = BASE_PATH.'templates/';
			$this->compile_dir  = BASE_PATH.'tplcompiled/';
			$this->config_dir   = BASE_PATH.'config/';
			$this->cache_dir    = BASE_PATH.'cache/';
			$this->register_modifier('dateBR', 'smarty_modifier_dateBR');
		}

		function validateReferral()
		{
			if (array_key_exists('HTTP_REFERER', $_SERVER))
			{
				$pieces = explode('/', $_SERVER['HTTP_REFERER'], 4);
				if ($pieces[2] != $_SERVER['HTTP_HOST'])
					$this->redirect('');
			}
			else
				$this->redirect('');
		}

		function sendHeader()
		{
			if ($this->headerUnsent)
			{
				header('Content-Type: text/html; charset=utf-8');
				header('Cache-Control: no-cache, must-revalidate');
				$this->headerUnsent = false;
			}
		}

		function page($name)
		{
			$this->sendHeader();
			$this->assign('isAdmin', $this->isAdmin());
			$this->display($name.'.tpl');
		}

		function ajax($name)
		{
			# this function used to be different than page(), not anymore
			$this->page($name);
		}

		function redirect($whereto, $exit=true)
		{
			header('Cache-Control: no-cache, must-revalidate');
			if (strpos($whereto, '://') !== false)
				$base = '';
			else if ($this->isAdmin())
				$base = 'https://'.$_SERVER['HTTP_HOST'].'/';
			else
				$base = 'http://'.$_SERVER['HTTP_HOST'].'/';

			header('Location: '.$base.$whereto);
			if ($exit)
				exit;
		}

		function redirectBack($exit=true)
		{
			if (array_key_exists('HTTP_REFERER', $_SERVER))
				$this->redirect($_SERVER['HTTP_REFERER'], $exit);
			else
				$this->redirect('');
		}

		function concatenate($subfolder, $contentType='text/plain', $exit=true)
		{
			$when = function($file)
			{
				$stat = stat($file);
				return $stat[9];
			};

			# let's find about our compiled file
			$compiledFile = $this->compile_dir.'concatenated-'.$subfolder;
			$lastCompiled = 0;
			if (file_exists($compiledFile))
				$lastCompiled = $when($compiledFile);

			# first we list the CSS files
			$dir = $this->template_dir.$subfolder.'/';
			$list = array($dir); # this is the only way to detect deletions
			$dh = opendir($dir);
			while (($file=readdir($dh)) !== false)
				if (substr_compare($file, '.', 0, 1, true) != 0)
					$list[] = $dir.$file;

			# do we need to compile?
			$mustCompile = false;
			foreach ($list as $file)
				if ($when($file) >= $lastCompiled)
				{
					$mustCompile = true;
					break;
				}

			#compile!!
			if ($mustCompile)
			{
				$fh = fopen($compiledFile, 'w');
				foreach ($list as $file)
					fwrite($fh, file_get_contents($file));
				fclose($fh);
			}

			header('Content-Type: '.$contentType.'; charset=UTF-8');
			readfile($compiledFile);
			if ($exit)
				exit;
		}
	}
	$smarty = new MySmarty();
	
	function smarty_modifier_dateBR($string)
	{
		$arr = explode('-', $string);
		$arr = array_reverse($arr);
		return implode('/', $arr);
	}

?>
