<?php
/**
 *
 *
 * @version 0.1.0
 * @since   
 * @package 
 * @author  Etki <etki@etki.name>
 */
class RestController extends BaseController
{
    public function respond(
        array $data = array(),
        $success = true,
        $code = null
    ) {
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        if (!$code) {
            $code = $success ? 200 : 400;
        }
        if (function_exists('http_response_code')) {
            http_response_code($code);
        }
        echo json_encode(array('success' => $success, 'data' => $data,));
        Yii::app()->end();
    }
}
