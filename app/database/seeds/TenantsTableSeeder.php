<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder {
public function run()
{
$this->call('TenantsTableSeeder');
$this->command->info('User table seeded!');
}
}


class TenantsTableSeeder extends Seeder {

	public function run()
	{
		
		$branch = new Branch;

		$branch->name = 'Head Office';
		$branch->save();


		$currency = new Currency;

		$currency->name = 'Kenyan Shillings';
		$currency->shortname = 'KES';
		$currency->save();

		

		$organization = new Organization;

		$organization->name = null;
		$organization->save();


		


	$perm = new Permission;
    $perm->name = 'manage_organization';
    $perm->display_name = 'manage organizations';
    $perm->category = 'Organization';
    $perm->save();
	
	
	$perm = new Permission;
    $perm->name = 'manage_branch';
    $perm->display_name = 'manage branches';
    $perm->category = 'Organization';
    $perm->save();
	
	
	$perm = new Permission;
    $perm->name = 'manage_group';
    $perm->display_name = 'manage groups';
    $perm->category = 'Organization';
    $perm->save();
	
	
	$perm = new Permission;
    $perm->name = 'manage_user';
    $perm->display_name = 'manage users';
    $perm->category = 'User';
    $perm->save();
	
	
	$perm = new Permission;
    $perm->name = 'manage_role';
    $perm->display_name = 'manage roles';
    $perm->category = 'User';
    $perm->save();
	
	
	$perm = new Permission;
    $perm->name = 'manage_license';
    $perm->display_name = 'manage license';
    $perm->category = 'System';
    $perm->save();
	
	
	$perm = new Permission;
    $perm->name = 'manage_audit';
    $perm->display_name = 'manage audits';
    $perm->category = 'System';
    $perm->save();
	
	
	$perm = new Permission;
    $perm->name = 'manage_backup';
    $perm->display_name = 'manage backups';
    $perm->category = 'System';
    $perm->save();

    

    

    
	}

}