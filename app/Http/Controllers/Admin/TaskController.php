<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Cliente;
use App\Models\Task;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::all();

        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tasks.create');
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());

        return redirect()->route('admin.tasks.index');
    }


    public function addClient(Request $request)
    {
        $client_id = $request->get("client_id");
        $task_id = $request->get("task_id");


        $task = Task::find($task_id);
        $client = Cliente::find($client_id);



        $cli = DB::table('task_client')
            ->where('task_id', $task->id)
            ->where('client_id', $client->id)
            ->first();

        if (empty($cli->id)) {

            DB::table('task_client')
                ->insert(
                    [
                        'task_id' => $task->id,
                        'client_id' => $client->id
                    ]
                );
    
    
        }

        return redirect()->route('admin.tasks.show',$task_id);
    }

    public function edit(Task $task)
    {
        abort_if(Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());

        return redirect()->route('admin.tasks.index');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');


    
        $clients = Db::table("tasks")->select("clientes.*",'task_client.id as tk_id')
        ->join("task_client","task_client.task_id","tasks.id")
        ->join("clientes","task_client.client_id","clientes.id")
        ->get();

        $clients_all = [];

        return view('admin.tasks.show', compact('task','clients','clients_all'));
    }
    public function listClient(Request $request)
    { 
        $q = DB::table("clientes");
        if($request->has("q")){
            $q->where('fullname','like',"%".$request->get("q")."%");
            $q->orWhere('identificacion','like',"%".$request->get("q")."%");
        }

        $clients_all = $q->get();

        return response()->json(['data'=>$clients_all]);
    }

    public function destroyTaskClient(Request $request)
    {

        DB::table('task_client')
            ->where('id', $request->get('id'))->delete();

        return 'ok';
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskRequest $request)
    {
        $tasks = Task::find(request('ids'));

        foreach ($tasks as $task) {
            $task->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
