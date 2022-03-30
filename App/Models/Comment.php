<?php

namespace App\Models;

use PDO;
use \Datetime;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Comment extends \Core\Model
{


    public static function getCommentsByPost($id)
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM comment WHERE post_id = ? AND visible = 1', array($id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCommentsNoVisible()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM comment WHERE visible = 0');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function insertComment($message, $account_id, $post_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare('INSERT INTO comment (message, account_id, post_id, visible, created_at) VALUES (?,?,?,?,?)');
        $stmt->execute(array($message, $account_id, $post_id, false, new DateTime()));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateComment($id, $message, $account_id, $post_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare('UPDATE comment SET message = ?, account_id = ?, post_id = ?, visible = 1, created_at = ? WHERE id = ?');
        $stmt->execute(array($message, $account_id, $post_id, new DateTime(), $id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteComment($id)
    {
        $db = static::getDB();
        $stmt = $db->prepare('DELETE FROM comment WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCommentById($id)
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM comment WHERE id = ?', array($id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCommentByAccountId($id)
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM comment WHERE account_id = ?', array($id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
