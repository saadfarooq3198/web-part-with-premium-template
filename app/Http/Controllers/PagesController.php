<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\GoogleFont;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::latest()->get();
        $fonts = GoogleFont::all();
        return view('pages.pages')->with('pages',$pages)->with('fonts',$fonts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new Page;
                $user->page_title = $request->page_title;
                $user->page_description = $request->page_description;
                $user->button_text = $request->button_text;
                $user->button_background_color = $request->button_background_color;
                $user->button_text_color = $request->button_text_color;
                // $user->page_slug = $request->page_slug;
                $user->page_slug = $request->page_title."_page";
                $user->page_text_font = $request->page_text_font;
                $user->save();
                return response()->json([
                    'success'=>200,
                    'message'=>'Page Added Successfully'
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        return response()->json([
            'status'=>200,
            'page'=>$page
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Page::where('id',$id)->update([
            'page_title'=>$request->page_title,
            // 'page_description'=>$request->page_description,
            'button_text'=>$request->button_text,
            'button_background_color'=>$request->button_background_color,
            'button_text_color'=>$request->button_text_color,
            'page_slug'=>$request->page_slug,
            'page_text_font'=>$request->page_text_font
        ]);
        return response()->json([
            'status'=>200,
            'message'=>'Page successfully updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Page deleted Successfully'
        ]);
    }

    // Getting all pages
    
    public function get_pages(Request $request)
    {
        if ($request->ajax()) {

            $data = Page::latest()->get();

            return DataTables::of($data)
                    ->addIndexColumn()

                    ->addColumn('edit', function($row){
                        $edit = '<td><button value="'.$row->id.'" class="edit-page btn btn-primary btn-sm">Edit</button></td>
                        ';
                        return $edit;
                     })->addColumn('delete', function($row){
                        $delete = '<td> <button value="'.$row->id.'" class="delete-page btn btn-danger btn-sm">Delete</button></td>
                        ';
                        return $delete;
                     })->rawColumns(['edit','delete'])->make(true);
            }
                    return view('pages.pages');
    }

    public function view_page($id){
        $data = Page::where('id',$id)->get();
        return view('pages.testpage',compact('data'));
    }
}
