<?php

class TopAction extends ActionBase
{
    protected array $validations = [
        'val',
    ];

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
     * @param string ...$params
     * @return Response
     */
    public function __invoke(string ...$params): Response
    {
        $errors = $this->validation();
        if (count($errors) > 0) {
            // TODO: エラーレスポンス
            return $this->responder->response(
                $this->domain->get('error')
            );
        }
        $responseMessage = '';
        foreach ($params as $key => $param) {
            $responseMessage .= sprintf('%s:%s', $key, $param);
            if ($key !== array_key_last($params)) {
                $responseMessage .= ',';
            }
        }
        return $this->responder->response(
            $this->domain->get($responseMessage)
        );
    }
}