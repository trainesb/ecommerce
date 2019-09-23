<?php


namespace ECommerce;


class Controller {

    protected $result = null;
    protected $site;

    public function __construct(Site $site) {
        $this->site = $site;
    }

    public function getResult() { return $this->result; }
}