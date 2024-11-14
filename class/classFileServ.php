<?php

/**
 * Description of classFileServ
 *
 * @author andreych
 */
class classFileServ
{
    protected $extentionDeny = array(
        'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps','php8','cgi', 'pl', 'asp',
        'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html',
        'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
    );
    protected $extentionAllow = array(
        'pdf', 'doc', 'docx', 'xlsx', 'xls', 'odt', 'ods'
    );
    protected $mimeAllow = array(
        'application/msword','application/vnd.ms-excel','application/pdf','application/vnd.oasis.opendocument.text',
        'application/vnd.oasis.opendocument.spreadsheet',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    );
    protected $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
    //транслитерация имени файла
    public function translitera($fname){
        $fname_f = strtr($fname, array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',  'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',  'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',  'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'', 'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
        ));
        return $fname_f;
    }
    public function ifItsLoad($fname)
    {
        $result_report = false;
        if(isset($fname) ){
            $result_report = true;
        }
        return $result_report;
        
    }
    // проверка на ошибки загрузки файла
    public function if_noError($fname)
    {
        $result_report = true;
        if (!empty($fname['error']) || empty($fname['tmp_name'])) {
            $result_report = false;
        } elseif ($fname['tmp_name'] == 'none' || !is_uploaded_file($fname['tmp_name'])) {
            $result_report = false;
        }
        return $result_report;
    }

    // проверка миме типа на соответсвие заявленному расширению, говно ващемта. MIME можно брать из
    // $_FILE mime_content_type не описана, даже если включить fileinfo
    public function mimeReview($fname){
        $result_report = true; 
        if(!in_array(mime_content_type($fname['name']), $this->mimeAllow) ){
            $result_report = false;
        }
        return $result_report;
    }
    // Проверка на соответствие расширения файлов
    public function testExtention($fname)
    {
        $result_report = true;
        $name = mb_eregi_replace($this->pattern, '-', $fname);//['name']
        $name = mb_ereg_replace('[-]+', '-', $fname);
        $parts = pathinfo($fname);
        if (empty($fname) || empty($parts['extension'])) {
            $result_report = false;
        } elseif (!in_array(strtolower($parts['extension']), $this->extentionAllow)) {
            $result_report = false;
        } elseif (in_array(strtolower($parts['extension']), $this->extentionDeny)) {
            $result_report = false;
        }
        return $result_report;
    }
}
