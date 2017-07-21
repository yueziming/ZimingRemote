<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateBaseDataTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::connection('self')->create('base_data', function (Blueprint $table){
                $table->string('index', 50)->comment('字段索引');
                $table->string('value', 100)->comment('数据值');
                $table->string('value_pinyin', 100)->comment('数据值拼音码');
                $table->boolean('default')->default(\App\Model\System\BaseData::DEFAULT_FALSE)->comment('是否为默认值');
                $table->bigIncrements('id');
                $table->boolean('status')->default()->comment('状态');
                $table->text('comment')->nullable(\App\Model\BaseModel::STATUS_ENABLED)->comment('备注');
                $table->dateTime('creatime')->comment('创建时间');
                $table->dateTime('updatime')->nullable()->comment('更新时间');
                $table->dateTime('deletime')->nullable()->comment('删除时间');
                $table->bigInteger('creator_id')->default(0)->comment('创建者ID');
                $table->bigInteger('updater_id')->nullable()->comment('更新者ID');
                $table->bigInteger('deleter_id')->nullable()->comment('删除者ID');
                $table->string('creator', 30)->default(0)->comment('创建者');
                $table->string('updater', 30)->nullable()->comment('更新者');
                $table->string('deleter', 30)->nullable()->comment('删除者');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('base_data');
        }
    }
