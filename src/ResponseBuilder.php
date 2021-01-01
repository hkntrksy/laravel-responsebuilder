<?php

namespace Turksoy\ResponseBuilder;

use Turksoy\ResponseBuilder\ResponseMessenger;
use Turksoy\ResponseBuilder\ResponseStatus;

class ResponseBuilder
{
    private $data   = null;
    private $custom = null;

    private $pagination = [
        'page'          => '',
        'pageCount'     => '',
        'limit'         => '',
        'total'         => ''
    ];

    private $messenger;

    /**
     * ResponseBuilder constructor.
     */
    public function __construct()
    {
        $this->messenger = new ResponseMessenger();
    }

    /**
     * @param array $pagination
     * @return $this
     */
    public function pagination($pagination)
    {
        $this->pagination = $pagination;

        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function result($key, $value = null)
    {
        if (!is_array($this->data)) {
            $this->data = array();
        }

        if (is_array($key)) {
            $this->data = $key;
        }else{
            $this->data[$key] = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function clearPayload()
    {
        $this->data = [];
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return ResponseService
     */
    public function custom($key, $value)
    {
        if (!is_array($this->custom)) {
            $this->custom = array();
        }

        $this->custom[$key] = $value;

        return $this;
    }

    /**
     * @param $statusKey
     * @param $messageKey
     * @param $paramArray
     * @return $this
     */
    public function message($statusKey, $messageKey, $paramArray = null)
    {
        switch ($statusKey) {
            case 'success':
                $this->messenger->addSuccess($messageKey, $paramArray);
                break;

            case 'warning':
                $this->messenger->addWarning($messageKey, $paramArray);
                break;

            case 'error':
                $this->messenger->addError($messageKey, $paramArray);
                break;

            case 'validation_error':
                $this->messenger->addValidationErrors($messageKey, $paramArray);
                break;
        }

        return $this;
    }

    /**
     * @return array
     */
    private function getResponse()
    {
        $response = [
            'meta' => [
                'messages' => [
                    'success'           => $this->messenger->getSuccesses(),
                    'warning'           => $this->messenger->getWarnings(),
                    'error'             => $this->messenger->getErrors(),
                    'validation_error'  => $this->messenger->getValidationErrors()
                ]
            ],
            'payload' => $this->data
        ];

        if ($this->pagination['page']) {
            $response['pagination'] = $this->pagination;
        }

        if ($this->custom) {
            foreach ($this->custom as $key => $item) {
                $response[$key] = $item;
            }
        }

        return $response;
    }


    /**
     * @param $responseStatus
     * @return JsonResponse
     */
    public function get($responseStatus)
    {
        return response()->json($this->getResponse(), $responseStatus);
    }

    /**
     * @return JsonResponse
     */
    public function ok()
    {
        return response()->json($this->getResponse(), ResponseStatus::OK);
    }

    /**
     * @return JsonResponse
     */
    public function badRequest()
    {
        return response()->json($this->getResponse(), ResponseStatus::BAD_REQUEST);
    }

    /**
     * @return JsonResponse
     */
    public function internalServerError()
    {
        return response()->json($this->getResponse(), ResponseStatus::INTERNAL_SERVER_ERROR);
    }

    /**
     * @return JsonResponse
     */
    public function unauthorized()
    {
        return response()->json($this->getResponse(), ResponseStatus::UNAUTHORIZED);
    }

    /**
     * @return JsonResponse
     */
    public function notFound()
    {
        return response()->json($this->getResponse(), ResponseStatus::NOT_FOUND);
    }

    /**
     * @return JsonResponse
     */
    public function validationFail()
    {
        return response()->json($this->getResponse(), ResponseStatus::UNPROCESSABLE_ENTITY);
    }

    /**
     * @return JsonResponse
     */
    public function created()
    {
        return response()->json($this->getResponse(), ResponseStatus::CREATED);
    }

    /**
     * @return JsonResponse
     */
    public function noContent()
    {
        return response()->json($this->getResponse(), ResponseStatus::NO_CONTENT);
    }

}
