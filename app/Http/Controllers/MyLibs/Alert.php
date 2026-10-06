<?php

namespace App\Http\Controllers\MyLibs;

class Alert
{
    public function success($message, $title = "")
    {
        $data = [
            'notif' => 'alert',
            'title' => $title,
            'icon' => 'success',
            'message' => $message,
        ];

        return $data;
    }

    public function warning($message, $title = "")
    {
        $data = [
            'notif' => 'alert',
            'title' => $title,
            'icon' => 'warning',
            'message' => $message,
        ];

        return $data;
    }

    public function error($message, $title = "")
    {
        $data = [
            'notif' => 'alert',
            'title' => $title,
            'icon' => 'error',
            'message' => $message,
        ];

        return $data;
    }

    public function info($message, $title = "")
    {
        $data = [
            'notif' => 'alert',
            'title' => $title,
            'icon' => 'info',
            'message' => $message,
        ];

        return $data;
    }
}
