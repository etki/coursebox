<?php
/**
 * Simple controller for handling all course-related work
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
class CorsController extends RestController
{
    /**
     * Simply returns headers for a preflight request.
     *
     * @return void
     * @since 0.1.0
     */
    public function actionOptions()
    {
        //noop
    }
}
