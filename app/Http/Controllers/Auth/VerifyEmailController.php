<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

use App\Models\Customer;
use Illuminate\Http\Request;


class VerifyEmailController extends Controller
{
  public function __invoke(Request $request, $id, $hash)
{
  
    $user = Customer::findOrFail($id);

    // 🚨 SECURITY CHECK
    if (sha1($user->email) !== $hash) {
        abort(403, 'Invalid verification link');
    }

    $alreadyVerified = !is_null($user->email_verified_at);

    if (!$alreadyVerified) {
        $user->email_verified_at = now();
        $user->save();
    }

    return view('emails.emailVerifed', [
        'name' => $user->name,
        'email' => $user->email,
        'alreadyVerified' => $alreadyVerified,
    ]);
}

}