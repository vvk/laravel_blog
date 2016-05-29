<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UeditorController extends CommonController
{
    	
    //'anchor':'~/dialogs/anchor/anchor.html',
    public function anchor(){
    	return view('admin.ueditor.anchor.anchor');
    }

    //'insertimage':'~/dialogs/image/image.html',
    public function image(){
    	return view('admin.ueditor.image.image');
    }

    //'link':'~/dialogs/link/link.html',
    public function link(){
    	return view('admin.ueditor.link.link');
    }

    //'spechars':'~/dialogs/spechars/spechars.html',
    public function spechars(){
    	return view('admin.ueditor.spechars.spechars');
    }

    //'searchreplace':'~/dialogs/searchreplace/searchreplace.html',
    public function searchreplace(){
    	return view('admin.ueditor.searchreplace.searchreplace');
    }

    //'map':'~/dialogs/map/map.html',
    public function map(){
    	return view('admin.ueditor.map.map');
    }

    //'gmap':'~/dialogs/gmap/gmap.html',
    public function gmap(){
    	return view('admin.ueditor.gmap.gmap');
    }

    //'insertvideo':'~/dialogs/video/video.html',
    public function video(){
    	return view('admin.ueditor.video.video');
    }

    //'help':'~/dialogs/help/help.html',
    public function help(){
    	return view('admin.ueditor.help.help');
    }

    //'preview':'~/dialogs/preview/preview.html',
    public function preview(){
    	return view('admin.ueditor.preview.preview');
    }

    //'emotion':'~/dialogs/emotion/emotion.html',
    public function emotion(){
    	return view('admin.ueditor.emotion.emotion');
    }

    //'wordimage':'~/dialogs/wordimage/wordimage.html',
    public function wordimage(){
    	return view('admin.ueditor.wordimage.wordimage');
    }

    //'attachment':'~/dialogs/attachment/attachment.html',
    public function attachment(){
    	return view('admin.ueditor.attachment.attachment');
    }

    //'insertframe':'~/dialogs/insertframe/insertframe.html',
    public function insertframe(){
    	return view('admin.ueditor.insertframe.insertframe');
    }

    //'edittip':'~/dialogs/table/edittip.html',
    public function edittip(){
    	return view('admin.ueditor.table.edittip');
    }

    //'edittable':'~/dialogs/table/edittable.html',
    public function edittable(){
    	return view('admin.ueditor.table.edittable');
    }

    //'edittd':'~/dialogs/table/edittd.html',
    public function edittd(){
    	return view('admin.ueditor.table.edittd');
    }

    //'webapp':'~/dialogs/webapp/webapp.html',
    public function webapp(){
    	return view('admin.ueditor.webapp.webapp');
    }

    //'snapscreen':'~/dialogs/snapscreen/snapscreen.html',
    public function snapscreen(){
    	return view('admin.ueditor.snapscreen.snapscreen');
    }

    //'scrawl':'~/dialogs/scrawl/scrawl.html',
    public function scrawl(){
    	return view('admin.ueditor.scrawl.scrawl');
    }

    //'music':'~/dialogs/music/music.html',
    public function music(){
    	return view('admin.ueditor.music.music');
    }

    //'template':'~/dialogs/template/template.html',
    public function template(){
    	return view('admin.ueditor.template.template');
    }

    //'background':'~/dialogs/background/background.html',
    public function background(){
    	return view('admin.ueditor.background.background');
    }

    //'charts': '~/dialogs/charts/charts.html'
    public function charts(){
    	return view('admin.ueditor.charts.charts');
    }
}
