<?php
/**
 * CommentModel.php
 * Created by day11.
 * User: 苏小林
 * Date: 2016/6/3
 * Time: 11:55
 */

namespace app\model;

use core\Model;

class CommentModel extends Model
{
    protected $table = 'comment';

    public function getAllWithJoin()
    {
        $sql = "SELECT `comment`.*, `user`.`username`, `article`.`title`, a.`content` AS parent_content
                      FROM `comment`
                      LEFT JOIN `user` ON `comment`.`user_id`=`user`.`id`
                      LEFT JOIN `article` ON `comment`.`article_id`=`article`.`id`
                      LEFT JOIN `comment` AS a ON `comment`.`parent_id`=a.`id`";
        return $this->getAll($sql);
    }

    public function getAllWithJoinUserByArticleId($id)
    {
        $sql = "SELECT
                  `comment`.*,
                  `user`.`username`
                FROM
                  `comment`
                LEFT JOIN
                  `user` ON `comment`.`user_id` = `user`.`id`
                WHERE
                  `article_id` = {$id}";
        return $this->getAll($sql);
    }

    public function limitlessLevel($comments, $parentId = 0)
    {
        $limitlessComments = array();
        // 在$comments去找顶级评论
        foreach ($comments as $comment) {
            if ($comment['parent_id'] == $parentId) {
                $comment['son'] = $this->limitlessLevel($comments, $comment['id']);
                $limitlessComments[] = $comment;
                //var_dump( $limitlessComments);die;
            }
        }
        return $limitlessComments;
    }
}