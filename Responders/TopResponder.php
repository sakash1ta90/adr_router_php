<?php

class TopResponder implements Responder
{
    /**
     * @param $params
     * @return Response
     */
    public function response($params): Response
    {
        return new Response($params);
    }
}