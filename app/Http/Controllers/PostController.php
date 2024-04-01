<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

  public function postForm()
  {
    return view('create');
  }
  
  public function uploadCreate(Request $request)
  {
    if($request->hasFile('upload'))
    {
      $originName = $request->file('upload')->getClientOriginalName();
      $fileName = pathinfo($originName, PATHINFO_FILENAME);
      $extension = $request->file('upload')->getClientOriginalExtension();
      $fileName = $fileName . '_' . time() . '.' . $extension;

      $request->file('upload')->move(public_path('media'), $fileName);

      $url = asset('media/' . $fileName);
      return response()->json([
        'filename' => $fileName, 
        'uploaded' => 1, 
        'url' => $url
      ]);
    }
  }
  
  public function uploadUpdate(Request $request)
  {
    if($request->hasFile('upload'))
    {
      $originName = $request->file('upload')->getClientOriginalName();
      $fileName = pathinfo($originName, PATHINFO_FILENAME);
      $extension = $request->file('upload')->getClientOriginalExtension();
      $fileName = $fileName . '_' . time() . '.' . $extension;

      $request->file('upload')->move(public_path('media'), $fileName);

      $url = asset('media/' . $fileName);
      return response()->json([
        'filename' => $fileName, 
        'uploaded' => 1, 
        'url' => $url
      ]);
    }
  }

  public function create(Request $request)
  {
    $post = new Post;

    $post->title = $request->title;
    $post->description = $request->description;

    $post->save();

    return response()->json([
      'status' => 'success', 
      'message' => 'create post success',
      'data' => $post, 
    ], 200);
  }

  public function update(Request $request, string $id)
  {
    $post = Post::find($id);

    if (!$post) {
      return redirect()->back()->with('error', 'Post not found with id' . $id);
    }

    $updated = $post->update([
      'title' => $request->title,
      'description' => $request->description,
    ]);

    if ($updated) {
      return redirect()->route('showAll')->with('success', 'Post ' . $id . ' update success');
    } else {
      return redirect()->back()->with('error', 'Post ' . $id . ' update failed');
    }

    // return response()->json([
    //   'status' => 'success', 
    //   'message' => 'update post success',
    //   'data' => $post, 
    // ], 200);
  }

  public function edit(Request $request, string $id)
  {
    $post = Post::find($id);

    return view('edit', compact('post'));

    // return response()->json([
    //   'status' => 'success', 
    //   'message' => 'get all post success',
    //   'data' => $post, 
    // ], 200);
  }

  public function showAll()
  {
    $posts = Post::all();

    return view('showAll', compact('posts'));

    // return response()->json([
    //   'status' => 'success', 
    //   'message' => 'get all post success',
    //   'data' => $post, 
    // ], 200);
  }

  public function show(string $id)
  {
    $post = Post::find($id);

    if (!$post) {
      return redirect()->back()->with('error', 'Post not found with id' . $id);
    }

    return view('show', compact('post'));

    // return response()->json([
    //   'status' => 'success', 
    //   'message' => 'get all post success',
    //   'data' => $post, 
    // ], 200);
  }

  public function delete(string $id)
  {
    $post = Post::find($id);

    if (!$post) {
      return redirect()->back()->with('error', 'Post not found with id' . $id);
    }

    $deleted = $post->delete();

    if ($deleted) {
      return redirect()->route('showAll')->with('success', 'Post ' . $id . ' delete success');
    } else {
      return redirect()->back()->with('success', 'Post ' . $id . ' delete failed');
    }
    // return response()->json([
    //   'status' => 'success', 
    //   'message' => 'get all post success',
    //   'data' => $post, 
    // ], 200);
  }
}
