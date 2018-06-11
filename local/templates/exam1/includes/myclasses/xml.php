<?php

/**
 * Created by PhpStorm.
 * User: Вован
 * Date: 10.06.2018
 * Time: 13:34
 */
class xml
{
    private $tab = 0;
    private $file = '';
    private $resource = null;
    private $charset = 'UTF-8';

    public function __construct()
    {
        $this->file =  tempnam('/tmp', 'xml');

        if (file_exists($this->file)) {
            unlink($this->file);
        }
    }

    public function StartFile()
    {
        $this->resource = fopen($this->file, 'ab');
        fwrite($this->resource, '<?xml version="1.0" encoding="' . $this->charset . '"?>' . PHP_EOL);
    }

    public function CloseFile()
    {
        fclose($this->resource);

        $GLOBALS['APPLICATION']->RestartBuffer();

        if ($_SERVER['SERVER_SOFTWARE'] == 'Apache'){
            header('Content-type: application/octet-stream');
            header('Content-Length: ' . filesize($this->file));
            header('Content-Disposition: attachment; filename="new_file.xml"');
            readfile($this->file);
            unlink($this->file);
        } elseif ($_SERVER['SERVER_SOFTWARE'] == 'nginx') {
            header('X-Accel-Redirect: ' . $this->file);
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="new_file.xml"');
            unlink($this->file);
        }

        die();
    }

    public function WriteItem($items, $mTag='', $tag = '')
    {
        if ($mTag != '') {
            $this->OpenTag($mTag);
        }
        foreach ($items as $t => $value) {
            if (is_array($value)) {
                $this->WriteItem($value, $tag);
            } else {
                $this->FullTag($t, $value);
            }
        }

        if ($mTag != '') {
            $this->EndTag($mTag);
        }

    }

    public function OpenTag($tag = '')
    {
        fwrite($this->resource, str_repeat("\t", $this->tab ) . '<' . $tag . '>' . PHP_EOL);
        $this->tab++;
    }

    public function EndTag($tag = '')
    {
        $this->tab--;
        fwrite($this->resource, str_repeat("\t", $this->tab ) . '</' . $tag . '>' . PHP_EOL);
    }

    public function FullTag($tag = '', $value)
    {
        fwrite($this->resource, str_repeat("\t", $this->tab ) . '<' . $tag . '>' . $value . '</' . $tag . '>' . PHP_EOL);
    }


}