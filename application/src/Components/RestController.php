<?php
/**
 * This controller helps with basic REST operations.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
class RestController extends BaseController
{
    /**
     * Creates response.
     *
     * @param array $data
     * @param bool  $success
     * @param int   $code
     *
     * @return void
     * @since 0.1.0
     */
    public function emitResponse(
        array $data = array(),
        $success = true,
        $code = 200
    ) {
        header('Content-Type: application/json; charset=utf-8');
        $origin = '*';
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            $origin = $_SERVER['HTTP_ORIGIN'];
        }
        header('Access-Control-Allow-Origin: ' . $origin);
        header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: *');
        if (!$code) {
            $code = $success ? 200 : 400;
        }
        if (function_exists('http_response_code')) {
            http_response_code($code);
        }
        echo json_encode(array('success' => $success, 'data' => $data,));
        /** @type CWebApplication $app */
        $app = Yii::app();
        $app->end();
    }

    /**
     * Emits regular 2xx response.
     *
     * @param array $data Data to send.
     * @param int   $code Response code.
     *
     * @return void
     * @since 0.1.0
     */
    public function emitNormalResponse(array $data = array(), $code = 200)
    {
        $this->emitResponse($data, true, $code);
    }

    /**
     * Emits bad request response.
     *
     * @param array $data Data to send.
     * @param int   $code Response code.
     *
     * @return void
     * @since 0.1.0
     */
    public function emitBadRequestResponse(array $data = array(), $code = 400)
    {
        $this->emitResponse($data, false, $code);
    }

    /**
     * Verifies that all expected parameters are in place.
     *
     * @param array $parameters List of parameters in form of
     *                          [get|post => [names]].
     *
     * @return void
     * @since 0.1.0
     */
    protected function barricade(array $parameters)
    {
        $missingParameters = array();
        $getters = array(
            'post' => 'getPost',
            'get' => 'getQuery',
        );
        foreach (array('post', 'get',) as $source) {
            $missingParameters[$source] = array();
            if (!isset($parameters[$source])) {
                continue;
            }
            foreach ($parameters[$source] as $parameter) {
                $value = call_user_func(
                    array($this->getRequest(), $getters[$source],),
                    $parameter
                );
                if (!$value) {
                    $missingParameters[$source][] = $parameter;
                }
            }
        }
        if ($missingParameters['post'] || $missingParameters['get']) {
            $payload = array('missingParameters' => $missingParameters);
            $this->emitBadRequestResponse($payload);
        }
    }

    /**
     * Emits 'not authorized' response.
     *
     * @return void
     * @since 0.1.0
     */
    protected function emitNotAuthorizedResponse()
    {
        $this->emitBadRequestResponse(array('error' => 'Not authorized',), 401);
    }

    /**
     * Emits 404 response.
     *
     * @return void
     * @since 0.1.0
     */
    protected function emitResourceNotFoundResponse()
    {
        $this->emitBadRequestResponse(array(), 404);
    }

    /**
     * Emits 403 Forbidden response.
     *
     * @return void
     * @since 0.1.0
     */
    protected function emitForbiddenResponse()
    {
        $this->emitBadRequestResponse(array('error' => 'Forbidden',), 403);
    }

    /**
     * Quick filter reimplementation.
     *
     * @param CAction $action Current action.
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @return bool
     * @since 0.1.0
     */
    protected function beforeAction($action)
    {
        if ($this->getRequest()->getRequestType() === 'PUT') {
            parse_str(file_get_contents('php://input'), $_POST);
        }
        if ($this->getUser()->getIsGuest()) {
            foreach ($this->getProtectedActions() as $name) {
                if ($action->id === $name) {
                    $this->emitNotAuthorizedResponse();
                }
            }
        }
        return true;
    }

    /**
     * Lists actions that require authentication.
     *
     * @return string[]
     * @since 0.1.0
     */
    public function getProtectedActions()
    {
        return array();
    }
}
