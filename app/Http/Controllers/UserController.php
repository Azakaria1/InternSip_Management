<?php
namespace App\Http\Controllers;
use App\Models\Departement;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use App\Models\User;
use Symfony\Component\Translation\Dumper\YamlFileDumper;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:afficher utilisateur|créer utilisateur|modifier utilisateur', ['only' => ['index','store']]);
        $this->middleware('permission:créer utilisateur', ['only' => ['create','store']]);
        $this->middleware('permission:modifier utilisateur', ['only' => ['edit','update']]);
    }
    public function index(Request $request)
    {
        $services = Service::get();
        $data = User::orderBy('id','ASC')->simplePaginate(5);
        return view('users.index',[
            'data'=>$data,
            'services' => $services,
        ])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function profil()
    {
        $user = auth()->user();
        return view('users.profil', compact('user'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::get();
        $roles = Role::pluck('name','name')->all();
        return view('users.create',[
            'roles' => $roles,
            'services' => $services
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required',
            'prenom' => 'required',
            'tel' => 'required', 
            'date_naissance' => 'required',
            'email' => 'required',
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $services = Service::get();
        $departements = Departement::get();
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nom' => 'required',
            'prenom' => 'required',
            'tel' => 'required',
            'date_naissance' => 'required',
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
            ->with('success','Utilisateur Modifié avec succès');
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $data = User::query()
            ->where('nom', 'LIKE', "%{$search}%")
            ->orWhere('prenom' , 'LIKE', "%{$search}%")->get();

        // Return the search view with the resluts compacted
        return view('users.search', compact('data'));
    }
}
