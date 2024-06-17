<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Master;
use App\Models\Master_schedule;
use App\Models\User;
use App\Models\Work;
use App\Models\Work_order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminListUser(Request $request)
    {
        $adminList = User::get();

        foreach ($adminList as $admin) {
            switch ($admin->isAdmin) {
                case User::ROLE_ADMIN:
                    $admin->isAdmin = 'ADMIN';
                    break;
                case User::ROLE_USER:
                    $admin->isAdmin = 'USER';
                    break;
                case User::ROLE_MANAGER:
                    $admin->isAdmin = 'MANAGER';
                    break;
                case User::ROLE_ASSISTANT:
                    $admin->isAdmin = 'ASSISTANT';
                    break;
                default:
                    $admin->isAdmin = 'UNKNOWN';
            }
        }
        return view('admin.adminList', ['adminList' => $adminList]);

    }

    public function adminListChange(Request $request, $id, $status)
    {
        $client = User::find($id);
        if ($client) {
            $client->isAdmin = $status;
            $client->save();
        }
        return redirect()->route('adminListUser');
    }

    public function adminWorker()
    {
        $worker = Master::all();
        $companies = Company::all();

        return view('admin.adminWorker', ['workers' => $worker, 'companies' => $companies]);
    }

    public function dayWorker()
    {
        $masterSchedules = Master_schedule::with('master')->get();

        $master = Master::all();

        return view('adminWorkDay', ['masterSchedules' => $masterSchedules, 'Masters' => $master,]);
    }

    public function addWorker(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('img'), $imageName);

        $master = new Master;
        $master->name = $request->name;
        $master->companies_id = $request->companies_id;
        $master->image = $imageName;
        $master->save();

        return back()
            ->with('success', 'You have successfully upload image.')
            ->with('image', $imageName);
    }

    public function workerDelete($id)
    {
        $master = Master::find($id);

        if ($master != null) {
            $master->delete();
            return back()->with('success', 'Record has been deleted successfully!');
        }

        return back()->with('error', 'Record not found!');
    }

    public function workerEdit($id)
    {
        $company = Company::all();
        $master = Master::find($id);

        return view('admin.adminWorkerUpdate', ['master' => $master, 'companies' => $company]);


    }

    public function workerUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $master = Master::find($id);

        if ($master != null) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);

            $master->name = $request->name;
            $master->companies_id = $request->companies_id;
            $master->image = $imageName;
            $master->active = $request->active;

            $master->save();

            return back()->with('success', 'Record has been updated successfully!');
        }

        return back()->with('error', 'Record not found!');
    }

    public function adminDayOff($masters_id)
    {
        $masterSchedules = Master_schedule::with('master')->where('masters_id', $masters_id)->get();

        $master = Master::all();

        return view('admin.adminWorkDay', ['masterSchedules' => $masterSchedules, 'masters' => $master]);
    }

    public function adminDayOffDelete($id)
    {
        $master = Master_schedule::find($id);

        if ($master != null) {
            $master->delete();
            return back()->with('success', 'Record has been deleted successfully!');
        }
        return back()->with('error', 'Record not found!');
    }

    public function adminWorkerEdit(Request $request, $id)
    {
        $masterSchedule = Master_schedule::find($id);

        if ($masterSchedule) {
            $masterSchedule->work_day = $request->input('myChangeDate');
            $masterSchedule->save();
            return back()->with('success', 'Record has been changed successfully!');
        }
        return back()->with('error', 'Record not changed!');

    }

    public function worksList()
    {
        $workList = Work::all();
        return view('admin.adminWorkList', ['workList' => $workList]);
    }

    public function addWorks(Request $request)
    {
        $works = new Work;
        $works->name_of_work = $request->name_of_work;
        $works->description = $request->description;
        $works->price = $request->price;
        $works->time_for_work = $request->time_for_work;
        $works->save();
        return back()
            ->with('success', 'You have successfully add works.');
    }

    public function worksDelete($id)
    {
        $works = Work::find($id);
        if ($works != null) {
            $works->delete();
            return back()->with('success', 'Record has been deleted successfully!');
        }
        return back()->with('error', 'Record not found!');
    }

    public function editWork($id)
    {
        $work = Work::find($id);
        return view('admin.adminWorkListEdit', compact('work'));
    }

    public function updateWork(Request $request, $id)
    {
        $work = Work::find($id);
        $work->name_of_work = $request->name_of_work;
        $work->description = $request->description;
        $work->price = $request->price;
        $work->time_for_work = $request->time_for_work;
        $work->active = $request->active;
        $work->save();
        return redirect()->route('adminListOfWork');
    }

    public function sumPriceTotal(Request $request)
    {

        $startDate = $request->myStartDate;
        $endDate = $request->myStopDate;

        if ($startDate == null && $endDate == null) {
            $start_date = Carbon::now()->startOfMonth();
            $end_date = Carbon::now()->endOfDay();
        } else {
            $start_date = Carbon::parse($startDate)->startOfDay();
            $end_date = Carbon::parse($endDate)->endOfDay();
        }
        $totalPrise = Work_order::whereBetween('start_order', [$start_date, $end_date])
            ->with('work')
            ->get()
            ->sum(function ($work_order) {
                return $work_order->work->price;
            });
        $totalHouers = Work_order::whereBetween('start_order', [$start_date, $end_date])
            ->with('work')
            ->get()
            ->sum(function ($work_order) {
                return $work_order->work->time_for_work;
            });

        $dailyTotalsByMoney = Work_order::whereBetween('start_order', [$start_date, $end_date])
            ->with('work')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->start_order)->format('Y-m-d');
            })
            ->map(function ($work_orders) {
                return $work_orders->sum(function ($work_order) {
                    return $work_order->work->price;
                });
            });
        $dailyTotalsByTime = Work_order::whereBetween('start_order', [$start_date, $end_date])
            ->with('work')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->start_order)->format('Y-m-d');
            })
            ->map(function ($work_orders) {
                return $work_orders->sum(function ($work_order) {
                    return $work_order->work->time_for_work;
                });
            });

        $totalWorkDayWorkers = Work_order::whereBetween('start_order', [$start_date, $end_date])
            ->with('master')
            ->selectRaw('DATE(start_order) as date, masters_id')
            ->groupBy('date', 'masters_id')
            ->get()
            ->groupBy('masters_id')
            ->mapWithKeys(function ($work_orders) {
                $master_name = $work_orders->first()->master->name;
                return [$master_name => $work_orders->count()];
            });

        return view('admin.adminDashboard', [
            'totalPrise' => $totalPrise,
            'totalHouers' => $totalHouers,
            'dailyTotalsByMoney' => $dailyTotalsByMoney,
            'dailyTotalsByTime' => $dailyTotalsByTime,
            'totalWorkDayWorkers' => $totalWorkDayWorkers,
            'start_date' => $start_date,
            'end_date' => $end_date,]);
    }

}
