<?php


use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //User::truncate();   //清空
        /* 隨機帳號 */
        foreach (range(1,5) as $id => $value) {
            User::create([
                'name' => '使用者' . $value,
                'account' => 'acc' . $value,
                'password' => 'pass'. $value,
                'admin' => 0,
                //'created_at' => date('Y-d-m H:i:s',time()), //可選
                //'updated_at' => date('Y-d-m H:i:s',time()), //可選
            ]);
        }
        User::create([
            'name' => '管理員',
            'account' => 'admin',
            'password' => 'admin',
            'admin' => 1,
            //'created_at' => date('Y-d-m H:i:s',time()), //可選
            //'updated_at' => date('Y-d-m H:i:s',time()), //可選
        ]);
    }
}
