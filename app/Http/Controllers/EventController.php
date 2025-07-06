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
        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id){
        $events = Event::findOrFail($id);
        $eventOwner = User::where('id', $events->user_id)->first()->toArray();
        $user = auth()->user();
        $hasUserJoined = false;

        
        if($user){
                $userEvents = $user->eventsAsParticipant->toArray();
                foreach($userEvents as $userEvent){
                    if($userEvent['id'] == $id){
                        $hasUserJoined = true;
                    }
                }
        }
        return view('events.show', 
        [
            'event'=>$events,
            'eventOwner'=>$eventOwner,
            'hasUserJoined'=>$hasUserJoined
        ]);
    }

    public function dashboard(){
        $user = auth()->user();
        $events = $user->events;
        $eventsAsParticipant = $user->eventsAsParticipant;

        return(view('events.dashboard',
        [
            'events'=>$events,
            'eventsAsParticipant'=>$eventsAsParticipant
        ]));
    }

    public function edit($id){
        $event = Event::findOrFail($id);
        $user = auth()->user();

        if($user->id != $event->user->id ){
            return redirect('/dashboard')->with('msg', 
            '<span style="display: block; border-radius: 0;width:100%;height:100%;margin-bottom: 0px;"
             class="alert alert-danger">
             Voce nao tem permissao para editar este evento!
             </span> 
             <script>
                function Display_Alert(){
                    let alerBlock = document.querySelector(".msg")
                    alerBlock.style.padding="0px"
                    alerBlock.style.border="0px"
                }
                window.onload = Display_Alert
             </script>');
        }

            return(view('events.edit',
            [
                'event'=>$event,
    
            ]        ));


    }

    public function update(Request $request){
        $data = $request->all();

        //image upload
        if($request->hasFile('image') && $request->file('image')->isValid()){
            
            $requestImage = $request->image;

            $extension = $requestImage->extension();
            
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")). ".". $extension;
            
            $requestImage->move(public_path("img/events"), $imageName);
            
            $data['image'] = $imageName;
        }
        Event::findOrFail($request->id)->update($data);

        return redirect("/dashboard")->with('msg', 'Evento editado com sucesso');

    }

    public function destroy($id){
        Event::findOrFail($id)->delete() ;

        return redirect("/dashboard")->with('msg', 'Evento deletado com sucesso');
    }

    public function joinEvent($id){
        $user = auth()->user();
        
        //Se o usuário já estiver participando do evento (event_id e user_id já existirem na tabela event_user), nada acontece.
        $user->eventsAsParticipant()->syncWithoutDetaching([$id]);
        
        //$user->eventsAsParticipant()->attach($id); Mesmo ja participando, adiciona

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', "<span>Sua presença está confirmada no evento </span><span ><a href=\"/events/".$event->id."\" style=\"color: #FF0000; text-decoration: none;\">". $event->title ."</a>  </span>");


    }

    public function exitEvent($id){
            $user = auth()->user();
            $event = Event::findOrFail($id);
            $user->eventsAsParticipant()->detach($id);
            return redirect('/dashboard')->with('msg', "<span>Voce saiu do evento </span><span ><a href=\"/events/".$event->id."\" style=\"color: #FF0000; text-decoration: none;\">". $event->title ." </a> com sucesso</span>");
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
