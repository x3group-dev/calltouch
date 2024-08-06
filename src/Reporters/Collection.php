<?php

namespace X3Group\CallTouch\Reporters;

/**
 * Включает в себя N-количество отчетов.
 * @author Daniil S.
 */
class Collection extends AbstractReporter
{
    protected array $reporters = [];

    public function report(): void
    {
        array_walk($this->reporters, [$this, 'send']);
    }

    /**
     * Добавление механизма создания отчета
     *
     * @param ReportedInterface $reporter
     * @return void
     */
    public function add(ReportedInterface $reporter): void
    {
        $this->reporters[spl_object_id($reporter)] = $reporter;
    }

    /**
     * Сформировать и отправить отчет
     *
     * @param ReportedInterface $reporter
     * @return void
     */
    private function send(ReportedInterface $reporter): void
    {
        $reporter->setRequest($this->request)
            ->setResponse($this->response)
            ->setResultValidate($this->result);

        $reporter->report();
    }
}