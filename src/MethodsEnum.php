<?php

namespace X3Group\CallTouch;

/**
 * Список поддерживаемых методов отправки заявки в CallTouch
 * @author Daniil S.
 */
enum MethodsEnum: string
{
    /**
     * Отправка заявки типом CallBack
     * @link https://www.calltouch.ru/support/servernoe-callback-api/
     */
    case CallBack = 'callback';
}