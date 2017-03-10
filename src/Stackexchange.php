<?php

namespace shamanzpua\yii2stackexchange;

use Yii;
use yii\base\Component;
use yii\base\InvalidParamException;

/**
 * Class for stackoverflow data grab
 */
class Stackexchange extends Component
{

    
    /**
     * @var array apis
     */
    private $apis = [];
    
    /**
     * @var array apis
     */
    private $apiKey;


    /**
     * @param string api key
     */
    public function setApiKey($value)
    {
        $this->apiKey = $value;
    }
    
    /**
     * @param string api key
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }
    
    /**
     * @param array $apis list apies
     */
    public function setApis(array $apis)
    {
        $this->apis = $apis;
    }

    /**
     * @return StackexchangeInterface[] list of stackexchange apies.
     */
    public function getApis()
    {
        $apis = [];
        foreach ($this->apis as $id => $api) {
            $apis[$id] = $this->getApi($id);
        }

        return $apis;
    }

    /**
     * @param string $id api id.
     * @return StackexchangeInterface api class grabber instance.
     * @throws InvalidParamException on non existing api class grubber.
     */
    public function getApi($id)
    {
        if (!array_key_exists($id, $this->apis)) {
            throw new InvalidParamException("Unknown api grabber '{$id}'.");
        }
        if (!is_object($this->apis[$id])) {
            $this->apis[$id] = $this->createApi($id, $this->apis[$id]);
        }

        return $this->apis[$id];
    }

    /**
     * Checks if api grabber exists in the hub.
     * @param string $id
     * @return boolean whether api class grubber exist.
     */
    public function hasApi($id)
    {
        return array_key_exists($id, $this->apis);
    }

    /**
     * @param string $id
     * @param array $config
     * @return StackexchangeInterface
     */
    protected function createApi($id, $config)
    {
        $config['id'] = $id;

        return Yii::createObject($config, [$this->getApiKey()]);
    }
}
