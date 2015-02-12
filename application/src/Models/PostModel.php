<?php
/**
 * Post model.
 *
 * @property int    $id
 * @property string $title
 * @property string $content
 * @property User   $user
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
class PostModel extends BaseModel
{
    /**
     * Returns corresponding table name.
     *
     * @codeCoverageIgnore
     *
     * @return string
     * @since 0.1.0
     */
    public function tableName()
    {
        return 'posts';
    }

    /**
     * Specifies relations.
     *
     * @codeCoverageIgnore
     *
     * @return array
     * @since 0.1.0
     */
    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id',),
        );
    }

    /**
     * Returns attribute labels.
     *
     * @codeCoverageIgnore
     *
     * @return string[]
     * @since 0.1.0
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Название',
            'content' => 'Текст',
        );
    }
}
