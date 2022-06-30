<?php
namespace  Custom\Mrc\Api\Data;
interface HeroDataInterface{
    const ID  = 'id';
    const TITLE = 'title';
    const CONTENT = 'content';

    public function getId();
    public function setId($id);

    public function getTitle();
    public function setTitle($title);

    public function getContent();
    public function setContent($title);




}
