<?php

namespace App\Livewire\PatientRegistration;

use App\Models\CollectedAddress;
use App\Models\Organisation;
use App\Models\PatientRegistration as PatientRegistrationModel;
use App\Models\SampleCollector;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Livewire\Attributes\On;
use Livewire\Component;
use PHPUnit\Framework\Constraint\SameSize;

class Add extends Component
{
    
    public $keyword = ''; // Search keyword
    public $users = [];   // Search results
    public $userId;       // Selected user ID
   

    public $designation, $firstname, $lastname, $mobile, $gender = 'other', $age, $age_type, $email, $address;
    public $sampleCollector, $organisation, $collectedat, $b2bCenter;
    public $password;

    public function updatedKeyword()
    {
        // Fetch users and their patient registrations
        $this->users = User::where('name', 'like', '%' . $this->keyword . '%')
            ->orWhere('mobile', 'like', '%' . $this->keyword. '%')
            ->orWhere('email', 'like', '%' . $this->keyword . '%')
            ->get();
    }

    public function selectUser($id)
    {
        $user = User::with('patient')->find($id);
      

        if ($user) {
            $this->userId = $user->id;
            $this->keyword = $user->name;
            $this->designation = $user->patient->designation;
            $this->firstname = $user->name;
            $this->lastname = $user->lastname;
            $this->mobile = $user->mobile;
            $this->address=$user->patient->address;
            $this->gender = $user->gender;
            $this->age = $user->patient->age;
            $this->age_type = $user->patient->age_type;
            $this->email = $user->email;
            

        }

        $this->users = [];
    }
    
 


    public function rules()
    {
        return [
            'designation' => 'required',
            'firstname' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'mobile' => [
                'required',         // Phone is required
                'numeric',          // Must be numeric
                'digits:10',        // Must be exactly 10 digits
                // Rule::unique('users', 'mobile'), // Ensure uniqueness in the users table
            ],
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:1|max:100',
            'age_type' => 'required|in:year,month,day',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'sampleCollector' => 'nullable',
            'organisation' => 'nullable',
            'collectedat' => 'nullable|string',
        ];
    }
    
    
   
    

    

    public function submit()
    {
        
        $validateData = $this->validate($this->rules());

       
        
      $this->dispatch('patient-data',$validateData);
      $this->dispatch('open-bill-modal');   
     
    }
    public function updatedMobile($value)
    {
        // Sanitize app name
        $appName = config('app.name');
        $sanitizedAppName = preg_replace('/[^a-zA-Z0-9]/', '', strtolower($appName));

        // Auto-generate email and password
        $this->email = $value . '@' . $sanitizedAppName . '.com';
        $this->password = $value;
    }
  

    #[On('refresh-Organisationlist')] 
    #[On('refresh-address')]
    #[On('refresh-modal-sampleCollector')]
    public function render()
    {   
        $data['collectAt']=CollectedAddress::all();
        $data['organisationlist'] = Organisation::all();
        $data['sampleCollectorlist'] =SampleCollector::all();
        return view('livewire.patient-registration.add',$data);
    }
}
