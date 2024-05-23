<?php

class TopAction extends ActionBase
{
    // TODO: バリデーションルールを設定できるようにする
    protected array $validations = [
        'val' => 'nullable',
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
            return $this->responder->responseValidationError($errors);
        }
        $responseMessage = '';
        foreach ($params as $key => $param) {
            $responseMessage .= sprintf('%s:%s', $key, $param);
            if ($key !== array_key_last($params)) {
                $responseMessage .= ',';
            }
        }
        return $this->responder->responseOk(
            $this->domain->get($responseMessage)
        );
    }
}