<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Base\Animation;
use App\Model\Base\Image as Image;
use App\Model\Base\LinkVideo;
use App\Model\Base\Presentation;
use App\Model\Base\Text;
use App\Model\Base\Video;
use App\Model\Lesson;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function index()
    {
    }
    public function images()
    {
        $images = Image::all();
        return $images;
    }
    public function videos()
    {
        $videos = Video::all();
        return $videos;
    }
    public function texts()
    {
        $texts = Text::all();
        return $texts;
    }
    public function animations()
    {
        $animations = Animation::all();
        return $animations;
    }
    public function presentations()
    {
        $presentations = Presentation::all();
        return $presentations;
    }
    public function linkvideos()
    {
        $linkvideos = LinkVideo::all();
        return $linkvideos;
    }
    public function lessons()
    {
        $projects = Lesson::all();
        return $projects;
    }
    public function recentLessons()
    {
        $lessons = Lesson::all()->sortByDesc('id')->values()->take(8);
        return $lessons;
    }
    public function createLesson(Request $request) {

        $lesson = new Lesson();
        $lesson->content = json_encode($request->all());
        $lesson->save();

        return $request->all();

    }
    public function updateLesson(Request $request, $id)
    {
        Lesson::where('id', $id)->update(['content' => json_encode($request->all())]);
        return $request;
    }
    public function getLessonById($id)
    {
        $lesson = Lesson::find($id);
        return $lesson;
    }
}
