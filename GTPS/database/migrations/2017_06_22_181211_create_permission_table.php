<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreatePermissionTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::connection('self')->create('permission', function (Blueprint $table){
                $table->bigIncrements('id');
                $table->string('code', 64)->unique()->comment('权限码');
                $table->string('name', 50)->comment('名称');
                $table->string('name_pinyin', 50)->nullable()->comment('名称拼音码');
                $table->bigInteger('parent_id')->default(\App\Model\System\Permission::PARENT_ROOT_ID)->comment('父级权限');
                $table->dateTime('creatime')->nullable()->comment('创建时间');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('permission');
        }
    }
