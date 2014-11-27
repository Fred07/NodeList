<?php
/**
 * Created by PhpStorm.
 * User: Hiiir
 * Date: 2014/11/25
 * Time: 下午 05:44
 */

class Node {

    protected $id;
    protected $value;
    protected $prev;
    protected $next;

    function Node($param = array()) {

        if (isset($param['id'])) {
            $this->id = $param['id'];
        }
        if (isset($param['value'])) {
            $this->value = $param['value'];
        }

        $this->prev = null;
        $this->next = null;
    }

    // Setter
    public function setId($id) {
        $this->id = $id;
    }

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
    public function getId() {
        return $this->id;
    }

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