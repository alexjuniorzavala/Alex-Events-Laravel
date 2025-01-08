<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index(){
        /*$arr= [1,2,3,4,5];
        $nome='Mateus';
        $idade=19;
        $nomes = ["Maria", "Joao", "Mateus", "Ana", "Pedro", "Jonas", "Carla", "Katia", "Marlene", "Ludmila", "Yola", "Sara"];*/

        // $events = Event::whereRaw("TRIM(image) != ''")->get(); Elimina as linhas onde a coluna esta vazia 
        $search = request('search');
        if($search){
            $events = Event::where([
                ['title','like','%'.$search.'%']
            ])->get();
        } else {
            $events = Event::all();
        }
        
    
        return view('welcome', 
            [
                'events' => $events,
                'search' => $search
                /*'arr' => $arr,
                'nome' => $nome,
                'nomes' => $nomes,
                'idade1' => $idade,
                'profissao' => 'Programador',*/
    
            ]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        $event = new Event;
        
        $event->title = $request->title;
        $event->city = $request->city;
        $event->description = $request->description;
        $event->private = $request->private;
        $event->items = $request->items;
        $event->date = $request->date;

        $user = auth()->user();
        $event->user_id = $user->id;
        
        //image upload
        if($request->hasFile('image') && $request->file('image')->isValid()){
            
            $requestImage = $request->image;

            $extension = $requestImage->extension();
            
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")). ".". $extension;
            
            $requestImage->move(public_path("img/events"), $imageName);
            
            $event->image = $imageName;
        }
        $event->save();
        return redirect('/');
    }

    public function show($id){
        $events = Event::findOrFail($id);

        $eventOwner = User::where('id', $events->user_id)->first()->toArray();
        return view('events.show', 
        [
            'event'=>$events,
            'eventOwner'=>$eventOwner
        ]);
    }

    public function dashboard(){
        $user = auth()->user();
        $events = $user->events;

        return(view('events.dashboard',
        [
            'events'=>$events
        ]));
    }
    /*
    public function produtos(){
        $busca = request('search');
        return view('produtos', ['busca'=>$busca]);
    }

    public function contato(){
        return view('contato');
    }*/
}
