<?php

use App\Models\Road;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('roadmap_id');
            $table->unsignedBigInteger('sent_by');
            $table->unsignedBigInteger('sent_to');
            $table->unsignedBigInteger('document_id');
            $table->string('reference');
            $table->string('file')->nullable();
            $table->boolean('is_sent')->default(false);
            $table->dateTime('sent_on')->nullable();
            $table->boolean('is_delivered')->default(false);
            $table->dateTime('delivered_on')->nullable();
            $table->enum('status', [
                Road::Active,
                Road::Inactive,
                Road::Conclude,
            ])->default(Road::Active);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('roads');
            $table->foreign('roadmap_id')->references('id')->on('roadmaps');
            $table->foreign('sent_by')->references('id')->on('assignments');
            $table->foreign('sent_to')->references('id')->on('assignments');
            $table->foreign('document_id')->references('id')->on('documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roads');
    }
};
