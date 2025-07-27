<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

use App\Models\Creature;
use App\Models\UserCreature;

class BookController extends Controller
{
    private $book;

    public function __construct(Book $book, Creature $creature)
    {
        $this->book = $book;
        $this->creature = $creature;
    }

    public function create()
    {
        // 現在育成中のモンスターがいるか確認
        $user = Auth::user();
        $current = $user->userCreatures()->where('current', true)->first();

        $all_creatures = $this->creature->latest()->get();

        return view('users.books.create')->with('all_creatures', $all_creatures)->with('current', $current);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:1|max:150',
            'author_name' => 'required|min:1|max:50',
            'impression' => 'required|min:1|max:1000',
            'cover_photo' => 'mimes:jpeg,jpg,png,gif|max:1048',
        ]);

        $user = Auth::user();

        // 現在育成中のモンスターを確認
        $current = $user->userCreatures()->where('current', true)->first();

        if (!$current) {
            // 初回 or 完了後、新しい育成を開始
            $current = UserCreature::create([
                'user_id' => $user->id,
                'creature_id' => $request->creature_id, // モンスター選択がある場合
                'stage' => 1,
                'current' => true,
            ]);
        }

        // 本の保存
        $this->book->user_id = $user->id;
        $this->book->title = $request->title;
        $this->book->author_name = $request->author_name;
        $this->book->impression = $request->impression;

        if ($request->hasFile('cover_photo')) {
            $this->book->cover_photo = 'data:image/' . $request->cover_photo->extension() . ';base64,' . base64_encode(file_get_contents($request->cover_photo));
        }

        // モンスターとの関連付け
        $this->book->user_creature_id = $current->id;
        $this->book->save();

        // 投稿数に応じてステージ進化（2冊ごと、最大6）
        $bookCount = $current->books()->count();
        // $newStage = min(6, floor($bookCount / 2) + 1);
        // 検証用-1冊で1 stage up
        $newStage = min(6, floor($bookCount / 1));

        $changed = false;

        if ($current->stage < $newStage) {
            $current->stage = $newStage;
            $changed = true;
        }

        if ($newStage === 6 && $current->current) {
            $current->current = false;
            $changed = true;
        }

        if ($changed) {
            $current->save();
        }

        return redirect()->route('profile.show', $user->id);
    }

    public function show($id)
    {
        $book = $this->book->findOrFail($id);

        return view('users.books.show')->with('book', $book);
    }

        public function edit($id)
    {
        $book = $this->book->findOrFail($id);

        if(Auth::user()->id !== $book->user->id){
            return redirect()->route('index');
        }

        return view('users.books.edit')->with('book', $book);
    }

        public function update(Request $request, $id)
    {

        $book = $this->book->findOrFail($id);

        $request->validate([
            'title' => 'required|min:1|max:150',
            'author_name' => 'required|min:1|max:50',
            'impression' => 'required|min:1|max:1000',
            'cover_photo' => 'mimes:jpeg,jpg,png,gif|max:1048',
        ]);

        $book->title = $request->title;
        $book->author_name = $request->author_name;
        $book->impression = $request->impression;
        if($request->cover_photo){
            $book->cover_photo = 'data:image/' . $request->cover_photo->extension() . ';base64,' . base64_encode(file_get_contents($request->cover_photo));
        }
        
        $book->save();

        // return redirect()->route('profile.show')?;
        return redirect()->route('book.show', $book->id);
    }

    //     public function destroy($id)
    // {
    //     $book = $this->book->findOrFail($id);

    //     $book->delete();

    //     return redirect()->route('index');
    // }

    public function destroy($id)
    {
        $book = $this->book->findOrFail($id);
        $user = $book->user; // 投稿者（育成主）

        // 投稿に紐づくモンスター（user_creature_id）を取得
        $userCreature = $book->userCreature;

        $book->delete(); // 本を削除

        // 「育成中」のモンスターのみステージを再評価（紐づいていれば）
        if ($userCreature && $userCreature->current) {
            $bookCount = $userCreature->books()->count(); // ←このモンスターに紐づいた投稿の数
             // 2冊で1段階UPルールと仮定
            //  $newStage = min(6, floor($bookCount / 2) + 1);
            // 検証用-1冊で1段階UPルール
             $newStage = min(6, floor($bookCount / 1));

            if ($userCreature->stage !== $newStage) {
                $userCreature->stage = $newStage;

                // 完了モンスターは完了状態を維持するため、current の変更は行わない
                $userCreature->save();
            }
        }

        return redirect()->route('index');
    }

}
