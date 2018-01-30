<?php

namespace SpyCss;

/**
 * Interaction class represent user interaction.
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Interaction
{
    /**
     * Interaction payload will be sent to backend.
     *
     * @var string
     */
    protected $payload;

    /**
     * Css class for interaction.
     *
     * @var string
     */
    protected $cssClass;

    /**
     * Create interaction instance.
     *
     * @param string $payload  Payload for backend.
     * @param string $cssClass Optional, implicit css class.
     */
    public function __construct($payload, $cssClass = '')
    {
        $this->payload = $payload;
        $this->cssClass = $cssClass;
    }

    /**
     * Generate css snippet for interaction.
     *
     * @param  \SpyCss\SpyCss $spyCss
     * @return string         Css string
     */
    public function getSnippet(\SpyCss\SpyCss $spyCss)
    {
        throw new \RuntimeException('not implemented');
    }

    /**
     * Get the interaction payload.
     *
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Set the interaction payload.
     *
     * @param string payload
     * @return self
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
        return $this;
    }

    /**
     * Encode interaction payload from array through *base64 + json*.
     *
     * @param array $payload
     * @return self
     */
    public function setBjPayload(array $payload)
    {
        $this->payload = base64_encode(json_encode($payload));
        return $this;
    }

    /**
     * Decode interaction paylod from *base64 + json*.
     *
     * @throws \RuntimeException
     * @return [type] [description]
     */
    public function getBjPayload()
    {
        $decoded = base64_decode($this->payload);
        if ($decoded === false) {
            throw new \RuntimeException('Base64 invalid: '.$this->payload);
        }
        $data = json_decode($decoded, true);
        $lastError = json_last_error();
        if ($lastError !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Json invalid, json_last_error = '.$lastError);
        }
        return $data;
    }

    /**
     * Get the value of Css class for interaction.
     *
     * @return string
     */
    public function getCssClass()
    {
        return $this->cssClass;
    }

    /**
     * Set the value of Css class for interaction.
     *
     * @param string cssClass
     * @return self
     */
    public function setCssClass($cssClass)
    {
        $this->cssClass = $cssClass;
        return $this;
    }
}
