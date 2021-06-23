<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopDatetimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_datetimes', function (Blueprint $table) {
            $table->id()->comment('開催日時ID');
            $table->foreignId('workshop_id')
                ->comment('ワークショップID')
                ->references('id')
                ->on('workshops')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->dateTime('event_date_time', $precision = 0)->comment('開催日時');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshop_datetimes');
    }
}
