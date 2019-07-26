<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\News;
use App\Helpers\GeneralHelper;
use App\Http\Requests\NewsRequest;
use App\Http\Controllers\Controller;
use DB;

class NewsController extends Controller
{

    protected $module;
    public function __construct()
    {
        $this->module = GeneralHelper::module_data('NewsController');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(10);
        return view('rcpadmin.news', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rcpadmin.news.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $form)
    {
        $insert_id =  $form->saveRequest();

        /* Activity Log Begin */
        $module = $this->module;
        $insertedData = News::find($insert_id);
        $logs = "A new News: '". $insertedData->heading . "' is created";
        GeneralHelper::EditLogFile($module->id, $logs);
        /* Activity Log End */

        return redirect('rcpadmin/news');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = news::find($id);
        return view('rcpadmin.news.edit', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $form, $id)
    {
        /* Activity Log Before Update Begin */
        $before= News::find($id);
        $beforeUpdate = [
           'Heading' => $before['heading'],
           'Link' =>  $before['link'],
            'Description' => $before['description']
        ];
        /* Acitvity Log Before Updated End */

        /* Updating the News, Using Form Request*/
        $form->updateRequest($id);
        /* News Update End */

        /* Acitvity Log After Update Begin  */
        $after = News::find($id);
        $afterUpdate = [
            'Heading' => $after['heading'],
            'Link' =>  $after['link'],
            'Description' => $after['description']
        ];


        $module = $this->module;
        $befor_change = !empty($beforeUpdate) ? json_encode($beforeUpdate) : '';
        $after_change = !empty($afterUpdate) ? json_encode($afterUpdate) : '';

        $data = GeneralHelper::getNameById('news', 'heading', $id);
        $logs = $data . ' Updated ';
        GeneralHelper::EditLogFile($module->id, $logs, $befor_change, $after_change);
        /* Activity Log End */

        return redirect('rcpadmin/news');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);

        if ($news) {
            $module = $this->module;
            $data = GeneralHelper::getNameById('news', 'heading', $id);
            $logs = $data . ' Deleted from '.$module->title;
            News::destroy($id);
            GeneralHelper::EditLogFile($module->id, $logs);
        }

        return redirect('rcpadmin/news');
    }
}
