<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Base\Animation;
use App\Model\Base\Image as Image;
use App\Model\Base\LinkVideo;
use App\Model\Base\Presentation;
use App\Model\Base\Text;
use App\Model\Base\Video;
use App\Model\Board;
use App\Model\Input\InputAnswer;
use App\Model\Input\InputImage;
use App\Model\Input\InputQuestion;
use App\Model\Input\InputText;
use App\Model\Input\InputVideo;
use App\Model\PartBoard;
use App\Model\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;
use stdClass;

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
    public function projects()
    {
        $projects = Project::all();
        return $projects;
    }
    public function recentprojects()
    {
        $projects = Project::all()->sortByDesc('id')->values()->take(8);
        return $projects;
    }
    public function createproject(Request $request)
    {
        $cover_id = null;
        $intro_id = null;
        $develop_id = null;
        $conclusion_id = null;

        for ($totalindex = 0; $totalindex <= 3; $totalindex++) {

            $data = $request[$totalindex];

            $main_id = null;
            $sub_id = null;

            for ($subindex = 0; $subindex <= 1; $subindex++) {

                if ($subindex == 0) {
                    $field = "main";
                } else {
                    $field = "sub";
                }


                $type = $data[$field]["type"] ?? null;

                $txttype = $data[$field]["txttype"] ?? null;
                $field_id = null;


                if ($type == null) {
                    continue;
                }

                switch ($type) {
                    case "image": {
                            $image = new InputImage();
                            $image->image_id = $data[$field]["id"];
                            $image->save();
                            $boardpart = new PartBoard();
                            $boardpart->inputimage_id = $image->id;
                            $boardpart->save();
                            $field_id = $boardpart->id;

                            break;
                        }
                    case "video": {
                            $video = new InputVideo();
                            $video->video_id = $data[$field]["id"];
                            $video->save();
                            $boardpart = new PartBoard();
                            $boardpart->inputvideo_id = $video->id;
                            $boardpart->save();
                            $field_id = $boardpart->id;
                            break;
                        }
                    case "text": {
                            switch ($txttype) {
                                case "normal": {
                                        $text = new InputText();
                                        $text->title = $data[$field]["content"]["title"];
                                        $text->fontfamily = $data[$field]["content"]["fontfamily"];
                                        $text->fontsize = $data[$field]["content"]["fontsize"];
                                        $text->textcolor = $data[$field]["content"]["textcolor"];
                                        $text->bgcolor = $data[$field]["content"]["bgcolor"];
                                        $text->save();
                                        $boardpart = new PartBoard();
                                        $boardpart->inputtext_id = $text->id;
                                        $boardpart->save();
                                        $field_id = $boardpart->id;
                                        break;
                                    }
                                case "question1": {
                                        $question = new InputQuestion();
                                        $question->title = $data[$field]["content"]["title"];
                                        $question->fontfamily = $data[$field]["content"]["fontfamily"];
                                        $question->fontsize = $data[$field]["content"]["fontsize"];
                                        $question->textcolor = $data[$field]["content"]["textcolor"];
                                        $question->bgcolor = $data[$field]["content"]["bgcolor"];
                                        $question->save();
                                        $boardpart = new PartBoard();
                                        $boardpart->inputquestion_id = $question->id;
                                        $boardpart->save();
                                        $field_id = $boardpart->id;
                                        $inputanswer1 = new InputAnswer();
                                        $inputanswer1->question_id = $question->id;
                                        $inputanswer1->content = $data[$field]["content"]["answer1"];
                                        $inputanswer1->save();
                                        $inputanswer2 = new InputAnswer();
                                        $inputanswer2->question_id = $question->id;
                                        $inputanswer2->content = $data[$field]["content"]["answer2"];
                                        $inputanswer2->save();
                                        $inputanswer3 = new InputAnswer();
                                        $inputanswer3->question_id = $question->id;
                                        $inputanswer3->content = $data[$field]["content"]["answer3"];
                                        $inputanswer3->save();
                                        break;
                                    }
                            }
                        }
                }

                if ($subindex == 0) {
                    $main_id = $field_id;
                } else {
                    $sub_id = $field_id;
                }
            }
            if ($main_id !== null || $sub_id !== null) {

                $board = new Board();
                $board->main_id = $main_id;
                $board->sub_id = $sub_id;
                $board->save();

                switch ($totalindex) {
                    case 0:
                        $cover_id = $board->id;
                        break;
                    case 1:
                        $intro_id = $board->id;
                        break;
                    case 2:
                        $develop_id = $board->id;
                        break;
                    case 3:
                        $conclusion_id = $board->id;
                        break;
                }
            }
        }

        if ($cover_id !== null || $intro_id !== null || $develop_id !== null || $conclusion_id !== null) {
            $project = new Project();
            $project->title = $request->title;
            $project->cover_id = $cover_id;
            $project->intro_id = $intro_id;
            $project->develop_id = $develop_id;
            $project->conclusion_id = $conclusion_id;
            $project->save();
        }

        return $request;
    }

    public function getProjectById($id)
    {
        $result = new stdClass();

        $project = Project::find($id);

        $result->title = $project->title;

        $result->data = new stdClass();

        $project = array(
            'cover_id' => $project->cover_id,
            'intro_id' => $project->intro_id,
            'develop_id' => $project->develop_id,
            'conclusion_id' => $project->conclusion_id
        );

        foreach ($project as $key => $value) {

            $cover = Board::find($value);

            if ($key == 'cover_id') {
                $key = "0";
            }
            if ($key == 'intro_id') {
                $key = "1";
            }
            if ($key == 'develop_id') {
                $key = "2";
            }
            if ($key == 'conclusion_id') {
                $key = "3";
            }

            $result->data->$key = new stdClass();

            // if ($value == null) {
            //     continue;
            // }

            $cover = array(
                'main_id' => $cover->main_id ?? null,
                'sub_id' => $cover->sub_id ?? null
            );

            foreach ($cover as $subkey => $subvalue) {

                $content = new stdClass();

                $boardpart = PartBoard::find($subvalue);

                if ($subkey == 'main_id') {
                    $subkey = "main";
                }
                if ($subkey == 'sub_id') {
                    $subkey = "sub";
                }

                $result->data->$key->$subkey = new stdClass();

                if ($subvalue == null) {
                    continue;
                }

                if ($boardpart->inputimage_id !== null) {
                    $image = $boardpart->inputimage->image;
                    $content->type = "image";
                    $content->id = $image->id;
                    $content->name = $image->name;
                    $content->src = $image->src;
                }
                if ($boardpart->inputvideo_id !== null) {
                    $video = $boardpart->inputvideo->video;
                    $content->type = "video";
                    $content->id = $video->id;
                    $content->name = $video->name;
                    $content->src = $video->src;
                }
                if ($boardpart->inputtext_id !== null) {
                    $text = $boardpart->inputtext;

                    $content->type = "text";
                    $content->txttype = "normal";
                    $content->content = new stdClass;
                    $content->content->title = $text->title;
                    $content->content->fontfamily = $text->fontfamily;
                    $content->content->fontsize = $text->fontsize;
                    $content->content->textcolor = $text->textcolor;
                    $content->content->bgcolor = $text->bgcolor;

                }
                if ($boardpart->inputquestion_id !== null) {
                    $question = $boardpart->inputquestion;
                    $answers = $question->answers;

                    $content->type = "text";
                    $content->txttype = "question1";
                    $content->content =  new stdClass();

                    $content->content->title = $question->title;
                    $content->content->fontfamily = $question->fontfamily;
                    $content->content->fontsize = $question->fontsize;
                    $content->content->textcolor = $question->textcolor;
                    $content->content->bgcolor = $question->bgcolor;

                    $content->content->answer1 = $answers[0]->content;
                    $content->content->answer2 = $answers[1]->content;
                    $content->content->answer3 = $answers[2]->content;
                }

                $result->data->$key->$subkey = $content;

            }

        }
        return json_encode($result);

    }
}
