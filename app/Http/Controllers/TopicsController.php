<?php

namespace App\Http\Controllers;

use App\Handles\ImageUploadHandler;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request,Topic $topic)
	{
		//使用预加载解决N+1的问题
        $params = $request->query();
		$topics = $topic->withOrder($request->order)->paginate(20);
		return view('topics.index', compact('topics','params'));
	}

    /**
     * 隐形路由绑定
     * @param Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
		$categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function store(TopicRequest $request,Topic $topic)
	{
		$topic->fill($request->all());
		$topic->user_id = Auth::id();
		$topic->save();

		return redirect()->route('topics.show', $topic->id)->with('message', '成功创建话题');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
		return view('topics.create_and_edit', compact('topic'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('message', '更新成功!');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', '删除成功');
	}

    /**
     * 处理编辑上传的图片
     * @param Request $request
     * @param ImageUploadHandler $uploadHandler
     * @return array
     */
	public function uploadImage(Request $request,ImageUploadHandler$uploadHandler){
        //初始化返回数据默认是失败
        $data = [
            'success'=>false,
            'msg'=>'上传失败!',
            'file_path'=>''
        ];

        $file = $request->upload_file;
        if ($file){
            //保存图片到本地
            $result = $uploadHandler->save($file,'topics',Auth::id(),1024);

            //如果图片保存成功
            if ($result ) {
                $data = [
                    'success'=>true,
                    'msg'=>'上传成功!',
                    'file_path'=>$result['path']
                ];
            }
        }

        return $data;
    }
}