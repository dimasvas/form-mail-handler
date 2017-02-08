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
     * FormHandler constructor.
     * @param $dataFields
     */
    public function __construct($dataFields)
    {
        $this->fields = $dataFields;
        $this->data = $this->handleData($_POST);
        $this->files = $this->handleFiles($_FILES);
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
     * @param $rawFiles
     * @return array
     */
    protected function handleFiles($rawFiles)
    {
        $result = [];

        if(array_key_exists('userfile', $rawFiles)) {
            $files = $rawFiles['userfile'];

            foreach ($files['error'] as $key => $error) {
                if($error === 0) {
                    $result[] = [
                        'name' => $files['name'][$key],
                        'type' => $files['type'][$key],
                        'tmp_name' => $files['tmp_name'][$key],
                        'size' => $files['size'][$key],
                    ];
                }
            }
        }

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


