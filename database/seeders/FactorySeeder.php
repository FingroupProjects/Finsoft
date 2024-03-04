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
        Category::factory(20000)->create();
        Employee::factory(20000)->create();
        CounterpartyAgreement::factory(20000)->create();
        Counterparty::factory(20000)->create();
        Currency::factory(20000)->create();
        Document::factory(20000)->create();
        Good::factory(20000)->create();
        Organization::factory(20000)->create();
        Position::factory(20000)->create();
        PriceType::factory(20000)->create();
        Storage::factory(20000)->create();
        Unit::factory(20000)->create();
        User::factory(20000)->create();
        CashRegister::factory(20000)->create();
        EmployeeStorage::factory(20000)->create();
        ExchangeRate::factory(20000)->create();
        OrganizationBill::factory(20000)->create();






    }
}
