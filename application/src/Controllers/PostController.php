<?php
/**
 * This controller handles all the post-related work.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
class PostController extends RestController
{
    /**
     * Displays post feed.
     *
     * @return void
     * @since 0.1.0
     */
    public function actionIndex()
    {
        $posts = PostModel::model()->findAll();
        $data = array();
        foreach ($posts as $post) {
            $data[] = $post->getAttributes();
        }
        $this->respond($data);
    }

    /**
     * Creates new post.
     *
     * @return void
     * @since 0.1.0
     */
    public function actionNew()
    {
        if (Yii::app()->getUser()->getIsGuest()) {
            $this->respond(array('error' => 'Not authorized'), false);
        }
        $request = Yii::app()->getRequest();
        $parameters = array('title', 'content');
        $missingParameters = array();
        foreach ($parameters as $parameter) {
            $$parameter = $request->getPost($parameter);
            if (!$$parameter) {
                $missingParameters[] = $parameter;
            }
        }
        if ($missingParameters) {
            $this->respond(
                array('error' => 'Missing parameters: ' . implode(', ', $missingParameters)),
                false
            );
        }
        $post = new PostModel();
        $post->title = $title;
        $post->content = $content;
        $post->user_id = Yii::app()->getUser()->getId();
        if (!$post->save()) {
            $this->respond($post->getErrors(), false);
        }
        $this->respond();
    }

    /**
     * Deletes post.
     *
     * @return void
     * @since 0.1.0
     */
    public function actionDelete()
    {

    }

    /**
     * Edits post.
     *
     * @return void
     * @since 0.1.0
     */
    public function actionEdit()
    {

    }

    /**
     * Shows single post.
     *
     * @return void
     * @since 0.1.0
     */
    public function actionSingle()
    {

    }
}
