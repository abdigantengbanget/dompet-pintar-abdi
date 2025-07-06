<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('saving_goals', function (Blueprint $table) {
            $table->decimal('monthly_income', 12, 2)->after('user_id');
            
          
        });
    }

    public function down(): void
    {
        Schema::table('saving_goals', function (Blueprint $table) {
            $table->dropColumn([
                'monthly_income',
                
              
            ]);
        });
    }
};
