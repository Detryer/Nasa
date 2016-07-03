<?php
require_once "../mysqli/mysqli.php";

Class Item
{
    private $title;
    private $pubDate;
    private $description;
    private $imageUrl;
    private $link;

    public function __construct($title, $pubDate, $description, $imageUrl, $link)
    {
        $this->title = $title;
        $this->pubDate = $pubDate;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
        $this->link = $link;
        $this->updDate = date("d.m.Y H:i");
    }

    public function save()
    {
        global $mysqli;
        $query = "INSERT INTO items(title, pubDate, description, link, imageUrl, updDate)
                  VALUES ('$this->title','$this->pubDate', '$this->description','$this->link', '$this->imageUrl', '$this->updDate')";
        $mysqli->query($query);
    }

    public function edit()
    {
    }

    public function remove()
    {
    }
}