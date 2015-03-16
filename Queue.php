<?php
/**
 * Created by PhpStorm.
 * User: Hiiir
 * Date: 2015/1/12
 * Time: 上午 11:23
 */

class_exists("NodeList") || require_once(dirname(__FILE__)."/NodeList.php");

class Queue extends NodeList implements Countable, Iterator{

    public function __construct() {
        parent::__construct();
    }

    public function enqueue( $value ) {
        $new = new Node(array('value'=>$value));
        $this->addNodeToLast($new);
    }

    // FIFO
    public function dequeue() {

        if ( $this->count() > 0 ) {
            $node = $this->getFirst();
            $this->removeFirstNode();
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