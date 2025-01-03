<?php

namespace App\Livewire\ManageUser;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Add extends Component
{
    public $name;
    public $contact;
    public $gender;
    public $email;
    public $username;
    public $password;

    public $role;

    protected $rules = [
        'name' => 'required|string|max:255',
        'contact' => 'required|numeric|digits:10',
        'gender' => 'required|in:Male,Female,Other',
        'email' => 'required|email|unique:users,email',
        'username' => 'required|string|unique:users,username|max:255',
        'password' => 'required|string|min:8',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveUser()
    {
        $this->validate();

        $user=new User();
        $user->name=$this->name;
        $user->mobile=$this->contact;
        $user->gender=$this->gender;
        $user->email=$this->email;
        $user->username=$this->username;
        $user->password=Hash::make($this->password);
            
        

        $user->syncRoles($this->role);
        $user->save();


        $this->reset();
        $this->dispatch('refresh-user');
        $this->dispatch('success', __("User added successfully"));
        $this->dispatch('reset-modal-user');
        
    }
    public function render()
    {  $roles=Role::orderBy('name','ASC')->get();
        return view('livewire.manage-user.add',[
            'roles'=>$roles,
        ]);
    }
}
