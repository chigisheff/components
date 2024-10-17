<?php
/* pagemain */
class pagemain{
	
	public $meta_charset= "<meta charset=\"utf-8\">";
	public $title = "Справочник радиолектронных компонентов  @AGChigisheff";
	public $meta_name_viewport = "<meta name=\"viewport\" content=\"width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0\">";
	public $link_style_reset = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/reset.css\" media=\"screen\">";
	public $link_styles = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/m_style.css\" media=\"screen\">";
	public $link_href = "<link rel=\"stylesheet\" type=\"text/css\" href=\"js/jquery-3.7.1.js\">";
	public $script_src = "<script src=\"js/jquery-3.7.1.js\" ></script>";
	public function p_header(){
		?><head>
                <?php echo $this->meta_charset; ?>
                  <meta name="robots" content="noindex,nofollow">
                  
                  <title> <?php echo $this->title; ?> </title> 
                <link rel="icon" href="favicon.ico" type="image/x-icon">
                <?php
		echo $this->meta_name_viewport;
		echo $this->link_style_reset;
		echo $this->link_styles;
		echo $this->script_src;
		?></head>
        <?php
	}
	public function p_open(){
		require_once "interface/pg_head.php";
	}
	public function p_content(){
		require_once "interface/pg_content.php";
	}
	public function p_close(){
		require_once "interface/pg_bottom.php";	
	}
}

