<?php

namespace App\Repositories\Contracts;

use App\DTO\BarcodeDTO;
use App\DTO\LoginDTO;
use App\Models\Barcode;
use App\Models\Good;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

interface BarcodeRepository
{

    public function index(array $data, Good $good) :LengthAwarePaginator;

    public function store(BarcodeDTO $dto) :Barcode;

    public function update(Barcode $barcode, BarcodeDTO $DTO) :Barcode;

    public function delete(Barcode $barcode);
}
