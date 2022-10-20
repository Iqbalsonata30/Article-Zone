<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ArticlesList extends Component
{
    public $totalRecords;
    public $loadAmount = 7;
    public $titleArticle = 'Home ~ Article-Zone';
    public function loadMore()
    {
        $this->loadAmount += 7;
    }
    public function mount()
    {
        $this->totalRecords = Article::count();
    }
    public function render()
    {
        $User = User::firstWhere('token', Session::get('token'));
        return view('livewire.articles-list', [
            'articles' => Article::orderBy('id', 'desc')->limit($this->loadAmount)->get(),
            'title'    => $this->titleArticle,
            'user'     => $User,
        ]);
    }
}
