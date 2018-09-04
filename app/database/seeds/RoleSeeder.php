<?php

class RoleSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('roles')->insert(['id'=>1, 'name'=>'ATM']);
		DB::table('roles')->insert(['id'=>2, 'name'=>'DATM']);
		DB::table('roles')->insert(['id'=>3, 'name'=>'TA']);
		DB::table('roles')->insert(['id'=>4, 'name'=>'WM']);
		DB::table('roles')->insert(['id'=>5, 'name'=>'AWM']);
		DB::table('roles')->insert(['id'=>6, 'name'=>'ATA']);
		DB::table('roles')->insert(['id'=>7, 'name'=>'EC']);
		DB::table('roles')->insert(['id'=>8, 'name'=>'FE']);
		DB::table('roles')->insert(['id'=>9, 'name'=>'AEC']);
		DB::table('roles')->insert(['id'=>10, 'name'=>'INS']);
		DB::table('roles')->insert(['id'=>11, 'name'=>'MTR']);


		DB::table('permissions')->insert(['id'=>1, 'name'=>'snrstaff', 'display_name'=>'snrstaff']);
		DB::table('permissions')->insert(['id'=>2, 'name'=>'roster_edit', 'display_name'=>'roster_edit']);
		DB::table('permissions')->insert(['id'=>3, 'name'=>'roster_add', 'display_name'=>'roster_add']);
		DB::table('permissions')->insert(['id'=>4, 'name'=>'roster_del', 'display_name'=>'roster_del']);
		DB::table('permissions')->insert(['id'=>5, 'name'=>'docs', 'display_name'=>'docs']);
		DB::table('permissions')->insert(['id'=>6, 'name'=>'events', 'display_name'=>'events']);
		DB::table('permissions')->insert(['id'=>7, 'name'=>'scenery', 'display_name'=>'scenery']);
		DB::table('permissions')->insert(['id'=>8, 'name'=>'visit', 'display_name'=>'visit']);
		DB::table('permissions')->insert(['id'=>9, 'name'=>'feedback', 'display_name'=>'feedback']);
		DB::table('permissions')->insert(['id'=>10, 'name'=>'loa', 'display_name'=>'loa']);
		DB::table('permissions')->insert(['id'=>11, 'name'=>'instruct', 'display_name'=>'instruct']);
		DB::table('permissions')->insert(['id'=>12, 'name'=>'mentor', 'display_name'=>'mentor']);

		
		DB::table('permission_role')->insert(['permission_id'=>1, 'role_id'=>1], ['permission_id'=>2, 'role_id'=>1], ['permission_id'=>3, 'role_id'=>1], ['permission_id'=>4, 'role_id'=>1], ['permission_id'=>5, 'role_id'=>1], ['permission_id'=>6, 'role_id'=>1], ['permission_id'=>7, 'role_id'=>1], ['permission_id'=>8, 'role_id'=>1], ['permission_id'=>9, 'role_id'=>1], ['permission_id'=>10, 'role_id'=>1], ['permission_id'=>11, 'role_id'=>1], ['permission_id'=>12, 'role_id'=>1]);
		DB::table('permission_role')->insert(['permission_id'=>1, 'role_id'=>2], ['permission_id'=>2, 'role_id'=>2], ['permission_id'=>3, 'role_id'=>2], ['permission_id'=>4, 'role_id'=>2], ['permission_id'=>5, 'role_id'=>2], ['permission_id'=>6, 'role_id'=>2], ['permission_id'=>7, 'role_id'=>2], ['permission_id'=>8, 'role_id'=>2], ['permission_id'=>9, 'role_id'=>2], ['permission_id'=>10, 'role_id'=>2], ['permission_id'=>11, 'role_id'=>2], ['permission_id'=>12, 'role_id'=>2]);
		DB::table('permission_role')->insert(['permission_id'=>1, 'role_id'=>3], ['permission_id'=>2, 'role_id'=>3], ['permission_id'=>3, 'role_id'=>3], ['permission_id'=>4, 'role_id'=>3], ['permission_id'=>5, 'role_id'=>3], ['permission_id'=>6, 'role_id'=>3], ['permission_id'=>7, 'role_id'=>3], ['permission_id'=>8, 'role_id'=>3], ['permission_id'=>9, 'role_id'=>3], ['permission_id'=>10, 'role_id'=>3], ['permission_id'=>11, 'role_id'=>3], ['permission_id'=>12, 'role_id'=>3]);
		DB::table('permission_role')->insert(['permission_id'=>1, 'role_id'=>4], ['permission_id'=>2, 'role_id'=>4], ['permission_id'=>3, 'role_id'=>4], ['permission_id'=>4, 'role_id'=>4], ['permission_id'=>5, 'role_id'=>4], ['permission_id'=>6, 'role_id'=>4], ['permission_id'=>7, 'role_id'=>4], ['permission_id'=>8, 'role_id'=>4], ['permission_id'=>9, 'role_id'=>4], ['permission_id'=>10, 'role_id'=>4], ['permission_id'=>11, 'role_id'=>4], ['permission_id'=>12, 'role_id'=>4]);
		DB::table('permission_role')->insert(['permission_id'=>2, 'role_id'=>5], ['permission_id'=>3, 'role_id'=>5], ['permission_id'=>4, 'role_id'=>5], ['permission_id'=>5, 'role_id'=>5], ['permission_id'=>7, 'role_id'=>5], ['permission_id'=>11, 'role_id'=>5], ['permission_id'=>12, 'role_id'=>5]);
		DB::table('permission_role')->insert(['permission_id'=>2, 'role_id'=>6], ['permission_id'=>3, 'role_id'=>6], ['permission_id'=>5, 'role_id'=>6], ['permission_id'=>9, 'role_id'=>6], ['permission_id'=>11, 'role_id'=>6], ['permission_id'=>12, 'role_id'=>6]);
		DB::table('permission_role')->insert(['permission_id'=>6, 'role_id'=>7]);
		DB::table('permission_role')->insert(['permission_id'=>5, 'role_id'=>8], ['permission_id'=>7, 'role_id'=>8]);
		DB::table('permission_role')->insert(['permission_id'=>6, 'role_id'=>9]);
		DB::table('permission_role')->insert(['permission_id'=>2, 'role_id'=>10], ['permission_id'=>9, 'role_id'=>10], ['permission_id'=>11, 'role_id'=>10], ['permission_id'=>12, 'role_id'=>10]);
		DB::table('permission_role')->insert(['permission_id'=>2, 'role_id'=>11], ['permission_id'=>12, 'role_id'=>11]);

	}

}
