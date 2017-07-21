<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateUserRoleTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::connection('self')->create('user_role', function (Blueprint $table){
                $table->bigIncrements('id');
                $table->bigInteger('uid')->comment('用户ID');
                $table->bigInteger('rid')->comment('角色ID');
                $table->dateTime('assign_time')->nullable()->comment('分配时间');
                $table->dateTime('cancel_time')->nullable()->comment('取消时间');
                $table->boolean('status')->default(\App\Model\BaseModel::STATUS['enabled'])->comment('状态');
                $table->dateTime('creatime')->nullable()->comment('创建时间');
                $table->dateTime('updatime')->nullable()->comment('更新时间');
                $table->dateTime('deletime')->nullable()->comment('删除时间');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            //
        }
    }
