<?php
/**
 * Created by PhpStorm.
 * User: Howard (Five)
 * Date: 2014/11/25
 * Time: 下午 05:44
 */

class Node {

    protected $value;
    protected $prev;
    protected $next;

    function Node($param = array()) {

        if (isset($param['value'])) {
            $this->value = $param['value'];
        }

        $this->prev = null;
        $this->next = null;
    }

    // Setter

    public function setValue($value) {
        $this->value = $value;
    }

    public function setPrev($node) {
        $this->prev = $node;
    }

    public function setNext($node) {
        $this->next = $node;
    }


    // Getter

    public function getValue() {
        return $this->value;
    }

    public function getPrev() {
        return $this->prev;
    }

    public function getNext() {
        return $this->next;
    }


    // Functions
    public function hasPrev() {
        return ($this->prev)?true:false;
    }

    public function hasNext() {
        return ($this->next)?true:false;
    }
}