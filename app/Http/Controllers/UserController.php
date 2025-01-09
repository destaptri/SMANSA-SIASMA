<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $data = User::latest()->paginate(5);
  
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
{
    // Validasi input
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm-password',
        'roles' => 'required',
        'input_type' => 'required|string|min:10|max:18', // Validasi panjang input
    ]);

    // Ambil semua data request
    $input = $request->all();

    // Hash password
    $input['password'] = Hash::make($input['password']);

    // Tentukan apakah input_type masuk ke nisn atau nip
    $inputType = $request->input('input_type');
    if (strlen($inputType) === 10) {
        $input['nisn'] = $inputType; // Set ke kolom nisn
    } elseif (strlen($inputType) === 18) {
        $input['nip'] = $inputType;  // Set ke kolom nip
    }

    // Hapus input_type agar tidak ada konflik
    unset($input['input_type']);

    // Simpan data user ke database
    $user = User::create($input);

    // Assign role ke user
    $user->assignRole($request->input('roles'));

    // Redirect ke halaman index users dengan pesan sukses
    return redirect()->route('users.index')
                     ->with('success', 'User created successfully');
}

// Modified import method
public function import(Request $request): RedirectResponse
{
    $this->validate($request, [
        'excel_file' => 'required|mimes:xlsx,xls',
    ]);

    try {
        $import = new UsersImport();
        Excel::import($import, $request->file('excel_file'));

        return redirect()->route('users.index')
                       ->with('success', 'Alumni users imported successfully');
    } catch (\Exception $e) {
        return redirect()->back()
                       ->with('error', 'Error importing users: ' . $e->getMessage());
    }
}
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}