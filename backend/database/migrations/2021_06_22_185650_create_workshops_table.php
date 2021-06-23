<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->id()->comment('ワークショップID');
            $table->foreignId('host_user_id')
                ->comment('開催者ID')
                ->references('id')
                ->on('users')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title')->comment('タイトル');
            $table->string('venue')->comment('開催地');
            $table->text('description')->comment('説明文')->nullable();
            $table->text('caution')->comment('注意・警告事項')->nullable();
            $table->dateTime('cancellation_deadline', $precision = 0)->comment('キャンセル期限');
            $table->unsignedSmallInteger('min_participants')->comment('最少催行人数');
            $table->string('case_of_rain')->comment('雨天時の開催');
            $table->unsignedDecimal('participation_fee', $precision = 12, $scale = 2)->default(0)->comment('参加費');
            $table->char('status', 2)->default('10')->comment('ステータス（10:未公開、20:公開、30:開催中止、90:開催完了）');
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
        Schema::dropIfExists('workshops');
    }
}
