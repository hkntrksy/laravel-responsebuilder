<?php

namespace Turksoy\ResponseBuilder;

use Illuminate\Support\Facades\Lang;

class ResponseMessenger
{

    private $errors             = [];
    private $warnings           = [];
    private $successes          = [];
    private $validation_errors  = [];

    /**
     * @param $messageKey
     * @param $paramArray
     * @return mixed
     */
    private function getMessage($messageKey,$paramArray)
    {

        if(!is_array($messageKey) AND Lang::has($messageKey)){
            return is_null($paramArray) ? Lang::get($messageKey) : Lang::get($messageKey,$paramArray);
        }

        return $messageKey;
    }

    /**
     * @param $messageKey
     * @param $paramArray
     */
    public function addError($messageKey,$paramArray)
    {
        $this->errors[] = $this->getMessage($messageKey,$paramArray);
    }

    /**
     * @param $messageKey
     * @param $paramArray
     */
    public function addValidationErrors($messageKey,$paramArray)
    {
        $this->validation_errors = $this->getMessage($messageKey,$paramArray);
    }


    /**
     * @param $messageKey
     * @param $paramArray
     */
    public function addWarning($messageKey,$paramArray)
    {
        $this->warnings[] = $this->getMessage($messageKey,$paramArray);
    }

    /**
     * @param $messageKey
     * @param $paramArray
     */
    public function addSuccess($messageKey,$paramArray)
    {
        $this->successes[] = $this->getMessage($messageKey,$paramArray);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getValidationErrors()
    {
        return $this->validation_errors;
    }

    /**
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @return array
     */
    public function getSuccesses()
    {
        return $this->successes;
    }
}
