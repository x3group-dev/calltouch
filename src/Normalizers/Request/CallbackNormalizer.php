<?php

namespace X3Group\CallTouch\Normalizers\Request;

use X3Group\CallTouch\DTO\RequestData;
use X3Group\CallTouch\Helpers\CheckerHelper;
use X3Group\CallTouch\Normalizers\NormalizerInterface;
use X3Group\CallTouch\Exceptions\NotImplementedException;

/**
 * Создание тела запроса, для callback запроса.
 *
 * @link https://www.calltouch.ru/support/servernoe-callback-api/
 * @author Daniil S.
 */
class CallbackNormalizer implements NormalizerInterface
{
    /**
     * @param RequestData $data
     * @return string
     * @throws NotImplementedException
     */
    public function normalize(mixed $data): string
    {
        CheckerHelper::implemented($data, RequestData::class);

        $fields = [
            'routeKey' => $data->routeKey,
            'phone' => $data->phone,
            'fields' => $data->fields,
            'sessionId' => $data->session,
            'utmSource' => $data->utmSource,
            'utmMedium' => $data->utmMedium,
            'utmCampaign' => $data->utmCampaign,
            'utmContent' => $data->utmContent,
            'utmTerm' => $data->utmTerm,
            'callUrl' => $data->url,
            'tags' => $data->tags
        ];

        return json_encode(array_filter($fields)) ?: '';
    }
}