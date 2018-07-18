<?php defined('BASEPATH') OR exit('No direct script access allowed');

    if (!function_exists('response'))
    {
        function response($data, $type = null)
        {
            switch($type) {
                case 'json':
                    $contentType = 'application/json';
                    $data = json_encode($data, JSON_PRETTY_PRINT);
                break;

                case 'html':
                    $contentType = 'text/html';
                break;

                default:
                    $contentType = 'application/json';
                    $data = json_encode($data, JSON_PRETTY_PRINT);
                break;
            }

            $CI = get_instance();

            $CI->output
                ->set_content_type($contentType)
                ->set_status_header(200)
                ->set_output($data)
                ->_display();

            exit;
        }
    }