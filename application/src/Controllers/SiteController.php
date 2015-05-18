<?php
/**
 * This controller runs site-wide actions.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
class SiteController extends BaseController
{
    /**
     * Prints out short documentation.
     *
     * @return void
     * @since 0.1.0
     */
    public function actionIndex()
    {
        $this->render('index');
    }
}
