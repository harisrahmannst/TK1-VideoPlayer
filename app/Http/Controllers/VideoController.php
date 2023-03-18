<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
{
  protected function listFiles()
  {
    $files = File::files(public_path('videos'));
    $fileList = array();
    foreach ($files as $file) {
      $extension = $file->getExtension();
      if ($extension === 'mp4') {
        $fileList[] = $file;
      }
    }
    return $fileList;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $fileList = $this->listFiles();
    return view('list', ['files' => $fileList]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('upload');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'video' => 'required|mimetypes:video/mp4|max:20480'
    ], [
        'name.required' => 'The file name field is required',
        'name.max' => 'The file name may not be greater than 255 characters',
        'video.required' => 'The video file field is required',
        'video.mimetypes' => 'The video file must be in .mp4 format',
        'video.max' => 'The video file may not be greater than 20MB'
      ]);

    // simpan file
    $file = $request->file('video');
    $name = $validatedData['name'] . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('videos'), $name);

    // kirim response
    return redirect()->route('dashboard.index')->with('success', 'File uploaded successfully');
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
  public function edit($filename)
  {
    $filenameWithoutExt = basename($filename, "." . pathinfo($filename, PATHINFO_EXTENSION));
    return view('edit', ['filename' => $filename, 'name' => $filenameWithoutExt]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $oldfilename)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'video' => 'mimetypes:video/mp4|max:20480'
    ], [
        'name.required' => 'The file name field is required',
        'name.max' => 'The file name may not be greater than 255 characters',
        'video.mimetypes' => 'The video file must be in .mp4 format',
        'video.max' => 'The video file may not be greater than 20MB'
      ]);
    $extension = pathinfo($oldfilename, PATHINFO_EXTENSION);
    $path = public_path('videos/' . $oldfilename);
    if (($request->name . "." . $extension !== $oldfilename) && file_exists($path)) {
      $newPath = public_path('videos/' . $request->name . "." . $extension);
      rename($path, $newPath);
    }
    if (($request->hasFile('video'))) {
      $file = $request->file('video');
      $name = $validatedData['name'] . '.' . $file->getClientOriginalExtension();
      $file->move(public_path('videos'), $name);
    }
    // kirim response
    return redirect()->route('dashboard.index')->with('success', 'File updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($filename)
  {
    $filepath = public_path('videos/' . $filename);
    if (File::exists($filepath)) {
      File::delete($filepath);
    }
    return redirect()->route('dashboard.index')->with('success', 'File deleted successfully');
  }
}