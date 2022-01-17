<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Comment;
use App\Models\User;
use Validator;
use App\Http\Resources\Comment as CommentResource;
   
class CommentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Comments = Comment::all();
    
        return $this->sendResponse(CommentResource::collection($Comments), 'Comments retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'blog_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $Comment = Comment::create($input);
   
        return $this->sendResponse(new CommentResource($Comment), 'Comment created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Comment = Comment::find($id);

        if (is_null($Comment)) {
            return $this->sendError('Comment not found.');
        }
   
        return $this->sendResponse(new CommentResource($Comment), 'Comment retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $Comment)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'blog_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $Comment->blog_id = $input['blog_id'];
        $Comment->name = $input['name'];
        $Comment->email = $input['email'];
        $Comment->comment = $input['comment'];
        $Comment->save();
   
        return $this->sendResponse(new CommentResource($Comment), 'Comment updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $Comment)
    {
        $Comment->delete();
   
        return $this->sendResponse([], 'Comment deleted successfully.');
    }
}