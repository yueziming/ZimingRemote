<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateFieldTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::connection('self')->create('field', function (Blueprint $table){
                $table->bigIncrements('id');
                $table->string('code', 64)->unique()->comment('字段码');
                $table->string('table', 50)->comment('表名');
                $table->string('field', 50)->comment('字段名');
                $table->string('name', 50)->comment('名称');
                $table->string('name_pinyin', 50)->nullable()->comment('名称拼音');
                $table->boolean('searchable')->comment('可搜索');
                $table->boolean('list_viewable')->comment('列表字段是否可查看');
                $table->boolean('read_viewable')->comment('详情字段是否可查看');
                $table->boolean('write_viewable')->comment('写入字段是否可查看');
                $table->boolean('necessary')->comment('是否必填');
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
            Schema::dropIfExists('field');
        }
    }
