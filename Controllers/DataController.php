<?php

class DataController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST['data'];

            $this->model->saveData($data);

            $savedData = $this->model->getData();

            $this->sendEmail($savedData);

            $this->sendSMS($savedData);

            $this->viewData($savedData);
        } else {
            include '../View/AddDataView.php';
        }
    }

    private function sendEmail($data)
    {}

    private function sendSMS($data)
    {}

    private function viewData($data)
    {
        echo nl2br(htmlspecialchars($data));
    }
}