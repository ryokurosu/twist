<?php

use Illuminate\Database\Seeder;

use App\Botrule;
use App\Dmrule;
use App\Botstory;
use App\Dmstory;
use App\User;

class RuleTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $b = Botrule::create(['id' => 0,'name' => '送信しない', 'span' => 10000,'limit' => 0]);
        $b->botrule_id = 0;
        $b->save();

        $d = Dmrule::create(['id' => 0,'name' => '送信しない','span' => 0,'limit' => 0]);
        $d->dmrule_id = 0;
        $d->save();

        $s = Botstory::create(['id' => 0,'name' => '送信しない']);
        $s->botstory_id = 0;
        $s->save();


        $s = Dmstory::create(['id' => 0,'name' => '送信しない']);
        $s->dmstory_id = 0;
        $s->save();

        $a = new User;
        $a->fill(['name' => 'kurosu' , 'email' => 'knowrop1208@gmail.com','password' => '$2y$10$6Sitv1HHn6SbLVmBg.meTeaEUJEfgn2TlSNGm2W7MpSMokWqi9B6S'])->save();
    }
}
