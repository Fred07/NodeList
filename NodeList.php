<?php
/**
 * Created by PhpStorm.
 * User: Howard (Five)
 * Date: 2014/11/26
 * Time: 上午 10:23
 * Desc: Doubly Linked List 雙向鍊結串列
 */

class_exists("Node") || require_once(dirname(__FILE__)."/Node.php");
class NodeList implements Countable, Iterator{

    protected $first;
    protected $last;
    protected $count;

    // implement of Iterator
    protected $pos = 0;

    const ERROR_TYPE_NODE = 'need instance of Node';

    function __construct() {
        $this->first = null;
        $this->last = null;
        $this->count = 0;
    }

    public function isEmpty() {
        return ($this->count == 0);
    }

    public function getFirst() {
        if ($this->first != null) {
            return $this->first;
        } else {
            throw new Exception('need add at least one node');
        }
    }

    public function getLast() {
        if ($this->last != null) {
            return $this->last;
        } else {
            throw new Exception('need add at least one node');
        }
    }

    // Add node to last
    public function addNodeToLast($node) {

        if ( $node instanceof Node ) {

            $this->addNode($node, $this->count);

        } else {
            throw new Exception(self::ERROR_TYPE_NODE);
        }
    }

    // Add node to first
    public function addNodeToFirst($node) {

        if ( $node instanceof Node ) {

            $this->addNode($node, 0);

        } else {
            throw new Exception(self::ERROR_TYPE_NODE);
        }
    }

    public function removeFirstNode() {
        $this->removeNode(0);
    }

    public function removeLastNode() {
        $this->removeNode($this->count-1);
    }

    // 取得指定位置節點
    // @param $pos int: 索引值, 0為起始位置
    public function getNodeByPos($pos) {

        if ( !$this->isNodeExist($pos) ) {
            //throw new Exception('can not find node');
            return false;
        }

        $targetNode = $this->getFirst();
        for($i = 0; $i <= $pos; $i++) {

            if ($i == $pos) {
                return $targetNode;
            }

            $targetNode = $targetNode->getNext();
        }

        return false;     // 找不到節點
    }

    // 指定位置插入node
    // @param $number int: 插入位置, 0為起始位置
    public function addNode( $node, $pos ) {

        // 檢查範圍
        if ( !$this->isValidInsertPos($pos) ) {
            return false;
        }

        if ($node instanceof Node) {

            $curNode = $this->first;
            $prevNode = null;

            for ($i=0;$i<=$pos;$i++) {       // 迴圈找尋目標節點位置

                if ( $i == $pos ) {          // 找到目標位置

                    // 進行連結修改
                    $this->insertNode($node, $prevNode, $curNode);
                    return true;
                }

                // 轉移往下一個節點
                $prevNode = $curNode;
                $curNode = $curNode->getNext();
            }
        } else {
            throw new Exception(self::ERROR_TYPE_NODE);
        }
    }

    // 移除節點
    // @param $pos int: 刪除指定位置節點, 0為起始位置
    public function removeNode($pos) {

        $curNode = $this->first;
        $preNode = null;
        for ($i=0;$i<=$pos;$i++) {

            if ( $i == $pos ) {

                $this->deleteNode($curNode, $preNode, $curNode->getNext());
            }

            // 轉移往下一個節點
            $preNode = $curNode;
            $curNode = $curNode->getNext();
        }
    }

    // 加入節點
    // 指標重新指向
    // @param $newNode  Node: 要加入的新節點
    // @param $prevNode Node: 上一個節點
    // @param $nextNode Node: 下一個節點
    protected function insertNode($newNode, $prevNode, $nextNode) {
        $newNode->setNext($nextNode);
        $newNode->setPrev($prevNode);
        if ($prevNode == null) {
            $this->first = $newNode;
        } else {
            $prevNode->setNext($newNode);
        }
        if ($nextNode == null) {
            $this->last = $newNode;
        } else {
            $nextNode->setPrev($newNode);
        }
        $this->count++;
    }

    // 移除節點
    // 指標重新指向
    // @param $node     Node: 要移除的節點
    // @param $prevNode Node: 上一個節點
    // @param $nextNode Node: 下一個節點
    protected function deleteNode($node, $prevNode, $nextNode) {

        if ($prevNode == null) {
            $this->first = $nextNode;
        } else {
            $prevNode->setNext($nextNode);
        }
        if ($nextNode == null) {
            $this->last = $prevNode;
        } else {
            $nextNode->setPrev($prevNode);
        }
        unset($node);
        $this->count--;
    }

    // 是否為可以加入節點的位置
    protected function isValidInsertPos($pos) {
        if ($pos > $this->count) {
            return false;
        } else {
            return true;
        }
    }

    // 是否為有資料的節點(非null Node)
    protected function isNodeExist($pos) {

        if ( $pos >= 0 AND $pos < $this->count ) {
            return true;
        } else {
            return false;
        }
    }

    // implement of Countable
    public function count() {
        return $this->count;
    }

    // implement of Iterator
    public function valid() {
        return $this->isNodeExist($this->pos);
    }

    public function next() {
        ++$this->pos;
    }

    public function rewind() {
        $this->pos = 0;
    }

    public function current() {

        $node = $this->getNodeByPos($this->pos);
        //return $node->getValue();
        return $node;
    }

    public function key() {
        return $this->pos;
    }
    // End of Iterator implement


    private function printOut($name, $value) {

        echo $name . ': ' . $value . '<br/>';

    }

    private function testLog($title, $value) {
        echo '////Log ' . $title . ': ' . $value . '<br/>';
    }
} 