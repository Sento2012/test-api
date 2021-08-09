<?php

namespace Api\Model;

interface JsonSerializable
{
    public function jsonSerialize(): array;
}
