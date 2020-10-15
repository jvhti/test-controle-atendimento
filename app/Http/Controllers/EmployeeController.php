<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Shift;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = \App\Models\Employee::with('shifts')->get();

        if(request()->ajax())
            return view('gerenciarFuncionario')->with(['employees' => $employees])->renderSections()['content'];

        return view('gerenciarFuncionario')->with(['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationRules = ['name' => 'required|min:5'];

        $employee = new Employee([
            'name' => $request->input('name')
        ]);

        $newShifts = $this->generateShifts($request, $validationRules, $employee);

        $employee->save();
        $employee->shifts()->saveMany($newShifts);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::with('shifts')->findOrFail($id);

        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::with('shifts')->findOrFail($id);

        return view('modals.editEmployee')->with(['employee' => $employee]);
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
        $employee = Employee::findOrFail($id);
        $validationRules = ['name' => 'required|min:5'];

        $newShifts = $this->generateShifts($request, $validationRules, $employee);

        $employee['name'] = $request->input('name');

        $employee->shifts()->delete();
        $employee->shifts()->saveMany($newShifts);
        $employee->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->shifts()->delete();
        $employee->delete();
        return response()->json(["success" => true]);
    }

    /**
     * @param Request $request
     * @param array $validationRules
     * @param $employee
     * @return array
     */
    private function generateShifts(Request $request, array $validationRules, $employee): array
    {
        $newShifts = [];

        $data = $request->all();
        for ($i = 0; $i <= 6; ++$i) {
            if (array_key_exists('enable' . $i, $data)) {
                $validationRules['entrada' . $i] = 'required|regex:/^\d{2}:\d{2}$/';
                $validationRules['saida' . $i] = 'required|regex:/^\d{2}:\d{2}$/';

                $newShifts[] = new Shift([
                    'employee_id' => $employee->id,
                    'day_of_week' => $i,
                    'start_time' => parseTimeStringToMinutes($data['entrada' . $i]),
                    'end_time' => parseTimeStringToMinutes($data['saida' . $i])
                ]);
            }
        }

        $request->validate($validationRules);
        return $newShifts;
    }
}
