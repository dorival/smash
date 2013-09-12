<?php

	class UploadedFile
	{
		var $file;
		var $extension;

		function __construct($file)
		{
			$this->file = $file;
			$name = $file['name'];
			$lastDotPos = strrpos($name, '.');
			if ($lastDotPos !== false)
			{
				$this->extension = strtolower(substr($name, $lastDotPos));
			}
		}

		function toImage()
		{
			$file = $this->file['tmp_name'];
			switch ($this->extension)
			{
				case '.gif':  return new Image(imagecreatefromgif ($file));
				case '.jpeg': return new Image(imagecreatefromjpeg($file));
				case '.jpg':  return new Image(imagecreatefromjpeg($file));
				case '.png':  return new Image(imagecreatefrompng ($file));
				default: return NULL;
			}
		}

		function createFilename()
		{
			return new Filename($this->extension);
		}
	}

	class Image
	{
		var $handle;
		var $width;
		var $height;

		function __construct($handle)
		{
			$this->handle = $handle;
			$this->width = imagesx($handle);
			$this->height = imagesy($handle);
		}
		
		function toResizedAndCropped($size)
		{
			// default to a square image
			$sx = $sy = 0;
			$ss = min($this->width, $this->height);
			// sanity check - we may already be the right size
			if (($size == $ss) && ($this->width == $this->height))
				return $this;
			// alternative values are exceptions
			$newImg = new Image(imagecreatetruecolor($size, $size));
			if ($this->width > $this->height)
				$sx = (int)(($this->width - $this->height) / 2);
			else if ($this->height > $this->width)
				$sy = (int)(($this->height - $this->width) / 2);
			imagecopyresampled($newImg->handle, $this->handle,
				0, 0, $sx, $sy, $size, $size, $ss, $ss);
			return $newImg;
		}

		function toResizedAndCroppedAndSaved($size)
		{
			$newImg = $this->toResizedAndCropped($size);
			$filename = new Filename('.jpeg');
			$newImg->savejpeg($filename->getFullPath());
			return $filename->getRelativePath();
		}

		function savejpeg($filename = NULL, $quality = 75)
		{
			imagejpeg($this->handle, $filename, $quality);
		}

		function __destruct()
		{
			imagedestroy($this->handle);
		}
	}

	class Filename
	{
		var $path1;
		var $path2;
		var $path3;

		function __construct($extension)
		{
			$this->path1 = BASE_PATH . 'www/uploads/';
			$this->path2 = date('Y/m/');
			$this->path3 = mt_rand(0,999999999) . $extension;
		}

		function getFullPath()
		{
			$folder = $this->path1 . $this->path2;
			if (!file_exists($folder))
				mkdir($folder, 0755, true);
			return $this->path1 . $this->path2 . $this->path3;
		}

		function getRelativePath()
		{
			return $this->path2 . $this->path3;
		}
	}

?>
