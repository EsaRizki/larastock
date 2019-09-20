<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Barang;
use Cookie;
class ChartController extends Controller
{
	public function index(Request $request, $id){
		$barang = Barang::find($request->get('barang_id'));
		$quantity = $request->get('qty');
	}
    public function add(Request $request)
    {
    	
    	
    }
}
