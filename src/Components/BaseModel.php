<?php
/**
 * Model interlayer.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
abstract class BaseModel extends CActiveRecord
{
    /**
     * Returns model instance.
     *
     * @param string $class Model class name.
     *
     * @codeCoverageIgnore
     *
     * @return static
     * @since 0.1.0
     */
    public static function model($class = __CLASS__)
    {
        return parent::model($class);
    }
}
