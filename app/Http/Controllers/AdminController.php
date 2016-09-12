<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Admin;
use Hash;

class AdminController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $admins = Admin::all();
      return view ('admin.index', compact('admins'));
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      return view('admin.create');
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      $admin = new Admin();
      $admin->first_name = $request->first_name;
      $admin->last_name = $request->last_name;
      $admin->email = $request->email;
      $admin->username = $request->username;
      $admin->password = bcrypt($request->password);
      $admin->save();
      return redirect()->route('admin.index');
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
      $admin = Admin::find(decrypt($id));
      return view('admin.edit', compact('admin'));
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
      $admin = Admin::find(decrypt($id));
      $admin->first_name = $request->first_name;
      $admin->last_name = $request->last_name;
      $admin->email = $request->email;
      $admin->username = $request->username;
      if (Hash::needsRehash($request->password)) {
         $admin->password = bcrypt($request->password);
      }
      $admin->save();
      return redirect()->route('admin.index');
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      Admin::find(decrypt($id))->delete();
      return redirect()->route('admin.index');
   }
}
