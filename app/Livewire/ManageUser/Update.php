<?php

namespace App\Livewire\ManageUser;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Update extends Component
{
    public $name;
    public $contact;
    public $gender;
    public $email;
    public $username;


    public $role;
    public $Id;

   
    #[On('update-user')]
    public function edit($id){
        $user=User::find($id);
        $this->name=$user->name;
        $this->contact=$user->mobile;
        $this->gender=$user->gender;
        $this->email=$user->email;
        $this->username=$user->username;
     
        $this->role=$user->roles->pluck('id')->toArray();
        $this->Id=$id;
    }

    public function saveUser(){
       

        $user= User::find($this->Id);
        $user->name=$this->name;
        $user->mobile=$this->contact;
        $user->gender=$this->gender;
        $user->email=$this->email;
        $user->username=$this->username;
   
            
        

        $user->syncRoles($this->role);
        $user->save();
        $this->reset();
        $this->dispatch('reset-modal-user');
        $this->dispatch('refresh-user');
        $this->dispatch('success', __("User updated successfully"));
    }
    
    public function render()
    { 
        $roles=Role::orderBy('name','ASC')->get();
        return view('livewire.manage-user.update',[
            'roles'=>$roles
        ]);
    }
}
