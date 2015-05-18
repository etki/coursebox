<?php
/**
 * Application controller handles all application logic.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
class AppController extends RestController
{
    /**
     *
     *
     * @return void
     * @since 0.1.0
     */
    public function actionStatus()
    {
        $data = array(
            'environment' => $this->getEnvironment(),
        );
        $this->emitNormalResponse($data);
    }
}
