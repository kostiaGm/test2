<?php

class PageReaderCurl extends PageReader {

   
    public function connect() {
        
        $uagent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8";

        $ch = curl_init($this->_url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // возвращает веб-страницу
        curl_setopt($ch, CURLOPT_HEADER, 0); // не возвращает заголовки
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // переходит по редиректам
        curl_setopt($ch, CURLOPT_ENCODING, ""); // обрабатывает все кодировки
        curl_setopt($ch, CURLOPT_USERAGENT, $uagent); // useragent
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // таймаут соединения
        curl_setopt($ch, CURLOPT_TIMEOUT, 120); // таймаут ответа
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10); // останавливаться после 10-ого редиректа

        $this->_htmlPage = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);
        if (isset($header['http_code'])) {
            $this->_httpCode = $header['http_code'];
        }
        
       
        return true;
    }

   

}
