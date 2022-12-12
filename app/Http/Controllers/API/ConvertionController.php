<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConvertionController extends Controller
{
	public function Convertion(Request $request) {
		$validator = Validator::make($request->all(), [
			"first_scala" => "required |in:celcius,farenheit,kelvin",
			"second_scala" => "required|in:celcius,farenheit,kelvin",
			"ipt_num" => "required | numeric "
		]);

		if($validator->fails()) {
			return response()
				->json([
					"message" => "invalid field",
					"status" => false
				], 401);
		}
		
		$fs = $request->first_scala;
		$ss = $request->second_scala;
		$bcn = $request->ipt_num;

		if($fs == "celcius" && $ss == "farenheit") {
			$res = ($bcn * 9/5) + 32;

			return response()
				->json([
					"your_req" => $request->all(),
					"result" => "{$res} {$ss}",
					"formula" => "({$bcn} * 9/5) + 32)",
				]);
		} else if($fs == "celcius" && $ss == "kelvin" ) {
			$res = $bcn + 273.15;

				return response()
				->json([
					"your_req" => $request->all(),
					"result" => "{$res} {$ss}",
					"formula" => "{$bcn} + 273.15",
				]);

		} else if($fs == "farenheit" && $ss == "celcius") {
			$res = ($bcn - 32) * 5/9;

			return response()
				->json([
					"your_req" => $request->all(),
					"result" => "{$res} {$ss}",
					"formula" => "({$bcn} - 32) * 5/9",
				]);
		} else if($fs == "farenheit" && $ss == "kelvin" ) {
			$res = ($bcn - 32 ) * 5/9 + 273.15;

			return response()
				->json([
					"your_req" => $request->all(),
					"result" => "{$res} {$ss}",
					"formula" => "({$bcn} - 32) * 5/9",
				]);
		} else if($fs == "kelvin" && $ss == "celcius") {
			$res = $bcn - 273.15;

			return response()
				->json([
					"your_req" => $request->all(),
					"result" => "{$res} {$ss}",
					"formula" => "{$bcn} - 273.15",
				]);
		} else if($fs == "kelvin" && $ss == "farenheit") {
			$res = ($bcn - 273.15) * 9/5 + 32;

			return response()
				->json([
					"your_req" => $request->all(),
					"result" => "{$res} {$ss}",
					"formula" => "({$bcn} - 273.15) * 9/5 + 32",

				]);
		}
		
	}

}
