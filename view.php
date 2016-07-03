<?php
require_once "mysqli/mysqli.php";

Class View
{
    public static function showShort()
    {
        global $mysqli;
//        $query = "SELECT items.id, items.title, items.pubDate, items.updDate, items.link, COUNT(comments.text)
//        FROM items LEFT JOIN comments ON items.id=comments.id
//        ORDER BY items.pubDate DESC";
        $query = "SELECT id, title, pubDate, updDate, link FROM items ORDER BY pubDate ASC";
        $data = $mysqli->query($query);


        while($row = $data->fetch_assoc()){
            $id = $row['id'];
            $title = $row['title'];
            $pub = date("d.m.Y H:i", $row['pubDate']);
            $upd = $row['updDate'];
            $link = $row['link'];
            echo "
<tr>
<td>$id</td>
<td></td>
<td>$title</td>
<td><a href='$link'>$pub</a></td>
<td>$upd</td>
</tr>";
        }
        $mysqli->close();
    }

    public function showFull()
    {
    }
}
