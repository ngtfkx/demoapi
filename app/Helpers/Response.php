<?php

if (!function_exists('api_success')) {
    /**
     * Формирование успешного ответа
     *
     * @param array $data Передаваемые данные
     * @param int $responseServerCode Код ответа сервера
     * @return \Illuminate\Http\JsonResponse
     */
    function api_success($data = [], $responseServerCode = 200)
    {
        if (!array_key_exists('status', $data)) {
            $data['status'] = 'success';
        }

        return Response::json(
            $data,
            $responseServerCode,
            ['Content-type' => 'application/json; charset=utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
}

if (!function_exists('api_error')) {
    /**
     * Формирование успешного ответа
     *
     * @param array $data Передаваемые данные
     * @param int $responseServerCode Код ответа сервера
     * @return \Illuminate\Http\JsonResponse
     */
    function api_error($data, $responseServerCode = 200)
    {
        if (!array_key_exists('status', $data)) {
            $data['status'] = 'error';
        }

        return Response::json(
            $data,
            $responseServerCode,
            ['Content-type' => 'application/json; charset=utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
}