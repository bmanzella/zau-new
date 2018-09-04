<?php

class ForumSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$users = User::all();
		$i = 0;
		foreach($users as $u)
		{
			$current = SMFMember::where('member_name', $u->id)->first();
			if($current)
			{
				continue;
			}
			else
			{
				$new = new SMFMember;
				$new->member_name = $u->id;
				$new->date_registered = time();
				$new->email_address = $u->email;
				$new->passwd = uniqid();
				if($u->visitor == 1) {
					$new->id_group = 21;
				} else {
					$new->id_group = 20;
				}
				$new->is_activated = 1;
				$new->id_theme = 3;
				$new->password_salt = substr(md5(mt_rand()), 0, 4);
				$new->member_ip = '127.0.0.1';
				$new->member_ip2 = '127.0.0.1';
				$new->validation_code = '';
				$new->real_name = $u->first_name.' '.$u->last_name;
				$new->save();

				$full_name = SMFSettings::find('latestRealName');
				$full_name->value = $u->full_name;
				$full_name->save();

				$full_name = SMFSettings::find('latestMember');
				$full_name->value = $new->id_member;
				$full_name->save();
				$i++;
			}
		}
		echo "Saved {$i} Forum Members \n";
	}

}