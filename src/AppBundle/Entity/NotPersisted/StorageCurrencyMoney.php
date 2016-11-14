<?php


namespace AppBundle\Entity\NotPersisted;


use AppBundle\Entity\Currency;

class StorageCurrencyMoney implements \Iterator
{
    /** @var Money[] */
    private $storageAmounts = [];
    private $position = 0;

    public function getStorageAmounts()
    {
        return $this->storageAmounts;
    }

    public function sumMoney($amount, Currency $currency)
    {
        if (!$this->hashKey($currency->getId()))
            $this->storageAmounts[$currency->getId()] = new Money($amount, $currency);
        else
            $this->storageAmounts[$currency->getId()]->sumAmount($amount);
    }

    public function sumExtraData($currencyId, $idExtraData, $amount)
    {
        if (!isset($this->storageAmounts[$currencyId]->extraData[$idExtraData]))
            $this->storageAmounts[$currencyId]->extraData[$idExtraData] = 0;

        $this->storageAmounts[$currencyId]->extraData[$idExtraData]+= $amount;
    }

    public function pushUniqueExtraData($currencyId, $idExtraData, $value)
    {
        if (!isset($this->storageAmounts[$currencyId]->extraData[$idExtraData]))
            $this->storageAmounts[$currencyId]->extraData[$idExtraData] = [];

        if (!in_array($value, $this->storageAmounts[$currencyId]->extraData[$idExtraData]))
            $this->storageAmounts[$currencyId]->extraData[$idExtraData] []= $value;
    }




    // Functions to use with foreach or something like that

    public function rewind() {
        $this->position = 0;
    }

    /**
     * @param $index
     * @return null|money
     */
    private function getKeyByIndex($index)
    {
        $newArray = array_keys($this->storageAmounts);
        if (!isset($newArray[$index]))
            return null;

        return $newArray[$index];
    }

    /**
     * @param $index
     * @return Money
     */
    private function getByIndex($index)
    {
        return $this->storageAmounts[$this->getKeyByIndex($index)];
    }

    /**
     * @return Money|mixed
     */
    public function current()
    {
        return $this->getByIndex($this->position);
    }

    public function key()
    {
        return $this->getKeyByIndex($this->position);
    }

    public function next() {
        ++$this->position;
    }

    public function valid()
    {
        $key = $this->getKeyByIndex($this->position);

        if ($key === null)
            return false;

        return $this->hashKey($this->getKeyByIndex($this->position));
    }

    public function hashKey($key)
    {
        return isset($this->storageAmounts[$key]);
    }

} 