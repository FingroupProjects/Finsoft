<?php

namespace Database\Seeders;

use App\Http\Controllers\Api\PositionController;
use App\Models\CashRegister;
use App\Models\Category;
use App\Models\Counterparty;
use App\Models\CounterpartyAgreement;
use App\Models\Currency;
use App\Models\Document;
use App\Models\Employee;
use App\Models\EmployeeStorage;
use App\Models\ExchangeRate;
use App\Models\Good;
use App\Models\Organization;
use App\Models\OrganizationBill;
use App\Models\Position;
use App\Models\PriceType;
use App\Models\Storage;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory(500)->create();
        Employee::factory(500)->create();
        CounterpartyAgreement::factory(500)->create();
        Counterparty::factory(500)->create();
        Currency::factory(500)->create();
        Document::factory(500)->create();
        Good::factory(500)->create();
        Organization::factory(500)->create();
        Position::factory(500)->create();
        PriceType::factory(500)->create();
        Storage::factory(500)->create();
        Unit::factory(500)->create();
        User::factory(500)->create();
        CashRegister::factory(500)->create();
        EmployeeStorage::factory(500)->create();
        ExchangeRate::factory(500)->create();
        OrganizationBill::factory(500)->create();
    }
}
