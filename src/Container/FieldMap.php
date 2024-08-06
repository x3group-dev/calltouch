<?php

namespace X3Group\CallTouch\Container;

class FieldMap extends Container
{
    /**
     * Указание кода свойства хранящий номер телефона
     *
     * @param array $fields
     * @return $this
     */
    public function setPhone(array $fields): self
    {
        $this->set('phone', $fields);
        return $this;
    }

    /**
     * Указание кода свойства хранящий URL страницы отправки заявки.
     *
     * @param array $fields
     * @return $this
     */
    public function setCallUrl(array $fields): self
    {
        $this->set('callUrl', $fields);
        return $this;
    }

    /**
     * Указание кодов хранения дополнительных данных
     *
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields): self
    {
        $this->set('fields', $fields);
        return $this;
    }
}