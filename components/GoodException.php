<?php

namespace app\components;

use yii;
use yii\base\ExitException;

/**
 * ����������, ������� ����� ������������� �������������� �� ������ yii\base\Application
 */
class GoodException extends ExitException
{
    /**
     * �����������
     * @param string $name �������� (������� � �������� �������� ��������)
     * @param string $message ��������� ��������� �� ������
     * @param int $code ��� ������
     * @param int $status ������ ������
     * @param \Exception $previous ���������� ����������
     */
    public function __construct($name, $message = null, $code = 0, $status = 500, \Exception $previous = null)
    {
        # ���������� �����
        $view = yii::$app->getView();
        $response = yii::$app->getResponse();
        $response->data = $view->renderFile('@app/views/exception.php', [
            'name' => $name,
            'message' => $message,
        ]);

        # ��������� ������ ������ (��-��������� ������� 500-�)
        $response->setStatusCode($status);

        parent::__construct($status, $message, $code, $previous);
    }
}