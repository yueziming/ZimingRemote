<?php
    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            \Illuminate\Database\Eloquent\Model::unguard();
            $this->call(PermissionSeeder::class);
            $this->call(FieldSeeder::class);
            \Illuminate\Database\Eloquent\Model::reguard();
        }
    }
