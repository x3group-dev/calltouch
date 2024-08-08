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
        return $this->set('phone', $fields);
    }

    /**
     * Указание кода свойства хранящий URL страницы отправки заявки.
     *
     * @param array $fields
     * @return $this
     */
    public function setCallUrl(array $fields): self
    {
        return $this->set('callUrl', $fields);
    }

    /**
     * Указание кодов хранения дополнительных данных
     *
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields): self
    {
        return $this->set('fields', $fields);
    }

    /**
     * Указание кодов хранения тегов заявки
     *
     * @param array $tags
     * @return self
     * @author Daniil S.
     */
    public function setTags(array $tags): self
    {
        return $this->set('tags', $tags);
    }
}