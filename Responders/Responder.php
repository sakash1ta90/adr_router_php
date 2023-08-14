<?php

interface Responder {
    public function response($params): Response;
}