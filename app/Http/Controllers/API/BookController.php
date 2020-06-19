<?php

namespace App\Http\Controllers\API;

use App\Book;
use App\Helpers\ParamHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBook;
use App\Http\Requests\UpdateBook;
use App\Http\Resources\Book as BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $sortDirection = ParamHelper::validateSort(
            $request->query->get('sort', 'asc')
        );
        $sortField = ParamHelper::getFieldByParam($request->query->get('field', 'book'));

        $books = Book::join('authors', 'books.author_id', '=', 'authors.id')
            ->join('book_category', 'books.id', '=', 'book_category.book_id')
            ->join('categories', 'book_category.category_id', '=', 'categories.id')
            ->orderBy($sortField, $sortDirection)
            ->select([
                'books.*',
            ])
            ->groupBy('books.id')
            ->paginate(20);

        return BookResource::collection($books);
    }

    /**
     * @param StoreBook $request
     * @return BookResource
     */
    public function store(StoreBook $request)
    {
        $data = $request->validated();
        $book = new Book();
        $book->fill($data);
        $book->save();
        $book->categories()->attach($request->category_ids);

        return BookResource::make($book);
    }

    /**
     * @param int $id
     * @param UpdateBook $request
     * @return BookResource
     */
    public function update(int $id, UpdateBook $request)
    {
        $data = $request->validated();
        $book = Book::find($id);
        $book->fill($data);
        $book->save();
        $book->categories()->sync($request->category_ids);

        return BookResource::make($book);
    }
}
