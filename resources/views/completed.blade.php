@extends('layouts.default')

@section('content')
    <main class="flex-shrink-0 mt-5">
        <div class="container">
            <div class="my-3 p-3 bg-body rounded shadow-sm"> 
                <div class="mb-3">Welcome {{auth()->user()->name}} to your completed tasks</div>
                    <h6 class="border-bottom pb-2 mb-0">Comleted Task:</h6> 
                    @forelse ($tasks as $task)
                    <div class="d-flex text-body-secondary pt-3"> 
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-right"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M13 18l6 -6" /><path d="M13 6l6 6" /></svg>
                        <div class="pb-3 mb-0 small lh-sm border-bottom w-100"> 
                            <div class="d-flex justify-content-between"> 
                                <strong class="text-gray-dark">{{$task->title}} | {{$task->deadline}}</strong> 
                                <div>
                                    <a href="{{route('task.status.update',parameters: $task->id)}}" class="btn btn-success"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg></a> 
                                    <a href="{{route('task.delete',parameters: $task->id)}}" class="btn btn-danger"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a> 
                                </div>
                            </div> 
                            <span class="d-block">{{$task->description}}</span> 
                        </div>
                    </div>
                    @empty
                        <p class="text-muted mt-3">🚀 No completed tasks yet.</p>
                    @endforelse
                    <div class="mt-3">{{$tasks->links()}}</div> 
                </div>
            </div>
        </div>
    </main>
@endsection