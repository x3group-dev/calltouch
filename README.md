<h1>Интеграция с сервисом CallTouch</h1>

<a href="https://my.calltouch.ru/user/registration/?ref=x3group.ru">Ссылка на сервис</a>

<h2>Установка</h2>

``
composer require x3group-dev/calltouch
``

<h2>Отслеживание UTM-меток</h2>
Для корректной интеграции с CallTouch необходимо подключить сбор UTM-меток посетителя

```injectablephp
use X3Group\CallTouch\Conversion\Utm;

Utm::search();
```

<h2>Отслеживание активных аккаунтов</h2>
В любой части сайта необходимо разместить js скрипт поиска активных кабинетов CallTouch

```injectablephp
use X3Group\CallTouch\Helpers\RenderHelper;

RenderHelper::showTrackingParameters();
```

<h2>Карта соответствия свойств</h2>
Точка взаимодействия с CallTouch является общей, для всех методов.
Необходимо построить карту соответствий, которая привязывает ключи значений запроса с внутренними механизма обработки.
Допускается множественное указание, если более 1 ключа совпало, то произойдет выбор случайного значения.

```injectablephp
use X3Group\CallTouch\Container\FieldMap;

$map = new FieldMap();
$map->setPhone(['USER_PHONE']);
$map->setCallUrl(['NOW_PAGE']);
```

<h2>Создание отчета</h2>
Предоставляется возможность указания произвольных механизмов формирования отчета о результате взаимодействия с CallTouch.
Отчет отправляется вне зависимости от результата работы.

Генератор отчета должен реализовывать интерфейс <b>X3Group\CallTouch\Reporters\ReportedInterface</b>

Пример собственного генератора отчета

```injectablephp
use Throwable;

use X3Group\CallTouch\Result\ResultInterface;
use X3Group\CallTouch\Helpers\ExceptionHelper;
use X3Group\CallTouch\Reporters\ReportedInterface;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

class EmailReporter implements ReportedInterface
{    
    private ?ResponseInterface $response = null;
    private ?RequestInterface $request = null;
    private ?ResultInterface $result = null;
    
    public function report(): void
    {
        if (null === $this->response) {
            return;
        }
    
        $responseBody = $this->response->getBody();
        $responseBody->rewind();
        
        $message = $responseBody->getContents() ?: 'Unknown error';
    
        mail('test@mail.ru', 'Subject', $message);
    }
    
    public function setResponse(ResponseInterface $response): self
    {
        $this->response = $response;
        return $this;
    }
    
    public function setRequest(RequestInterface $request): self
    {
        $this->request = $request;
        return $this;
    }
    
    public function setResultValidate(ResultInterface $result): self
    {
        $this->result = $result;
        return $this; 
    }
}

```

<h2>Инициализация и отправка запроса</h2>
Для создания метода отправки заявок в CallTouch рекомендуется пользоваться сборщиком.

Необходимо указать токен доступа - благодаря которому происходит защищенное общение с API.
Вторым параметром указываем какой метод отправки заявки нам необходим.

```injectablephp
use X3Group\CallTouch\MethodsEnum;
use X3Group\CallTouch\Builder\MethodBuilder;

$token = 'your access token...';

$builder = new MethodBuilder($token, MethodsEnum::CallBack);
$callTouch = $builder->make();
```

Пример отправки заявки на <a href="https://www.calltouch.ru/support/servernoe-callback-api/">обратный звонок</a>

```injectablephp
use X3Group\CallTouch\Builder\CallbackBuilder;

$routeKey = "myKey";
$token = 'your access token...';

$formData = [
    'USER_PHONE' => '79099999999',
    'NAME' => "Игорь",
    'EMAIL' => "test@mail.ru",
    'NOW_PAGE' => 'http://test.ru',
];

$builder = new CallbackBuilder($token);
$builder->getFieldMap()
    ->setPhone(['USER_PHONE', 'PERSONAL_PHONE'])
    ->setCallUrl(['NOW_PAGE'])
    ->setFields([
        'NAME',
        'EMAIL',
        'NOW_PAGE'
    ]);

$builder->setRouteKey($routeKey)
    ->addReporter(new EmailReporter)
    ->make()
    ->send($formData);
```

Если мы имеем несколько кабинетов CallTouch, то необходимо в явном виде передать желаемый кабинет.
Если будет указан несуществующий кабинет, то произойдет отправка заявки без указания сессии.

```injectablephp
$callTouch->setModelID('your model_id ...');
```
