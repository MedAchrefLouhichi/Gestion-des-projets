<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as user;


class Client extends Controller
{

  public static function deleted($id)
  {
    User::find($id)->client()->delete();
    return true;
  }

  public function actionn(Request $request)
  {
    $output = '';
    if (!empty($request->get('query'))) {
      $users = user::where('role', 3)
        ->where('name', 'like', '%' . $request->get('query') . '%')
        ->orwhere('adress', 'like', '%' . $request->get('query') . '%')
        ->orderBy('id')
        ->get();
    } else {
      $users =  user::where('role', 3);
    }



    foreach ($users as $user) {
      $output .= '
                            <tr>
                            <td class="text-center">
                            <img style="height:100px; width:100px" src="' . asset('photos/' . $user->image) . '"
                             class="img-circle">
                            </td>
                            <td>' . $user->name . '</td>
                            <td> <input type="checkbox" name="clientcheck" value="' . $user->client->id . '">
                            </td>
                            </tr>
                             ';
      return array(
        'table_data'  => $output,
      );
    }
  }
}
