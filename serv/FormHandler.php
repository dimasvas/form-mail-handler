<?php

class FormHandler {

    /**
     * @var array
     */
    private $files = [];

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var array
     */
    private $fields = [];

    /**
     * formHandler constructor.
     * @param $rawPost
     * @param $files
     * @param $dataFields
     */
    public function __construct($rawPost, $files, $dataFields)
    {
        $this->fields = $dataFields;
        $this->data = $this->handleData($rawPost);
        $this->files = $this->handleFiles();
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param $rawPost
     * @return array
     */
    protected function handleData($rawPost)
    {
        $result = [];

        foreach ($this->fields as $key => $value) {
            if(array_key_exists($key, $rawPost)) {
                $result[$key] = $this->validate($key, $rawPost[$key]);
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    protected function handleFiles()
    {
        $result = [];

        return $result;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    private function validate($key, $value)
    {
        $filer = $key != 'email' ? FILTER_SANITIZE_STRING : FILTER_SANITIZE_EMAIL;

        return filter_var($value, $filer);
    }
}


