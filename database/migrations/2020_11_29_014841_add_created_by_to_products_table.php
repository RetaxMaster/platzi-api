<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedByToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        $user = User::factory()->create([
            "name" => "Administrador"
        ]);

        Schema::table('products', function (Blueprint $table) use ($user) {
            
            $table->unsignedBigInteger("created_by")->default($user->id);

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn("created_by");
        });
    }
}
