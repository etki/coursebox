<?php

namespace Etki\Coursebox\Tests\Support;

/**
 * API helper.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Codeception\Module
 * @author  Etki <etki@etki.name>
 */
class Api
{
    /**
     * API route prefix.
     *
     * @since 0.1.0
     */
    const API_ROUTE_PREFIX = '/api/v1';
    /**
     * Auth API endpoint.
     *
     * @since 0.1.0
     */
    const ENDPOINT_AUTH = 'auth';
    /**
     * User API endpoint.
     *
     * @since 0.1.0
     */
    const ENDPOINT_USER = 'user';
    /**
     * Post API endpoint.
     *
     * @since 0.1.0
     */
    const ENDPOINT_POST = 'post';

    /**
     * Retrieves particular route.
     *
     * @param string   $endpoint   API endpoint.
     * @param string[] $parameters URL parameters.
     *
     * @return string
     * @since 0.1.0
     */
    public static function getRoute($endpoint, array $parameters = null)
    {
        $chunks = array(self::API_ROUTE_PREFIX, $endpoint);
        if ($parameters) {
            foreach ($parameters as $key => $value) {
                if (!is_int($key)) {
                    $chunks[] = $key;
                }
                $chunks[] = $value;
            }
        }
        return implode('/', $chunks);
    }
}
