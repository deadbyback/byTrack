<?php 

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Comment;

class CommentForm extends Model
{
    public $comment;

    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3,250]],
        ];
    }

    public function saveComment($bug_id)
    {
        $comment = new Comment;
        $comment->comment = $this->comment;
        $comment->author_id = Yii::$app->user->identity->id;
        $comment->bug_id = $bug_id;
        $comment->created_at = date('Y-m-d');
        return $comment->save();
    }
}