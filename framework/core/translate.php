<?php


class Translator {

    private $language   = 'en';
    private $lang       = array();
    private $filename = 'lang';

    public function __construct($language){
        $this->language = $language;
        $this->lang[$this->language] = array();
        $this->filename = $this->filename.'_'.$this->language;
    }

    private function findString($str) {
        if (array_key_exists($str, $this->lang[$this->language])) {
            echo $this->lang[$this->language][$str];
            return;
        }
        echo $str;
    }

    private function fetchLang() {
    	if(file_exists(TRANSLATE_DIR.DS.$this->filename) && is_readable(TRANSLATE_DIR.DS.$this->filename)) {
    		$data = file_get_contents(TRANSLATE_DIR.DS.$this->filename);
            
            if(!empty($data))
    		      $this->lang[$this->language] = json_decode($data, true);

    		return true;
    	}
    	else {
    		return false;
    	}
    }

    private function saveString($str) {
    	if(file_exists(TRANSLATE_DIR.DS.$this->filename) && is_writeable(TRANSLATE_DIR.DS.$this->filename)) {

            $data = file_get_contents(TRANSLATE_DIR.DS.$this->filename);
            
            if(!empty($data)) {
                  $data = json_decode($data, true);
                  $this->lang[$this->language] = array_merge($this->lang[$this->language], $data);
              }
            
            if(!array_key_exists($str, $this->lang[$this->language]))
                $this->lang[$this->language][$str] = $str;

            $data = json_encode($this->lang[$this->language], JSON_PRETTY_PRINT);
            file_put_contents(TRANSLATE_DIR.DS.$this->filename, $data);

            return true;
        }
        else {
            return false;
        }
    }

    public function __($str) {

    	$this->fetchLang();

    	if(!array_key_exists($str, $this->lang[$this->language])) {
    		$this->lang[$this->language][$str] = $str;
    	}


        #$data = $this->saveString($str);
        #var_dump($data);

    	return $this->lang[$this->language][$str];
    }
}



function __($str) {
	global $lang;
	return htmlspecialchars($lang->__($str));
}
