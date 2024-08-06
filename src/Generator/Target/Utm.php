<?php

namespace X3Group\CallTouch\Generator\Target;

use X3Group\CallTouch\DTO\RequestData;
use X3Group\CallTouch\Cookie\UtmCookie;
use X3Group\CallTouch\Generator\GeneratorInterface;

/**
 * Производит прикрепление UTM меток к запросу
 *
 * @internal Используется перед отправкой заявки в CallTouch
 * @author Daniiol S.
 */
class Utm implements GeneratorInterface
{
    /**
     * Генерация данных
     *
     * @param RequestData $storage
     * @param array $data
     * @return void
     */
    public function generate(RequestData $storage, array $data): void
    {
        $utmList = (new UtmCookie)->get();

        foreach ($utmList as $utm => $value) {
            switch ($utm) {
                case 'utm_source':
                    $storage->utmSource = $value;
                    break;
                case 'utm_medium':
                    $storage->utmMedium = $value;
                    break;
                case 'utm_campaign':
                    $storage->utmCampaign = $value;
                    break;
                case 'utm_term':
                    $storage->utmTerm = $value;
                    break;
                case 'utm_content':
                    $storage->utmContent = $value;
                    break;
            }
        }
    }
}