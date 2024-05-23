<?php

abstract class ActionBase
{
    protected array $validations;

    /**
     * @return array
     */
    protected function validation(): array
    {
        $errors = [];
        foreach ($this->validations as $key => $validationRule) {
            $param = filter_input(INPUT_GET, $key);
            if(!str_contains($validationRule,'nullable')) {
                if (false === $param || null === $param) {
                    $errors[] = $key;
                }
            }
        }
        return $errors;
    }
}