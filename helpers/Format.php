<?php 
  /**
   * Format class
   */
  class Format
  {
  	public function formatdate($date)
  	{
  		return date('F j, Y, g:i a', strtotime($date));
  	}

  	public function shortentext($body, $limit=400)
  	{
  		$text = $body. " ";
      $text = substr($text,0,$limit);
      $text = substr($text,0,strrpos($text, ' '));
      $text = $text.".........";
      return $text;
  	}

    public function validate($data)
    {
      $data = trim($data);
      $data = stripcslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    public function title()
    {
      $path  = $_SERVER['SCRIPT_FILENAME'];
      $title = basename($path, '.php');
      if($title == 'index'){
        $title = 'home';
      }elseif($title == 'about'){
        $title = 'about';
      }elseif($title == 'contact'){
        $title = 'contact';
      }
      return $title = ucfirst($title);
    }
  }
?>