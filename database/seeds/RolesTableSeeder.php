<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	db::table('roles')->truncate();
    	// create Admin role
       $admin= new Role();
       $admin->name="admin";
       $admin->display_name="Admin";
       $admin->save();

       //create Editor role
       
       $editor= new Role();
       $editor->name="editor";
       $editor->display_name="Editor";
       $editor->save();

       //create Author role
       
       $author= new Role();
       $author->name="author";
       $author->display_name="Author";
       $author->save();
       //attach the roles
       //first as Admin
       $user1=User::find(3);
       $user1->attachRole($admin);
        $user1->detachRole($admin);
       //second user as editor
       $user2=User::find(2);
       $user2->attachRole($editor);
       $user2->detachRole($editor);
       //second as author
       $user3=User::find(1);
       $user3->attachRole($author);
       $user3->detachRole($author);
    }
}
