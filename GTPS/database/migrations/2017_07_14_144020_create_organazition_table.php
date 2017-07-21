<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateOrganazitionTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::connection('self')->create('organization', function (Blueprint $table){
                $table->string('name', 100)->index()->comment('名称');
                $table->string('name_pinyin', 100)->index()->nullable()->comment('名称拼音码');
                $table->string('telephone', 30)->nullable()->comment('联系电话');
                $table->string('email', 100)->nullable()->comment('邮箱');
                $table->string('province', 50)->nullable()->comment('省');
                $table->string('city', 50)->nullable()->comment('市');
                $table->string('county', 50)->nullable()->comment('县/区');
                $table->string('address', 50)->nullable()->comment('地址');
                $table->string('is_new', 5)->default('新店')->comment('是否新店');
                $table->string('agent', 20)->nullable()->comment('媒介');
                $table->string('level',5)->default('1星')->comment('等级');
                $table->bigInteger('parent_id')->default(\App\Model\System\Organization::ROOT_ID)->comment('上级会所');
                $table->bigIncrements('id');
                $table->boolean('status')->default(\App\Model\BaseModel::STATUS_ENABLED)->comment('状态');
                $table->text('comment')->nullable()->comment('备注');
                $table->dateTime('creatime')->comment('创建时间');
                $table->dateTime('updatime')->nullable()->comment('更新时间');
                $table->dateTime('deletime')->nullable()->comment('删除时间');
                $table->bigInteger('creator_id')->comment('创建者ID');
                $table->bigInteger('updater_id')->nullable()->comment('更新者ID');
                $table->bigInteger('deleter_id')->nullable()->comment('删除者ID');
                $table->string('creator', 30)->comment('创建者');
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
            Schema::dropIfExists('organization');
        }
    }
