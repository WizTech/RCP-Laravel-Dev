<?php

namespace App\Http\Controllers\rcpadmin;

/*use Illuminate\Http\Request;*/

use App\AdminCampuses;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AdminUser;
use App\CampusModel;
/*use App\AdminModulePermissions;*/

use App\Models\AdminModules;
use App\ModuleOptions;
use App\ModulePermissions;
use Request;
use Auth;

class AdminUsers extends Controller
{
    //
    public function index()
    {
        $webUsers = AdminUser::with('role')->where('id', '!=', Auth::user()->id)->paginate(10);
        return view('rcpadmin.admin', compact('webUsers', 'admin_id'));
    }

    public function create()
    {
        $campuses = CampusModel::all('id', 'title')->toArray();

        $campusSelect = [];

        $campusSelect[''] = 'Campus (es)';
        foreach ($campuses as $campus) {
            $campusSelect[$campus['id']] = $campus['title'];
        }
        return view('rcpadmin.admin-users.add', compact('campusSelect'));
    }

    public function store(Requests\AdminUserRequest $request)
    {
        $input = Request::all();


        $input['password'] = bcrypt($input['password']);
        $admin_user = AdminUser::create($input);

        if ($admin_user && !empty($input['campus_id'])) {

            $campusIds = $input['campus_id'];
            foreach ($campusIds as $campId) {
                if ($campId):
                    AdminCampuses::create(['admin_id' => $admin_user->id, 'campus_id' => $campId]);
                endif;
            }


        }
        return redirect('rcpadmin/admin_users');

    }

    public function show($id)
    {
        $admin_user = AdminUser::find($id)->toArray();

        $admin_campuses = AdminUser::find($id)->campuses->pluck('id')->toArray();

        $campuses = CampusModel::all('id', 'title')->toArray();


        $campusSelect = [];

        $campusSelect[''] = 'Campus (es)';
        foreach ($campuses as $campus) {
            $campusSelect[$campus['id']] = $campus['title'];
        }
        return view('rcpadmin.admin-users.edit', compact('admin_user', 'campusSelect', 'admin_campuses'));
    }

    public function modules($id)
    {

        $admin_user = AdminUser::find($id)->toArray();
        $admin_modules = AdminModules::all()->toArray();
        $modules_permissions = ModulePermissions::where('admin_id', '=', $id)->get()->toArray();

        $modules_options = ModuleOptions::all()->toArray();
        return view('rcpadmin.admin-users.modules', compact('admin_user', 'admin_modules', 'modules_options', 'modules_permissions'));
    }

    public function modules_update($id)
    {

        $admin_user = AdminUser::find($id);

        $input = Request::all();


        $admin_modules = ModulePermissions::where('admin_id', '=', $id)->first();
        if (!empty($admin_modules)) {
            $admin_user->modules()->detach();
        }

        $optionsArray = explode(',', implode('-', $input['options']));

        for ($i = 0; $i < count($optionsArray); $i++) {
            $option = $optionsArray[$i];
            $selected_opt_data = explode('-', $option);
            if (isset($selected_opt_data[0]) && isset($selected_opt_data[1])) {
                ModulePermissions::create(['admin_id' => $admin_user->id, 'module_id' => $selected_opt_data[1], 'module_option_id' => $selected_opt_data[0]]);

            }

        }

        return redirect('rcpadmin/admin_users');
    }

    public function update($id, Requests\AdminUserRequest $request)
    {

        $admin_user = AdminUser::find($id);


        $input = Request::all();

        if (!empty($input['password'])) {

            $input['password'] = bcrypt($input['password']);
        } else {
            $input['password'] = $admin_user['password'];
        }


        $admin_user->update($input);

        if (!empty($input['campus_id'])) {

            $admin_campuses = AdminCampuses::where('admin_id', '=', $id)->first();
            if (!empty($admin_campuses)) {
                $admin_user->campuses()->detach();
            }

            $campusIds = $input['campus_id'];
            foreach ($campusIds as $campId) {
                AdminCampuses::create(['admin_id' => $admin_user->id, 'campus_id' => $campId]);
            }
        }

        return redirect('rcpadmin/admin_users');
    }

    public function destroy($id)
    {
        $admin_users = AdminUser::find($id);
        $admin_users->delete();
        return redirect('rcpadmin/admin_users');
    }
}
