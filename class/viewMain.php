<?php
/* pagemain */
class viewMain{
	
    public $meta_charset= "<meta charset=\"utf-8\">";
    public $title = "Справочник радиоэлектронных компонентов  @AGChigisheff";
    public $meta_name_viewport = "<meta name=\"viewport\" content=\"width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0\">";
    public $link_style_reset = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/reset.css\" media=\"screen\">";
    public $link_styles = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/m_style.css\" media=\"screen\">";
    public $link_href = "<link rel=\"stylesheet\" type=\"text/css\" href=\"js/jquery-3.7.1.js\">";
    public $script_src = "<script src=\"js/jquery-3.7.1.js\" ></script>";
    public function pHeader(){
            ?><head>
            <?php echo $this->meta_charset;  ?>
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
    public function pOpen(){
            require_once "interface/viewHeader.php";
    }
    public function pContent(){
            require_once "interface/viewContent.php";
    }
    public function pFooter(){
            require_once "interface/viewFooter.php";	
    }
}

/* <script src=\"js/actions.js\" ></script>*/