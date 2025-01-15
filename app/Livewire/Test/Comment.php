<?php

namespace App\Livewire\Test;

use App\Models\Comment as ModelsComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comment extends Component
{

    public $Id;
    public $comment;
    public function mount($id){

        $this->Id=$id;
        
 
     }
     public function store(){
        ModelsComment::create([
            'user_id'=>Auth::id(),
            'comment'=>$this->comment,
            'test_id'=>$this->Id,
         ]);
         $this->comment='';

         $this->dispatch('success',__('comment added successfully'));
         $this->dispatch('reset-modal-comment');
         $this->dispatch('refresh-comments');

         
        
     }
    public function render()
    {
        return view('livewire.test.comment');
    }
}
