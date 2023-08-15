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
        foreach ($this->validations as $validation) {
            $param = filter_input(INPUT_GET, $validation);
            if (false === $param || null === $param) {
                $errors[] = $validation;
            }
        }
        return $errors;
    }
}