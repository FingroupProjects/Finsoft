<?php

namespace App\Repositories\Contracts;

use App\DTO\CashRegisterDTO;
use App\Models\CashRegister;
use Illuminate\Support\Collection;

interface CashRegisterRepositoryInterface {

    public function index() :Collection;

    public function store(CashRegisterDTO $DTO);

    public function update(CashRegister $cashRegister, CashRegisterDTO $DTO) :CashRegister;
}
