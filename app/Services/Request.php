<?php

/**
 * Created by PhpStorm.
 * User: billpap
 * Date: 3/11/2018
 * Time: 12:04 PM
 */
class Request
{
    private  $url;
    private  $method;
    private  $headers;
    private  $content;
    private  $type;


    public function create($urlTarget)
    {
        $this->url = $urlTarget;//'http://localhost/project-learn/public/';
        return $this;
    }

    public function method($method)
    {
        $this->method = strtoupper($method);
        return $this;
    }

    public function headers($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public function content($content)
    {
        $this->content = $content;
        return $this;
    }

    public function type($type = 'http')
    {
        $this->type = $type;
        return $this;
    }

    public function commit()
    {
        $requestData = $this->content;
        $theHeaders = '';
        if(is_array($this->headers) && count($this->headers)>0){
            foreach ($this->headers as $header){
                $theHeaders .= $header."\r\n";
            }
        }else{$theHeaders .= $this->headers."\r\n";}
        $backbone = array(
            $this->type => array(
                'header'  => $theHeaders,
                'method'  => $this->method,
                'content' => http_build_query($requestData)
            )
        );

        $cont = stream_context_create($backbone);
        $results = file_get_contents($this->url, false, $cont);


        return unserialize($results);
    }

    public static function response($val)
    {
        $answer = serialize($val);
        return printf(eval('return $'. "answer" . ';'));
    }


}

function response($val)
{
    $answer = serialize($val);
    return printf(eval('return $'. "answer" . ';'));
}


