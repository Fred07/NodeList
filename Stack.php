<?php
/**
 * Created by PhpStorm.
 * User: Hiiir
 * Date: 2015/1/12
 * Time: 下午 04:30
 */

class_exists("NodeList") || require_once(dirname(__FILE__)."/NodeList.php");

class Stack extends NodeList implements Countable, Iterator{

    public function __construct() {
        parent::__construct();
    }

    public function push( $value ) {
        $node = new Node(array('value'=>$value));
        $this->addNodeToLast($node);
    }

    // LIFO
    public function pop() {

        if ( $this->count() > 0 ) {
            $node = $this->getLast();
            $this->removeLastNode();
            return $node->getValue();
        } else {
            return false;
        }

    }

    /**
     * extends Countable implementation
     */


    /**
     * extends Iterator implementation
     */

} 