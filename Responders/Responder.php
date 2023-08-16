<?php

interface Responder {
    public function responseOk($params): Response;
    public function responseValidationError(array $errors);
}