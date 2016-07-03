<?php

require_once "../mysqli/mysqli.php";
require_once "item.php";

Class Update
{

    public static function refresh()
    {

        global $mysqli;
        $xml = simplexml_load_file("https://www.nasa.gov/rss/dyn/lg_image_of_the_day.rss");
        $items = $xml->channel->item;
        $result = $mysqli->query("SELECT pubDate FROM items ORDER BY pubDate DESC");
        $dates = $result->fetch_assoc();
        $lastDate = $dates[0];
        echo $lastDate;

        foreach ($items as $item) {
            $pubDate = strtotime($item->pubDate);
            if ($pubDate > $lastDate && $pubDate !== 0) {
                $data = new Item($item->title, $pubDate, $item->description, $item->enclosure['url'], $item->link);
                $data->save();
                $item->pubDate->unset();
            }
        }
    }

    public static function load()
    {
        global $mysqli;
        $xml = simplexml_load_file("https://www.nasa.gov/rss/dyn/lg_image_of_the_day.rss");
        $items = $xml->channel->item;
        $result = $mysqli->query("SELECT pubDate FROM items ORDER BY pubDate DESC");
        $dates = $result->fetch_array();

        foreach ($items as $item) {
            $pubDate = strtotime($item->pubDate);
            if (count($dates) !== 0) {
                foreach ($dates as $date) {
                    $date = strtotime($date);
                    if ($pubDate != $date) {
                        $data = new Item($item->title, $pubDate, $item->description, $item->enclosure['url'], $item->link);
                        $data->save();
                    }
                }
            } else {
                $data = new Item($item->title, $pubDate, $item->description, $item->enclosure['url'], $item->link);
                $data->save();
            }
        }
    }

}