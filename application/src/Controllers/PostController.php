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
        /** @type PostModel[] $posts */
        $posts = PostModel::model()->findAll();
        $data = array();
        foreach ($posts as $post) {
            $data[] = $post->getAttributes();
        }
        $this->emitNormalResponse($data);
    }

    /**
     * Creates new post.
     *
     * @return void
     * @since 0.1.0
     */
    public function actionCreate()
    {
        $this->barricade(array('post' => array('title', 'content',)));
        $post = new PostModel();
        $post->title = $this->getRequest()->getPost('title');
        $post->content = $this->getRequest()->getPost('content');
        $post->user_id = $this->getUser()->getId();
        if (!$post->save()) {
            $this->emitBadRequestResponse($post->getErrors());
        }
        $this->emitNormalResponse($post->getAttributes());
    }

    /**
     * Deletes post.
     *
     * @SuppressWarnings(PHPMD.ShortVariableName)
     *
     * @return void
     * @since 0.1.0
     */
    public function actionDelete()
    {
        $this->barricade(array('get' => array('id',),));
        $id = $this->getRequest()->getQuery('id');
        /** @type PostModel|null $post */
        $post = PostModel::model()->findByPk($id);
        if (!$post) {
            $this->emitResourceNotFoundResponse();
        }
        if ($post->user->id !== $this->getUser()->getId()) {
            $this->emitNotAuthorizedResponse();
        }
        $post->delete();
        $this->emitNormalResponse();
    }

    /**
     * Edits post.
     *
     * @SuppressWarnings(PHPMD.ShortVariableName)
     *
     * @return void
     * @since 0.1.0
     */
    public function actionUpdate()
    {
        $parameters = array(
            'get' => array('id',),
            'post' => array('title', 'content',),
        );
        $this->barricade($parameters);
        $id = $this->getRequest()->getQuery('id');
        /** @type PostModel|null $post */
        $post = PostModel::model()->findByPk($id);
        if (!$post) {
            $this->emitResourceNotFoundResponse();
        }
        $post->title = $this->getRequest()->getPost('id');
        $post->content = $this->getRequest()->getPost('id');
        $this->emitNormalResponse($post->getAttributes());
    }

    /**
     * Shows single post.
     *
     * @SuppressWarnings(PHPMD.ShortVariableName)
     *
     * @return void
     * @since 0.1.0
     */
    public function actionRead()
    {
        $this->barricade(array('get' => array('id',)));
        $id = $this->getRequest()->getQuery('id');
        /** @type PostModel $post */
        if (!($post = PostModel::model()->findByPk($id))) {
            $this->emitResourceNotFoundResponse();
        }
        $this->emitNormalResponse($post->getAttributes());
    }

    /**
     * Returns list of auth-protected actions.
     *
     * @return string[]
     * @since 0.1.0
     */
    public function getProtectedActions()
    {
        return array('create', 'update', 'delete',);
    }
}
