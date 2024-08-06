<?php

namespace X3Group\CallTouch\Helpers;

class RenderHelper
{
    /**
     * Вывод механизма регистрации доступных кабинетов CallTouch
     * @return void
     */
    public static function showTrackingParameters(): void
    {
        $cookieKey = CookieHelper::generateKeyByModelID('');
        require dirname(__DIR__) . '/Views/Tracking/Parameters.php';
    }
}