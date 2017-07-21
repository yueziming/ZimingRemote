<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateRoleTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::connection('self')->create('role', function (Blueprint $table){
                $table->bigIncrements('id');
                $table->string('name', 50)->comment('名称');
                $table->string('name_pinyin', 50)->nullable()->comment('名称拼音');
                $table->boolean('status')->default(\App\Model\BaseModel::STATUS['enabled'])->comment('状态');
                $table->text('comment')->nullable()->comment('备注');
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
