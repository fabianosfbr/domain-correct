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
        create or replace function max(uuid, uuid) returns uuid immutable parallel safe language plpgsql as $$ begin return greatest($1, $2); end $$;
        ");

        DB::statement("
        create or replace aggregate max(uuid) ( sfunc = max, stype = uuid, combinefunc = max, parallel = safe, sortop = operator (>));
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            drop aggregate max(uuid)
        ");

        DB::statement("
            drop function max(uuid, uuid)
        ");
    }
};
