<?php

namespace App\Models;

use PDO;
use \Datetime;


class Post extends \Core\Model
{


    public static function getAllPost()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM post');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getPostById(int $id)
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM post WHERE id =' . $id);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getPostByAccountId($id)
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM post WHERE account_id = ?', array($id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addPost($title, $chapo, $content, $img_url)
    {
        $db = static::getDB();
        $stmt = $db->prepare('INSERT INTO post (title, chapo, content, img_url, created_at, updated_at) VALUES (?,?,?,?)');
        $stmt->execute(array($title, $chapo, $content, $img_url, new DateTime(), new DateTime()));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updatePost($id, $title, $chapo, $content, $img_url)
    {
        $db = static::getDB();
        $stmt = $db->prepare('UPDATE post SET title = ?, chapo = ?, content = ?, img_url = ?, updated_at = ? WHERE id = ?');
        $stmt->execute(array($title, $chapo, $content, $img_url, new DateTime(), $id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deletePost($id)
    {
        $db = static::getDB();
        $stmt = $db->prepare('DELETE FROM post WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
