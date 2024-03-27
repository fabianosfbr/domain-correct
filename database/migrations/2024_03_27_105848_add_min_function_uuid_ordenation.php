<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        DB::statement("
            create or replace function min(uuid, uuid) returns uuid immutable parallel safe language plpgsql as $$ begin return least($1, $2); end $$;
        ");

        DB::statement("
            create or replace aggregate min(uuid) (sfunc = min, stype = uuid, combinefunc = min, parallel = safe, sortop = operator (<));
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            drop aggregate min(uuid)
        ");

        DB::statement("
            drop function min(uuid, uuid)
        ");


    }
};
