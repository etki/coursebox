<?php

class Post
{
    private $status;
    const STATUS_PUBLISHED = 'published';
    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';
    const STATUS_DELETED = 'deleted';
    public function __construct($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }
}

new Post('deleted'); // есть возможно опечатки, которая будет обнаружена не
                     // сразу и принесет много головной боли
new Post(Post::STATUS_DELETED); // возможности опечататься нет
