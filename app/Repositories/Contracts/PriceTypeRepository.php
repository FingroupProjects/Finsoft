<?php

namespace App\Repositories\Contracts;

use App\DTO\PriceTypeDTO;
use App\Models\PriceType;
use Illuminate\Http\JsonResponse;

interface PriceTypeRepository {

    public function store(PriceTypeDTO $DTO);

    public function update(PriceType $priceType, PriceTypeDTO $DTO) :PriceType;
}
