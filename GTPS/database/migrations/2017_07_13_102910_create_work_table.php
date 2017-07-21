<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateWorkTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::connection('self')->create('work', function (Blueprint $table){
                $table->bigIncrements('id');
                $table->bigInteger('workflow_data_id')->comment('工作流ID');
                $table->bigInteger('user_id')->comment('用户ID');
                $table->boolean('process_status')->comment('工作状态');
                $table->dateTime('creatime')->nullable()->comment('创建时间');
                $table->dateTime('updatime')->nullable()->comment('更新时间');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('work');
        }
    }
