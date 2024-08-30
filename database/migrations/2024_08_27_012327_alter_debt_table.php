<?php

use App\Models\DebtStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('debts', function (Blueprint $table) {
            DB::statement(
                'ALTER TABLE debts ALTER COLUMN status_id TYPE bigint USING (status_id)::integer'
            );

            $table->foreignIdFor(DebtStatus::class, 'status_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
