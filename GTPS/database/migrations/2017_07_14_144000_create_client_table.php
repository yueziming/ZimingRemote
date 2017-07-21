<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateClientTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::connection('self')->create('client', function (Blueprint $table){
                $table->string('name', 64)->index()->comment('名称');
                $table->string('name_pinyin', 64)->index()->nullable()->comment('名称拼音码');
                $table->bigInteger('organization_id')->index()->comment('会所ID');
                $table->date('birthday')->nullable()->comment('生日');
                $table->string('mobile', 30)->index()->comment('手机号');
                $table->string('email', 100)->nullable()->comment('邮箱');
                $table->string('qq', 20)->nullable()->comment('QQ号');
                $table->string('constellation', 15)->nullable()->comment('星座');
                $table->string('blood_group', 5)->nullable()->comment('血型');
                $table->string('gender', 10)->default('未知')->comment('性别');
                $table->string('level',5)->default('1星')->comment('等级');
                $table->string('nationality', 30)->nullable()->comment('国籍');
                $table->string('religion', 30)->nullable()->comment('宗教');
                $table->string('race', 30)->nullable()->comment('民族');
                $table->string('identity_card', 30)->nullable()->comment('身份证');
                $table->string('profession', 40)->nullable()->comment('职业');
                $table->string('unit', 64)->nullable()->comment('工作单位');
                $table->string('province', 50)->nullable()->comment('省');
                $table->string('city', 50)->nullable()->comment('市');
                $table->string('county', 50)->nullable()->comment('县/区');
                $table->string('address', 50)->nullable()->comment('地址');
                $table->string('agent', 20)->nullable()->comment('媒介');
                $table->string('type', 20)->default('其他')->comment('类型');
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
            Schema::dropIfExists('client');
        }
    }
