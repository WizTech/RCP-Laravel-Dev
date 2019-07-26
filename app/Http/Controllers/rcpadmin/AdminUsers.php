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
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

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

        $optionsArray = $input['options'];

        for ($i = 0; $i < count($optionsArray); $i++) {
            $option = $optionsArray[$i];
            $selected_options = explode(',', $option);
            if (isset($selected_options[0]) && isset($selected_options[1])) {
                ModulePermissions::create([
                    'admin_id' => $admin_user->id,
                    'module_id' => $selected_options[0],
                    'module_option_id' => $selected_options[1]
                ]);
            }

        }

        return redirect('rcpadmin/admin_users');
    }

    function activityExport()
    {
        $input = Request::all();

       $date_from = date('Y-m-d', strtotime($input['date_from']));
       $date_to = date('Y-m-d', strtotime($input['date_to']));
       $user_id = $input['user_id'];

        $userActivities = AdminUser::activity_export($user_id, $date_from, $date_to);

        $activity_array[] = ['Username', 'Module', 'Activity', 'Before Change', 'After Change', 'Date Time'];

        if (!empty($userActivities)) {
            foreach ($userActivities as $activity) {
                $activity_array[] = array(
                    'Username' => $activity->user_name,
                    'Module' => $activity->module_title,
                    'Activity' => $activity->text,
                    'Befor Change' => !empty($activity->before_change) ? $activity->before_change : '',
                    'After Change' => !empty($activity->after_change) ? $activity->after_change : '',
                    'Date Time' => $activity->created_at
                );
            }
            $sheetName = "User Activities ".date('d-m-y his');
            return Excel::create($sheetName, function ($excel) use ($activity_array) {
                $excel->setTitle('activities');
                $excel->sheet('activities', function ($sheet) use ($activity_array) {
                    $sheet->fromArray($activity_array, null, 'A1', false, false);
                });
            })->download('csv');

        }
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
