<?php declare(strict_types=1);

namespace Database\Seeders;

use App;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    protected function clearTables() : void
    {
        $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        Schema::disableForeignKeyConstraints();
        foreach ($tableNames as $name) {
            if ($name !== 'migrations')
                DB::table($name)->truncate();
        }
        Schema::enableForeignKeyConstraints();
    }

    public function run()
    {
        if (!App::isProduction()) {
            $this->clearTables();
            app(FixtureSeeder::class)->run();
        }
    }
}
