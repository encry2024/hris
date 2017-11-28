<?php

use Illuminate\Database\Seeder;

class ProgrammerTrainingSeeder extends Seeder
{
   /**
   * Run the database seeds.
   *
   * @return void
   */
   public function run()
   {
      DB::table('training')
      ->insert(
         array(
            array(
               'name' => 'WEB-DEVELOPER',
               'created_at' => date('Y-m-d h:i:s'),
               'updated_at' => date('Y-m-d h:i:s')
            ),
            array(
               'name' => 'RECEPTIONIST',
               'created_at' => date('Y-m-d h:i:s'),
               'updated_at' => date('Y-m-d h:i:s')
            )
         )
      );
   }
}
