<?php

class TopAction
{
    /**
     * @param Domain $domain
     * @param Responder $responder
     */
    public function __construct(
        protected Domain    $domain,
        protected Responder $responder
    )
    {
    }

    /**
     * @param string $val
     * @return Response
     */
    public function __invoke(string $val = ''): Response
    {
        return $this->responder->response(
            $this->domain->get($val)
        );
    }
}