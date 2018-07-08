<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCadre;
use App\Models\Comment;
use App\Models\Cadre;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class CommentTotalController extends BaseController
{
    public function index()                 //总体评论界面
    {
        $comment=Comment::paginate(15);
        return View('admin.comment.comment_total',[
            'comments' => $comment,
            'pagination' => $comment->links('pagination.default')]);
    }




    public function store(Request $request)     //增加评论
    {
        $request = $request->all();

        try{
            $comment = $this->create($request);
            return $comment ? redirect('/cadre') :$comment ;
        }catch (QueryException $exception) {
            abort(403, '包含重名标签名'.$exception);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    private function create(array $data)
    {

        return Comment::create([
            'text' => $data['text'],
            'author_id' => $data['user_id'],
            'user_id' => $data['cadre_id'],
            'user_trueName' => $data['user_trueName'],
            'level' =>$data['level']
        ]);
    }

    public function delete(Request $request)         //删除
    {
        $request = $request->all();
        $comment = Comment::destroy($request['id']);
        return $comment;
    }

    public function edit(Request $request)           //编辑评论
    {
        $request = $request->all();
        $comment=Comment::find($request['id']);
        $comment->author_id=$request['user_id'];
        $comment->text=$request['text'];
        $comment->level=$request['level'];

        $comment->save();

        return redirect('/cadre');
    }

    public function search(Request $request){      //搜索功能
        $request = $request->all();

        if($request['search_name']==null) {
            if ($request['search_level'] == null) {
                $comment = Comment::paginate(15);
                }
            else
                $comment = Comment::where('level', $request['search_level'])->paginate(15);
        }
        else {
            if (($request['search_level'] == null)) {
                $comment = Comment::where('user_trueName', $request['search_name'])->paginate(15);
            }
            else{
                $comment = Comment::where(['user_trueName'=>$request['search_name'],'level'=>$request['search_level']])->paginate(15);
            }
        }

        return View('admin.comment.comment_search', [
            'comments' => $comment,
            'pagination' => $comment->links('pagination.default')]);
    }
}







