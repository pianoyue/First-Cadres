<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCadre;
use App\Models\Comment;
use App\Models\Cadre;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class CommentController extends BaseController
{
    public function index(Request $request)   //个人评论界面
    {
        $request = $request->all();

        $cadre=Cadre::find($request['id']);
        $str=$cadre['cadreRegion_c'].$cadre['cadreRegion_t'].$cadre['cadreRegion_v'];
        $comment=Comment::paginate(15);

        //返回评论视图并传被操作用户、评论参数
        return View('admin.comment.comment_index',[
            'cadre' => $cadre,
            'str' => $str,
            'comments' => $comment,
            'pagination' => $comment->links('pagination.default')]);
    }

    public function store(Request $request)     //增加评论
    {
        $request = $request->all();

        try{
            $comment = $this->create($request);
            return $comment ? redirect('/comment_total') :$comment ;
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

        return redirect('/comment_total');

    }

}







