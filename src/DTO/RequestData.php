<?php

namespace X3Group\CallTouch\DTO;

/**
 * Данные, для отправки в CallTouch
 *
 * Производит хранение сырых данных до преобразования под стандарты метода отправки.
 *
 * @internal Используется при отправке заявки
 * @author Daniil S.
 */
class RequestData
{
    /**
     * ID кабинета, которому относится заявка.
     *
     * @var string
     */
    public string $modelID = '';

    /**
     * Номер телефона получателя
     *
     * @var string
     */
    public string $phone = '';

    /**
     * Сессия пользователя в рамках кабинета
     *
     * @var string
     */
    public string $session = '';

    /**
     * URL страницы с которого произведен запрос.
     *
     * @var string
     */
    public string $url = '';

    /**
     * Ключ виджета
     *
     * @var string
     */
    public string $routeKey = '';

    /**
     * Список пользовательских полей
     *
     * Хранит в формате название => значение
     *
     * @var array
     */
    public array $fields = [];

    public string $utmSource = '';
    public string $utmMedium = '';
    public string $utmCampaign = '';
    public string $utmTerm = '';
    public string $utmContent = '';

    /**
     * Добавить новое свойство
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public function addField(string $key, string $value): void
    {
        $this->fields[$key] = $value;
    }
}