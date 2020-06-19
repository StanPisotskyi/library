<?php

namespace App\Http\Controllers\API;

use App\Author;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthor;
use App\Http\Requests\UpdateAuthor;
use Illuminate\Http\Request;
use App\Http\Resources\Author as AuthorResource;

class AuthorController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return AuthorResource::collection(Author::paginate(20));
    }

    /**
     * @param StoreAuthor $request
     * @return AuthorResource
     */
    public function store(StoreAuthor $request)
    {
        $data = $request->validated();
        $author = new Author();
        $author->fill($data);
        $author->save();

        return AuthorResource::make($author);
    }

    /**
     * @param int $id
     * @param UpdateAuthor $request
     * @return AuthorResource
     */
    public function update(int $id, UpdateAuthor $request)
    {
        $data = $request->validated();
        $author = Author::find($id);
        $author->fill($data);
        $author->save();

        return AuthorResource::make($author);
    }
}
