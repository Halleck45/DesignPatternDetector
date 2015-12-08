<?php
interface Requester {
    public function request($path)   ;
}

class FileRequester implements Requester {
    public function request($path) {

    }
}

class FileProxyRequester implements Requester {
    public function request($path) {
        $proxyfied = new FileRequester();
        $proxyfied->request($path);
    }
}