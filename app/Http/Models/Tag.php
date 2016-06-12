<?php

namespace App\Http\Models;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Response;
use Cookie;

class Tag extends Model
{
    protected $request;
    public $timestamps = false;
    protected $table = 'tag';
    protected $fillable = array('name', 'status');

/*    public function __construct() {
        parent::__construct();
        $this->request = new \Illuminate\Support\Facades\Request();
    }*/


    public function post() {
        return $this->belongsTo('App\Http\Models\Article');
    }

    /**
     * 获取热门标签
     * @param  int $limit
     * @return array
     */
    public function getHotTags($limit = 5){
        $result = DB::table('article_tag')->select(DB::raw('tag_id,count(tag_id) as count'))
            ->groupBy('tag_id')->orderBy('count', 'desc')->get();
        $tagId = array();
        if($result){
            foreach($result as $k=>$v){
                $tagId[] = $v->tag_id;
            }
        }

        $tags = $this->whereIn('id', $tagId)->where('status', 1)->limit($limit)->get();
        return $tags;
    }

    public function getAllTags(){
        $data = $this->where('status', 1)->get()->toArray();
        if($data){
            foreach($data as $k=>$v){
                $data[$k]['count'] = DB::table('article_tag')->where('tag_id', $v['id'])->count();
            }
        }
        return $data;
    }


}
