<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateUserPermissionTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::connection('self')->create('user_permission', function (Blueprint $table){
                $table->bigIncrements('id');
                $table->bigInteger('user_id')->comment('用户ID');
                $table->bigInteger('permission_id')->comment('权限ID');
                $table->dateTime('revoke_time')->nullable()->comment('撤权时间');
                $table->dateTime('grant_time')->nullable()->comment('撤权时间');
                $table->boolean('status')->default(\App\Model\BaseModel::STATUS_ENABLED)->comment('状态');
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
            Schema::dropIfExists('user_permission');
        }
    }
