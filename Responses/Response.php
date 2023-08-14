<?php

class Response
{
    /**
     * @param string $body
     * @param string $contentType
     */
    public function __construct(protected string $body, protected string $contentType = 'Content-type: text/html')
    {
    }

    public function __invoke(): void
    {
        header($this->contentType);
        echo $this->body;
    }
}