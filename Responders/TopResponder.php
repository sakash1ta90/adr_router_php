<?php

class TopResponder implements Responder
{
    /**
     * @param $params
     * @return Response
     */
    public function responseOk($params): Response
    {
        return new Response($params);
    }

    /**
     * @param array $errors
     * @return Response
     */
    public function responseValidationError(array $errors): Response
    {
        http_response_code(403);
        return new Response(json_encode([
            'errors' => $errors
        ]));
    }
}