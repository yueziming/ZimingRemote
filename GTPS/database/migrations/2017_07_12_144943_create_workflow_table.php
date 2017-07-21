<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateWorkflowTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::connection('self')->create('workflow', function (Blueprint $table){
                $table->bigIncrements('id');
                $table->bigInteger('client_id')->comment('客户ID');
                $table->string('node', 50)->comment('流程节点名称');
                $table->boolean('process_status')->comment('流程状态');
                $table->string('route_uri', 100)->comment('页面路由');
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
            Schema::dropIfExists('workflow');
        }
    }
